<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Daftar Controller
*| --------------------------------------------------------------------------
*| Daftar site
*|
*/

class Daftar extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_daftar');
	}

	public function index($ujian = null)
	{
		//$this->is_allowed('daftar_list') ;
		$this->template->title('Pendaftaran Ujian');
		//Get Template by $ujian
		$this->model_daftar->select('mdtemplate_form.*, mdtemplate_komponen.*, kategori_komponen.*, pejabats.*, karyawans.*, pengajars.*, komponen.*');

		$this->model_daftar->join('mdtemplate_komponen', 'mdtemplate_komponen.id_template = mdtemplate_form.id_template', 'left');

		$this->model_daftar->join('kategori_komponen', 'kategori_komponen.id = mdtemplate_komponen.id_kategori_komponen', 'left');
		$this->model_daftar->join('komponen', 'komponen.id_kategori_komponen = kategori_komponen.id', 'left');

		$this->model_daftar->join('pejabats', 'pejabats.id = kategori_komponen.pejabat_id', 'UNION ALL');
		$this->model_daftar->join('pejabats', 'pejabats.id = mdtemplate_form.pejabat_id', 'UNION ALL');

		$this->model_daftar->join('karyawans', 'karyawans.id = pejabatas.karyawan_id', 'UNION ALL');
		$this->model_daftar->join('pengajars', 'pengajars.id = pejabatas.pengajar_id', 'UNION ALL');
		

		$this->model_daftar->from('mdtemplate_form');
		$this->model_daftar->where('mdtemplate_form.nama_template', 'proposal');
		$data = $this->model_daftar->get()->result();
		echo "<pre>";
		print_r ($data);
		die();

		$data = ['ujian' => $ujian];
		$this->render('Daftar/daftar_add', $data);
	}


	public function ajax()
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
		$data = $this->model_daftar->getRequestAjax();
		$data_row = array();
			$no = $_POST['start'];
			$data_ = array();
			foreach ($data as $row) {
				$no++;
				$data_row = array();
				$data_row[] = '<input type="checkbox" class="data-check check checkbox icheckbox_flat-green toltip" value="'.$row->id.'" name="data-check[]">';
				$data_row[] = $no;
				  
			         
			      
			    			    $data_row[] = $row->kode;  
			          
			      
			    			    $data_row[] = $row->npm;  
			          
			      
			    			    $data_row[] = $row->ujian_id;  
			          
			      
			    			    $data_row[] = $row->form_id;  
			          
			      
			    			    $data_row[] = $row->tanggal_daftar;  
			          
			      
			    			    $data_row[] = $row->tanggal_ujian;  
			          
			    
				//add html for action
				$data_row[] = '
				<div class="text-center"><button type="button" class="btn btn-sm btn-warning edit" title="Edit" id="edit" data-id = "'.$row->id.'"><i class="fa fa-pencil"></i>Edit </button>
				<button type="button" class="btn btn-sm btn-danger delete" title="Delete" id="delete" data-id = "'.$row->id.'"><i class="fa fa-trash"></i>Delete</button></div>';
				$data_[] = $data_row;
			}

			$json_data = [
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->model_daftar->count_all(),
				"recordsFiltered" => $this->model_daftar->_count_filtered(),
				'data' => $data_
			];

			return $this->response($json_data);
		}
		
	}

	

}