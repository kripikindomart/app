 <?php 
 foreach ($this->crud_builder->getFieldShowInColumn() as $field)
{
    $relation = $this->crud_builder->getFieldRelation($field);
    if (!$this->crud_builder->getFieldFile($field) AND !$this->crud_builder->getFieldFileMultiple($field) AND !$relation){
        $table_name->$field;
    } elseif ($relation){
        $table_name->$relation['relation_label'];

    } elseif($this->crud_builder->getFieldFileMultiple($field)) { 
        foreach (explode(',', $ $table_name->$field) as $file){
            if (!empty($file)){
                if (is_image($file)){

                } else {

                }
            }
        }

    } else {
        if (!empty($$table_name->$field)){}

        if (is_image($table_name->$field)){}
    }
}

  ?>