<?
	/*
		This is the FEED PAGE view.
	*/

	class View_Feed extends View
	{
		function __contruct ()
		{
		}

		public function Draw ()
		{
			echo $this->Body();
		}

		public function Body ()
		{
			$html = "";

			switch($_GET["feed_type"])
			{
				case Constants::$FEED_ITEMS_BY_CATEGORY_ID:
					$html = $html.$this->BodyItems();
					break;				
				
				case Constants::$FEED_ITEM_BY_ID:
					$html = $html.$this->BodyItem();
					break;

				case Constants::$FEED_ADD_TO_SHOPPING_CART:
					$html = $html.$this->AddToShoppingCart();
					break;

				case Constants::$FEED_REMOVE_FROM_SHOPPING_CART:
					$html = $html.$this->RemoveFromShoppingCart();
					break;
				
				case Constants::$FEED_SHOPPING_CART_DETAILS:
					$html = $html.$this->ShoppingCartDetails();
					break;

				default:
					break;
			}				

			return $html;
		}

		public function ShoppingCartDetails ()
		{
			$html = '';
			$cart = unserialize($_SESSION['cart']);
			
			foreach($cart->items as $item)
			{
				$html = $html.parent::ItemPreview(parent::ConvertCartItemToDBItem($item), true);
			}

			return $html;
		}

		public function AddToShoppingCart ()
		{
			$cart = unserialize($_SESSION['cart']);
			$cart->AddItem($this->data['item']['id'],$this->data['item']['name'],$this->data['item']['price'],$this->data['item']['img_url']);

			$_SESSION['cart'] = serialize($cart);

			$html = parent::ShoppingCart();
			$html = $html."added";
			return $html;
		}

		public function RemoveFromShoppingCart ()
		{
			$cart = unserialize($_SESSION['cart']);
			$cart->RemoveItem($_GET['item_id']);

			$_SESSION['cart'] = serialize($cart);

			$html = parent::ShoppingCart();
			$html = $html."removed";
			return $html;
		}

		public function BodyItem()
		{
			$html = parent::ItemFull($this->data['item']);

			return $html;
		}

		public function BodyItems ()
		{
			$html = "";

			for($x = 0; $x < count($this->data['items']); $x++)
			{
				$html = $html.parent::ItemPreview($this->data['items'][$x]);
			}

			return $html;
		}
	}
?>