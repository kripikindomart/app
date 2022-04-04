{php_open_tag}
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| <?= ucwords(clean_snake_case($controller_name)); ?> Controller
*| --------------------------------------------------------------------------
*| <?= ucwords(clean_snake_case($controller_name)); ?> site
*|
*/

class <?= ucwords($controller_name); ?> extends Admin	
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_{model_name}');
	}

	public function index()
	{
		//$this->is_allowed('{uc_controller_name}_list') ;
		$this->template->title('<?= ucwords(clean_snake_case($title)); ?>');
		$data = [];
		$this->render('{controller_name}/<?= strtolower($controller_name); ?>_list', $data);
	}

	public function getDatatable()
	{
		<?php 
		foreach ($this->crud_builder->getFieldShowInColumn() as $field) {
				$relation = $this->crud_builder->getFieldRelation($field);
				if ($relation){
					$cetak[] = $relation['relation_table'].'.'.$relation['relation_label'].' as '.$relation['relation_table'].'_'.$relation['relation_label'];

				} else {
					$cetak[] = $table_name.'.'.$field;
				}
				
				
			}

		$sql = implode(', ', $cetak);
		?>
		$this->datatables->select('<?= $sql ?>');
		<?php 
		if ($join != null || !empty($join)) {
			echo implode("\r\n", $join);
		}
		 ?>
        $this->datatables->from('{table_name}');
        $this->db->order_by('{table_name}.{primary_key}','dsc');

        $btn_edit = false;
        if ($this->is_allowed('<?= $uc_controller_name; ?>_update', false) == true) {
        	$btn_edit = '
        		        	<a title="Edit data terpilih" class="btn btn-xs btn-warning" href="'. site_url('admin/<?= $uc_controller_name; ?>/edit/$1').'">
        		            <i class="fa fa-pencil"></i>
        		          </a>';
        }
        $btn_delete = false;
        if ($this->is_allowed('<?= $uc_controller_name; ?>_delete', false) == true) {
        	$btn_delete = '<button title="Hapus data terpilih" type="button" class="btn btn-xs btn-danger 					delete" data-id="$1" >
        	                    <i class="fa fa-trash"></i>
        	                  </button>	';
        }
		$status = false;
		$btn_detail = '<button title="Detail" type="button" class="btn btn-xs btn-info 					" data-id="$1" >
        	                    <i class="fa fa-eye"></i>
        	                  </button>	';
		if ($this->is_allowed('<?= $uc_controller_name; ?>_benned', false) == true) {
      		$status = true;
      	}		        	                  
       $this->datatables->add_column('btn_edit', $btn_edit, '{primary_key}')
       ->add_column('btn_delete', $btn_delete, '{primary_key}')
       ->add_column('btn_detail', $btn_detail, '{primary_key}')
       ->add_column('status', $status);	
       
        return $this->response($this->datatables->generate(), false);
	}

	public function ajax()
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
		$data = $this->model_{model_name}->getRequestAjax();
		$data_row = array();
			$no = $_POST['start'];
			$data_ = array();
			foreach ($data as $row) {
				$no++;
				$data_row = array();
				$data_row[] = '<input type="checkbox" class="data-check check checkbox icheckbox_flat-green toltip" value="'.$row->{primary_key}.'" name="data-check[]">';
				$data_row[] = $no;
				<?php  foreach ($this->crud_builder->getFieldShowInColumn() as $field):
			         $relation = $this->crud_builder->getFieldRelation($field);
			    if ($relation):
			             ?>
			    $data_row[] = $row-><?= $relation['relation_table'].'_'.$relation['relation_label'] ?>;
			    <?php
			    else:
			       if ($this->crud_builder->getFieldFile($field)):

			    ?> 


			    if (is_file(FCPATH . 'uploads/user/' . $row-><?= $this->crud_builder->getFieldFile($field) ?>)): 
	            $img_url = base_url() . 'uploads/user/' .$row-><?= $this->crud_builder->getFieldFile($field) ?>; 
	            else: 
	            $img_url = base_url() . 'uploads/user/default.png'; 
	            endif; 
                $data_row[] = '<a class="fancybox" rel="group" href="'.$img_url.'">
                          <img src="'.$img_url.'" alt="Person" width="50" height="50">
                       	 </a>';

			    <?php else: ?>  
			    <?php if ($field != $primary_key): ?>
			    $data_row[] = $row-><?= $field ?>;  
			     <?php endif ?>     
			    <?php 
			    endif;         
			    endif;
			    endforeach;
			    ?>

				//add html for action
				$data_row[] = '
				<div class="text-center"><button type="button" class="btn btn-sm btn-warning edit" title="Edit" id="edit" data-id = "'.$row->{primary_key}.'"><i class="fa fa-pencil"></i>Edit </button>
				<button type="button" class="btn btn-sm btn-danger delete" title="Delete" id="delete" data-id = "'.$row->{primary_key}.'"><i class="fa fa-trash"></i>Delete</button></div>';
				$data_[] = $data_row;
			}

			$json_data = [
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->model_{model_name}->count_all(),
				"recordsFiltered" => $this->model_{model_name}->_count_filtered(),
				'data' => $data_
			];

			return $this->response($json_data);
		}
		
	}

	

}