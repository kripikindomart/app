<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends Frontend {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ujian_model', 'ujian');
		//$this->user = $this->ion_auth->user()->row();
		$this->mhs 	= $this->ujian->where('no_hp', $this->session->userdata('no_hp'))->first('master_mahasiswa');
	}


	public function index()
	{
		if ($this->aauth->is_loggedin()) {
			redirect('kelas','refresh');
		}

		$data['title']	= 'Dashboard';
		$data['page']	= 'index';
		$this->template->title('Landing');

		$this->render($data['page'], $data);
	}

}

/* End of file Landing.php */
/* Location: ./application/controllers/Landing.php */