<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	public $core_template   = 'backend/layouts/app';
    public $page_dir        = "backend/standart/admin/";
    public $template_data = array();
    public $limit_page = 10;

	public function __construct()
	{

		parent::__construct();
		$this->config->set_item('language', 'english');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache"); 
        $this->output->set_header("Access-Control-Allow-Origin: *"); 
        $this->load->helper(['cookie']);
        $this->load->helper(['cookie']);

        if ($lang = get_cookie('language')) {

            $this->lang->load([
                'web',
                'form_validation',
                'upload',
                'db',
            ], $lang);
        } else {
            $lang = get_lang_by_ip($this->input->ip_address());

            $this->lang->load([
                'web',
                'form_validation',
                'upload',
                'db',
            ], $lang);
            set_cookie('language', $lang, (60 * 60 * 24) * 365 );
        }
        $this->load->library([
        	'Template', 'parser', 'Datatables'
        ]);
	}

    public function response($data, $encode = true)
    {
        if ($encode) $data = json_encode($data);
        return $this->output->set_content_type('application/json')->set_output($data);
    }

     /**
    * Render pagination
    * 
    * @param Array $config 
    *
    * @return HTML
    */
    public function pagination($config = [])
    {
        $this->load->library('pagination');
        
        $config = [
            'suffix'           => isset($_GET)?'?'.http_build_query($_GET):'',
            'base_url'         => site_url($config['base_url']),
            'total_rows'       => $config['total_rows'],
            'per_page'         => $config['per_page'],
            'uri_segment'      => $config['uri_segment'],
            'num_links'        => 1,
            'num_tag_open'     => '<li>',
            'num_tag_close'    => '</li>',
            'full_tag_open'    => '<ul class="pagination">',
            'full_tag_close'   => '</ul>',
            'first_link'       => 'First',
            'first_tag_open'   => '<li>',
            'first_tag_close'  => '</li>',
            'last_link'        => 'Last',
            'last_tag_open'    => '<li>',
            'last_tag_close'   => '</li>',
            'next_link'        => 'Next',
            'next_tag_open'    => '<li>',
            'next_tag_close'   => '</li>',
            'prev_link'        => 'Prev',
            'prev_tag_open'    => '<li>',
            'prev_tag_close'   => '</li>',
            'cur_tag_open'     => '<li class="active"><a href="#">',
            'cur_tag_close'    => '</a></li>',
        ];

        $this->pagination->initialize($config);
        
        return  '<center>'.$this->pagination->create_links().'</center>';
    }


    /**
    * render admin page
    * 
    * @param String $view 
    * @param Array $data 
    * @param Boolean $bool 
    *
    * @return JSON
    */
    public function render($view = '', $data = array(), $bool = FALSE)
    {
        $this->template->enable_parser(false);
        $this->template->set_partial('content', $this->page_dir.$view, $data);
        $this->template->build($this->core_template, $data);
    }

    /**
    * User is allowed
    * 
    * @param String $perm 
    * @param Boolean $redirect 
    *
    * @return JSON
    */
    public function is_allowed($perm, $redirect = true)
    {
        if (!$this->aauth->is_loggedin()) {
            if ($redirect) {
                redirect('auth/login','refresh');
            } else {
                return false;
            }
        } else {
            if ($this->aauth->is_allowed($perm,$this->session->userdata('id'))) {
                return true;
                //return "Anda adalah admin";
                //return $this->aauth->is_allowed($perm, $this->session->userdata('id'));
            } else {
                
                if ($redirect) {
                    $this->session->set_flashdata('f_message', cclang('sorry_you_do_not_have_permission_to_access'));
                    $this->session->set_flashdata('f_type', 'warning');
                    redirect('admin/dashboard','refresh');
                }
                return false;
            }
        }

    }


    public function is_loggin()
    {
        if (!$this->aauth->is_loggedin()) {
             $this->session->set_flashdata('f_message', 'Anda harus login terlebih dahulu');
             $this->session->set_flashdata('f_type', 'warning');
            redirect('auth/login','refresh');

            return false;
        }
        return true;
    }

}


