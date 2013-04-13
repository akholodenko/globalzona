<?
	class Events extends MY_Controller
	{
		function __construct()
		{
			parent::__construct();	
		}
		
		public function index () {}
		
		public function get ($category_id = 0)
		{
			echo "list of events for category id ".$category_id;
		}
	}
?>