<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dosen Controller
*| --------------------------------------------------------------------------
*| Dosen site
*|
*/

class Dosen extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_Dosen');
	}

	public function index()
	{
		//$this->is_allowed('Dosen_list') ;
		$this->template->title('Dosen');
		$data = [];
		$this->render('Dosen/dosen_list', $data);
	}

	public function getDatatable()
	{
				$this->datatables->select('master_dosen.id, master_dosen.nik, master_dosen.nama_lengkap, master_dosen.jenis_kelamin, master_dosen.no_ktp, master_dosen.gelar_kesarjanaan, master_dosen.tempat_lahir, master_dosen.tanggal_lahir, master_dosen.status_kawin, master_dosen.alamat_rumah, master_dosen.email, master_dosen.no_hp, program_studis.nama as program_studis_nama, master_dosen.fungsional, master_dosen.golongan, master_dosen.foto, master_dosen.status_dosen');
		$this->db->join("program_studis", "program_studis.id = master_dosen.id_master_prodi", "left");        $this->datatables->from('master_dosen');
        $this->db->order_by('master_dosen.id','dsc');

        $btn_edit = false;
        if ($this->is_allowed('dosen_update', false) == true) {
        	$btn_edit = '
        		        	<a title="Edit data terpilih" class="btn btn-xs btn-warning" href="'. site_url('admin/dosen/edit/$1').'">
        		            <i class="fa fa-pencil"></i>
        		          </a>';
        }
        $btn_delete = false;
        if ($this->is_allowed('dosen_delete', false) == true) {
        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete" data-id="$1" >
        	                    <i class="fa fa-trash"></i>
        	                  </button>	';
        }
		$status = false;
		$btn_detail = '<button title="Detail" type="button" class="btn btn-xs btn-info 					" data-id="$1" >
        	                    <i class="fa fa-eye"></i>
        	                  </button>	';
		if ($this->is_allowed('dosen_benned', false) == true) {
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
		$data = $this->model_Dosen->getRequestAjax();
		$data_row = array();
			$no = $_POST['start'];
			foreach ($data as $row) {
				$no++;
				$data_row = array();
				$data_row[] = '<input type="checkbox" class="data-check check checkbox icheckbox_flat-green toltip" value="'.$row->id.'" name="data-check[]">';
				$data_row[] = $no;
				  
			         
			      
			    			    $data_row[] = $row->nik;  
			          
			      
			    			    $data_row[] = $row->nama_lengkap;  
			          
			      
			    			    $data_row[] = $row->jenis_kelamin;  
			          
			      
			    			    $data_row[] = $row->no_ktp;  
			          
			      
			    			    $data_row[] = $row->gelar_kesarjanaan;  
			          
			      
			    			    $data_row[] = $row->tempat_lahir;  
			          
			      
			    			    $data_row[] = $row->tanggal_lahir;  
			          
			      
			    			    $data_row[] = $row->status_kawin;  
			          
			      
			    			    $data_row[] = $row->alamat_rumah;  
			          
			      
			    			    $data_row[] = $row->email;  
			          
			      
			    			    $data_row[] = $row->no_hp;  
			          
			    			    $data_row[] = $row->program_studis_nama;
			      
			    			    $data_row[] = $row->fungsional;  
			          
			      
			    			    $data_row[] = $row->golongan;  
			          
			      
			    			    $data_row[] = $row->foto;  
			          
			      
			    			    $data_row[] = $row->status_dosen;  
			          
			    
				//add html for action
				$data_row[] = '
				<div class="text-center"><button type="button" class="btn btn-sm btn-warning edit" title="Edit" id="edit" data-id = "'.$row->id.'"><i class="fa fa-pencil"></i>Edit </button>
				<button type="button" class="btn btn-sm btn-danger delete" title="Delete" id="delete" data-id = "'.$row->id.'"><i class="fa fa-trash"></i>Delete</button></div>';
				$data_[] = $data_row;
			}

			$json_data = [
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->model_Dosen->count_all(),
				"recordsFiltered" => $this->model_Dosen->_count_filtered(),
				'data' => $data_
			];

			return $this->response($json_data);
		}
		
	}

	

}