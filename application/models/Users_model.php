<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {

	protected $primary_key = 'id';
	protected $table = 'aauth_users';

	public function __construct()
	{
		parent::__construct();
		
	}	

	public function getData()
    {
        $this->datatables->select('a.id_master_prodi as id_prodi, b.program_studi');
        $this->datatables->distinct('');
        $this->datatables->select('(SELECT COUNT(id_master_prodi) FROM group_soal WHERE id_master_prodi = b.id) AS total_ujian  ');

        $this->datatables->from('group_soal a');
        $this->datatables->join('master_prodi b', 'a.id_master_prodi = b.id');
        $this->db->order_by('a.id_master_prodi','dsc');
        
        return $this->datatables->generate();
    }

    public function get_group_user($user_id = false)
    {
        if ($user_id === false) {
            $user_id = get_user_data('id');
        }
        $result_group_user = [];

        $query = $this->db->get_where('aauth_user_to_group', ['user_id' => $user_id]);
        foreach ($query->result() as $row) {
            $result_group_user[] = $row->group_id;
        }

        return $result_group_user;
    }

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */