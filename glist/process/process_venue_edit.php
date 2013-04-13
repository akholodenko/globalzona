<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
		if($_POST['venue_id'] != "" && $_POST['venue_name'] != "" && $_POST['venue_address'] != "")
		{
			Data::UpdateVenue($_POST['venue_id'], urlencode(stripslashes($_POST['venue_name'])), urlencode(stripslashes($_POST['venue_address'])));
			header( 'Location: ../admin_venues.php?message=updated+'.urlencode(stripslashes($_POST['venue_name'])) );
		}
		else
		{
			header( 'Location: ../admin_venues.php?message=can+not+update+with+blank+values' );
		}
	}
?>

