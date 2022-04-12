<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Karyawan Controller
*| --------------------------------------------------------------------------
*| Karyawan site
*|
*/

class Karyawan extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_Karyawan');
	}

	public function index()
	{
		//$this->is_allowed('karyawan_list') ;
		$this->template->title('Data Karyawan');
		$data = [];
		$this->render('Karyawan/karyawan_list', $data);
	}

	
	public function ajax()
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
		$data = $this->model_Karyawan->getRequestAjax();
		$data_row = array();
			$no = $_POST['start'];
			$data_ = array();
			foreach ($data as $row) {
				$no++;
				$data_row = array();
				$data_row[] = '<input type="checkbox" class="data-check check checkbox icheckbox_flat-green toltip" value="'.$row->id.'" name="data-check[]">';
				$data_row[] = $no;
				  
			         
			      
			    			    $data_row[] = $row->code;  
			          
			      
			    			    $data_row[] = $row->nik;  
			          
			      
			    			    $data_row[] = $row->nama;  
			          
			      
			    			    $data_row[] = $row->email;  
			          
			      
			    			    $data_row[] = $row->status_karyawan;  
			          
			      
			    			    $data_row[] = $row->jenis_kelamin;  
			          
			      
			    			    $data_row[] = $row->tempat_lahir;  
			          
			      
			    			    $data_row[] = $row->tanggal_lahir;  
			          
			      
			    			    $data_row[] = $row->alamat;  
			          
			      
			    			    $data_row[] = $row->kode_pos;  
			          
			      
			    			    $data_row[] = $row->pendidikan_terakhir;  
			          
			      
			    			    $data_row[] = $row->asal_pendidikan;  
			          
			      
			    			    $data_row[] = $row->no_hp;  
			          
			     


			    if (is_file(FCPATH . 'uploads/user/' . $row->photo)): 
	            $img_url = base_url() . 'uploads/user/' .$row->photo; 
	            else: 
	            $img_url = base_url() . 'uploads/user/default.png'; 
	            endif; 
                $data_row[] = '<a class="fancybox" rel="group" href="'.$img_url.'">
                          <img src="'.$img_url.'" alt="Person" width="50" height="50">
                       	 </a>';

			      
			    			    $data_row[] = $row->program_studi_id;  
			          
			      
			    			    $data_row[] = $row->departement_id;  
			          
			      
			    			    $data_row[] = $row->status_akun;  
			          
			    
				//add html for action
				$data_row[] = '
				<div class="text-center"><button type="button" class="btn btn-sm btn-warning edit" title="Edit" id="edit" data-id = "'.$row->id.'"><i class="fa fa-pencil"></i>Edit </button>
				<button type="button" class="btn btn-sm btn-danger delete" title="Delete" id="delete" data-id = "'.$row->id.'"><i class="fa fa-trash"></i>Delete</button></div>';
				$data_[] = $data_row;
			}

			$json_data = [
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->model_Karyawan->count_all(),
				"recordsFiltered" => $this->model_Karyawan->_count_filtered(),
				'data' => $data_
			];

			return $this->response($json_data);
		}
		
	}

	public function add()
	{
		$this->template->title('Karyawan');
		$data = [];
		$this->render('karyawan/karyawan_add', $data);
	}

	/**
	* Add New users
	*
	* @return JSON
	*/
	public function add_save()
	{
		// if (!$this->is_allowed('users_add', false)) {
		// 	return $this->response([
		// 		'success' => false,
		// 		'message' => cclang('sorry_you_do_not_have_permission_to_access')
		// 		]);
		// }

		$this->form_validation->set_rules('code', 'Kode', 'trim');
		$this->form_validation->set_rules('nik', 'NIK', 'trim');
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[karyawans.email]');
		$this->form_validation->set_rules('status_karyawan', 'Satatus Karyawan', 'trim|required');
		$this->form_validation->set_rules('departements', 'Departement', 'trim|required');

		if ($this->form_validation->run()) {
			$user_avatar_uuid = $this->input->post('user_avatar_uuid');
			$user_avatar_name = $this->input->post('user_avatar_name');

			$save_data = [
				'code'	=> $this->input->post('code'),
				'nik'	=> $this->input->post('nik'),
				'nama'	=> $this->input->post('nama'),
				'email'	=> $this->input->post('email'),
				'status_karyawan'	=> $this->input->post('status_karyawan'),
				'tempat_lahir'	=> $this->input->post('tempat_lahir'),
				'tanggal_lahir'	=> $this->input->post('tanggal_lahir'),
				'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
				'alamat'	=> $this->input->post('alamat'),
				'departement_id'	=> $this->input->post('departement_id'),
				'photo' 		=> 'default.png',
				'created_at'	=> date('Y-m-d H:i:s'),
				'departement_id'	=> $this->input->post('departements')
			];

			if (!empty($user_avatar_name)) {

				$user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;

				if (!is_dir(FCPATH . '/uploads/karyawan')) {
					mkdir(FCPATH . '/uploads/karyawan');
				}

				@rename(FCPATH . 'uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
						FCPATH . 'uploads/karyawan/' . $user_avatar_name_copy);

				$save_data['photo'] = $user_avatar_name_copy;
			}

			$save = $this->model_Karyawan->create($save_data); 

			if ($save) {
				if ($this->input->post('save_type') == 'stay') {
					$response['success'] = true;
					$response['message'] = cclang('success_save_data_stay', [
						anchor('admin/karyawan/edit/' . $save, 'Edit Karyawan'),
						anchor('admin/karyawan', ' Go back to list')
					]);
				} else {
						set_message(
							cclang('success_save_data_redirect', [
							anchor('admin/karyawan/edit/' . $save, 'Edit Karyawan')
						]), 'success');

	        		$response['success'] = true;
	        		$response['message'] = false;
							$response['redirect'] = site_url('admin/karyawan');
				}
			} else {
				$response['success'] = false;
				$response['message'] = "gagal menginputkan data";
			}

		} else {
			$response['success'] = false;
			$response['message'] = validation_errors();
		}

		return $this->response($response);
	}

	/**
	* delete users
	*
	* @var $id String
	*/
	public function delete()
	{
		$this->is_allowed('users_delete');
		$id = $this->input->post(null, true);
		
		$remove = false;
		if (is_array($id['delete_id'])) {
			foreach ($id['delete_id'] as $i) {
				$remove = $this->_remove($i);
				//$response['success'] = $id['delete_id'];
				if ($remove) {
					$response['success'] = true;
					$response['message'] = "Data user berhasil di hapus";
					set_message('Data user berhasil di hapus', 'success');
				} else {
					$response['success'] = false;
					$response['message'] = 'Maaf gagal menghapus data';
				}
			}
		} else {
			if (! $this->_db->where('id', $id['delete_id'])->first()) {
				$response['success'] = false;
				$response['message'] = 'Maaf data tidak ditemukan';
			} else {
				$remove = $this->_remove($id['delete_id']);
				if ($remove) {
					$response['success'] = true;
					$response['message'] = "Data user berhasil di hapus";
					set_message('Data user berhasil di hapus', 'success');
				} else {
					$response['success'] = false;
					$response['message'] = 'Maaf gagal menghapus data';
				}
			}				
		}
		
		return $this->response($response);
	}

	/**
	* Edit users
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('users_update') ;
		$this->template->title('Users Edit');
		$data['data']		= $this->_db->where('id', $id)->first();
		$data['group_user']		= $this->_db->get_group_user($id);
		$this->render('users/users_edit', $data);
	}

	/**
	* Update users
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('users_update', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');

		if ($this->form_validation->run()) {
			$user_avatar_uuid = $this->input->post('user_avatar_uuid');
			$user_avatar_name = $this->input->post('user_avatar_name');

			$save_data = [
				'full_name' 	=> $this->input->post('fullname'),
			];

			if (!empty($user_avatar_name)) {
				if (!empty($user_avatar_uuid)) {
					$user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;
		
					rename(FCPATH . '/uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
							FCPATH . '/uploads/user/' . $user_avatar_name_copy);

					if (!is_file(FCPATH . '/uploads/user/' . $user_avatar_name_copy)) {
						return $this->response([
							'success' => false,
							'message' => 'Error uploading avatar'
							]);
						exit;
					}

					$save_data['avatar'] = $user_avatar_name_copy;
				}
			}

			if ($pass = $this->input->post('password')) {
				$password = $pass;
			} else {
				$password = false;
			}

			$save_user = $this->aauth->update_user($id, $this->input->post('email'), $password, $this->input->post('username'), $save_data);

			if ($save_user) {
				//update user to group
				$this->db->delete('aauth_user_to_group', ['user_id' => $id]);
				if (count($this->input->post('group'))) {
					foreach ($this->input->post('group') as $group_id) {
						$this->aauth->add_member($id, $group_id);				
					}
				}

				if ($this->input->post('save_type') == 'stay') {
					$response['success'] = true;
					$response['message'] = cclang('success_update_data_stay', [
						anchor('admin/users', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

	        		$response['success'] = true;
					$response['message'] = false;
				}
			} else {
				$response['success'] = false;
				$response['message'] = cclang('data_not_change').$this->aauth->print_errors();
			}

		} else {
			$response['success'] = false;
			$response['message'] = validation_errors();
		}

		return $this->response($response);
	}


	

	/**
	* delete users
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$image = $this->_db->find($id)->avatar;
		$this->load->helper('file');
		$delete_file = '';
		$path = FCPATH . 'uploads/karyawan/'.$image;
		if (file_exists($path)) {
			if ($image != 'default.png') {
				$delete_file = unlink($path);
				//$delete_files = delete_files($path);
			}
		} else {
			$delete_file = false;
		}
		$delete = $this->aauth->delete_user($id);//$this->_db->where('id', $id)->delete();  
		if ($delete) {
			return true;
		}	
	}

	/**
	* Upload Image User
	* 
	* @return JSON
	*/
	public function upload_avatar_file()
	{
		// if (!$this->is_allowed('users_add', false)) {
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
	* Delete Image User
	* 
	* @return JSON
	*/
	public function delete_avatar_file($uuid)
	{
		// if (!$this->is_allowed('users_delete', false)) {
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
				$user = $this->model_Karyawan->where('id', $uuid)->first();
				$path = FCPATH . 'uploads/karyawan/'.$user->photo;
				if ($user->avatar != 'default.png') {
					if (isset($uuid)) {
						if (is_file($path)) {
							$delete_file = unlink($path);
							$this->model_Karyawan->where('id', $uuid)->update(['photo' => '']);
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
	* Get Image User
	* 
	* @return JSON
	*/
	public function get_avatar_file($id)
	{
		// if (!$this->is_allowed('users_update', false)) {
		// 	return $this->response([
		// 		'success' => false,
		// 		'message' => cclang('sorry_you_do_not_have_permission_to_access')
		// 		]);
		// }

		$this->load->helper('file');
		
		$user = $this->model_Karyawan->where('id', $id)->first();

		if (!$user) {
			$result = [
				'error' =>  'Error getting file'
			];

    		return $this->response($result);
		} else {
			if (!empty($model_Karyawan->photo)) {
				$result[] = [
					'success' 				=> true,
					'thumbnailUrl' 			=> base_url('uploads/karyawan/'.$user->photo),
					'id' 					=> 0,
					'name' 					=> $user->photo,
					'uuid' 					=> $user->id,
					'deleteFileEndpoint' 	=> base_url('admin/karyawan/delete_avatar_file'),
					'deleteFileParams'		=> ['by' => 'id']
				];

	    		return $this->response($result);
			}
		} 
	}

	

}