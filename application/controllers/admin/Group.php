<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Group_model','group');
	}

	public function index()
	{
		$this->is_allowed('group_list') ;
		
		$this->template->title('Group List');
		$data = [];
		$this->render('group/group_list', $data);
	}

	public function ajaxList($id=null)
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
			$this->datatables->select('id, name, definition');
	        $this->datatables->distinct('');
	        $this->datatables->from('aauth_groups');
	        $this->db->order_by('id','dsc');
	        if ($id != null) {
	        	 $this->datatables->where('id', $id);
	        }
	        $btn_edit = false;
	        if ($this->is_allowed('group_update', false) == true) {
	        	$btn_edit = '
	        		        	<a title="Edit data terpilih" class="btn btn-xs btn-warning" href="'.base_url("apanel/group/edit/$1").'">
	        		            <i class="fa fa-pencil"></i>
	        		          </a>';
	        }
	        $btn_delete = false;
	        if ($this->is_allowed('group_delete', false) == true) {
	        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete" data-id="$1" >
	        	                    <i class="fa fa-trash"></i>
	        	                  </button>	';
	        }
	       $this->datatables->add_column('btn_edit', $btn_edit, 'id')
	       ->add_column('btn_delete', $btn_delete, 'id');	
	       

	        return $this->response($this->datatables->generate(), false);
		}
	}

	/**
	* delete Group
	*
	* @var $id String
	*/
	public function delete()
	{
		if (!$this->is_allowed('group_delete', false)) {
			return $this->response([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		$id = $this->input->post(null, true);
		
		$remove = false;
		if (is_array($id['delete_id'])) {
			foreach ($id['delete_id'] as $i) {
				$remove = $this->_remove($i);
				//$response['success'] = $id['delete_id'];
				if ($remove) {
					$response['success'] = true;
					$response['message'] = cclang('has_been_deleted', 'Group');
					set_message(cclang('has_been_deleted', 'Group'), 'success');
				} else {
					$response['success'] = false;
					$response['message'] = cclang('error_delete', 'Group');
				}
			}
		} else {
			if (! $this->group->where('id', $id['delete_id'])->first()) {
				$response['success'] = false;
				$response['message'] = 'Maaf data tidak ditemukan';
			} else {
				$remove = $this->_remove($id['delete_id']);
				if ($remove) {
					$response['success'] = true;
					$response['message'] = cclang('has_been_deleted', 'Group');
					set_message(cclang('has_been_deleted', 'Group'), 'success');
				} else {
					$response['success'] = false;
					$response['message'] = cclang('error_delete', 'Group');
				}
			}				
		}
		
		return $this->response($response);
	}


	/**
	* delete groups
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$delete = $this->group->where('id', $id)->delete();
		if ($delete) {
			return true;
		}
	}

	/*
	* add groups
	*
	*
	*/
	public function add()
	{
		$this->is_allowed('group_add') ;
		
		$this->template->title('Group New');
		$data = [];
		$this->render('group/group_add', $data);
	}

}

/* End of file Group.php */
/* Location: ./application/controllers/apanel/Group.php */