<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_model extends MY_Model {

	protected $perPage = 5;
	protected $primary_key = 'id';
	protected $table = 'group_soal';

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getDefaultValues()
	{
		return [
			'id'		=> '',
			'id_master_prodi'	=> '',
			'title_ujian'	=> '',
			'jumlah_soal'	=> '',
			'tgl_mulai'	=> '',
			'tgl_berakhir'	=> '',
			'jenis'	=> '',
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			
			[
				'field' => 'waktu_pengerjaan',
				'label' => 'Waktu Pengerjaan',
				'rules' => 'trim|required',
			],
			[
				'field' => 'tanggal_maulai',
				'label' => 'Tanggal akhir',
				'rules' => 'trim|required',
			],
			[
				'field' => 'tanggal_berakhir',
				'label' => 'Tanggal mulai',
				'rules' => 'trim|required',
			],
			[
				'field' => 'title_ujian',
				'label' => 'Title Ujian',
				'rules' => 'trim|required',
			],

		];
		return $validationRules;
		
	}

	public function run($data, $action = 'input')
	{
		if ($action == 'input') {
	
			$save_data = [
				'title_ujian'	=> $data->title_ujian,
				//'jumlah_soal'	=> $data->jumlah_soal,
				'waktu_pengerjaan'	=> $data->waktu_pengerjaan,
				'tgl_mulai'	=> $data->tanggal_maulai,
				'tgl_berakhir'	=> $data->tanggal_berakhir,
				'jenis' => $data->jenis

			];

			return $this->create($save_data);
		} else {
		
			return $this->where('id', $data['id'])->update($data);
		}
	}

	public function save_soal($data)
	{
		 $save = $this->create($data, 'soal_to_gorupsoal');
		 if ($save) {
		 	return $save;
		 } else {
		 	return false;
		 }
	}


	public function getDataUjian($id_prodi = null)
    {
        $this->datatables->select('a.id as id_group, a.id_master_prodi as id_prodi, b.program_studi, a.title_ujian, a.jumlah_soal, a.waktu_pengerjaan, a.tgl_mulai, a.tgl_berakhir, a.token, a.jenis');
        $this->datatables->select('(SELECT COUNT(id_group_soal) FROM prodi_soal WHERE id_group_soal = a.id) AS total_soal  ');
        $this->datatables->from('group_soal a');
        $this->datatables->join('master_prodi b', 'a.id_master_prodi = b.id');
        //$this->db->order_by('a.id_master_prodi','dsc');
        //$this->datatables->where('a.id_master_prodi', $id_prodi);
        if ($id_prodi != null) {
        	 $this->datatables->where('a.id_master_prodi', $id_prodi);
        }
        return $this->datatables->generate();
    }


    public function loadCourse()
    {
        $this->datatables->select('a.id as id_group,  a.title_ujian, a.jumlah_soal, a.waktu_pengerjaan, a.tgl_mulai, a.tgl_berakhir, a.token, a.jenis');
        $this->datatables->from('group_soal a');
        
        return $this->datatables->generate();
    }


    public function getGroup($id_prodi, $id_group = null)
    {

    	$data_prodi_soal = $this->distinct()->where('id_group_soal', $id_group)->get('soal_to_gorupsoal');
 		$rowss = $this->distinct()->where('id_group_soal', $id_group)->count_filtered('soal_to_gorupsoal');


        $this->datatables->select('a.id, b.program_studi, a.title_soal, a.type_soal, a.bobot, a.file, a.tipe_file, a.pertanyaan, a.opsi_a, a.opsi_b, a.opsi_d, a.opsi_e, a.file_a, a.file_b, a.file_c, a.file_d, a.file_e, a.jawaban, FROM_UNIXTIME(a.created_at) as created_at, FROM_UNIXTIME(a.update_at) as update_at, a.created_by');
        $this->datatables->from('bank_soal a');
        $this->datatables->join('master_prodi b', 'a.id_master_prodi = b.id');
        $row_data=[];
        if (!$rowss > 0) {

        } else {
        	foreach ($data_prodi_soal as $row) {
	       			$row_data[] = $row->id_bank_soal;
	       	}
	       	$this->datatables->where("a.id NOT IN ( ".implode(", ",  $row_data).")", null, false);
        }
       	
        if ($id_prodi != null) {
        	if (!$rowss > 0) {

	        } else {
	        	foreach ($data_prodi_soal as $row) {
		       			$row_data[] = $row->id_bank_soal;
		       	}
		       	$this->datatables->where("a.id NOT IN ( ".implode(", ",  $row_data).")", null, false);
	        }

        	 $this->datatables->where('a.title_soal', $id_prodi);

	       
        } 
       
       	
    		
    	

        // if ($id_prodi != null) {
        // 	 $this->datatables->where('a.id_master_prodi', $id_prodi);
        // }
        return $this->datatables->generate();
    }

    public function getData($id_prodi)
    {
        $this->datatables->select('a.id_master_prodi as id_prodi, b.program_studi');
        $this->datatables->distinct('');
        $this->datatables->select('(SELECT COUNT(id_master_prodi) FROM group_soal WHERE id_master_prodi = b.id) AS total_ujian  ');

        $this->datatables->from('group_soal a');
        $this->datatables->join('master_prodi b', 'a.id_master_prodi = b.id');
        $this->db->order_by('a.id_master_prodi','dsc');
        if ($id_prodi != null) {
        	 $this->datatables->where('a.id_master_prodi', $id_prodi);
        }
        return $this->datatables->generate();
    }
	

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */