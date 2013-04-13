<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
		if($_GET['vip_id'] != "")
		{
			Data::DeleteVIP($_GET['vip_id']);
			header( 'Location: ../admin_vip.php?message=deleted+vip+entry');
		}
		else
		{
			header( 'Location: ../admin_vip.php?message=can+not+delete' );
		}
	}
?>

