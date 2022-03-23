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
		$this->is_allowed('{controller_name}_list') ;
		$this->template->title('<?= ucwords(clean_snake_case($title)); ?>');
		$data = [];
		$this->render('{controller_name}/<?= strtolower($controller_name); ?>_list', $data);
	}

}