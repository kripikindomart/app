<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends MY_Model {

	protected $primary_key = 'id';
	protected $table = 'master_mahasiswa';
	
	public function __construct()
	{
		parent::__construct();
		
	}	


    public function getDefaultValues()
    {
        return [
            'id'        => '',
            'nama_lengkap'  => '',
            'email' => '',
            'npm' => '',
            'program_studi' => '',
            'no_hp' => '',
            'foto'  => '',
            'created_at'    => '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_mahasiswa',
                'label' => 'Nama Mahasiswa',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[master_mahasiswa.email]',
            ],
            [
                'field' => 'npm',
                'label' => 'No Registrasi',
                'rules' => 'trim|required|is_unique[master_mahasiswa.npm]',
            ],
            [
                'field' => 'no_hp',
                'label' => 'No HP (WA)',
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
                'nama_lengkap'  => $data->nama_mahasiswa,
                'email' => $data->email,
                'npm' => $data->npm,
                'id_master_prodi'   => $data->prodi,
                'no_hp' => $data->no_hp,
                'created_by' => $this->session->userdata('id')

            ];

            if (!empty($user_avatar_name)) {

                $user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;

                if (!is_dir(FCPATH . '/uploads/mahasiswa')) {
                    mkdir(FCPATH . '/uploads/mahasiswa');
                }

                @rename(FCPATH . 'uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
                        FCPATH . 'uploads/mahasiswa/' . $user_avatar_name_copy);

                $save_data['foto'] = $user_avatar_name_copy;
            }

            return $this->create($save_data);
        } else {
        
            
                $user_avatar_uuid = $data->user_avatar_uuid;
                $user_avatar_name = $data->user_avatar_name;

                $save_data = [
                    'nama_lengkap'  => $data->nama_mahasiswa,
                    'email' => $data->email,
                    'npm' => $data->npm,
                    'id_master_prodi'   => $data->prodi,
                    'no_hp' => $data->no_hp,
                    'foto'      => 'default.png',
                    'update_at' => date('Y-m-d H:i:s'),

                ];


                if (!empty($user_avatar_name)) {

                    $user_avatar_name_copy = date('YmdHis') . '-' . $user_avatar_name;

                    if (!is_dir(FCPATH . '/uploads/mahasiswa')) {
                        mkdir(FCPATH . '/uploads/mahasiswa');
                    }

                    @rename(FCPATH . 'uploads/tmp/' . $user_avatar_uuid . '/' . $user_avatar_name, 
                            FCPATH . 'uploads/mahasiswa/' . $user_avatar_name_copy);

                    $save_data['foto'] = $user_avatar_name_copy;
                }
            

            return $this->where('id', $data->id)->update($save_data);
        }
    }

    public function save_users($data)
    {
         $save = $this->create($data, 'users');
         if ($save) {
            return $save;
         } else {
            return false;
         }
    }

	public function getData($id_prodi, $angkatan)
    {
        $this->datatables->select('a.id, a.npm, a.nama_lengkap, a.no_ktp,a.no_hp, a.gelar_kesarjanaan, a.tempat_lahir, a.tanggal_lahir, a.status_kawin, a.alamat_rumah, a.email, a.no_hp, a.nama_ayah, a.nama_ibu, b.program_studi, a.konsentrasi, a.foto, a.created_at,a.update_at, a.created_by,a.status');
        $this->datatables->select('(SELECT COUNT(id) FROM aauth_users WHERE username = a.npm) AS ada');
        $this->datatables->from('master_mahasiswa a');
        $this->datatables->join('master_prodi b', 'b.id = a.id_master_prodi', 'left');
        $this->datatables->join('master_angkatan c', 'a.id_angkatan = c.id', 'left');
        
        if ($id_prodi != null && $angkatan != null) {
            $this->datatables->where('a.id_master_prodi', $id_prodi);
             $this->db->where('a.id_angkatan', $angkatan);
        }

        // if ($id_prodi != null && $angkatan != null) {
        //      $this->datatables->where('a.id_master_prodi', $id_prodi);
        //      $this->datatables->where('a.id_angkatan', $angkatan);
         
        // } else if($id_prodi != null) {
        //     $this->datatables->where('a.id_master_prodi', $id_prodi);
        // } else if($id_prodi == null && $angkatan != null) {
        //     $this->datatables->where('a.id_angkatan', $angkatan);
        // } 

       // return $this->db->get();
        return $this->datatables->generate();
    }

}

/* End of file Mahasiswa_model.php */
/* Location: ./application/models/Mahasiswa_model.php */