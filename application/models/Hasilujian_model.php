<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasilujian_model extends MY_Model {

	protected $perPage = 5;
	protected $primary_key = 'id';
	protected $table = 'h_ujian';

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


    public function getData2($id)
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

	public function getHasilUjian($id_prodi)
    {
        $this->datatables->select('a.id_group_soal, b.id_master_prodi, b.title_ujian, b.jumlah_soal,  b.tgl_mulai');
        $this->datatables->select('(SELECT COUNT(id_master_mahasiswa) FROM h_ujian WHERE id_group_soal = b.id) AS total');
        $this->db->distinct();
        $this->datatables->from('h_ujian a');
        $this->datatables->join('group_soal b', 'a.id_group_soal = b.id');
        $this->db->order_by('b.id_master_prodi');
        if($id_prodi !== null){
            $this->datatables->where('b.id_master_prodi', $id_prodi);
        }
        return $this->datatables->generate();
    }



	public function HslUjianById($id, $dt=false)
    {
        if($dt===false){
            $db = "db";
            $get = "get";
        }else{
            $db = "datatables";
            $get = "generate";
        }
        
        $this->$db->select('d.id, a.nama_lengkap, b.program_studi, d.jml_benar, d.nilai');
        $this->$db->from('master_mahasiswa a');
        $this->$db->join('master_prodi b', 'a.id_master_prodi=b.id');
        $this->$db->join('h_ujian d', 'a.id=d.id_master_mahasiswa');
        $this->$db->where(['d.id_master_prodi' => $id]);
        return $this->$db->$get();
    }

    public function hasil_ujian_prodi($prodiID, $dt=false)
    {
        if($dt===false){
            $db = "db";
            $get = "get";
        }else{
            $db = "datatables";
            $get = "generate";
        }
        
        $this->$db->select('d.id, d.id_master_mahasiswa, a.no_registrasi,  a.nama_lengkap, b.program_studi, d.jml_benar, d.nilai');
        $this->$db->from('master_mahasiswa a');
        $this->$db->join('master_prodi b', 'a.id_master_prodi=b.id');
        $this->$db->join('h_ujian d', 'a.id=d.id_master_mahasiswa');
        $this->$db->where(['b.prodiID' => $prodiID]);
        return $this->$db->$get();
    }

    public function getSoal($id)
    {
        $ujian = $this->getGroupUjian($id);
        $order = $ujian->jenis==="acak" ? 'rand()' : 'id';

        $this->db->select('id, pertanyaan, file, tipe_file, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban');
        $this->db->from('bank_soal');
        //$this->db->where('matkul_id', $ujian->matkul_id);
        $this->db->order_by($order);
        $this->db->limit($ujian->jumlah_soal);
        return $this->db->get()->result();
    }

    public function getGroupUjian($id)
    {
        $this->db->select('b.*, a.*');
        $this->db->from('group_soal a');
        $this->db->join('enroll b', 'b.id_group_soal=a.id');
        $this->db->where('b.id_group_soal', $id);
        return $this->db->get()->row();
    }

    public function getUjianById($id)
    {
        $this->db->select('a.*, c.*, d.*');
        $this->db->from('enroll a');
        $this->db->join('master_prodi c', 'a.prodiID =c.prodiID');
        $this->db->join('group_soal d', 'a.id_group_soal=d.id');
        $this->db->where('c.prodiID', $id);
        return $this->db->get()->row();
    }

    public function bandingNilai($id)
    {
        $this->db->select_min('nilai', 'min_nilai');
        $this->db->select_max('nilai', 'max_nilai');
        $this->db->select_avg('FORMAT(FLOOR(nilai),0)', 'avg_nilai');
        $this->db->where('id_group_soal', $id);
        return $this->db->get('h_ujian')->row();
    }

     public function getIdMahasiswa($no_registrasi)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa a');
        $this->db->join('master_prodi b', 'a.id_master_prodi=b.id');
        $this->db->where('no_registrasi', $no_registrasi);
        return $this->db->get()->row();
    }

    public function HslUjian($id, $mhs)
    {
        $this->db->select('*, UNIX_TIMESTAMP(tgl_selesai) as waktu_habis');
        $this->db->from('h_ujian');
        $this->db->where('id_group_soal', $id);
        $this->db->where('id_master_mahasiswa', $mhs);
        return $this->db->get();
    }
	

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */