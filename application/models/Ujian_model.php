<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ujian_model extends MY_Model {

	protected $perPage = 5;
	protected $primary_key = 'id';
	protected $table = 'master_mahasiswa';
	public function __construct()
	{
		parent::__construct();
		
	}

	public function getMahasiswa($con)
	{
		$this->db->select('a.id_master_prodi,a.no_registrasi, a.nama_lengkap, a.jenis_kelamin, a.no_ktp, a.tempat_lahir, b.program_studi, b.prodiID, a.no_hp');
		$this->db->where('a.no_registrasi', $con);
		
		$this->db->from('master_mahasiswa a');
		$this->db->join('master_prodi b', 'b.id = a.id_master_prodi', 'left');
		return $this->db->get()->row();
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

    public function getSoals($id)
    {
        return $ujian = $this->getGroupUjian($id);
        
        $order = $ujian->jenis==="acak" ? 'rand()' : 'id';

        //Data Prodi _ Soal
        $prodi_soal = $this->where('id_group_soal', $id)->get('prodi_soal');


        // $this->db->select('id, pertanyaan, file, tipe_file, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban');
        // $this->db->from('bank_soal');
        $sql = "SELECT id, pertanyaan, file, tipe_file, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban FROM bank_soal";
        foreach($prodi_soal as $key=>$val){
            if($key == 0){
                $query .= " WHERE";
            } else{
                $query .= " OR";
            }
            $query .= " id_prodi_master = $val";
        }
        //$this->db->where('id', $ujian->matkul_id);
        $this->db->order_by($order);
        $this->db->limit($ujian->jumlah_soal);
        return $this->db->query($sql)->row();
    }


    public function getGroupUjian($id)
    {
        $this->db->select('b.*, a.*');
        $this->db->from('group_soal a');
        $this->db->join('enroll b', 'b.id_group_soal=a.id');
        $this->db->where('b.id_group_soal', $id);
        return $this->db->get()->row();
    }

    public function enrollCourse($id_prodi) //Get group enroll
    {
    	$this->db->select('b.*, a.*');
        $this->db->from('group_soal a');
        $this->db->join('enroll b', 'b.id_group_soal=a.id');
        $this->db->where('b.prodiID', $id_prodi);
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


    public function ambilSoal($pc_urut_soal1, $pc_urut_soal_arr)
    {
        $this->db->select("*, {$pc_urut_soal1} AS jawaban");
        $this->db->from('bank_soal');
        $this->db->where('id', $pc_urut_soal_arr);
        return $this->db->get()->row();
    }


    public function getJawaban($id_tes)
    {
        $this->db->select('list_jawaban');
        $this->db->from('h_ujian');
        $this->db->where('id', $id_tes);
        return $this->db->get()->row()->list_jawaban;
    }

    public function getSoalById($id)
    {
        return $this->db->get_where('bank_soal', ['id' => $id])->row();
    }

	public function getDefaultValues()
	{
		return [
			'id'		=> '',
			'username'	=> '',
			'email'	=> '',
			'password'	=> '',
			'password'	=> '',
			'fullname'	=> '',
			'id_role'	=> '',
			'is_active'	=> '',
			'avatar'	=> '',
			'token'	=> '',
			'created_at'	=> '',
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required',
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|is_unique[users.email]',
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required',
			],
			[
				'field' => 'role',
				'label' => 'Role',
				'rules' => 'required',
			],
		];
		return $validationRules;
		
	}

	public function run($data, $action = 'input')
	{
		if ($action == 'input') {
			$user_avatar_uuid = $data->user_avatar_uuid;
			$user_avatar_name = $data->user_avatar_name;

			$save_data = [
				'fullname' 	=> $data->fullname,
				'avatar' 		=> 'default.png',
				'created_at'	=> date('Y-m-d H:i:s'),
				'username'	=> $data->username,
				'email'		=> strtolower($data->email),
				'password'	=> hashEncrypt($data->password),
				'id_role'	=> $data->role,
				'is_active'	=> 1,
				'token'		=> '',
			];

			if (!empty($user_avatar_name)) {

				$user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;

				if (!is_dir(FCPATH . '/uploads/user')) {
					mkdir(FCPATH . '/uploads/user');
				}

				@rename(FCPATH . 'uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
						FCPATH . 'uploads/user/' . $user_avatar_name_copy);

				$save_data['avatar'] = $user_avatar_name_copy;
			}

			return $this->create($save_data);
		} else {
		
			if (empty($data->password)) {
				$user_avatar_uuid = $data->user_avatar_uuid;
				$user_avatar_name = $data->user_avatar_name;

				$save_data = [
					'fullname' 	=> $data->fullname,
					'avatar' 		=> 'default.png',
					'username'	=> $data->username,
					'email'		=> strtolower($data->email),
					'id_role'	=> $data->role,
					'is_active'	=> 1,
					'token'		=> '',
					'update_at' => date('Y-m-d H:i:s'),
				];

				if (!empty($user_avatar_name)) {

					$user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;

					if (!is_dir(FCPATH . '/uploads/user')) {
						mkdir(FCPATH . '/uploads/user');
					}

					@rename(FCPATH . 'uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
							FCPATH . 'uploads/user/' . $user_avatar_name_copy);

					$save_data['avatar'] = $user_avatar_name_copy;
				} 
			} else {
				$user_avatar_uuid = $data->user_avatar_uuid;
				$user_avatar_name = $data->user_avatar_name;

				$save_data = [
					'fullname' 	=> $data->fullname,
					'avatar' 		=> 'default.png',
					'username'	=> $data->username,
					'email'		=> strtolower($data->email),
					'password'	=> hashEncrypt($data->password),
					'id_role'	=> $data->role,
					'is_active'	=> 1,
					'token'		=> '',
					'update_at' => date('Y-m-d H:i:s'),
				];

				if (!empty($user_avatar_name)) {

					$user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;

					if (!is_dir(FCPATH . '/uploads/user')) {
						mkdir(FCPATH . '/uploads/user');
					}

					@rename(FCPATH . 'uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
							FCPATH . 'uploads/user/' . $user_avatar_name_copy);

					$save_data['avatar'] = $user_avatar_name_copy;
				}
			}

			return $this->where('id', $data->id)->update($save_data);
		}
	}

	// public function run()
	// {
	// 	$user_avatar_uuid = $this->input->post('user_avatar_uuid');
	// 	$user_avatar_name = $this->input->post('user_avatar_name');

	// 	$save_data = [
	// 		'fullname' 	=> $this->input->post('fullname'),
	// 		'avatar' 		=> 'default.png',
	// 		'created_at'	=> date('Y-m-d H:i:s'),
	// 		'username'	=> $this->input->post('username', TRUE),
	// 		'email'		=> strtolower($this->input->post('email', TRUE)),
	// 		'password'	=> hashEncrypt($this->input->post('password', TRUE)),
	// 		'id_role'	=> $this->input->post('role', TRUE),
	// 		'is_active'	=> 1,
	// 		'token'		=> '',
	// 	];

	// 	if (!empty($user_avatar_name)) {

	// 		$user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;

	// 		if (!is_dir(FCPATH . '/uploads/user')) {
	// 			mkdir(FCPATH . '/uploads/user');
	// 		}

	// 		@rename(FCPATH . 'uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
	// 				FCPATH . 'uploads/user/' . $user_avatar_name_copy);

	// 		$save_data['avatar'] = $user_avatar_name_copy;
	// 	}

	// 	return $this->create($save_data);

	// }

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */