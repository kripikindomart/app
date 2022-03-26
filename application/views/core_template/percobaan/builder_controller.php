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
		//$this->is_allowed('{controller_name}_list') ;
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
		<?= implode("\r\n", $join); ?>
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

}