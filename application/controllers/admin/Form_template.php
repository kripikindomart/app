<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Template Controller
*| --------------------------------------------------------------------------
*| Form Template site
*|
*/

class Form_template extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_Form_template');
		$this->load->model('Model_pejabat', 'pejabat');
	}

	public function index()
	{
		//$this->is_allowed('form_template_list') ;
		$this->template->title('Template Form');
		$data = [];
		$this->render('Form_template/form_template_list', $data);
	}

	public function getDatatable()
	{
				$this->datatables->select('mdtemplate_form.id, mdtemplate_form.nama_template, pejabats.jabatan as pejabats_jabatan, mdtemplate_form.aktif');
		$this->db->join("pejabats", "pejabats.id = mdtemplate_form.pejabat_id", "left");        $this->datatables->from('mdtemplate_form');
        $this->db->order_by('mdtemplate_form.id','dsc');

        $btn_edit = false;
        if ($this->is_allowed('form_template_update', false) == true) {
        	$btn_edit = '
        		        	<a title="Edit data terpilih" class="btn btn-xs btn-warning" href="'. site_url('admin/form_template/edit/$1').'">
        		            <i class="fa fa-pencil"></i>
        		          </a>';
        }
        $btn_delete = false;
        if ($this->is_allowed('form_template_delete', false) == true) {
        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete" data-id="$1" >
        	                    <i class="fa fa-trash"></i>
        	                  </button>	';
        }
		$status = false;
		$btn_detail = '<button title="Detail" type="button" class="btn btn-xs btn-info 					" data-id="$1" >
        	                    <i class="fa fa-eye"></i>
        	                  </button>	';
		if ($this->is_allowed('form_template_benned', false) == true) {
      		$status = true;
      	}		        	                  
       $this->datatables->add_column('btn_edit', $btn_edit, 'id')
       ->add_column('btn_delete', $btn_delete, 'id')
       ->add_column('btn_detail', $btn_detail, 'id')
       ->add_column('status', $status);	
       
        return $this->response($this->datatables->generate(), false);
	}

	public function ajax()
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
		$data = $this->model_Form_template->getRequestAjax();
		$data_row = array();
			$no = $_POST['start'];
			$data_ = array();
			foreach ($data as $row) {
				$no++;
				$data_row = array();
				$data_row[] = '<input type="checkbox" class="data-check check checkbox icheckbox_flat-green toltip" value="'.$row->id.'" name="data-check[]">';
				$data_row[] = $no;
				  
			         
			      
			    			    $data_row[] = $row->nama_template;  
			          
			    			    $data_row[] = $row->pejabats_jabatan;
			      
			    			    $data_row[] = $row->aktif;  
			          
			    
				//add html for action
				$data_row[] = '
				<div class="text-center"><button type="button" class="btn btn-sm btn-warning edit" title="Edit" id="edit" data-id = "'.$row->id.'"><i class="fa fa-pencil"></i>Edit </button>
				<button type="button" class="btn btn-sm btn-danger delete" title="Delete" id="delete" data-id = "'.$row->id.'"><i class="fa fa-trash"></i>Delete</button></div>';
				$data_[] = $data_row;
			}

			$json_data = [
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->model_Form_template->count_all(),
				"recordsFiltered" => $this->model_Form_template->_count_filtered(),
				'data' => $data_
			];

			return $this->response($json_data);
		}
		
	}

	public function add()
	{
		//$this->is_allowed('form_template_add') ;
		$this->template->title('Template Form');
		$pejabat = $this->pejabat->resultData();
		
		$data = [
			'pejabat' => $pejabat
		];
		$this->render('Form_template/form_template_add', $data);
	}

	

}