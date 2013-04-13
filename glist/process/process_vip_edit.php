<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
		if($_POST['vip_id'] != "" && $_POST['first_name'] != "" && $_POST['last_name'] != "" && $_POST['email'] != "")
		{
			Data::UpdateVIP($_POST['vip_id'], urlencode(stripslashes($_POST['first_name'])), urlencode(stripslashes($_POST['last_name'])), $_POST['email'], urlencode(stripslashes($_POST['phone'])));
			header( 'Location: ../admin_vip.php?message=updated+'.urlencode(stripslashes($_POST['first_name'])).' '.urlencode(stripslashes($_POST['last_name'])) );
		}
		else
		{
			header( 'Location: ../admin_vip.php?message=can+not+edit+vip+-+blank+required+values' );
		}
	}
?>