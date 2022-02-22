<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi_model extends MY_Model {

	protected $primary_key = 'id';
	protected $table = 'master_prodi';

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

/* End of file Prodi_model.php */
/* Location: ./application/models/Prodi_model.php */