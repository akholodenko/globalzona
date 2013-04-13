<?
	include "../utils.php";

	if ($_GET['venueId'] != "")
	{
		$submitEvent = new Event();
		$submitEvent->SetVenueInfo($_GET['venueId']);
		echo $submitEvent->VenueName;
		echo "<input type='hidden' id='dbVenueAddress' name='dbVenueAddress' value='".$submitEvent->VenueAddress.", ".$submitEvent->VenueCityName.", ".$submitEvent->VenueCityState."'>";
		echo "<input type='hidden' id='dbVenueStreetAddress' name='dbVenueStreetAddress' value='".$submitEvent->VenueAddress."'>";
		echo "<input type='hidden' id='dbVenueCityName' name='dbVenueCityState' value='".$submitEvent->VenueCityName.", ".$submitEvent->VenueCityState."'>";
		echo "<input type='hidden' id='dbVenueImg' name='dbVenueImg' value='".$submitEvent->VenueImg."'>";
	}
?>