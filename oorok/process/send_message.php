<?
	session_start();
	
	$classesPrefix = "../";
	include "../classes/allClasses.php";


	if(Session::ValidateSession())
	{
		
		if($_POST['to_user_id'] != "" && $_POST['subject'] != "" && $_POST['body'] != "")
		{
			Data::SetNewMessage($_SESSION['USER_id'], $_POST['to_user_id'], $_POST['subject'], $_POST['body']);
		}
		
	}
?>