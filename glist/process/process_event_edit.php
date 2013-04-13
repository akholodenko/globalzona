<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
		if($_POST['has_guestlist'] != "" && $_POST['event_id'] != "" && $_POST['title'] != "" && $_POST['month'] != "" && $_POST['day'] != "" && $_POST['year'] != "" && $_POST['flyer_url'] != "" && $_POST['description'] != "" && $_POST['venues'] != "")
		{
			//replace double quotes with single quotes
			$event_title = urlencode(str_replace("\"", "'", stripslashes($_POST['title'])));
			//$event_description = urlencode(nl2br(stripslashes($_POST['description'])));
			$event_description =  urlencode(str_replace("\n", "<br/>", stripslashes($_POST['description'])));

			Data::UpdateEvent($_POST['event_id'], $event_title, $_POST['year']."-".$_POST['month']."-".$_POST['day'], $_POST['venues'], urlencode(stripslashes($_POST['flyer_url'])), $event_description, $_POST['has_guestlist']);
			header( 'Location: ../admin_event.php?event_id='.$_POST['event_id'].'&message=updated+event');
		}
		else if($_POST['event_id'] != "")
		{
			header( 'Location: ../admin_event.php?event_id='.$_POST['event_id'].'&message=can+not+update+event+-+blank+values' );
		}
		else
		{
			header( 'Location: ../admin_main.php?message=can+not+update+event+-+blank+values' );
		}
	}
?>

