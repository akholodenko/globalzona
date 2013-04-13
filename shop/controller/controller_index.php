<?
	/*
		This is the INDEX PAGE controller.
	*/

	class Controller_Index extends Controller
	{	
		function __contruct ()
		{
		}

		public function PrintPageName ()
		{
			echo Constants::$PAGE_INDEX;
		}

		public function CreatePage ()
		{
			$this->model = new Model_Index();
			$this->view = new View_Index();

			parent::CreatePage();			
		}
	}
?>