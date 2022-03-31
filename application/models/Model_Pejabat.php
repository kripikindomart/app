<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Pejabat extends MY_Model {
		
	protected $primary_key 	= 'id';
	protected $table 	= 'pejabats';
	var $column_order = array(null, null, "pejabats.id", "karyawans.nama", "pengajars.nama", "departements.nama", "pejabats.jabatan", "pejabats.ttd", "pejabats.status", null);
	var $column_search = array("pejabats.id", "karyawans.nama", "pengajars.nama", "departements.nama", "pejabats.jabatan", "pejabats.ttd", "pejabats.status"); 
	var $select = array("pejabats.id", "karyawans.nama as karyawans_nama", "pengajars.nama as pengajars_nama", "departements.nama as departements_nama", "pejabats.jabatan", "pejabats.ttd", "pejabats.status");
	var $join = array("karyawans" => "karyawans.id=pejabats.karyawan_id", "pengajars" => "pengajars.id=pejabats.pengajar_id", "departements" => "departements.id=pejabats.departement_id");
	var $order = array('pejabats.id' => 'desc'); // default order 

	public function __construct()
	{
		

		parent::__construct();
	}

	

	
}