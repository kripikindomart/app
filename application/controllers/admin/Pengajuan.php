<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Prodi_model', 'prodi');
		$this->load->model('Mahasiswa_model', 'mhs');
	}


	public function index()
	{
		//$this->is_allowed('Program Studis_list') ;
		$this->template->title('Pendaftaran');
		$data = [
			'angkatan' => $this->prodi->get('master_angkatan')
		];
		$data['prodi'] = $this->prodi->where('prodiID != ', 'ADM')->get('master_prodi');

		// print_r ($data['angkatan']);
		// die();
		$this->render('Pendaftaran/pendaftaran', $data);
	}

	public function add()
	{
		$this->template->title('Pendaftaran');
		
		$this->render('Pendaftaran/pendaftaran', $data);
	}

	public function getData()
	{
		$id = $this->input->post('id');
		$this->db->join('master_angkatan', 'master_angkatan.id = master_mahasiswa.id_angkatan', 'left');
		$this->db->join('master_prodi', 'master_prodi.id = master_mahasiswa.id_master_prodi', 'left');
		$data_mhs = $this->mhs->where('master_mahasiswa.id', $id)->first();

		if ($data_mhs) {
			$response['data'] = $data_mhs;
			$response['success'] = true;	
		} else {
			$response['data_mhs'] = 'Tidak ada data';
			$response['success'] = false;
		}

		$this->response($response);

	}

	public function ajuan()
	{
		$post = $this->input->post(null, true);
		$data = [
			'npm' => $post['npm'],
			'ujian' => $post['ujian'],
			'prodi_id' => $post['prodiid'],
			'angkatan_id' => $post['angkatanid'],
			'thesis' => $post['thesis'],
		];
		$save = $this->mhs->create($data, 'app_pengajuan');
		if ($save) {
			$response['message'] = 'Data berhasil di ajukan';
			$response['success'] = true;
		} else {
			$response['message'] = 'gagal menyimpan data';
			$response['success'] = false;
		}

		$this->response($response);

	}

}

/* End of file Pendaftaran.php */
/* Location: ./application/controllers/admin/Pendaftaran.php */