<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		
		$this->template->title('Menu List');
		$data = [];
		$this->render('menu/menu_list', $data);
	}

}

/* End of file Menu.php */
/* Location: ./application/controllers/admin/Menu.php */