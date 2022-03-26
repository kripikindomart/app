<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Karyawan Controller
*| --------------------------------------------------------------------------
*| Karyawan site
*|
*/

class Karyawan extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_Karyawan');
	}

	public function index()
	{
		//$this->is_allowed('Karyawan_list') ;
		$this->template->title('Data Karyawan');
		$data = [];
		$this->render('Karyawan/karyawan_list', $data);
	}

	public function getDatatable()
	{
	$this->datatables->select('karyawans.id, karyawans.code, karyawans.nik, karyawans.nama, karyawans.email, karyawans.jenis_kelamin, karyawans.photo, program_studis.nama as prodi, departements.nama as departements, karyawans.status_akun');
		$this->datatables->join("program_studis", "program_studis.id = karyawans.program_studi_id");
	$this->datatables->join("departements", "departements.id = karyawans.departement_id");        $this->datatables->from('karyawans');
        $this->db->order_by('karyawans.id','dsc');

        $btn_edit = false;
        if ($this->is_allowed('karyawan_update', false) == true) {
        	$btn_edit = '
        		        	<a title="Edit data terpilih" class="btn btn-xs btn-warning" href="'. site_url('admin/karyawan/edit/$1').'">
        		            <i class="fa fa-pencil"></i>
        		          </a>';
        }
        $btn_delete = false;
        if ($this->is_allowed('karyawan_delete', false) == true) {
        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete" data-id="$1" >
        	                    <i class="fa fa-trash"></i>
        	                  </button>	';
        }
		$status = false;
		$btn_detail = '<button title="Detail" type="button" class="btn btn-xs btn-info 					" data-id="$1" >
        	                    <i class="fa fa-eye"></i>
        	                  </button>	';
		if ($this->is_allowed('karyawan_benned', false) == true) {
      		$status = true;
      	}		        	                  
       $this->datatables->add_column('btn_edit', $btn_edit, 'id')
       ->add_column('btn_delete', $btn_delete, 'id')
       ->add_column('btn_detail', $btn_detail, 'id')
       ->add_column('status', $status);	
       
        return $this->response($this->datatables->generate(), false);
	}

}