<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angkatan extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Angkatan', 'angkatan');
	}

	public function index()
	{
		$data['title']	= 'Angkatan';
		$data['page']	= 'angkatan/angkatan_list';
		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}

	public function ajaxList($id=null)
	{
		//if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
			$this->datatables->select('id, keterangan, aktif');
	        $this->datatables->from('master_angkatan');
	        $this->db->order_by('id','dsc');
	       
	        $btn_edit = false;
	        if ($this->is_allowed('users_update', false) == true) {
	        	$btn_edit = '
	        		        	<button type="button" title="Edit data terpilih" class="btn btn-xs btn-warning edit mr-1" data-id = "$1">
	        		            <i class="fa fa-pencil"></i>
	        		          </a>';
	        }
	        $btn_delete = false;
	        if ($this->is_allowed('users_delete', false) == true) {
	        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete mr-1" data-id="$1" >
	        	                    <i class="fa fa-trash"></i>
	        	                  </button>	';
	        }
			$status = false;
			// $btn_detail = '<button title="Detail" type="button" class="btn btn-xs btn-info 					" data-id="$1" >
	  //       	                    <i class="fa fa-eye"></i>
	  //       	                  </button>	';
				        	                  
	       $this->datatables->add_column('btn_edit', $btn_edit, 'id')
	       ->add_column('btn_delete', $btn_delete, 'id');
	       // ->add_column('btn_detail', $btn_detail, 'id');
	       
	        return $this->response($this->datatables->generate(), false);
		//}
	}

	public function save()
	{
		if (!$_POST) {
			$input = (object) $this->angkatan->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}

		if ($this->angkatan->validate()) {
			$save_angkatan = $this->angkatan->run($input);
			if ($save_angkatan) {
				if ($this->input->post('save_type') == 'stay') {
						$response['success'] = true;
						$response['message'] = 'Berhasil menyimpan data, klik link untuk mengedit angkatan'.
							anchor('admin/angkatan/edit/' . $save_angkatan, ' Edit angkatan'). ' atau klik'.
							anchor('admin/angkatan', ' kemabali ke list'). ' untuk melihat seluruh data';
				} else {
					$response['message'] = 'Berhasil menyimpan data Angkatan';
	        		$response['success'] = true;
					$response['redirect'] = site_url('admin/angkatan');
				} 

			} else {
				$response['success'] = false;
				$response['message'] = 'gagal menyimpan data angkatan';
			}
		}	else {
			$response['success'] = false;
			$response['message'] = validation_errors();
		}

		return $this->response($response);
	}

	/**
	* delete Program Studis
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
					$response['message'] = "Data Program Studi berhasil di hapus";
					set_message('Data Program Studi berhasil di hapus', 'success');
				} else {
					$response['success'] = false;
					$response['message'] = 'Maaf gagal menghapus data';
				}
			}
		} else {
			if (! $this->angkatan->where('id', $id['delete_id'])->first()) {
				$response['success'] = false;
				$response['message'] = 'Maaf data tidak ditemukan';
			} else {
				$remove = $this->_remove($id['delete_id']);
				if ($remove) {
					$response['success'] = true;
					$response['message'] = "Data Program Studi berhasil di hapus";
					set_message('Data Program Studi berhasil di hapus', 'success');
				} else {
					$response['success'] = false;
					$response['message'] = 'Maaf gagal menghapus data';
				}
			}				
		}
		
		return $this->response($response);
	}

	/**
	* Edit Program Studis
	*
	* @var $id String
	*/
	public function edit()
	{
		$id = $this->input->post('id');
		$data= $this->angkatan->where('id', $id)->first();
		if ($data) {
			
				$response['message'] = $data;
				$response['success'] = true;
			
		} else {
			$response['message'] = 'Gagal meload data ruangan';
			$response['success'] = false;
		}
		
		return $this->response($response);
	}

	public function edit_save($profile = null)
	{
		if (!$_POST) {
			$input = (object) $this->angkatan->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}
		$this->load->library('form_validation');
		$validationRules = [
			[
				'field' => 'tahun_angkatan',
				'label' => 'Tahun Angkatan',
				'rules' => 'trim|required',
				'errors' => array('required' => '%s tidak boleh kosong')
			],

			
		];
		$this->form_validation->set_rules($validationRules);
		if ($this->form_validation->run()) {
			
			$save_angkatan = $this->angkatan->run($input,'update');
			if ($save_angkatan) {
				$response['message'] = 'Berhasil mengupdate data';
        		$response['success'] = true;
			} else {
				$response['success'] = false;
				$response['message'] = 'gagal menyimpan data Angkatan';
			}
		}	else {
			$response['success'] = false;
			$response['message'] = validation_errors();
		}

		return $this->response($response);
	}

		

	/**
	* delete Program Studis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$delete = $this->angkatan->where('id', $id)->delete(); //$this->aauth->delete_Program Studi(7); 
		if ($delete) {
			return true;
		}	
	}


}

/* End of file Angkatan.php */
/* Location: ./application/controllers/admin/Angkatan.php */