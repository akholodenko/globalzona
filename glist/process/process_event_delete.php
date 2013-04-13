<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
		if($_GET['event_id'] != "")
		{
			Data::DeleteEvent($_GET['event_id']);
			header( 'Location: ../admin_main.php?message=deleted+event');
		}
		else
		{
			header( 'Location: ../admin_main.php?message=can+not+delete+event' );
		}
	}
?>

