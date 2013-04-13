<?
	class Categories extends MY_Controller
	{
		function __construct()
		{
			parent::__construct();	
		}
		
		public function index ()
		{
			$this->load->view('categories_view', $this->data);
		}
	}
?>