<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model', 'mahasiswa');
	}

	public function index()
	{
		//$this->is_allowed('user_list') ;
		$this->template->title('Mahasiswa List');

		$data['prodi'] = $this->mahasiswa->where('prodiID != ', 'ADM')->get('master_prodi');
		$data['angkatan'] = $this->mahasiswa->get('master_angkatan');
		$this->render('mahasiswa/mahasiswa', $data);
	}


	public function ajax($id=null, $angkatan = null)
	{
		//if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {

			return $this->response($this->mahasiswa->getData($id, $angkatan), false);
		//}
	}

	public function create()
	{
		$this->template->title('Add Mahasiswa');
		$data['page']	= 'mahasiswa/form_mahasiswa';
		
		$this->render($data['page'], $data);
	}

	public function add_save()
	{
		if (!$_POST) {
			$input = (object) $this->mahasiswa->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}

		if ($this->mahasiswa->validate()) {
			
			$save_mahasiswa = $this->mahasiswa->run($input);
			if ($save_mahasiswa) {
				if ($this->input->post('save_type') == 'stay') {
						$response['success'] = true;
						$response['message'] = 'Berhasil menyimpan data, klik link untuk mengedit mahasiswa'.
							anchor('admin/mahasiswa/edit/' . $save_mahasiswa, ' Edit Mahasiswa'). ' atau klik'.
							anchor('admin/mahasiswa', ' kemabali ke list'). ' untuk melihat seluruh data';
				} else {
					// set_message('Berhasil menyimoan data '.anchor('admin/mahasiswa/edit/' . $save_mahasiswa, 'Edit mahasiswa'), 'success');
	        		$response['success'] = true;
					$response['redirect'] = site_url('admin/mahasiswa');
				} 

			} else {
				$response['success'] = false;
				$response['message'] = 'gagal menyimpan data mahasiswa';
			}
		}	else {
			$response['success'] = false;
			$response['message'] = validation_errors();
		}

		return $this->response($response);
	}

	public function edit($id)
	{
		$this->template->title('Edit mahasiswa');
		
		$data['page']		= 'mahasiswa/form_edit';
		$data['input']		= $this->mahasiswa->where('id', $id)->first();

		$this->render($data['page'], $data);
	}

	public function edit_save($profile = null)
	{
		if (!$_POST) {
			$input = (object) $this->mahasiswa->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}
		$this->load->library('form_validation');
		$validationRules = [
			[
				'field' => 'nama_mahasiswa',
				'label' => 'Nama Mahasiswa',
				'rules' => 'trim|required',
			],
			[
				'field' => 'no_hp',
				'label' => 'No HP (WA)',
				'rules' => 'required',
			],

		];
		$this->form_validation->set_rules($validationRules);
		if ($this->form_validation->run()) {
			
			$save_mahasiswa = $this->mahasiswa->run($input,'update');
			if ($save_mahasiswa) {
				if ($this->input->post('save_type') == 'stay') {
						$response['success'] = true;
						$response['message'] = 'Berhasil mengupdate data klik'.
							anchor('admin/mahasiswa', ' kemabali ke list'). ' untuk melihat seluruh data';
				} else {
					// set_message('Berhasil menyimpan data '.anchor('admin/mahasiswa/edit/' . $save_mahasiswa, 'Edit mahasiswa'), 'success');
					if ($profile == null) {
						 
						$response['success'] = true;
						$response['redirect'] = site_url('admin/mahasiswa/');
					} else {
		        		$response['success'] = true;
						$response['redirect'] = site_url('admin/mahasiswa/profile');
					}
				} 

			} else {
				$response['success'] = false;
				$response['message'] = 'gagal menyimpan data mahasiswa';
			}
		}	else {
			$response['success'] = false;
			$response['message'] = validation_errors();
		}

		return $this->response($response);
	}

	/**
	* delete mahasiswa
	*
	* @var $id String
	*/
	public function delete()
	{

		$id = $this->input->post(null, true);
		
		$remove = false;
		if (is_array($id['delete_id'])) {
			foreach ($id['delete_id'] as $i) {
				$remove = $this->_remove($i);
				//$response['success'] = $id['delete_id'];
				if ($remove) {
					$response['success'] = true;
					$response['message'] = "Data mahasiswa berhasil di hapus";
					set_message('Data mahasiswa berhasil di hapus', 'success');
				} else {
					$response['success'] = false;
					$response['message'] = 'Maaf gagal menghapus data';
				}
			}
		} else {
			if (! $this->mahasiswa->where('id', $id['delete_id'])->first()) {
				$response['success'] = false;
				$response['message'] = 'Maaf data tidak ditemukan';
			} else {
				$remove = $this->_remove($id['delete_id']);
				if ($remove) {
					$response['success'] = true;
					$response['message'] = "Data mahasiswa berhasil di hapus";
					set_message('Data mahasiswa berhasil di hapus', 'success');
				} else {
					$response['success'] = false;
					$response['message'] = 'Maaf gagal menghapus data';
				}
			}				
		}
		
		return $this->response($response);
	}

	public function create_user()
	{

		$id = $this->input->post(null, true);
		$batch = false;
		if (is_array($id['delete_id'])) {
			foreach ($id['delete_id'] as $i) {
				$save = $this->_save($i);
				//$response['success'] = $id['delete_id'];
				if ($save['status'] == true) {
					$response['success'] = true;
					$response['message'] = $save['message'];//"Data mahasiswa berhasil di Inputkan, Gunakan Email, dan No registrasi sebagai password default";
				} else if(is_array($save)){
					$response['success'] = $save['status'];
					$response['message'] = $save['message'];
				}
			}
		} else {
			$data = $this->mahasiswa->where('id', $id['delete_id'])->first();
			
				$save = $this->_save($id['delete_id']);
				if ($save['status'] == true) {
					$response['success'] = true;
					$response['message'] = $save['message'];//"Data mahasiswa berhasil di Inputkan, Gunakan Email, dan No registrasi sebagai password default";
				} else if(is_array($save)){
					$response['success'] = $save['status'];
					$response['message'] = $save['message'];
				}
						
		}

		$this->response($response);
		
	}

	public function create_user_check($data, $chechk_data)
	{
		$data = $this->mahasiswa->where($data, $chechk_data)->first('aauth_user');
		if ($data) {
			return true;
		} else {
			return false;
		}
	}

	public function _save($id)
	{
		$data = $this->mahasiswa->where('id', $id)->first();
		$save_data = [
			'full_name' 	=> $data->nama_lengkap,
			'id_master_prodi' 	=> $data->id_master_prodi,
			//'username' 	=> $data->no_registrasi,
			//'password' 	=> hashEncrypt($data->no_registrasi),
			'banned'	=> false,
			'avatar'	=> $data->foto,
			//'group_id'	=> 2,
		];
		// if ($this->create_user_check('no_hp', $save_data['no_hp'])) {
		// 	return $data = [
		// 		'status' 	 => false,
		// 		'message'	 => 'Email sudah terdaftar.'
		// 	];
		// }else if ($this->create_user_check('username',$save_data['username'])) {
		// 	return $data = [
		// 		'status' 	 => false,
		// 		'message'	 => 'No registrasi sudah terdaftar.'
		// 	];
		// } else {
			$save = $this->aauth->create_user($data->no_registrasi.'@gmail.com', $data->no_registrasi, $data->no_registrasi, $save_data);
			if ($save) {
				$this->aauth->add_member($save, 3);
				$response['status'] = true;
				$response['message'] = "Data mahasiswa berhasil di Inputkan, Gunakan No Pendaftaran Untuk Memasuki ruang kelas";
			} else {
				$response['status'] = false;
				$response['message'] = $this->aauth->print_errors();
			}

			return $response;
		//}
		
	}

	

	/**
	* delete mahasiswa
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$image = $this->mahasiswa->find($id)->foto;
		$this->load->helper('file');
		$delete_file = '';
		$path = FCPATH . 'uploads/mahasiswa/'.$image;
		if (file_exists($path)) {
			if ($image != 'default.png') {
				$delete_file = unlink($path);
				//$delete_files = delete_files($path);
			}
		} else {
			$delete_file = false;
		}
		$delete = $this->mahasiswa->where('id', $id)->delete();
		if ($delete) {
			return true;
		}

		
	}



	public function deleteImage($image)
	{
		if (!empty($image)) {
			$this->load->helper('file');
			$delete_file = '';
			$path = FCPATH . 'uploads/mahasiswa/'.$image;
			if (file_exists($path)) {
				if ($image != 'default.png') {
					$delete_file = unlink($path);
				}
			}
				
			if ($delete_file) {
				return true;
			}	
		}
	}



	/**
	* Upload Image mahasiswa
	* 
	* @return JSON
	*/
	public function upload_avatar_file()
	{
		// if (!$this->is_allowed('mahasiswa_add', false)) {
		// 	return $this->response([
		// 		'success' => false,
		// 		'message' => cclang('sorry_you_do_not_have_permission_to_access')
		// 		]);
		// }

		$uuid = $this->input->post('qquuid');

		mkdir(FCPATH . '/uploads/tmp/' . $uuid);

		$config = [
			'upload_path' 		=> './uploads/tmp/' . $uuid . '/',
			'allowed_types' 	=> 'png|jpeg|jpg|gif',
			'max_size'  		=> '1000'
		];
		
		$this->load->library('upload', $config);
		$this->load->helper('file');

		if ( ! $this->upload->do_upload('qqfile')){
			$result = [
				'success' 	=> false,
				'error' 	=>  $this->upload->display_errors()
			];

    		return $this->response($result);
		}
		else{
			$upload_data = $this->upload->data();

			$result = [
				'uploadName' 	=> $upload_data['file_name'],
				'success' 		=> true,
			];

    		return $this->response($result);
		}
	}

	/**
	* Delete Image mahasiswa
	* 
	* @return JSON
	*/
	public function delete_avatar_file($uuid)
	{
		// if (!$this->is_allowed('mahasiswa_delete', false)) {
		// 	return $this->response([
		// 		'success' => false,
		// 		'message' => cclang('sorry_you_do_not_have_permission_to_access')
		// 		]);
		// }

		if (!empty($uuid)) {
			$this->load->helper('file');

			$delete_by = $this->input->get('by');
			$delete_file = false;

			if ($delete_by == 'id') {
				$mahasiswa = $this->mahasiswa->where('id', $uuid)->first();
				$path = FCPATH . 'uploads/mahasiswa/'.$mahasiswa->foto;
				if ($mahasiswa->foto != 'default.png') {
					if (isset($uuid)) {
						if (is_file($path)) {
							$delete_file = unlink($path);
							$this->mahasiswa->where('id', $uuid)->update(['foto' => '']);
						}
					}	
				}
				

				
			} else {
				$path = FCPATH . '/uploads/tmp/' . $uuid . '/';
				$delete_file = delete_files($path, true);
			}

			if (isset($uuid)) {
				if (is_dir($path)) {
					rmdir($path);
				}
			}

			if (!$delete_file) {
				$result = [
					'error' =>  'Error delete file'
				];

	    		return $this->response($result);
			} else {
				$result = [
					'success' => true,
				];

	    		return $this->response($result);
			}
		}
	}

	/**
	* Get Image mahasiswa
	* 
	* @return JSON
	*/
	public function get_avatar_file($id)
	{

		$this->load->helper('file');
		$mahasiswa = $this->mahasiswa->where('id', $id)->first();
		if (!$mahasiswa) {
			$result = [
				'error' =>  'Error getting file'
			];

    		return $this->response($result);
		} else {
			if (!empty($mahasiswa->foto)) {
				$result[] = [
					'success' 				=> true,
					'thumbnailUrl' 			=> base_url('uploads/mahasiswa/'.$mahasiswa->foto),
					'id' 					=> 0,
					'name' 					=> $mahasiswa->foto,
					'uuid' 					=> $mahasiswa->id,
					'deleteFileEndpoint' 	=> base_url('admin/mahasiswa/delete_foto_file'),
					'deleteFileParams'		=> ['by' => 'id']
				];

	    		return $this->response($result);
			}
		} 
	}


	public function profile()
	{
		$id = $this->session->mahasiswadata('id');
		if (!$_POST) {
			$input = (object) $this->mahasiswa->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}
		$data['input'] = ['password' => hashEncrypt($this->input->post('password'))];	

		$validationRules = [
			[
				'field'	=> 'password',
				'label'	=> 'Password',
				'rules'	=> 'required|min_length[5]',
				'errors'	=> array('required' => ' %s harus di isi', 'min_length' => '%s harus minimal 5 karakter')
			],

			[
				'field'	=> 'password_confirmation',
				'label'	=> 'Konfirmasi Password',
				'rules'	=> 'required|matches[password]',
				'errors'	=> array('required' => '%s harus di isi', 'matches' => 'Konfirmasi password tidak benar / tidak match')
			],
		];
		$this->load->library('form_validation');
		$validate = $this->form_validation->set_rules($validationRules);

		if (!$validate->run()) {
			$data['title']	= 'Profile';
			$data['page']	= 'mahasiswa/profile';
			$data['form_action'] = base_url('admin/mahasiswa/profile/').$this->session->mahasiswadata('id');
			$data['profile'] = $this->mahasiswa->select(
					[
						'mahasiswa.id', 'mahasiswa.mahasiswaname', 'mahasiswa.email', 'mahasiswa.fullname', 'mahasiswa.is_active', 'mahasiswa.foto', 'mahasiswa.token', 'mahasiswa.created_at', 'mahasiswa.update_at', 'mahasiswa.last_login','role.role'
					])
				->join('role','left')
				->where('mahasiswa.id', $id)
				->first();
			$this->set($data);
			$this->view($data);
			return;
		}		

  		if ($this->mahasiswa->where('id', $id)->update($data['input'])) {
			$this->session->set_flashdata('success', 'data berhasil di perbaharui');
		} else {
			$this->session->set_flashdata('error', 'gagal mengupdate data');
		}

		redirect(base_url('admin/mahasiswa/profile'));
		
	}

	public function edit_profile()
	{
		$id = $this->session->mahasiswadata('id');
		$data['title']	= 'Profile';
		$data['page']	= 'mahasiswa/edit_profile';
		$data['input'] = $this->mahasiswa->select(
				[
					'mahasiswa.id', 'mahasiswa.mahasiswaname', 'mahasiswa.email', 'mahasiswa.fullname', 'mahasiswa.is_active', 'mahasiswa.foto', 'mahasiswa.token', 'mahasiswa.created_at', 'mahasiswa.update_at', 'mahasiswa.last_login','role.role','mahasiswa.id_role'
				])
			->join('role','left')
			->where('mahasiswa.id', $id)
			->first();

  		
		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}


	public function import($import_data = null)
	{
		$data['title']	= 'Import Data Mahasiswa';
		$data['page']	= 'mahasiswa/import';
		$data['content']	= $this->mahasiswa->get('master_prodi');
		if ($import_data != null) $data['import'] = $import_data;

		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}

	public function preview()
	{
		$config['upload_path']		= './uploads/import/';
		$config['allowed_types']	= 'xls|xlsx|csv';
		$config['max_size']			= 2048;
		$config['encrypt_name']		= true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload_file')) {
			$error = $this->upload->display_errors();
			echo $error;
			die;
		} else {
			$file = $this->upload->data('full_path');
			$ext = $this->upload->data('file_ext');

			switch ($ext) {
				case '.xlsx':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
					break;
				case '.xls':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
					break;
				case '.csv':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
					break;
				default:
					echo "unknown file ext";
					die;
			}

			$spreadsheet = $reader->load($file);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			$data = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				$data[] = [
					'no_registrasi' => $sheetData[$i][0],
					'nama_lengkap' => $sheetData[$i][1],
					'no_hp' => $sheetData[$i][2],
					'id_master_prodi' => $sheetData[$i][3]
				];
			}

			unlink($file);

			$this->import($data);
		}
	}

	public function do_import()
	{
		$input = json_decode($this->input->post('data', true));
		$data = [];
		foreach ($input as $d) {
			$data[] = [
				'no_registrasi' => $d->no_registrasi,
				'nama_lengkap' => $d->nama_lengkap,
				'no_hp' => $d->no_hp,
				'id_master_prodi' => $d->id_master_prodi
			];
		}

		$save = $this->mahasiswa->insert_batch($data);
		if ($save) {
			redirect('admin/mahasiswa');
		} else {
			redirect('admin/mahasiswa/import');
		}
	}

}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/admin/Mahasiswa.php */