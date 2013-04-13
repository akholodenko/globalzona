<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
		if($_POST['first_name'] != "" && $_POST['last_name'] != "" && $_POST['email'] != "")
		{
			//check if guest is in VIP
			$vip_check = Data::GetVIPByEmail($_POST['email']);

			//if not VIP, add to VIP
			if(count($vip_check) == 0)
			{
				Data::SetNewVIP(urlencode(stripslashes($_POST['first_name'])), urlencode(stripslashes($_POST['last_name'])), $_POST['email'], urlencode(stripslashes($_POST['phone'])));
				header( 'Location: ../admin_vip.php?message=added+'.urlencode(stripslashes($_POST['first_name'])).' '.urlencode(stripslashes($_POST['last_name'])) );
			}
			//if already on VIP list, redirect with message
			else
				header( 'Location: ../admin_vip.php?message=email+'.urlencode(stripslashes($_POST['email'])).'+is+already+on+the+VIP+list' );
		}
		else
		{
			header( 'Location: ../admin_vip.php?message=can+not+add+vip+-+blank+required+values' );
		}
	}
?>