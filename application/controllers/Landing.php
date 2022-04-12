<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends Frontend {

	public function __construct()
	{
		parent::__construct();

	}


	public function index($page = null)
	{
		if ($this->aauth->is_loggedin()) {
			redirect('kelas','refresh');
		}

		$data['title']	= 'Form pendaftaran';
		$data['page']	= 'index';
		$this->template->title('Landing');

		$this->render($data['page'], $data);
	}

}

/* End of file Landing.php */
/* Location: ./application/controllers/Landing.php */