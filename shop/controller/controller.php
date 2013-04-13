<?
	/*
		This is the base controller. All other controllers are extended from it
	*/

	class Controller
	{
		public $view;
		public $model;

		function Controller ()
		{
		}

		public function PrintPageName ()
		{
			echo "base";
		}

		public function CreatePage ()
		{
			/*
				MODEL and VIEW are instanciated in the extended child classes
			*/

			$this->model->BuildData();

			$this->view->data = $this->model->data;
			$this->view->Draw();
		}
	}
?>