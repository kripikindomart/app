<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komponen extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_komponen', 'komponen');
		$this->load->model('Kategori_model', 'kategori');
	}

	public function index()
	{
		$this->template->title('Program Studi List');
		$data = [];
		$this->render('komponen/kategori_list', $data);
	}

	public function setKategori($id)
	{
		
	}

	public function ajaxList($id=null)
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
			$this->datatables->select('id, kategori, aktif');
	        $this->datatables->from('kategori_komponen');
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
			$btn_detail = '<a title="Setup" class="btn btn-xs btn-info " data-id="$1" href="'.base_url("admin/komponen/setup/").'$1">
	        	                    <i class="fa fa-cog"></i> Setup
	        	                  </a>	';
				        	                  
	       $this->datatables->add_column('btn_edit', $btn_edit, 'id')
	       ->add_column('btn_delete', $btn_delete, 'id')
	       ->add_column('btn_detail', $btn_detail, 'id');
	       
	        return $this->response($this->datatables->generate(), false);
		}
	}

	public function setup($id)
	{
		$this->template->title('Komponen');
		$data_kategori = $this->komponen->where('id', $id)->first('kategori_komponen');

		$data = ['data_kategori' => $data_kategori];
		$this->render('komponen/setup_list', $data);
	}

	public function save_komponen()
	{
		$post = $this->input->post(null, true);
		
		$data = [
			'id_kategori_komponen' => $post['id_kategori'],
			'komponen' => $post['nama_komponen'],
			
		];
		$save = $this->komponen->create($data, 'komponen');
		if ($save) {
			$response['message'] = 'Data Komponen Berhasi di simpan';
			$response['success'] = true;
		} else {
			$response['message'] = 'gagal menyimpan data';
			$response['success'] = false;
		}

		$this->response($response);
	}

	public function setup_save()
	{
		$post = $this->input->post(null, true);
		
		$data = [
			'id_kategori_komponen' => $post['id_kategori'],
			'komponen' => $post['nama_komponen'],
			'jenis' => $post['jenis'],
			
		];
		$save = $this->komponen->create($data, 'komponen');
		if ($save) {
			$response['message'] = 'Data Komponen Berhasi di simpan';
			$response['success'] = true;
		} else {
			$response['message'] = 'gagal menyimpan data';
			$response['success'] = false;
		}

		$this->response($response);
	}

	public function edit()
	{
		$id = $this->input->post('id');
		$data = $this->komponen->where('id',$id)->first('kategori_komponen');
		if ($data) {
			$response['message'] = $data;
			$response['success'] = true;
		} else {
			$response['message'] = 'gagal meload data';
			$response['success'] = false;
		}

		return $this->response($response);
	}

	public function delete()
	{
		$id = $this->input->post('delete_id');

		if (is_array($id)) {
			foreach($id as $i){
				$delete = $this->komponen->where('id', $i)->delete('kategori_komponen');
			}
			if ($delete) {
				$response['message'] = 'data berhasil di hapus';
				$response['success'] = true;
			} else {
				$response['message'] = 'gagal menghapus data ';
				$response['success'] = false;
			}
		} else {
			$delete = $this->komponen->where('id', $id)->delete('kategori_komponen');
			if ($delete) {
				$response['message'] = 'berhasil menghapus data';
				$response['success'] = true;
			} else {
				$response['message'] = $id;
				$response['success'] = false;
			}
		}

		return $this->response($response);
	}

	public function edit_setup()
	{
		$id = $this->input->post('id');
		$data = $this->komponen->where('id',$id)->first();
		if ($data) {
			$response['message'] = $data;
			$response['success'] = true;
		} else {
			$response['message'] = 'gagal meload data';
			$response['success'] = false;
		}

		return $this->response($response);

	}

	public function setup_delete()
	{
		$id = $this->input->post('delete_id');
		if (is_array($id)) {
			foreach($id as $i){
				$delete = $this->komponen->where('id', $i)->delete();
			}
			if ($delete) {
				$response['message'] = 'data berhasil di hapus';
				$response['success'] = true;
			} else {
				$response['message'] = 'gagal menghapus data ';
				$response['success'] = false;
			}
		} else {
			$delete = $this->komponen->where('id', $id)->delete();
			if ($delete) {
				$response['message'] = 'data berhasil di hapus';
				$response['success'] = true;
			} else {
				$response['message'] = 'gagal menghapus data ';
				$response['success'] = false;
			}
		}

		return $this->response($response);
	}

	public function setup_edit_save()
	{
		$post = $this->input->post(null, true);
		
		$data = [
			'id_kategori_komponen' => $post['id_kategori'],
			'komponen' => $post['nama_komponen'],
			'jenis' => $post['jenis'],
			
		];
		$save = $this->komponen->where('id', $post['id'])->update($data, 'komponen');
		if ($save) {
			$response['message'] = 'Data Komponen Berhasi di simpan';
			$response['success'] = true;
		} else {
			$response['message'] = 'gagal menyimpan data';
			$response['success'] = false;
		}

		$this->response($response);
	}

	public function kategori_edit_save()
	{
		$post = $this->input->post(null, true);
		
		$data = [
			'kategori' => $post['kategori'],
			'aktif' => $post['aktif'],
			
		];
		$save = $this->komponen->where('id', $post['id'])->update($data, 'kategori_komponen');
		if ($save) {
			$response['message'] = 'Data Berhasi di simpan';
			$response['success'] = true;
		} else {
			$response['message'] = 'gagal menyimpan data';
			$response['success'] = false;
		}

		$this->response($response);
	}



	public function setup_list_ajax($id)
	{

		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {

	        $data = $this->komponen->where('id_kategori_komponen', $id)->getRequestAjax();


			$data_row = array();
			$data_ = array();
			$no = $_POST['start'];
			foreach ($data as $row) {
				$no++;
				$data_row = array();
				$data_row[] = $no;
				$data_row[] = '<input type="checkbox" class="delete_id check checkbox icheckbox_flat-green toltip" value="'.$row->id.'" name="delete_id[]">';
			    $data_row[] = $row->komponen;
			    $data_row[] = $row->jenis;
				//add html for action
				$data_row[] = '
				<div class="text-center"><button type="button" class="btn btn-sm btn-warning edit" title="Edit" id="edit" data-id = "'.$row->id.'"><i class="fa fa-pencil"></i>Edit </button>
				<button type="button" class="btn btn-sm btn-danger delete" title="Delete" id="delete" data-id = "'.$row->id.'"><i class="fa fa-trash"></i>Delete</button></div>';
				$data_[] = $data_row;
			}


			$json_data = [
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->komponen->where('id_kategori_komponen', $id)->count_all(),
				"recordsFiltered" => $this->komponen->where('id_kategori_komponen', $id)->_count_filtered(),
				'data' => $data_
			];
			return $this->response($json_data);

		}
	}

	public function add_kategori()
	{
		if (!$_POST) {
			$input = (object) $this->kategori->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}

		if ($this->kategori->validate()) {
			
			$save_prodi = $this->kategori->run($input);
			if ($save_prodi) {
				if ($this->input->post('save_type') == 'stay') {
						$response['success'] = true;
						$response['message'] = 'Berhasil menyimpan data, klik link untuk mengedit kategori'.
							anchor('admin/kategori/edit/' . $save_prodi, ' Edit kategori'). ' atau klik'.
							anchor('admin/kategori', ' kemabali ke list'). ' untuk melihat seluruh data';
				} else {
					$response['message'] = 'Berhasil menyimpan data Prodi';
	        		$response['success'] = true;
					$response['redirect'] = site_url('admin/kategori');
				} 

			} else {
				$response['success'] = false;
				$response['message'] = 'gagal menyimpan data kategori';
			}
		}	else {
			$response['success'] = false;
			$response['message'] = validation_errors();
		}

		return $this->response($response);
	}



	public function SidangTesis()
	{
		
	}

	public function SidangDisertasi()
	{
		
	}

	public function administrasi()
	{
		
	}

}

/* End of file Komponen.php */
/* Location: ./application/controllers/admin/Komponen.php */