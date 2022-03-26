<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Karyawans extends MY_Model {

		protected $primary_key 	= 'id';
	protected $table 	= 'karyawans';
	protected $field_search 	= ['id', 'code', 'nik', 'nama', 'email', 'status_karyawan', 'photo', 'program_studi_id', 'departement_id', 'status_akun'];

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