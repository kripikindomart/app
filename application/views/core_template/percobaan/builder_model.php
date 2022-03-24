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

	public function getDatatable()
	{
		<?php 
		foreach ($this->crud_builder->getFieldShowInColumn() as $field) {
				$relation = $this->crud_builder->getFieldRelation($field);
				if ($relation){
					$cetak[] = $relation['relation_table'].'.'.$relation['relation_label'];

				} else {
					$cetak[] = $table_name.'.'.$field;
				}
				
				
			}

		$sql = implode(', ', $cetak);
		?>
		$this->datatables->select('<?= $sql ?>');
		<?= implode("\r\n", $join); ?>
        $this->datatables->from($this->table);
        $this->db->order_by($this->primary_key,'dsc');

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
       
        return $this->datatables->generate();
	}
}