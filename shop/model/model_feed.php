<?
	/*
		This is the FEED PAGE model.
	*/

	class Model_Feed extends Model
	{
		function __construct () 
		{	
			parent::__construct();
		}

		public function BuildData ()
		{
			$this->data = array();		

			switch($_GET["feed_type"])
			{
				case Constants::$FEED_ITEMS_BY_CATEGORY_ID:
					$this->data['items'] = $this->GetItemsByCategoryId($_GET['category_id']);
					break;				
				
				case Constants::$FEED_ITEM_BY_ID:
					$this->data['item'] = $this->GetItemById($_GET['item_id']);
					break;

				case Constants::$FEED_ADD_TO_SHOPPING_CART:
					$this->data['item'] = $this->GetItemById($_GET['item_id']);
					break;

				default:
					break;
			}
		}

		public function GetItemsByCategoryId ($category_id)
		{
			if($category_id == 0)	//passing in 0 as category id will return all items in all categories
				return parent::GetAllItems();
			if($category_id != '')
				return parent::GetDataMatrix("SELECT * FROM shop_item WHERE category_id = ".$category_id." ORDER BY name");
			else
				return null;
		}

		public function GetItemById ($item_id)
		{
			if($item_id != '')
				return parent::GetDataRow("SELECT * FROM shop_item WHERE id = ".$item_id);
			else
				return null;
		}
	}
?>