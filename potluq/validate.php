<?
	session_start();
	include "classes/allClasses.php";

	if($_POST['type'] == 'login')
	{
		if(Form::ValidateLogin($_POST['email'], $_POST['password']))
		{
			header( 'Location: main.php' );
		}
		else
		{
			header( 'Location: index.php?message=wrong+login+credentials' );
		}
	}
	else if($_POST['type'] == 'signup')
	{
		if(Form::ValidateSignup($_POST['f_name'], $_POST['l_name'], $_POST['email'], $_POST['password']))
		{
			header( 'Location: main.php' );
		}
	}
	else if($_GET['type'] == 'logout')
	{
		session_destroy();
		header( 'Location: index.php?message=you+are+now+logged+out' );
	}
?>