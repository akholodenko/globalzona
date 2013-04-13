<? 
	session_start();
	
	include "../classes/allClasses.php"; 
	
	if(Session::ValidateSession())
	{
		$guestlist = strtok($_GET['guestlist'], ",");
		$guestlistArray = array();

		while ($guestlist !== false) 
		{
			$guestlistArray[] = $guestlist;
			$guestlist = strtok(",");			
		}

		$items = strtok($_GET['items'], ",");
		$itemsArray = array();

		while ($items !== false)
		{
			$itemsArray[] = $items;
			$items = strtok(",");
		}

		$potluq_id = Data::SetNewPotluqBasics($_SESSION['USER_id'], $_GET['title'], $_GET['year']."-".$_GET['month']."-".$_GET['day'], $_GET['location_name'], $_GET['address'], urlencode(stripslashes($_GET['description'])));
		Data::SetNewPotluqGuestlist($guestlistArray, $potluq_id);
		Data::SetNewPotluqItems($itemsArray, $potluq_id);
	}
?>