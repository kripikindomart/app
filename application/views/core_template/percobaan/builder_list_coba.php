<?php 
foreach ($this->crud_builder->getFieldShowInColumn() as $field) {
	$relation = $this->crud_builder->getFieldRelation($field);
	if ($relation){
		$cetak[] = $relation['relation_table'].'.'.$relation['relation_label'].' as '.$relation['relation_table'].'_'.$relation['relation_label'];
		// $join[] = $this->datatables->join('$relation["relation_table"]','$relation["relation_table"].$relation["relation_value"] = $table_name.','left');
	} else {
		$cetak[] = $table_name.'.'.$field;
	}
		$sql = implode(', <br>', $cetak);

}
print_r($sql);



 ?>

 <?php 
// foreach ($this->crud_builder->getFieldShowInColumn() as $field) {
//    $relation = $this->crud_builder->getFieldRelation($field);
//    if (!$this->crud_builder->getFieldFile($field) AND !$this->crud_builder->getFieldFileMultiple($field) AND !$relation){ 
//      // print_r( _ent($table_name->$field));
//    		$cetak[] = $this->crud_builder->getFieldFile($field);
//    } elseif ($relation){
//     	$cetak[] = $relation['relation_table'].'.'.$relation['relation_label'];
//     } elseif($this->crud_builder->getFieldFileMultiple($field)) { 
   
//     foreach (explode(',', $table_name->$field) as $file){
//       	if (!empty($file)) {
// 	         if (is_image($file)){
// 	        	$cetak[] = '<a class="fancybox" rel="group" href="'.BASE_URL.'uploads/'.$table_name.'/'.$file.'">
// 	          <img src="'.BASE_URL.'uploads/'.$table_name.'/'.$file.'" class="image-responsive" alt="image '.$table_name.'" title="'.$field.'" width="40px">
// 	                </a>';

// 	         } else {
// 	          $cetak[] = '<a href="'.BASE_URL . 'admin/file/download/' . $table_name.'/'. $file.'">
// 	                     <img src="'.get_icon_file($file).'" class="image-responsive image-icon"  width="40px"> 
// 	                   </a>';
// 	         }
//        	} 
//     }
//    } else { 
//       if (!empty($table_name->$field)): 
//         if (is_image($table_name->$field)): 
//         $cetak[] =' <a class="fancybox" rel="group" href="'.BASE_URL . 'uploads/'.$table_name.'/' . $table_name->$field.'">
//                   <img src="'.BASE_URL.'uploads/'.$table_name.'/'.$table_name->$field.'"  width="40px">
//                 </a>';
//         else: 
//           $cetak[] = '<a href="'. BASE_URL . 'admin/file/download/' .  $table_name->$field.' ">
//                      <img src="'.get_icon_file($table_name->$field).'" class="image-responsive image-icon"  width="40px"> 
//                    </a>';
//          endif; 
//        endif; 
//    } 
// print_r($this->crud_builder->getFieldFile($field));

	
//}
?>