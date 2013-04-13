<?
	/*
		This is the ITEM PAGE controller.
	*/

	class Controller_Item extends Controller
	{
		function __contruct ()
		{
		}

		public function PrintPageName ()
		{
			echo Constants::$PAGE_ITEM;
		}

		public function CreatePage ()
		{
			$this->model = new Model_Item();	
			$this->view = new View_Item();

			parent::CreatePage();
		}
	}
?>