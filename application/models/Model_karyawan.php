<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Karyawan extends MY_Model {

		protected $primary_key 	= 'id';
	protected $table 	= 'karyawans';
	protected $field_search 	= ['code', 'nik', 'nama', 'email', 'jenis_kelamin', 'photo', 'program_studi_id', 'departement_id', 'status_akun'];

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