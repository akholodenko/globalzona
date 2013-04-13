<?
	session_start();
	
	$classesPrefix = "../";
	include "../classes/allClasses.php";


	if(Session::ValidateSession())
	{
		if($_POST['email'] != "")
		{
			Data::UpdateUserEmailByUserId($_SESSION['USER_id'], $_POST['email']);
			$_SESSION['USER_email'] = $_POST['email'];	//update session info for validation
		}
	}
?>