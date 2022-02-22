<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends Admin {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function switch_lang($lang = 'english')
	{
        $this->load->helper(['cookie']);

        set_cookie('language', $lang, (60 * 60 * 24) * 365 );
        $this->lang->load('web', $lang);
        redirect_back();
	}

}

/* End of file Web.php */
/* Location: ./application/controllers/Web.php */