/**
* Admin controller
*
* This class will be extended with administrator class modules
*/
class Admin extends MY_Controller
{
    public $core_template   = 'backend/standart/main_layout';
    public $page_dir        = "backend/standart/admin/";
    public $template_data = array();

    public function __construct()
    {
        parent::__construct();  
		//$this->output->enable_profiler(TRUE);
        $this->is_loggin();
        
    }


    

    /**
    * Upload Files tmp
    * 
    * @param Array $data 
    *
    * @return JSON
    */
    public function upload_file($data = [])
    {
        $default = [
            'uuid'          => '', 
            'allowed_types' => '*', 
            'max_size'      => '', 
            'max_width'     => '', 
            'max_height'    => '', 
            'upload_path'   => './uploads/tmp/',
            'input_files'   => 'qqfile',
            'table_name'    => '',
        ];

        foreach ($data as $key => $value) {
            if (isset($default[$key])) {
                $default[$key] = $value;
            }
        }

        $dir = FCPATH . $default['upload_path'] . $default['uuid'];
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        if (empty($default['file_name'])) {
            $default['file_name'] = date('Y-m-d').$default['table_name'].date('His');
        }

        $config = [
            'upload_path'       => $default['upload_path'] . $default['uuid'] . '/',
            'allowed_types'     => $default['allowed_types'],
            'max_size'          => $default['max_size'],
            'max_width'         => $default['max_width'],
            'max_height'        => $default['max_height'],
            'file_name'         => $default['file_name']
        ];
        
        $this->load->library('upload', $config);
        $this->load->helper('file');

        if ( ! $this->upload->do_upload('qqfile')){
            $result = [
                'success'   => false,
                'error'     =>  $this->upload->display_errors()
            ];

            return json_encode($result);
        } else {
            $upload_data = $this->upload->data();

            $result = [
                'uploadName'    => $upload_data['file_name'],
                'previewLink'  => $dir.'/'.$upload_data['file_name'],
                'success'       => true,
            ];

            return json_encode($result);
        }
    }

    /**
    * Delete Files tmp
    * 
    * @param Array $data 
    *
    * @return JSON
    */
    public function delete_file($data = [])
    {
        $default = [
            'uuid'              => '', 
            'delete_by'         => '', 
            'field_name'        => 'image', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'test',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/blog/'
        ];

        foreach ($data as $key => $value) {
            if (isset($default[$key])) {
                $default[$key] = $value;
            }
        }

        if (!empty($default['uuid'])) {
            $this->load->helper('file');
            $delete_file = false;

            if ($default['delete_by'] == 'id') {
                $row = $this->db->get_where($default['table_name'], [$default['primary_key'] => $default['uuid']])->row();
                if ($row) {
                    $path = FCPATH . $default['upload_path'] . $row->{$default['field_name']};
                }

                if (isset($default['uuid'])) {
                    if (is_file($path)) {
                        $delete_file = unlink($path);
                        $this->db->where($default['primary_key'], $default['uuid']);
                        $this->db->update($default['table_name'], [$default['field_name'] => '']);
                    }
                }
            } else {
                $path = FCPATH . $default['upload_path_tmp'] . $default['uuid'] . '/';
                $delete_file = delete_files($path, true);
            }

            if (isset($default['uuid'])) {
                if (is_dir($path)) {
                    rmdir($path);
                }
            }

            if (!$delete_file) {
                $result = [
                    'error' =>  'Error delete file'
                ];

                return json_encode($result);
            } else {
                $result = [
                    'success' => true,
                ];

                return json_encode($result);
            }
        }
    }

