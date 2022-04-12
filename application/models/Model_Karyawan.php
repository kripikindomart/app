<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Karyawan extends MY_Model {
		
	protected $primary_key 	= 'id';
	protected $table 	= 'karyawans';
	var $column_order = array(null, null, "karyawans.id", "karyawans.code", "karyawans.nik", "karyawans.nama", "karyawans.email", "karyawans.status_karyawan", "karyawans.jenis_kelamin", "karyawans.tempat_lahir", "karyawans.tanggal_lahir", "karyawans.alamat", "karyawans.kode_pos", "karyawans.pendidikan_terakhir", "karyawans.asal_pendidikan", "karyawans.no_hp", "karyawans.photo", "karyawans.program_studi_id", "karyawans.departement_id", "karyawans.status_akun", null);
	var $column_search = array("karyawans.id", "karyawans.code", "karyawans.nik", "karyawans.nama", "karyawans.email", "karyawans.status_karyawan", "karyawans.jenis_kelamin", "karyawans.tempat_lahir", "karyawans.tanggal_lahir", "karyawans.alamat", "karyawans.kode_pos", "karyawans.pendidikan_terakhir", "karyawans.asal_pendidikan", "karyawans.no_hp", "karyawans.photo", "karyawans.program_studi_id", "karyawans.departement_id", "karyawans.status_akun"); 
	var $select = array("karyawans.id", "karyawans.code", "karyawans.nik", "karyawans.nama", "karyawans.email", "karyawans.status_karyawan", "karyawans.jenis_kelamin", "karyawans.tempat_lahir", "karyawans.tanggal_lahir", "karyawans.alamat", "karyawans.kode_pos", "karyawans.pendidikan_terakhir", "karyawans.asal_pendidikan", "karyawans.no_hp", "karyawans.photo", "karyawans.program_studi_id", "karyawans.departement_id", "karyawans.status_akun");
	var $join = array();
	var $order = array('karyawans.id' => 'desc'); // default order 

	public function __construct()
	{
		

		parent::__construct();
	}

	

	
}