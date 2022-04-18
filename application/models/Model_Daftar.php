<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Daftar extends MY_Model {
		
	protected $primary_key 	= 'id';
	protected $table 	= 'mhs_daftar';
	var $column_order = array(null, null, "mhs_daftar.id", "mhs_daftar.kode", "mhs_daftar.npm", "mhs_daftar.ujian_id", "mhs_daftar.form_id", "mhs_daftar.tanggal_daftar", "mhs_daftar.tanggal_ujian", null);
	var $column_search = array("mhs_daftar.id", "mhs_daftar.kode", "mhs_daftar.npm", "mhs_daftar.ujian_id", "mhs_daftar.form_id", "mhs_daftar.tanggal_daftar", "mhs_daftar.tanggal_ujian"); 
	var $select = array("mhs_daftar.id", "mhs_daftar.kode", "mhs_daftar.npm", "mhs_daftar.ujian_id", "mhs_daftar.form_id", "mhs_daftar.tanggal_daftar", "mhs_daftar.tanggal_ujian");
	var $join = array();
	var $order = array('mhs_daftar.id' => 'desc'); // default order 

	public function __construct()
	{
		

		parent::__construct();
	}

	public function getDefaultValues()
	{
		return [
			'npm'		=> '',
			'prodi_id'	=> '',
			'ujian'	=> '',

		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field' => 'seminar',
				'label' => 'Ujian',
				'rules' => 'trim|required',
				'errors' => array('required' => '%s tidak boleh kosong')
			],

		];
		return $validationRules;
		
	}

	public function run($data, $action = 'input')
	{
		if ($action == 'input') {

			$save_data = [
				'npm' 	=> $data->npm,
				'prodi_id' 	=> $data->prodi_id,
				'ujian' 	=> $data->seminar,
				'pengajuan_ke' 	=> 1,
				'tanggal_pengajuan' 	=> date('Ymd'),
			];

			return $this->create($save_data, 'mdapp_pengajuan');
		} else {

			$save_data = [
				'keterangan' 	=> $data->tahun_angkatan,
				'aktif' 		=> $data->aktif,
			];

			return $this->where('id', $data->id)->update($save_data);
		}
	}

	

	
}