    /**
    * Get Files
    * 
    * @param Array $data 
    *
    * @return JSON
    */
    public function get_file($data = [])
    {
        $default = [
            'uuid'              => '', 
            'delete_by'         => '', 
            'field_name'        => 'image', 
            'table_name'        => 'test',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/blog/',
            'delete_endpoint'   => 'administrator/blog/delete_image_file'
        ];

        foreach ($data as $key => $value) {
            if (isset($default[$key])) {
                $default[$key] = $value;
            }
        }
        
        $row = $this->db->get_where($default['table_name'], [$default['primary_key'] => $default['uuid']])->row();

        if (!$row) {
            $result = [
                'error' =>  'Error getting file'
            ];

            return json_encode($result);
        } else {
            if (!empty($row->{$default['field_name']})) {
                if (strpos($row->{$default['field_name']}, ',')) {
                    foreach (explode(',', $row->{$default['field_name']}) as $filename) {
                        $result[] = [
                            'success'               => true,
                            'thumbnailUrl'          => check_is_image_ext(base_url($default['upload_path'] . $filename)),
                            'id'                    => 0,
                            'name'                  => $row->{$default['field_name']},
                            'uuid'                  => $row->{$default['primary_key']},
                            'deleteFileEndpoint'    => base_url($default['delete_endpoint']),
                            'deleteFileParams'      => ['by' => $default['delete_by']]
                        ];
                    }
                } else {
                    $result[] = [
                        'success'               => true,
                        'thumbnailUrl'          => check_is_image_ext(base_url($default['upload_path'] . $row->{$default['field_name']})),
                        'id'                    => 0,
                        'name'                  => $row->{$default['field_name']},
                        'uuid'                  => $row->{$default['primary_key']},
                        'deleteFileEndpoint'    => base_url($default['delete_endpoint']),
                        'deleteFileParams'      => ['by' => $default['delete_by']]
                    ];
                }

                return json_encode($result);
            }
        }
    }
}

/**
 * 
 */
class Builder extends MY_Controller
{
    public $core_template   = 'backend/standart/main_layout';
    public $page_dir        = "builder/add/";
    public $template_data = array();


    protected $table_name = 'news';
    protected $data = []; 
    protected $controller_dir = 'admin/';    
    protected $views_dir = 'backend/standart/admin/';    
    protected $view_path = '';
    protected $controller_path = '';
    protected $controller_name = 'Controller';
    protected $model_path = '';    
    protected $template_crud_path = 'core_template/crud/';
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('file');
        $this->data = [
            'php_open_tag'              => '<?php',
            'php_close_tag'             => '?>',
            'php_open_tag_echo'         => '<?=',
            'table_name'                => $this->table_name,

        ];
    $this->is_loggin();
    $this->view_path = FCPATH . '/application/views/'.$this->views_dir.'/'.$this->table_name.'/';
    $this->controller_path = FCPATH . '/application/controllers/'.$this->controller_dir;
    $this->model_path = FCPATH . '/application/models/builder/';  

        //Cek Direktori
        if (!is_dir($this->view_path)) {
            mkdir($this->view_path);
        }

        if (!is_dir($this->controller_path)) {
            mkdir($this->controller_path);
        }


