<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends MY_Model {
	protected $primary_key = 'id';
	protected $table = 'aauth_perms';
	public function __construct()
	{
		parent::__construct();
		
	}

	
	

}

/* End of file Permission_model.php */
/* Location: ./application/models/Permission_model.php */