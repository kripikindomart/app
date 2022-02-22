<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends MY_Model {

	protected $primary_key = 'id';
	protected $table = 'aauth_groups';
	
	public function __construct()
	{
		parent::__construct();
		
	}

	public function getData($id)
	{
		$this->datatables->select('*');
        $this->datatables->distinct('');
        $this->datatables->from('aauth_groups');
        $this->db->order_by('id','dsc');
        if ($id != null) {
        	 $this->datatables->where('id', $id);
        }
        
        return $this->datatables->generate();
	}

}

/* End of file Group_model.php */
/* Location: ./application/models/Group_model.php */