<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Authentication {

	public function __construct()
	{
		parent::__construct();
		
	}

	/**
	* Login user
	*
	*/
	public function login()
	{
		if ($this->aauth->is_loggedin()) {
			redirect('admin/dashboard','refresh');
		}
		$data = [];
		$data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		$this->config->load('Site');

		
		$this->template->build('backend/standart/admin/login', $data);
	}

	public function cek_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required',  array('required' => 'Usernam / Email tidak boleh kosong'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password tidak boleh kosong'));

		if ($this->form_validation->run()) {
			if ($this->aauth->login($this->input->post('username'), $this->input->post('password'), $this->input->post('remember'))) {
				// $data['url'] = 'admin/dashboard';
				//redirect('admin/dashboard','refresh');
				return $this->cek_akses();
			} else {
				$data = [
					'status' => false,
					'failed' => $this->aauth->print_errors(),
				];
				// $data['error'] = $this->aauth->print_errors(TRUE);
				$this->response($data);
			}
		} else {
			$invalid = [
				'username' => form_error('username'),
				'password' => form_error('password')
			];
			$data = [
				'status' 	=> false,
				'invalid' 	=> $invalid
			];
			$data['error'] = validation_errors();
			$this->response($data, true);
		}
	}

	public function landing_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required',  array('required' => 'isi No Pendaftaran untuk login'));
		

		if ($this->form_validation->run()) {
			if ($this->aauth->login($this->input->post('username'), $this->input->post('username'), false)) {
				
				if (!$this->aauth->is_loggedin()){
					$status = false; // jika false, berarti login gagal
					$url = 'auth'; // url untuk redirect
				}else{
					$status = true; // jika true maka login berhasil
					$url = 'kelas';
				}
				$data = [
					'status' => $status,
					'url'	 => $url
				];
				$this->response($data);
			} else {
				$data = [
					'status' => false,
					'failed' => $this->aauth->print_errors_landing(),
				];
				// $data['error'] = $this->aauth->print_errors(TRUE);
				$this->response($data);
			}
		} else {
			$invalid = [
				'username' => form_error('username'),
			];
			$data = [
				'status' 	=> false,
				'invalid' 	=> $invalid
			];
			$data['error'] = validation_errors();
			$this->response($data, true);
		}
	}

	public function cek_akses()
	{
		if (!$this->aauth->is_loggedin()){
			$status = false; // jika false, berarti login gagal
			$url = 'auth'; // url untuk redirect
		}else{
			$status = true; // jika true maka login berhasil
			$url = 'admin/dashboard';
		}

		$data = [
			'status' => $status,
			'url'	 => $url
		];
		$this->response($data);
	}


	public function logout() {

        $this->aauth->logout();
        redirect('auth/login','refresh');
    }

    public function logoutLanding() {

        $this->aauth->logout();
        redirect('/','refresh');
    }

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */