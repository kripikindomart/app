<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dosen Controller
*| --------------------------------------------------------------------------
*| Dosen site
*|
*/

class Dosen extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_Dosen');
	}

	public function index()
	{
		//$this->is_allowed('Dosen_list') ;
		$this->template->title('Data Dosen');
		$data = [];
		$this->render('Dosen/dosen_list', $data);
	}

}