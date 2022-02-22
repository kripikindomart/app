<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
	
        if (!$this->aauth->is_allowed('dashboard')) {
			redirect('/','refresh');
		}
		$this->template->title('Dashboard');

		$data = [];
		$this->render('dashboard/index', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/apanel/Dashboard.php */