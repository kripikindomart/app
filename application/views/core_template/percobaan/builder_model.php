{php_open_tag}
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_{model_name} extends MY_Model {

	<?php $field_in_column = $this->crud_builder->getFieldShowInColumn(); ?>
	protected $primary_key 	= '{primary_key}';
	protected $table 	= '{table_name}';
	protected $field_search 	= ['<?= implode("', '", $field_in_column); ?>'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct();
	}

	
}