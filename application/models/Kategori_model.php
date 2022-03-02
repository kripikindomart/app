<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends MY_Model {

	protected $primary_key = 'id';
	protected $table = 'kategori_komponen';
	protected $table_kategori = 'kategori_komponen';
	protected $table_sidang = 'kategori_komponen';
	protected $table_disertas = 'kategori_komponen';
	protected $table_administrasi = 'kategori_komponen';

	public function __construct()
	{
		parent::__construct();
		
	}	

	public function getDefaultValues()
	{
		return [
			'id'		=> '',
			'kategori'	=> '',
			'aktif'	=> '',

		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field' => 'kategori',
				'label' => 'Kategori',
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
				'kategori' 	=> $data->kategori,
				'aktif' 	=> $data->aktif,
			];



			return $this->create($save_data);
		} else {

			$save_data = [
				'kategori' 	=> $data->kategori,
				'aktif' 		=> $data->aktif,
			];

			return $this->where('id', $data->id)->update($save_data);
		}
	}

}

/* End of file Model_Komponen.php */
/* Location: ./application/models/Model_Komponen.php */