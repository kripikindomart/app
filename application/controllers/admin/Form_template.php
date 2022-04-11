<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Template Controller
*| --------------------------------------------------------------------------
*| Form Template site
*|
*/

class Form_template extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_Form_template');
		$this->load->model('Model_pejabat', 'pejabat');
		$this->load->model('Model_komponen', 'komponen');
	}

	public function index()
	{
		//$this->is_allowed('form_template_list') ;
		$this->template->title('Template Form');
		$data = [];
		$this->render('Form_template/form_template_list', $data);
	}


	public function ajax()
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
		$data = $this->model_Form_template->getRequestAjax();
		$data_row = array();
			$no = $_POST['start'];
			$data_ = array();
			foreach ($data as $row) {
				$no++;
				$data_row = array();
				$data_row[] = '<input type="checkbox" class="data-check check checkbox icheckbox_flat-green toltip" value="'.$row->id.'" name="data-check[]">';
				$data_row[] = $no;
				  
			         
			      
			    			    $data_row[] = $row->nama_template;  
			          
			    			    $data_row[] = $row->pejabats_jabatan.' - '.$row->nama_karyawan;
			      
			    			    $data_row[] = $row->aktif;  
			          
			    
				//add html for action
				$data_row[] = '
				<div class="text-center"><button type="button" class="btn btn-sm btn-warning edit" title="Edit" id="edit" data-id = "'.$row->id.'"><i class="fa fa-pencil"></i>Edit </button>
				<button type="button" class="btn btn-sm btn-danger delete" title="Delete" id="delete" data-id = "'.$row->id.'"><i class="fa fa-trash"></i>Delete</button></div>';
				$data_[] = $data_row;
			}

			$json_data = [
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->model_Form_template->count_all(),
				"recordsFiltered" => $this->model_Form_template->_count_filtered(),
				'data' => $data_
			];

			return $this->response($json_data);
		}
		
	}

	public function add()
	{
		//$this->is_allowed('form_template_add') ;
		$this->template->title('Template Form');
		$pejabat = $this->pejabat->resultData();
		$komponen = $this->komponen->where('aktif', 'Y')->get('kategori_komponen');
		$kt = '<select name="kategori[]"  class="form-control chosen chosen-select kategori"><option>-Pilih kategori-</option>';
		foreach($pejabat as $row){
			foreach ($komponen as $r):
			$kt .= '
 							<option value="'.$r->id.'">'.$r->kategori.'</option>
 							
 						';
 			endforeach;
		}
		$kt .= '</select>
 						<br>
 						<p id="data_komponen">
 							
 						</p>';

		$data = [
			'pejabat' => $pejabat,
			'kat_komponen' => $komponen,
			'select_kt' => $kt
		];

		$this->render('Form_template/form_template_add', $data);
	}

	public function getKomponen()
	{
		$id = $this->input->post('id');
		$komponen = $this->komponen->select('komponen.*, kategori_komponen.kategori, kategori_komponen.pejabat_id')->join_ref('komponen', 'kategori_komponen')->where('komponen.id_kategori_komponen', $id)->get();
		if ($komponen) {
			$komp = '<ul>';
			foreach($komponen as $row){
				$komp .= '<li>'.$row->komponen.'</li>';
				$kp = $row;
			}
			$komp .= '</ul>';
			$result['success']= true;
			$result['data']= $komp;
			$result['komponen'] = $kp;
		} else {
			$result['success']= false;
			$result['data']= 'tidak ada data';
		}

		return $this->response($result);
	}

	public function get_option()
	{
		$pejabat_id = $this->input->post('pejabat');
		$pejabat = $this->pejabat->where('status', 'Y')->pejabat->resultData();;
		$op = '<option>-Pilih Penaggung Jawab-</option>';
		foreach($pejabat as $row){
			$op .= '
 							<option value="'.$row->id.'"'.($pejabat_id == $row->id ? "selected" : "").'>'.($row->karyawans_nama != null ? $row->departements_nama.' - '.$row->karyawans_nama.' - '.$row->jabatan : $row->departements_nama.' - '.$row->pengajars_nama.' - '.$row->jabatan ).'</option>
 						';
		}

		$response['message'] = $op;

		return $this->response($response);
	

	}

	public function addRow()
	{

		// $komponen_id = $this->input->post('komponen');
		// $pejabat = $this->pejabat->resultData();
		// $komponen = $this->komponen->get('kategori_komponen');
		// $tr = '<tr>'
		// foreach ($komponen as $row) {
		//  	$tr .= '<td>

		//  	';
		//  } 
		// 	if ($komponen) {
		// 		$result['success']= true;
		// 		$result['data']= $komponen;
		// 	} else {
		// 		$result['success']= true;
		// 		$result['data']= 'tidak ada data';
		// 	}
		// 	return $this->response($result);
	}

	public function add_save()
	{
		$p = $this->input->post(null, true);

		$mdtemplate = [
			'nama_template' => $p['title'],
			'pejabat_id' => $p['penaggung_jawab'],
		];

		$save_template = $this->model_Form_template->create($mdtemplate);
		if ($save_template) {
			if (is_array($p['kategori'])) {

				foreach ($p['kategori'] as $kategori) {
					$mdtemplate_komponen = [
						'id_template' => $save_template,
						'id_kategori_komponen' => $kategori
					];
					$save_komponen = $this->model_Form_template->create($mdtemplate_komponen, 'mdtemplate_komponen');
					if ($save_template) {
						
							if ($p['save_type'] == 'back') {
								$result['success']= true;
								$result['data']= false;
							} else {
								$result['success']= true;
								$result['data']= 'Data berhasil di simpan';
							}
						
						
					} else {
						$result['success']= false;
						$result['data']= 'gagal menyimpan data';
					}
				}
				
				
			} else {
				$save_komponen = $this->model_Form_template->create('mdtemplate_komponen', $mdtemplate_komponen);

					if ($save_komponen) {
						if ($p['save_type'] == 'back') {
							$result['success']= true;
							$result['data']= false;
						} else {
							$result['success']= true;
							$result['data']= 'Data berhasil di simpan';
						}
						
					} else {
						$result['success']= false;
						$result['data']= 'gagal menyimpan data komponen';
					}
			}

		} else {
				$result['success']= false;
					$result['data']= 'gagal menyimpan data template';
		}

		
		return $this->response($result);
	}

	public function setPejabatKomponen()
	{
		$p = $this->input->post(null, true);
		$pejabat_id = $p['pejabat_id'];
		$komponen_id = $p['komponen_id'];
			$update = [
					'pejabat_id' => $pejabat_id
			];
		 $save = $this->model_Form_template->where('id', $komponen_id)->update( $update, 'kategori_komponen');
		 if ($save) {
		 		$response['success'] = true;
		 		$response['message'] = 'Penaggung jawab komponen berhasil di set';
		 } else {
		 		$response['success'] = false;
		 		$response['message'] = 'Gagal menset penaggungjawab';
		 }
		

		return $this->response($response);
	}

	public function delete()
	{
		
	}

	

}