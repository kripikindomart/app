<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Dosen extends MY_Model {
		
	protected $primary_key 	= 'id';
	protected $table 	= 'master_dosen';
	var $column_order = array(null, null, "master_dosen.id", "master_dosen.nik", "master_dosen.nama_lengkap", "master_dosen.jenis_kelamin", "master_dosen.no_ktp", "master_dosen.gelar_kesarjanaan", "master_dosen.tempat_lahir", "master_dosen.tanggal_lahir", "master_dosen.status_kawin", "master_dosen.alamat_rumah", "master_dosen.email", "master_dosen.no_hp", "program_studis.nama", "master_dosen.fungsional", "master_dosen.golongan", "master_dosen.foto", "master_dosen.status_dosen", null);
	var $column_search = array("master_dosen.id", "master_dosen.nik", "master_dosen.nama_lengkap", "master_dosen.jenis_kelamin", "master_dosen.no_ktp", "master_dosen.gelar_kesarjanaan", "master_dosen.tempat_lahir", "master_dosen.tanggal_lahir", "master_dosen.status_kawin", "master_dosen.alamat_rumah", "master_dosen.email", "master_dosen.no_hp", "program_studis.nama", "master_dosen.fungsional", "master_dosen.golongan", "master_dosen.foto", "master_dosen.status_dosen"); 
	var $select = array("master_dosen.id", "master_dosen.nik", "master_dosen.nama_lengkap", "master_dosen.jenis_kelamin", "master_dosen.no_ktp", "master_dosen.gelar_kesarjanaan", "master_dosen.tempat_lahir", "master_dosen.tanggal_lahir", "master_dosen.status_kawin", "master_dosen.alamat_rumah", "master_dosen.email", "master_dosen.no_hp", "program_studis.nama as program_studis_nama", "master_dosen.fungsional", "master_dosen.golongan", "master_dosen.foto", "master_dosen.status_dosen");
	var $join = array("program_studis" => "program_studis.id=master_dosen.id_master_prodi");
	var $order = array('master_dosen.id' => 'desc'); // default order 

	public function __construct()
	{
		

		parent::__construct();
	}

	

	
}