<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Permission_model', '_db');
	}

	public function index()
	{
		//$this->is_allowed('permission_list') ;
		$this->template->title('Permission List');
		$data = [];
		$this->render('permission/permission_list', $data);
	}

	public function ajaxList($id=null)
	{
		//if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
			$this->datatables->select('id, name, definition');
	        $this->datatables->from('aauth_perms');
	        $this->db->order_by('id','dsc');
	        if ($id != null) {
	        	 $this->datatables->where('id', $id);
	        }
	        //$btn_edit = false;
	        //if ($this->is_allowed('permission_update', false) == true) {
	        	$btn_edit = '
	        		        	<a title="Edit data terpilih" class="btn btn-xs btn-warning" href="'.base_url("admin/permission/edit/$1").'">
	        		            <i class="fa fa-pencil"></i>
	        		          </a>';
	        //}
	       // $btn_delete = false;
	        //if ($this->is_allowed('permission_delete', false) == true) {
	        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete" data-id="$1" >
	        	                    <i class="fa fa-trash"></i>
	        	                  </button>	';
	        //}
					        	                  
	       $this->datatables->add_column('btn_edit', $btn_edit, 'id')
	       ->add_column('btn_delete', $btn_delete, 'id');
	       
	        return $this->response($this->datatables->generate(), false);
		//}
	}

	public function add()
	{
		$this->is_allowed('permission_add') ;
		$this->template->title('permission Add');
		$data = [];
		$this->render('permission/permission_add', $data);
	}

	/**
	* Add New permission
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('permission_add', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[aauth_permission.username]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[aauth_permission.email]|valid_email');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

		if ($this->form_validation->run()) {
			$user_avatar_uuid = $this->input->post('user_avatar_uuid');
			$user_avatar_name = $this->input->post('user_avatar_name');

			$save_data = [
				'full_name' 	=> $this->input->post('fullname'),
				'avatar' 		=> 'default.png',
				'date_created'	=> date('Y-m-d H:i:s'),
				'group_id'	=> $this->input->post('si_group')
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

				//Insert Departement to permission
				$this->aauth->add_departement($user_id, $this->input->post('si_group'));			
				if ($this->input->post('save_type') == 'stay') {
					$response['success'] = true;
					$response['message'] = cclang('success_save_data_stay', [
						anchor('admin/permission/edit/' . $save_user, 'Edit User'),
						anchor('admin/permission', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('admin/permission/edit/' . $save_user, 'Edit User')
					]), 'success');

	        		$response['success'] = true;
	        		$response['message'] = false;
					$response['redirect'] = site_url('admin/permission');
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
	* delete permission
	*
	* @var $id String
	*/
	public function delete()
	{
		// if (!$this->is_allowed('permission_delete', false)) {
		// 	return $this->response([
		// 		'success' => false,
		// 		'message' => cclang('sorry_you_do_not_have_permission_to_delete')
		// 		]);
		// }
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
	* Edit permission
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('permission_update') ;

		$this->template->title('permission Edit');
		$data['data']		= $this->_db->where('id', $id)->first();
		$data['group_user']		= $this->_db->get_group_user($id);
		$this->render('permission/permission_edit', $data);
	}

	/**
	* Update permission
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('permission_update', false)) {
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
						anchor('admin/permission', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

	        		$response['success'] = true;
					$response['redirect'] = site_url('admin/permission');
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
	* delete permission
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$delete = $this->_db->where('id', $id)->delete(); //$this->aauth->delete_user(7); 
		if ($delete) {
			return true;
		}

		
	}

}

/* End of file Permission.php */
/* Location: ./application/controllers/admin/Permission.php */