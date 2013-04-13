<?
	/*
		This is the FEED PAGE controller.
	*/

	class Controller_Feed extends Controller
	{	
		function __contruct ()
		{
		}

		public function PrintPageName ()
		{
			echo Constants::$PAGE_FEED;
		}

		public function CreatePage ()
		{
			$this->model = new Model_Feed();
			$this->view = new View_Feed();

			parent::CreatePage();			
		}
	}
?>