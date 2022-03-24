<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Master_dosen extends MY_Model {

		protected $primary_key 	= 'id';
	protected $table 	= 'master_dosen';
	protected $field_search 	= ['nik', 'nama_lengkap', 'no_ktp', 'email', 'id_master_prodi', 'fungsional', 'foto'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct();
	}

	public function getDatatable()
	{
				$this->datatables->select('master_dosen.nik, master_dosen.nama_lengkap, master_dosen.no_ktp, master_dosen.email, aauth_departement.departement, pejabats.jabatan, master_dosen.foto');
		$this->datatables->join("aauth_departement", "aauth_departement.id = master_dosen.id_master_prodi");
$this->datatables->join("pejabats", "pejabats.id = master_dosen.fungsional");        $this->datatables->from($this->table);
        $this->db->order_by($this->primary_key,'dsc');

        $btn_edit = false;
        if ($this->is_allowed('master_dosen_update', false) == true) {
        	$btn_edit = '
        		        	<a title="Edit data terpilih" class="btn btn-xs btn-warning" href="'. site_url('admin/master_dosen/edit/$1').'">
        		            <i class="fa fa-pencil"></i>
        		          </a>';
        }
        $btn_delete = false;
        if ($this->is_allowed('master_dosen_delete', false) == true) {
        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete" data-id="$1" >
        	                    <i class="fa fa-trash"></i>
        	                  </button>	';
        }
		$status = false;
		$btn_detail = '<button title="Detail" type="button" class="btn btn-xs btn-info 					" data-id="$1" >
        	                    <i class="fa fa-eye"></i>
        	                  </button>	';
		if ($this->is_allowed('master_dosen_benned', false) == true) {
      		$status = true;
      	}		        	                  
       $this->datatables->add_column('btn_edit', $btn_edit, 'id')
       ->add_column('btn_delete', $btn_delete, 'id')
       ->add_column('btn_detail', $btn_detail, 'id')
       ->add_column('status', $status);	
       
        return $this->response($this->datatables->generate(), false);
	}
}