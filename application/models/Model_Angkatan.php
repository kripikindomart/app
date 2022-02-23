<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Angkatan extends MY_Model {
	protected $primary_key = 'id';
	protected $table = 'master_angkatan';

	public function __construct()
	{
		parent::__construct();
		
	}	

	public function getDefaultValues()
	{
		return [
			'id'		=> '',
			'keterangan'	=> '',
			'aktif'	=> '',

		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field' => 'tahun_angkatan',
				'label' => 'Tahun Angkatan',
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
				'keterangan' 	=> $data->tahun_angkatan,
				'aktif' 	=> $data->aktif,
			];

			return $this->create($save_data);
		} else {

			$save_data = [
				'keterangan' 	=> $data->tahun_angkatan,
				'aktif' 		=> $data->aktif,
			];

			return $this->where('id', $data->id)->update($save_data);
		}
	}
	

}

/* End of file Model_Angkatan.php */
/* Location: ./application/models/Model_Angkatan.php */