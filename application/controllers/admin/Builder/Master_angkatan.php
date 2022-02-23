<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Master Angkatan Controller
*| --------------------------------------------------------------------------
*| Master Angkatan site
*|
*/
class Master_angkatan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('builder/model_master_angkatan', 'model_master_angkatan');
	}

	/**
	* show all Master Angkatans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		//$this->is_allowed('master_angkatan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['master_angkatans'] = $this->model_master_angkatan->get($filter, $field, $this->limit_page, $offset);
		$this->data['master_angkatan_counts'] = $this->model_master_angkatan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/master_angkatan/index/',
			'total_rows'   => $this->model_master_angkatan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Master Angkatan List');
		$this->render('master_angkatan/master_angkatan_list', $this->data);
	}
	
	/**
	* Add new master_angkatans
	*
	*/
	public function add()
	{
		//$this->is_allowed('master_angkatan_add');

		$this->template->title('Master Angkatan New');
		$this->render('master_angkatan/master_angkatan_add', $this->data);
	}

	/**
	* Add New Master Angkatans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('master_angkatan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'keterangan' => $this->input->post('keterangan'),
				'aktif' => $this->input->post('aktif'),
			];

			
			$save_master_angkatan = $this->model_master_angkatan->store($save_data);

			if ($save_master_angkatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_master_angkatan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/master_angkatan/edit/' . $save_master_angkatan, 'Edit Master Angkatan'),
						anchor('administrator/master_angkatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/master_angkatan/edit/' . $save_master_angkatan, 'Edit Master Angkatan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/master_angkatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/master_angkatan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Master Angkatans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('master_angkatan_update');

		$this->data['master_angkatan'] = $this->model_master_angkatan->find($id);

		$this->template->title('Master Angkatan Update');
		$this->render('backend/standart/administrator/master_angkatan/master_angkatan_update', $this->data);
	}

	/**
	* Update Master Angkatans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('master_angkatan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'keterangan' => $this->input->post('keterangan'),
				'aktif' => $this->input->post('aktif'),
			];

			
			$save_master_angkatan = $this->model_master_angkatan->change($id, $save_data);

			if ($save_master_angkatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/master_angkatan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/master_angkatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/master_angkatan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Master Angkatans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('master_angkatan_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'master_angkatan'), 'success');
        } else {
            set_message(cclang('error_delete', 'master_angkatan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Master Angkatans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('master_angkatan_view');

		$this->data['master_angkatan'] = $this->model_master_angkatan->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Master Angkatan Detail');
		$this->render('backend/standart/administrator/master_angkatan/master_angkatan_view', $this->data);
	}
	
	/**
	* delete Master Angkatans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$master_angkatan = $this->model_master_angkatan->find($id);

		
		
		return $this->model_master_angkatan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('master_angkatan_export');

		$this->model_master_angkatan->export('master_angkatan', 'master_angkatan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('master_angkatan_export');

		$this->model_master_angkatan->pdf('master_angkatan', 'master_angkatan');
	}
}


/* End of file master_angkatan.php */
/* Location: ./application/controllers/administrator/Master Angkatan.php */