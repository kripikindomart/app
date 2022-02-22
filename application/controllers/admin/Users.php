<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model', '_db');
	}

	public function index()
	{
		//$this->is_allowed('users_list') ;
		$this->template->title('Users List');
		$data = [];
		$this->render('users/users_list', $data);
	}

	public function ajaxList($id=null)
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
			$this->datatables->select('id, email, username, full_name, banned, avatar, last_activity');
	        $this->datatables->from('aauth_users');
	        $this->db->order_by('id','dsc');
	        if ($id != null) {
	        	 $this->datatables->where('id', $id);
	        }
	        $btn_edit = false;
	        if ($this->is_allowed('users_update', false) == true) {
	        	$btn_edit = '
	        		        	<a title="Edit data terpilih" class="btn btn-xs btn-warning" href="'.base_url("admin/users/edit/$1").'">
	        		            <i class="fa fa-pencil"></i>
	        		          </a>';
	        }
	        $btn_delete = false;
	        if ($this->is_allowed('users_delete', false) == true) {
	        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete" data-id="$1" >
	        	                    <i class="fa fa-trash"></i>
	        	                  </button>	';
	        }
			$status = false;
			$btn_detail = '<button title="Detail" type="button" class="btn btn-xs btn-info 					" data-id="$1" >
	        	                    <i class="fa fa-eye"></i>
	        	                  </button>	';
			if ($this->is_allowed('user_benned', false) == true) {
          		$status = true;
          	}		        	                  
	       $this->datatables->add_column('btn_edit', $btn_edit, 'id')
	       ->add_column('btn_delete', $btn_delete, 'id')
	       ->add_column('btn_detail', $btn_detail, 'id')
	       ->add_column('status', $status);	
	       
	        return $this->response($this->datatables->generate(), false);
		}
	}

	public function add()
	{
		$this->is_allowed('users_add') ;
		$this->template->title('Users Add');
		$data = [];
		$this->render('users/users_add', $data);
	}

	/**
	* Add New users
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('users_add', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[aauth_users.username]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[aauth_users.email]|valid_email');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

		if ($this->form_validation->run()) {
			$user_avatar_uuid = $this->input->post('user_avatar_uuid');
			$user_avatar_name = $this->input->post('user_avatar_name');

			$save_data = [
				'full_name' 	=> $this->input->post('fullname'),
				'avatar' 		=> 'default.png',
				'date_created'	=> date('Y-m-d H:i:s'),
				'id_master_prodi'	=> $this->input->post('si_group')
			];

			if (!empty($user_avatar_name)) {

				$user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;

				if (!is_dir(FCPATH . '/uploads/user')) {
					mkdir(FCPATH . '/uploads/user');
				}

				@rename(FCPATH . 'uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
						FCPATH . 'uploads/user/' . $user_avatar_name_copy);

				$save_data['avatar'] = $user_avatar_name_copy;
			}

			$save_user = $this->aauth->create_user($this->input->post('email'), $this->input->post('password'), $this->input->post('username'), $save_data);

			if ($save_user) {
				//add user to group
				if (count($this->input->post('group'))) {
					$user_id = $save_user;
					foreach ($this->input->post('group') as $group_id) {
						$this->aauth->add_member($user_id, $group_id);				
					}			
				}

				//Insert Departement to users
				$this->aauth->add_departement($user_id, $this->input->post('si_group'));			
				if ($this->input->post('save_type') == 'stay') {
					$response['success'] = true;
					$response['message'] = cclang('success_save_data_stay', [
						anchor('admin/users/edit/' . $save_user, 'Edit User'),
						anchor('admin/users', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('admin/users/edit/' . $save_user, 'Edit User')
					]), 'success');

	        		$response['success'] = true;
	        		$response['message'] = false;
					$response['redirect'] = site_url('admin/users');
				}
			} else {
				$response['success'] = false;
				$response['message'] = $this->aauth->print_errors();
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
		$path = FCPATH . 'uploads/user/'.$image;
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


	public function set_status()
	{

		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$update_status = $this->_db->where('id', $id)->update([
			'banned' => $status == 'disabled' ? 1 : 0
		]);
		
		if ($update_status) {
			$this->response = [
				'success' => true,
				'message' => 'User status updated',
			];
		} else {
			$this->response = [
				'success' => false,
				'message' => 'Data not change.'
			];
		}
		return $this->response($this->response);
	}

	/**
	* Upload Image User
	* 
	* @return JSON
	*/
	public function upload_avatar_file()
	{
		if (!$this->is_allowed('users_add', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

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
		if (!$this->is_allowed('users_delete', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		if (!empty($uuid)) {
			$this->load->helper('file');

			$delete_by = $this->input->get('by');
			$delete_file = false;

			if ($delete_by == 'id') {
				$user = $this->users->where('id', $uuid)->first();
				$path = FCPATH . 'uploads/user/'.$user->avatar;
				if ($user->avatar != 'default.png') {
					if (isset($uuid)) {
						if (is_file($path)) {
							$delete_file = unlink($path);
							$this->users->where('id', $uuid)->update(['avatar' => '']);
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
		if (!$this->is_allowed('users_update', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->load->helper('file');
		
		$user = $this->_db->where('id', $id)->first();

		if (!$user) {
			$result = [
				'error' =>  'Error getting file'
			];

    		return $this->response($result);
		} else {
			if (!empty($user->avatar)) {
				$result[] = [
					'success' 				=> true,
					'thumbnailUrl' 			=> base_url('uploads/user/'.$user->avatar),
					'id' 					=> 0,
					'name' 					=> $user->avatar,
					'uuid' 					=> $user->id,
					'deleteFileEndpoint' 	=> base_url('admin/users/delete_avatar_file'),
					'deleteFileParams'		=> ['by' => 'id']
				];

	    		return $this->response($result);
			}
		} 
	}


}

/* End of file Users.php */
/* Location: ./application/controllers/admin/Users.php */