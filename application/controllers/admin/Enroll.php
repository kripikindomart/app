<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enroll extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Enroll_model', '_db');
		$this->load->model('Course_model', 'course');
		
	}

	public function index()
	{
		$data['title']	= 'Enroll ';
		$data['page']	= 'enroll/index';
		$data['prodi'] = $this->_db->get('master_prodi');

		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}

	public function ajax($id=null)
	{
		return $this->response($this->_db->getData($id), false);
	}


	public function detail($id)
	{
		$data['title']	= 'Detail Enroll ';
		$data['page']	= 'enroll/detail';
		$data['prodi'] = $this->_db->where('prodiID', $id)->get('master_prodi');
		$data['prodi_data'] = $this->_db->get('master_prodi');
		$this->template->title($data['title']);
		$this->render($data['page'], $data);
	}

	public function detail_ajax($id_prodi)
	{
		return$this->response($this->_db->getDataUjian($id_prodi), false);
		
	}

	/**
	* delete soal
	*
	* @var $id String
	*/
	public function delete()
	{

		$id = $this->input->post(null, true);
		
		$remove = false;
		if (is_array($id['delete_id'])) {
			foreach ($id['delete_id'] as $i) {
				$remove = $this->_remove($i);
				//$response['success'] = $id['delete_id'];
				if ($remove) {
					$response['success'] = true;
					$response['message'] = "Data Group Soal berhasil di unenroll";
					set_message('Data soal berhasil di hapus', 'success');
				} else {
					$response['success'] = false;
					$response['message'] = $i;
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
					$response['message'] = "Data Group Soal berhasil di unenroll";
					set_message('Data soal berhasil di hapus', 'success');
				} else {
					$response['success'] = false;
					$response['message'] = 'Maaf gagal menghapus data2';
				}
			}				
		}
		
		return $this->response($response);
	}

	

    public function delete_soal()
    {
        $chk = $this->input->post('checked', true);
        
        // Delete File
        foreach($chk as $id){
            $abjad = ['a', 'b', 'c', 'd', 'e'];
            $path = FCPATH.'uploads/bank_soal/';
            $soal = $this->soal->getSoalById($id);
            // Hapus File Soal
            if(!empty($soal->file)){
                if(file_exists($path.$soal->file)){
                    unlink($path.$soal->file);
                }
            }
            //Hapus File Opsi
            $i = 0; //index
            foreach ($abjad as $abj) {
                $file_opsi = 'file_'.$abj;
                if(!empty($soal->$file_opsi)){
                    if(file_exists($path.$soal->$file_opsi)){
                        unlink($path.$soal->$file_opsi);
                    }
                }
            }
        }

        if(!$chk){
            $this->output_json(['status'=>false]);
        }else{
            if($this->master->delete('tb_soal', $chk, 'id_soal')){
                $this->output_json(['status'=>true, 'total'=>count($chk)]);
            }
        }
    }

	

	/**
	* delete soal
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$delete = $this->_db->where('id', $id)->delete();
		if ($delete) {
			return true;
		}

		
	}

	public function detail_soal($prodi, $id_group)
	{
		$data['page']	= 'enroll/detail_soal';
		$data['prodi'] = $this->_db->where('prodiID', $prodi)->first('master_prodi');
		$data['group'] = $this->_db->where('id', $id_group)->get('group_soal');
		$this->template->title('Detail Soal');
		$this->render($data['page'], $data);

		
	}

	public function detailAjax($id_group)
	{
		return $this->response($this->_db->getSoal($id_group), false);
	}

}

/* End of file Enroll.php */
/* Location: ./application/controllers/admin/Enroll.php */