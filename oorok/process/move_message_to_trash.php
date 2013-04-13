<?
	session_start();
	
	$classesPrefix = "../";
	include "../classes/allClasses.php";


	if(Session::ValidateSession())
	{
		
		if($_POST['message_id'] != "")
		{
			Data::MoveMessageToTrash($_SESSION['USER_id'], $_POST['message_id']);
		}
		
	}
?>