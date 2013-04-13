<?
	session_start();
	include "classes/allClasses.php";

	if($_POST['type'] == 'login')
	{
		if(Form::ValidateLogin($_POST['username'], $_POST['password']))
		{
			header( 'Location: admin_main.php' );
		}
		else
		{
			header( 'Location: index.php?message=wrong+login+credentials' );
		}
	}
	else if($_GET['type'] == 'logout')
	{
		session_destroy();
		header( 'Location: index.php?message=you+are+now+logged+out' );
	}
?>