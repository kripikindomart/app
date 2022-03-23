<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends Builder {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('model_crud');
	}

	public function index()
	{
		$this->load->helper('directory');
		$directories = directory_map(APPPATH . '/controllers/admin/');
		$file_exist = [];

		foreach ($directories as $name => $dir) {
				$file_exist[] = strtolower(str_replace('.php', '', $name));
		}
		$tables = array_diff($this->db->list_tables(), $file_exist);
		$tables = array_diff($tables, get_table_not_allowed_for_builder());	

		$data['title']	= 'Build Crud';
		$data['page']	= 'index';
		$data['tables'] = $tables;

		$this->template->title($data['title']);
		$this->render('index', $data);
	}

	public function add_save()
	{

		
		return $this->buildCrud();
	}

	public function build()
	{
		
	}

	/**
	* Get field data
	*
	* @return html
	*/
	public function get_field_data($table)
	{
		
		$this->data['html'] = $this->load->view('builder/Add/crud_field_data.php', ['table' => $table], true);
		$this->data['subject'] = ucwords(clean_snake_case($table));
		$this->data['success'] = true;

		return $this->response($this->data);
	}

	/**
	* Get field table
	*
	* @return html
	*/
	public function get_list_field_id($table)
	{
		$this->data['html'] = $this->load->view('builder/Add/crud_list_field.php', ['table' => $table], true);
		$this->data['success'] = true;

		return $this->response($this->data);
	}

	/**
	* Get field table
	*
	* @return html
	*/
	public function get_list_field_label($table)
	{
		$this->data['html'] = $this->load->view('builder/Add/crud_list_field_label.php', ['table' => $table], true);
		$this->data['success'] = true;

		return $this->response($this->data);
	}

}

/* End of file Builder.php */
/* Location: ./application/controllers/admin/Builder/Builder.php */