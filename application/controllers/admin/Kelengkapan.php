<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelengkapan extends Admin {

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
		$this->render('kelengkapan/kelengkapan_list', $data);
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
		$this->template->title('Program Studi List');
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

	public function setup_list_ajax($id)
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
			$this->datatables->select('k.id, k.kategori, k.aktif, kk.kategori');
	        $this->datatables->from('komponen k');
	        $this->db->where('k.id', $id);
	        $this->db->join('kategori_komponen kk', 'kk.id = k.id_kategori_komponen', 'left');
	        $this->db->order_by('k.id','dsc');
	       
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