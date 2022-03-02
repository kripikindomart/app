<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Komponen extends MY_Model {

	protected $primary_key = 'id';
	protected $table = 'komponen';
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
			'program_studi'	=> '',
			'jenjang'	=> '',

		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field' => 'prodi',
				'label' => 'Program Studi',
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
				'prodiID' 	=> $data->prodiid,
				'program_studi' 	=> $data->prodi,
				'jenjang' 		=> $data->jenjang,
			];



			return $this->create($save_data);
		} else {

			$save_data = [
				'prodiID' 	=> $data->prodiid,
				'program_studi' 		=> $data->prodi,
				'jenjang' 		=> $data->jenjang,
			];

			return $this->where('id', $data->id)->update($save_data);
		}
	}

}

/* End of file Model_Komponen.php */
/* Location: ./application/models/Model_Komponen.php */