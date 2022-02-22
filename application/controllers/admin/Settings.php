<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Group_model','group');
		$this->is_allowed('settings') ;
	}

	public function index()
	{
		$this->template->title('Settings');
		$data = [];
		$this->render('settings/index', $data);
	}

}

/* End of file Settings.php */
/* Location: ./application/controllers/admin/Settings.php */