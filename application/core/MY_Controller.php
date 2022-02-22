<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	public $core_template   = 'backend/layouts/app';
    public $page_dir        = "backend/standart/admin/";
    public $template_data = array();

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
    protected $controller_dir = 'admin/Builder/';    
    protected $views_dir = 'builder/';    
    protected $view_path = '';
    protected $controller_path = '';
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
        $builder_list = $this->parser->parse($this->template_crud_path.'builder_list', $this->data, true);
        write_file($this->view_path.$this->table_name.'_list.php', $builder_list);
        $builder_list = $this->parser->parse($this->template_crud_path.'builder_controller', $this->data, true);
        write_file($this->controller_path.ucwords($this->table_name).'.php', $builder_list);
        $builder_list = $this->parser->parse($this->template_crud_path.'builder_model', $this->data, true);
        write_file($this->model_path.'Model_'.$this->table_name.'.php', $builder_list);
        // if ($this->input->post('create')) {
            $builder_list = $this->parser->parse($this->template_crud_path.'builder_add', $this->data, true);
            write_file($this->view_path.$this->table_name.'_add.php', $builder_list);
        // }
        // if ($this->input->post('update')) {
            $builder_list = $this->parser->parse($this->template_crud_path.'builder_update', $this->data, true);
            write_file($this->view_path.$this->table_name.'_update.php', $builder_list);
        // }
        // if ($this->input->post('read')) {
            $builder_list = $this->parser->parse($this->template_crud_path.'builder_view', $this->data, true);
            write_file($this->view_path.$this->table_name.'_view.php', $builder_list);
        // }
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