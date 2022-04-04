<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Form_template extends MY_Model {
		
	protected $primary_key 	= 'id';
	protected $table 	= 'mdtemplate_form';
	var $column_order = array(null, null, "mdtemplate_form.id", "mdtemplate_form.nama_template", "pejabats.jabatan", "mdtemplate_form.aktif", null);
	var $column_search = array("mdtemplate_form.id", "mdtemplate_form.nama_template", "pejabats.jabatan", "mdtemplate_form.aktif"); 
	var $select = array("mdtemplate_form.id", "mdtemplate_form.nama_template", "pejabats.jabatan as pejabats_jabatan", "mdtemplate_form.aktif");
	var $join = array("pejabats" => "pejabats.id=mdtemplate_form.pejabat_id");
	var $order = array('mdtemplate_form.id' => 'desc'); // default order 

	public function __construct()
	{
		

		parent::__construct();
	}

	

	
}