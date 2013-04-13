<?
	include "classes/database.php";
	include "classes/search.php";
	$search = new Search(urlDecode($_GET["query"]));

	if ($_GET["searchType"] == "event")
	{
		$search->SearchEvents();
		$search->PrintSearchEventResults();
	}
	else if ($_GET["searchType"] == "venue")
	{
		$search->SearchVenues();
		$search->PrintSearchVenueResults();
	}

?>
