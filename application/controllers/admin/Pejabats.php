<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pejabats Controller
*| --------------------------------------------------------------------------
*| Pejabats site
*|
*/

class Pejabats extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_Pejabats');
	}

	public function index()
	{
		//$this->is_allowed('Pejabats_list') ;
		$this->template->title('Pejabats');
		$data = [];
		$this->render('Pejabats/pejabats_list', $data);
	}

	public function getDatatable()
	{
				$this->datatables->select('pejabats.id, karyawans.nama as karyawans_nama, pengajars.nama as pengajars_nama, departements.nama as departements_nama, pejabats.jabatan, pejabats.ttd, pejabats.status');
		$this->db->join("karyawans", "karyawans.id = pejabats.karyawan_id", "left");
$this->db->join("pengajars", "pengajars.id = pejabats.pengajar_id", "left");
$this->db->join("departements", "departements.id = pejabats.departement_id", "left");        $this->datatables->from('pejabats');
        $this->db->order_by('pejabats.id','dsc');

        $btn_edit = false;
        if ($this->is_allowed('pejabats_update', false) == true) {
        	$btn_edit = '
        		        	<a title="Edit data terpilih" class="btn btn-xs btn-warning" href="'. site_url('admin/pejabats/edit/$1').'">
        		            <i class="fa fa-pencil"></i>
        		          </a>';
        }
        $btn_delete = false;
        if ($this->is_allowed('pejabats_delete', false) == true) {
        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete" data-id="$1" >
        	                    <i class="fa fa-trash"></i>
        	                  </button>	';
        }
		$status = false;
		$btn_detail = '<button title="Detail" type="button" class="btn btn-xs btn-info 					" data-id="$1" >
        	                    <i class="fa fa-eye"></i>
        	                  </button>	';
		if ($this->is_allowed('pejabats_benned', false) == true) {
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
		$data = $this->model_Pejabats->getDatatable();
		$data_row = array();
			$no = $_POST['start'];
			foreach ($data as $row) {
				


				$no++;
				$data_row = array();
				$data_row[] = '<input type="checkbox" class="data-check" value="'.$row->id.'">';
				$data_row[] = $no;
				       
			    $data_row[] = $row->id;  
			                      
			    			    $data_row[] = $row->karyawans_nama;
			             			    $data_row[] = $row->pengajars_nama;
			             			    $data_row[] = $row->departements_nama;
			                    
			    $data_row[] = $row->jabatan;  
			                      
			     


			    if (is_file(FCPATH . 'uploads/user/' . $row->ttd)): 
                 $img_url = base_url() . 'uploads/user/' .$row->ttd; 
                 else: 
                 $img_url = base_url() . 'uploads/user/default.png'; 
                 endif; 
                 $data_row[] = '<a class="fancybox" rel="group" href="'.$img_url.'">
                          <img src="'.$img_url.'" alt="Person" width="50" height="50">
                       	 </a>';

			                     
			    $data_row[] = $row->status;  
			                      
			    
				//add html for action
				$data_row[] = '
				<div class="text-center"><button type="button" class="btn btn-sm btn-warning edit" title="Edit" id="edit" data-id = "'.$row->id.'"><i class="fa fa-pencil"></i>Edit </button>
				<button type="button" class="btn btn-sm btn-danger delete" title="Delete" id="delete" data-id = "'.$row->id.'"><i class="fa fa-trash"></i>Delete</button></div>';
				$data_[] = $data_row;
			}

			$json_data = [
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->model_Pejabats->count_all(),
				"recordsFiltered" => $this->model_Pejabats->_count_filtered(),
				'data' => $data_
			];

			return $this->response($json_data);
		}
		
	}

}