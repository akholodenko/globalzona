<?
	session_start();
	include "classes/allClasses.php";

	if($_POST['type'] == 'login')
	{
		if(Form::ValidateLogin($_POST['email'], $_POST['password']))
		{
			if($_SESSION['USER_account_type_id'] == 1)	//student
				header( 'Location: student.php' );
			else if($_SESSION['USER_account_type_id'] == 2)	//instructor
				header( 'Location: instructor.php' );
		}
		else
		{
			echo "invalid";
			header( 'Location: index.php?message=wrong+login+credentials' );
		}
	}
	else if($_GET['type'] == 'logout')
	{
		session_destroy();
		header( 'Location: index.php?message=you+are+now+logged+out' );
	}
?>