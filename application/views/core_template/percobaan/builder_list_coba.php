<?php 
foreach ($this->crud_builder->getFieldShowInColumn() as $field) {
	$relation = $this->crud_builder->getFieldRelation($field);
	if ($relation){
		$cetak[] = $relation['relation_table'].'.'.$relation['relation_label'];
		// $join[] = $this->datatables->join('$relation["relation_table"]','$relation["relation_table"].$relation["relation_value"] = $table_name.','left');
	} else {
		$cetak[] = $table_name.'.'.$field;
	}
		$sql = implode(', <br>', $cetak);
print_r($relation);
}




 ?>