<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dosen extends MY_Model {

		protected $primary_key 	= 'id';
	protected $table 	= 'master_dosen';
	protected $field_search 	= ['nik', 'nama_lengkap', 'jenis_kelamin', 'no_ktp', 'gelar_kesarjanaan', 'tempat_lahir', 'tanggal_lahir', 'status_kawin', 'alamat_rumah', 'email', 'no_hp', 'id_master_prodi', 'fungsional', 'golongan', 'foto', 'status_dosen'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct();
	}
}