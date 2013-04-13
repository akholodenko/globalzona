<?
	/*
		This is the shopping cart.
	*/

	class Cart
	{
		public $items = array(); 

		function Cart ()
		{
		}

		public function AddItem ($id, $name, $price, $img_url)
		{
			if($this->IsItemInCart($id))
			{
				$this->items[$this->GetItemIndexByItemId($id)]->item_count++;
			}
			else
				array_push($this->items, new Cart_Item($id, $name, $price, $img_url));
				//$this->items[$this->GetUniqueItemCount()] = new Cart_Item($id, $name, $price, $img_url);
		}		

		public function RemoveItem ($item_id)
		{
			foreach($this->items as $key=>$item)
			{
				if($item->id == $item_id)
				{
					if($item->item_count <= 1)
						unset($this->items[$key]);
					else
						$item->item_count--;
				}
			}
		}

		public function IsItemInCart ($item_id)
		{
			foreach($this->items as $key=>$item)
			{
				if($item->id == $item_id)
					return true;
			}

			return false;
		}

		public function GetItemIndexByItemId ($item_id)
		{
			foreach($this->items as $key=>$item)
			{
				if($item->id == $item_id)
					return $key;
			}

			return -1;
		}

		public function GetItemCountByItemId ($item_id)
		{
			foreach($this->items as $key=>$item)
			{
				if($item->id == $item_id)
					return $item->item_count;
			}

			return -1;
		}

		public function GetUniqueItemCount()
		{
			return count($this->items);
		}

		public function GetTotalItemCount()
		{		
			$total_count = 0;
			foreach($this->items as $key=>$item)
			{
				$total_count += $item->item_count;
			}

			return $total_count;
		}

		public function GetTotalItemCost()
		{		
			$total_cost = 0;
			foreach($this->items as $key=>$item)
			{
				$total_cost += ($item->price * $item->item_count);
			}

			setlocale(LC_MONETARY, 'en_US');
			return money_format('%(#1n', $total_cost);
		}

		public function GetItemAtIndex($index)
		{
			return $this->items[$index];
		}

		public function GetItems()
		{
			return $this->items;
		}
	}
?>