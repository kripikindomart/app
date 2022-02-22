<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soal_model extends MY_Model {

	protected $perPage = 5;
	protected $primary_key = 'id';
	protected $table = 'bank_soal';

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getDefaultValues()
	{
		return [
			'id'		=> '',
			'id_master_prodi'	=> '',
			'pertanyaan'	=> '',
			'jawaban'	=> '',
			'bobot'	=> '',
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field' => 'title_soal',
				'label' => 'Title Soal',
				'rules' => 'trim|required',
			],
			[
				'field' => 'jawaban',
				'label' => 'Kunci Jawaban',
				'rules' => 'trim|required',
			],
			[
				'field' => 'bobot',
				'label' => 'Bobot Nilai',
				'rules' => 'trim|required',
			],

		];
		return $validationRules;
		
	}

	public function run($data, $action = 'input')
	{
		if ($action == 'input') {
	
			$save_data = [
				'pertanyaan'      	=> $data->soal,
                'jawaban'   		=> $data->jawaban,
                'bobot'     		=> $data->bobot,

			];

			$abjad = ['a', 'b', 'c', 'd', 'e'];
            
            // Inputan Opsi
            foreach ($abjad as $abj) {
                $save_data['opsi_'.$abj]    = $this->input->post('jawaban_'.$abj, true);
            }

            $i = 0;
            foreach ($_FILES as $key => $val) {
                $img_src = FCPATH.'uploads/bank_soal/';
                //$getsoal = $this->soal->getSoalById($this->input->post('id_soal', true));
                $getsoal = $this->soal->find($this->input->post('id', true));
                
                $error = '';
                if($key === 'file_soal'){
                    if(!empty($_FILES['file_soal']['name'])){
                        if (!$this->upload->do_upload('file_soal')){
                            $error = $this->upload->display_errors();
                            show_error($error, 500, 'File Soal Error');
                            exit();
                        }else{
                            
                            $save_data['file'] = $this->upload->data('file_name');
                            $save_data['tipe_file'] = $this->upload->data('file_type');
                        }
                    }
                }else{
                    $file_abj = 'file_'.$abjad[$i];
                    if(!empty($_FILES[$file_abj]['name'])){    
                        if (!$this->upload->do_upload($key)){
                            $error = $this->upload->display_errors();
                            show_error($error, 500, 'File Opsi '.strtoupper($abjad[$i]).' Error');
                            exit();
                        }
                    }
                    $i++;
                }
            }
            $save_data['title_soal'] = $this->input->post('title_soal');
            $save_data['created_at'] = time();
            $save_data['update_at'] = time();	
			return $this->create($save_data);
		} else {
		
			return $this->where('id', $data['id'])->update($data);
		}
	}

	public function save_soal($data)
	{
		 $save = $this->create($data);
		 if ($save) {
		 	return $save;
		 } else {
		 	return false;
		 }
	}


	public function getData($id_prodi)
    {
        $this->datatables->select('a.id, b.program_studi, a.type_soal, a.bobot, a.file, a.tipe_file, a.pertanyaan, a.opsi_a, a.opsi_b, a.opsi_d, a.opsi_e, a.file_a, a.file_b, a.file_c, a.file_d, a.file_e, a.jawaban, FROM_UNIXTIME(a.created_at) as created_at, FROM_UNIXTIME(a.update_at) as update_at, a.created_by');
        $this->datatables->from('bank_soal a');
        $this->datatables->join('master_prodi b', 'a.id_master_prodi = b.id');
        if ($id_prodi != null) {
        	 $this->datatables->where('a.id_master_prodi', $id_prodi);
        }
        return $this->datatables->generate();
    }
	

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */