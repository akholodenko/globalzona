<?
	/*
		This is the INDEX PAGE model.
	*/

	class Model_Index extends Model
	{
		function __construct () 
		{	
			parent::__construct();
		}

		public function BuildData ()
		{
			$this->data = array();
			$this->data['test'] = $this->GetTest();
			$this->data['items'] = parent::GetAllItems();
			$this->data['categories'] = parent::GetCategories();	//used to print out list of item categories
		}

		public function GetTest ()
		{
			return parent::GetDataRow("SELECT id, title FROM post WHERE id=3");
		}
	}
?>