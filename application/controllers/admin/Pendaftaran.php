<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Prodi_model', 'prodi');
	}


	public function index()
	{
		//$this->is_allowed('Program Studis_list') ;
		$this->template->title('Pendaftaran');
		$data = [];
		$this->render('Pendaftaran/pendaftaran', $data);
	}

}

/* End of file Pendaftaran.php */
/* Location: ./application/controllers/admin/Pendaftaran.php */