        if (!is_dir($this->model_path)) {
            mkdir($this->model_path);
        }
    }

    public function buildCrud()
    {
        $this->load->library('crud_builder', [
                'crud' => $_POST['crud']
                ]);
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('title', 'Subject', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('primary_key', 'Primary Key of Table', 'trim|required');

        if ($this->form_validation->run()) {
            $this->data = [
                'php_open_tag'              => '<?php',
                'php_close_tag'             => '?>',
                'php_open_tag_echo'         => '<?=',
                'table_name'                => $this->input->post('table_name'),
                'primary_key'               => $this->input->post('primary_key'),
                'subject'                   => $this->input->post('subject'),
                'non_input_able_validation' => $this->crud_builder->getNonInputableValidation(),
                'input_able_validation'     => $this->crud_builder->getInputableValidation(),
                'show_in_add_form'          => $this->crud_builder->getFieldShowInAddForm(),
                'show_in_update_form'       => $this->crud_builder->getFieldShowInUpdateForm(),
            ];
            if ($this->input->post('title')) {
                $this->data['title'] = $this->input->post('title');
            } else {
                $this->data['title'] = $this->input->post('subject');
            }

            $table_name = $this->input->post('table_name');
            $controller_name = $this->input->post('controler_name');
            $model_name = $this->input->post('model_name');


            $validate = $this->crud_builder->validateAll();

            if ($validate->isError()) {
                return $this->response([
                    'success' => false,
                    'message' => $validate->getErrorMessage()
                    ]);
                exit;
            }

            $builder_list = $this->parser->parse($this->template_crud_path.'builder_list', $this->data, true);
            write_file($this->view_path.$controller_name.'_list.php', $builder_list);

            $builder_list = $this->parser->parse($this->template_crud_path.'builder_controller', $this->data, true);
            write_file($this->controller_path.ucwords($controller_name).'.php', $builder_list);

            $builder_list = $this->parser->parse($this->template_crud_path.'builder_model', $this->data, true);
            write_file($this->model_path.'Model_'.$controller_name.'.php', $builder_list);

            if ($this->input->post('create')) {
                $this->builder_list = $this->parser->parse($this->template_crud_path.'builder_add', $this->data, true);
                write_file($this->view_path.$table_name.'_add.php', $builder_list);
                $this->aauth->create_perm($table_name.'_add');
            }

            if ($this->input->post('update')) {
                $builder_list = $this->parser->parse($this->template_crud_path.'builder_update', $this->data, true);
                write_file($this->view_path.$table_name.'_update.php', $builder_list);
                $this->aauth->create_perm($table_name.'_update');
            }
            
            if ($this->input->post('read')) {
                $builder_list = $this->parser->parse($this->template_crud_path.'builder_view', $this->data, true);
                write_file($this->view_path.$table_name.'_view.php', $builder_list);
                $this->aauth->create_perm($table_name.'_view');
            }







            // $builder_list = $this->parser->parse($this->template_crud_path.'builder_list', $this->data, true);
            // write_file($this->view_path.$this->table_name.'_list.php', $builder_list);
            // $builder_list = $this->parser->parse($this->template_crud_path.'builder_controller', $this->data, true);
            // write_file($this->controller_path.ucwords($this->table_name).'.php', $builder_list);
            // $builder_list = $this->parser->parse($this->template_crud_path.'builder_model', $this->data, true);
            // write_file($this->model_path.'Model_'.$this->table_name.'.php', $builder_list);
            // // if ($this->input->post('create')) {
            //     $builder_list = $this->parser->parse($this->template_crud_path.'builder_add', $this->data, true);
            //     write_file($this->view_path.$this->table_name.'_add.php', $builder_list);
            // // }
            // // if ($this->input->post('update')) {
            //     $builder_list = $this->parser->parse($this->template_crud_path.'builder_update', $this->data, true);
            //     write_file($this->view_path.$this->table_name.'_update.php', $builder_list);
            // // }
            // // if ($this->input->post('read')) {
            //     $builder_list = $this->parser->parse($this->template_crud_path.'builder_view', $this->data, true);
            //     write_file($this->view_path.$this->table_name.'_view.php', $builder_list);
            //}

            $this->aauth->create_perm($table_name.'_delete');
            $this->aauth->create_perm($table_name.'_list');

            $save_data = [
                'table_name'        => $this->input->post('table_name'),
                'primary_key'       => $this->input->post('primary_key'),
                'subject'           => $this->input->post('subject'),
                'title'             => $this->input->post('title'),
                'page_read'         => $this->input->post('read'),
                'page_update'       => $this->input->post('update'),
                'page_create'       => $this->input->post('create'),
            ];

            if ($id_crud = $this->model_crud->crud_exist($this->input->post('table_name'))) {
                $this->model_crud->change($id_crud, $save_data);
            } else {
                $id_crud = $this->model_crud->store($save_data);
            }
            $save_data_field = [];
            $this->db->delete('crud_field', ['crud_id' => $id_crud]);
            $this->db->delete('crud_field_validation', ['crud_id' => $id_crud]);
            $this->db->delete('crud_custom_option', ['crud_id' => $id_crud]);

            foreach ($this->input->post('crud') as $val) {
                $field_name = array_keys($val)[0];
                $field_label = isset($val[$field_name]['label']) ? $val[$field_name]['label'] : '';
                $input_type = isset($val[$field_name]['input_type']) ? $val[$field_name]['input_type'] : '';
                $show_in_column = isset($val[$field_name]['show_in_column']) ? $val[$field_name]['show_in_column'] : '';
                $show_in_add_form = isset($val[$field_name]['show_in_add_form']) ? $val[$field_name]['show_in_add_form'] : '';
                $show_in_add_form = isset($val[$field_name]['show_in_add_form']) ? $val[$field_name]['show_in_add_form'] : '';
                $show_in_update_form = isset($val[$field_name]['show_in_update_form']) ? $val[$field_name]['show_in_update_form'] : '';
                $show_in_detail_page = isset($val[$field_name]['show_in_detail_page']) ? $val[$field_name]['show_in_detail_page'] : '';
                $relation_table = isset($val[$field_name]['relation_table']) ? $val[$field_name]['relation_table'] : '';
                $relation_value = isset($val[$field_name]['relation_value']) ? $val[$field_name]['relation_value'] : '';
                $relation_label = isset($val[$field_name]['relation_label']) ? $val[$field_name]['relation_label'] : '';
                $sort = isset($val[$field_name]['sort']) ? $val[$field_name]['sort'] : '';

                $save_data_field = [
                    'crud_id'               => $id_crud,
                    'field_name'            => $field_name,
                    'field_label'           => $field_label,
                    'input_type'            => $input_type,
                    'show_column'           => $show_in_column,
                    'show_add_form'         => $show_in_add_form,
                    'show_update_form'      => $show_in_update_form,
                    'show_detail_page'      => $show_in_detail_page,
                    'sort'                  => $sort,
                    'relation_table'        => $relation_table,
                    'relation_value'        => $relation_value,
                    'relation_label'        => $relation_label,
                ];

                $this->db->insert('crud_field', $save_data_field);

                $crud_field_id = $this->db->insert_id();

                $save_data_rule = [];

                if (isset($val[$field_name]['validation']['rules'])) {
                    foreach ($val[$field_name]['validation']['rules'] as $rule => $value) {
                        $save_data_rule[] = [
                            'crud_field_id'     => $crud_field_id, 
                            'crud_id'           => $id_crud,
                            'validation_name'   => $rule, 
                            'validation_value'  => $value
                        ];
                    }
                }

                $save_data_option = [];

                if (isset($val[$field_name]['custom_option'])) {
                    foreach ($val[$field_name]['custom_option'] as $option) {
                        if (!empty($option['value']) or !empty($option['label'])) {
                            $save_data_option[] = [
                                'crud_field_id'     => $crud_field_id, 
                                'crud_id'           => $id_crud,
                                'option_value'      => $option['value'], 
                                'option_label'      => $option['label']
                            ];
                        }
                    }
                }

                if (count($save_data_rule)) {
                    $this->db->insert_batch('crud_field_validation', $save_data_rule);
                }
                if (count($save_data_option)) {
                    $this->db->insert_batch('crud_custom_option', $save_data_option);
                }
            }

            if ($this->input->post('save_type') == 'stay') {
                $this->response['success'] = true;
                $this->response['message'] = cclang('success_save_data_stay', [
                    anchor('admin/crud', ' Go back to list'),
                    anchor('admin/'.$this->input->post('table_name'), ' View')
                ]);
            } else {
                set_message(
                    cclang('success_save_data_redirect', [
                    anchor('admin/'.$this->input->post('table_name'), ' View')
                ]), 'success');
                $this->response['success'] = true;
                $this->response['redirect'] = site_url('admin/crud');
            }
        } else {
            $this->response['success'] = false;
            $this->response['message'] = validation_errors();
        }

        return json_encode($this->response);

        
    }
}



/**
 * Auth COntroller
 */
class Authentication extends MY_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }
}


/**
 * 
 */
class Frontend extends MY_Controller
{
    public $core_template   = 'core_template/landing_layout';
    public $page_dir        = "frontend/landing/";
    public $template_data = array();
    
    function __construct()
    {
        parent::__construct();
        
    }


    public function landing_login()
    {
        if (!$this->aauth->is_loggedin()) {
             $this->session->set_flashdata('f_message', 'Anda harus Memasukkan nomer pendaftaran terlebih dahulu');
             $this->session->set_flashdata('f_type', 'warning');
            redirect('/','refresh');

            return false;
        }
        return true;
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */