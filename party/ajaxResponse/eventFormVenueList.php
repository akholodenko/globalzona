<?
	include "../utils.php";
	
	if ($_GET['cityId'] != "")
	{
		$event = new Event();
		$event->GetVenueList($_GET['cityId']);

	}
?>