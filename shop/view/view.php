<?
	/*
		This is the base view. All other views are extended from it
	*/

	class View
	{
		public $data = array();

		function View ()
		{
		}

		public function Draw ()
		{
		}

		public function Body ()
		{
		}

		public function CategoryPanel()
		{
			$html = "<div id='categories'>";
			$html = $html."<ul>";

			for($x = 0; $x < count($this->data['categories']); $x++)
			{
				$html = $html."<li><a href='#' onClick=\"return load_category_items('".$this->data['categories'][$x]['id']."');\">".$this->data['categories'][$x]['name']."</a></li>";
			}

			$html = $html."	</ul>";
			$html = $html."</div>";

			return $html;
		}

		public function ShoppingCartPanel()
		{
			$html = "<div id='shopping_cart_panel'>";
			$html = $html.$this->ShoppingCart();
			$html = $html."</div>";

			return $html;
		}

		public function ShoppingCart()
		{
			$cart = unserialize($_SESSION['cart']);
			$html = "<div id='shopping_cart'>";
			$html = $html."<img style='float: right;' src='".Settings::$PATH_IMG."shopping_cart_64.png'/>";
			$html = $html."<div><a href='#' onClick=\"return load_cart_details();\">Cart</a>: ".$cart->GetTotalItemCount()." item(s)</div>";
			$html = $html."<div>Balance: ".$cart->GetTotalItemCost()."</div>";
			$html = $html."</div>";

			return $html;
		}

		public function ItemFull($item)
		{
			setlocale(LC_MONETARY, 'en_US');

			$html = "";

			$html = $html."<div style='float: right'><a href='#' onClick=\"return add_to_cart(".$item['id'].")\"><img src='".Settings::$PATH_IMG."add_item_48.png' border='0' /></a></div>";
			$html = $html.$item['name']." ".money_format('%(#1n', $item['price']);
			$html = $html."<br/><img src='".$item['img_url']."' />";			
			$html = $html."<br/>".urldecode($item['description']);
			


			return $html;
		}

		public function ItemPreview ($item, $showRemoveLink = false)
		{
			$html = "<div class='item_preview_panel' style='width: 100%;'>";
			$html = $html."<div id='demotip'>".Constants::$TOOLTIP_PREVIEW_IMG."</div>";
			$html = $html."<div class='item_preview_img' id='item_preview_id_".$item['id']."' item_id=".$item['id']."><img class='demo' alt='".Constants::$TOOLTIP_PREVIEW_IMG."' src='".$item['img_url']."' width='100px'/></div>";
			$html = $html."<div class='item_preview_body' style='margin-left: 150px;'>";
			$html = $html."	<a class='item_preview_name' href='#' onClick=\"return load_item_details('".$item['id']."');\">";
			$html = $html."		".$item['name'];
			$html = $html."	</a>";

			if($showRemoveLink)
			{
				$html = $html."<div style='float: right'>";
				$html = $html."	<a href='#' onClick=\"return remove_from_cart(".$item['id'].")\"><img src='".Settings::$PATH_IMG."remove_item_48.png' border='0' /></a>";
				$html = $html."</div>";
				$html = $html."<div id='shopping_cart_details_item_count'>x".$item['count']."</div>";
			}
			else
			{
				$html = $html."<div style='float: right'>";
				$html = $html."	<a href='#' onClick=\"return add_to_cart(".$item['id'].")\"><img src='".Settings::$PATH_IMG."add_item_48.png' border='0' /></a>";
				$html = $html."</div>";

				$cart = unserialize($_SESSION['cart']);
				$item_count = $cart->GetItemCountByItemId($item['id']);

				//show number of items already in the shopping cart (only if at least 1 already is)
				if($item_count > 0)
					$html = $html."<div id='shopping_cart_details_item_count'>x".$item_count."</div>";
			}

			$html = $html."</div>";
			$html = $html."<div style='clear:both;'></div>";
			$html = $html.'</div>';

			return $html;
		}

		public function ConvertCartItemToDBItem ($cart_item)
		{
			$db_item = array();
			$db_item['count'] = $cart_item->item_count;
			$db_item['id'] = $cart_item->id;
			$db_item['name'] = $cart_item->name;
			$db_item['img_url'] = $cart_item->img_url;

			return $db_item;
		}
	}
?>