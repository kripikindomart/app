<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Student Controller
*| --------------------------------------------------------------------------
*| Student site
*|
*/

class Student extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_Student');
	}

	public function index()
	{
		//$this->is_allowed('Student_list') ;
		$this->template->title('Data Siswa');
		$data = [];
		$this->render('Student/student_list', $data);
	}

	public function getDatatable()
	{
				$this->datatables->select('program_studis.nama as program_studis_nama, students.kelas_id, students.subkelas_id, students.total_semester, students.code, students.nik, students.nama, students.email, students.status_mahasiswa, students.status_penerimaan, students.jenis_kelamin, students.tempat_lahir, students.tanggal_lahir, students.alamat, students.kode_pos, students.no_hp, students.pendidikan_terakhir, students.asal_universitas_s1, students.asal_universitas_s2, students.asal_universitas_s3, students.gelar_terakhir, students.pekerjaan, students.alamat_pekerjaan, students.nama_ibu, students.photo, students.judul_thesis, students.status_akun, students.daftar_tgl, students.diterima_tgl, students.created_at, students.updated_at');
		$this->datatables->join("program_studis", "program_studis.id = students.program_studi_id");        $this->datatables->from('students');
        $this->db->order_by('students.id','dsc');

        $btn_edit = false;
        if ($this->is_allowed('student_update', false) == true) {
        	$btn_edit = '
        		        	<a title="Edit data terpilih" class="btn btn-xs btn-warning" href="'. site_url('admin/student/edit/$1').'">
        		            <i class="fa fa-pencil"></i>
        		          </a>';
        }
        $btn_delete = false;
        if ($this->is_allowed('student_delete', false) == true) {
        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete" data-id="$1" >
        	                    <i class="fa fa-trash"></i>
        	                  </button>	';
        }
		$status = false;
		$btn_detail = '<button title="Detail" type="button" class="btn btn-xs btn-info 					" data-id="$1" >
        	                    <i class="fa fa-eye"></i>
        	                  </button>	';
		if ($this->is_allowed('student_benned', false) == true) {
      		$status = true;
      	}		        	                  
       $this->datatables->add_column('btn_edit', $btn_edit, 'id')
       ->add_column('btn_delete', $btn_delete, 'id')
       ->add_column('btn_detail', $btn_detail, 'id')
       ->add_column('status', $status);	
       
        return $this->response($this->datatables->generate(), false);
	}

}