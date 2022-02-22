<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enroll_model extends MY_Model {

	protected $primary_key = 'id';
	protected $table = 'enroll';
	
	public function __construct()
	{
		parent::__construct();
		
	}

	public function getData($id)
	{
		
		$this->datatables->select('enroll.prodiID, master_prodi.program_studi');
		$this->datatables->distinct('');
		$this->datatables->select('(SELECT COUNT(prodiID) FROM enroll WHERE prodiID = master_prodi.prodiID) AS total_ujian  ');
        $this->datatables->from('enroll');
        $this->db->join('master_prodi', 'enroll.prodiID = master_prodi.prodiID', 'left');
        $this->db->join('group_soal', 'enroll.id_group_soal = group_soal.id', 'left');
        $this->db->where('master_prodi.prodiID != ', 'ADM');
        $this->db->order_by('enroll.prodiID','dsc');
        if ($id != null) {
        	 $this->datatables->where('enroll.prodiID', $id);
        }
        
        return $this->datatables->generate();
	}

	public function getDataUjian($id_prodi = null)
    {
        $this->datatables->select('b.id, a.id as id_group, a.title_ujian ,  a.jumlah_soal AS total_soal, a.waktu_pengerjaan, a.tgl_mulai, a.tgl_berakhir, a.token, a.jenis');
        // $this->datatables->select('(SELECT COUNT(pordiID) FROM soal_to_gorupsoal WHERE pordiID = b.prodiID) AS total_soal  ');
        $this->datatables->from('enroll b');
        $this->datatables->join('group_soal a', 'a.id = b.id_group_soal');
        //$this->db->order_by('a.id_master_prodi','dsc');
        //$this->datatables->where('a.id_master_prodi', $id_prodi);
        if ($id_prodi != null) {
        	 $this->datatables->where('b.prodiID', $id_prodi);
        }
        return $this->datatables->generate();
    }

    public function getSoal($idGroup)
    {
        $this->datatables->select('a.id, a.title_soal, a.bobot ,  a.type_soal, a.file, a.tipe_file, a.pertanyaan, a.opsi_a, a.opsi_b, a.opsi_c,a.opsi_d, a.opsi_e, a.file_a, a.file_b, a.file_c, a.file_d, a.file_e, jawaban');
        // $this->datatables->select('(SELECT COUNT(pordiID) FROM soal_to_gorupsoal WHERE pordiID = b.prodiID) AS total_soal  ');
        $this->datatables->from('soal_to_gorupsoal c');
        $this->datatables->join('group_soal b', 'b.id = c.id_group_soal');
        $this->datatables->join('bank_soal a', 'a.id = c.id_bank_soal');
        //$this->db->order_by('a.id_master_prodi','dsc');
        $this->datatables->where('c.id_group_soal', $idGroup);
        // if ($id_prodi != null) {
        // 	 $this->datatables->where('b.prodiID', $id_prodi);
        // }
        return $this->datatables->generate();
    }

}

/* End of file Group_model.php */
/* Location: ./application/models/Group_model.php */