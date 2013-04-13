<?
	$layout = new Layout();

	echo "<table width='97%' cellpadding='0' cellspacing='3' border='0'><tr><td>";
	$layout = new Layout();
	$leftLink = "<span id='mainMenu.Links' style='visibility: hidden'>";
	$leftLink = $leftLink."<a id='mainMenu.Reviews.Link' style='color: yellow' href='#' onClick=\"showWebUserModule('review'); return false;\">Your Reviews</a>";
	$leftLink = $leftLink."&nbsp;|&nbsp;<a id='mainMenu.Events.Link' href='#' onClick=\"showWebUserModule('event'); return false;\">Your Events</a>";
	$leftLink = $leftLink."&nbsp;|&nbsp;<a id='mainMenu.AddEvent.Link' href='#' onClick=\"showWebUserModule('addEvent'); return false;\">Add Event</a>";
	$leftLink = $leftLink."</span>";
	$title = "Welcome, ".$_SESSION["firstName"]." ".$_SESSION["lastName"];
	$layout->bubbleBoxTop($title,$leftLink);

	$passedVenueId = $_POST['venueId'];
	if (!check_int($passedVenueId)) $passedVenueId = $_GET['venueId'];
	if (check_int($passedVenueId)) include "includes/venueReview.php";
	else 
	{
		echo "<script>";
		echo "	document.getElementById('mainMenu.Links').style.visibility = 'visible';";
		echo "</script>";
		include "includes/mainMenu.php";

	}

	$layout->bubbleBoxSpacer();
	$layout->bubbleBoxBottom(); 
	$layout->bubbleBoxSpacer();
	echo "</td></tr></table>";
?>