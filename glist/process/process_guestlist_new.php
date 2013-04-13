<?
	session_start();
	include "../classes/allClasses.php";

	if($_POST['event_id'] != "" && $_POST['first_name'] != "" && $_POST['last_name'] != "" && $_POST['email'] != "")
	{
		Data::SetNewGuest($_POST['event_id'], urlencode(stripslashes($_POST['first_name'])), urlencode(stripslashes($_POST['last_name'])), $_POST['email']);

		//check if guest is in VIP
		$vip_check = Data::GetVIPByEmail($_POST['email']);

		//if not VIP, add to VIP
		if(count($vip_check) == 0)
		{
			Data::SetNewVIP(urlencode(stripslashes($_POST['first_name'])), urlencode(stripslashes($_POST['last_name'])), $_POST['email'], '');
		}

		header( 'Location: ../admin_event_sign_up.php?event_id='.$_POST['event_id'].'&added=true&noform=true');
	}
	else
	{
		header( 'Location: ../admin_event_sign_up.php?message=can+not+add+to+guestlist+-+blank+values' );
	}
?>