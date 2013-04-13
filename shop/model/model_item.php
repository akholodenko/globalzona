<?
	/*
		This is the ITEM PAGE model.
	*/

	class Model_Item extends Model
	{
		function __construct () 
		{	
			parent::__construct();
		}

		public function BuildData ()
		{
			$this->data = array();
			$this->data['test'] = array("title" => "test data");
			$this->data['categories'] = parent::GetCategories();
		}
	}
?>