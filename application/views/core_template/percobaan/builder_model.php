{php_open_tag}
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_{model_name} extends MY_Model {
	<?php 
	foreach ($this->crud_builder->getFieldShowInColumn() as $field) {
			$relation = $this->crud_builder->getFieldRelation($field);
			if ($relation){
				$cetak[] = '"'.$relation['relation_table'].'.'.$relation['relation_label'].' as '.$relation['relation_table'].'_'.$relation['relation_label'].'"';
				$order[] = '"'.$relation['relation_table'].'.'.$relation['relation_label'].'"';
				$joins[] = '"'.$relation['relation_table'].'" => "'.$relation['relation_table'].'.'.$relation['relation_value'].'='.$table_name.'.'.$relation['fk_field'].'"';

			} else {
				$cetak[] = '"'.$table_name.'.'.$field.'"';
				$order[] = '"'.$table_name.'.'.$field.'"';
			}
			
			
		}

	 $sql = implode(', ', $cetak);
	 $order = implode(', ', $order);
	 $joins = implode(', ', $joins);
	?>
	
	protected $primary_key 	= '{primary_key}';
	protected $table 	= '{table_name}';
	var $column_order = array(null, null, <?= $order ?>, null);
	var $column_search = array(<?= $order ?>); 
	var $select = array(<?= $sql ?>);
	var $join = array(<?= $joins ?>);
	var $order = array('{table_name}.{primary_key}' => 'desc'); // default order 

	public function __construct()
	{
		

		parent::__construct();
	}

	

	
}