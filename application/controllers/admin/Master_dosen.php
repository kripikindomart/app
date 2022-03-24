<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Master Dosen Controller
*| --------------------------------------------------------------------------
*| Master Dosen site
*|
*/

class Master_dosen extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_Master_dosen');
	}

	public function index()
	{
		//$this->is_allowed('Master_dosen_list') ;
		$this->template->title('Master Dosen');
		$data = [];
		$this->render('Master_dosen/master_dosen_list', $data);
	}

}