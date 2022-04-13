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
		//$this->db->select('mdtemplate_form.title, mdtemplate_form.nama_template, pjmdtemplate.jabatan, pjmdtemplate.ttd, kr.nama as nama_karyawan');
		$mdtemplate_komponen = "SELECT kategori_komponen.kategori, pejabats.jabatan, pejabats.ttd, karyawans.nama as nama_penaggungjawab FROM mdtemplate_komponen 
				INNER JOIN kategori_komponen on kategori_komponen.id = mdtemplate_komponen.id_kategori_komponen
					INNER JOIN mdtemplate_form on mdtemplate_form.id =  mdtemplate_komponen.id_template
					INNER JOIN pejabats on pejabats.id = kategori_komponen.pejabat_id
					INNER JOIN karyawans on karyawans.id = pejabats.karyawan_id";
				
		$sql_komponen = "SELECT komponen.* FROM kategori_komponen INNER JOIN komponen on komponen.id_kategori_komponen = kategori_komponen.id";			
		// $mdtemplate_komponen = "SELECT mdtemplate_form.title, mdtemplate_form.nama_template,  kategori_komponen.kategori, pejabats.jabatan, pejabats.ttd, komponen.komponen as nama_komponen, komponen.jenis, group_concat(karyawans.nama SEPARATOR ',') as penanggung_jawab FROM mdtemplate_komponen 
		// 		INNER JOIN kategori_komponen on kategori_komponen.id = mdtemplate_komponen.id_kategori_komponen
		// 		INNER JOIN komponen on komponen.id_kategori_komponen = kategori_komponen.id
		// 		INNER JOIN mdtemplate_form on mdtemplate_form.id =  mdtemplate_komponen.id_template
		// 		INNER JOIN pejabats on pejabats.id = kategori_komponen.pejabat_id AND kategori_komponen.pejabat_id=pejabats.id
		// 		INNER JOIN karyawans on karyawans.id = pejabats.karyawan_id 
		// 		GROUP BY kategori_komponen.pejabat_id
		// 		";					



		$mdtemplate_form = "SELECT mdtemplate_form.*, pejabats.jabatan, pejabats.ttd, kr.*
		FROM  mdtemplate_form
		INNER JOIN pejabats on pejabats.id = mdtemplate_form.pejabat_id
		LEFT JOIN karyawans kr on kr.id = pejabats.karyawan_id
		";
		
		
	
		$data1 = $this->db->query($mdtemplate_komponen)->result_array();
		$data2 = $this->db->query($mdtemplate_form)->result_array();
		$data3 = $this->db->query($sql_komponen)->result_array();
		$data = [];
		foreach ($data2 as $row) {
			$data[] = $row;
				$data[]['komponen'] = $data1;
		}
		
		// $this->db->join('pejabats pjmdtemplate', 'pjmdtemplate.id = mdtemplate_form.pejabat_id', 'left');

		// $this->db->join('karyawans kr', 'kr.id = pjmdtemplate.karyawan_id', 'left');
		// $this->model_daftar->join('kategori_komponen', 'kategori_komponen.id = mdtemplate_komponen.id_kategori_komponen', 'left');
		// $this->model_daftar->join('komponen', 'komponen.id_kategori_komponen = kategori_komponen.id', 'left');

		// $this->model_daftar->join('pejabats ps1', 'ps1.id = kategori_komponen.pejabat_id', 'UNION ALL');
		// $this->model_daftar->join('pejabats ps2', 'ps2.id = mdtemplate_form.pejabat_id', 'UNION ALL');

		// $this->model_daftar->join('karyawans', 'karyawans.id = ps1.karyawan_id', 'UNION ALL');
		// $this->model_daftar->join('pengajars', 'pengajars.id = ps2.pengajar_id', 'UNION ALL');
		

		//$this->db->where('mdtemplate_form.nama_template', 'proposal');
		//$data = $this->db->get('mdtemplate_form')->result();
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