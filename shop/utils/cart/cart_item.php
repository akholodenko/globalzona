<?
	/*
		This is a single shopping cart item.
	*/

	class Cart_Item
	{
		public $item_count = 0;

		public $id; 
		public $name;
		public $price;
		public $img_url;

		function Cart_Item ($id, $name, $price, $img_url)
		{
			$this->id = $id;
			$this->name = $name;
			$this->price = $price;
			$this->img_url = $img_url;

			$this->item_count++;
		}

		
	}
?>