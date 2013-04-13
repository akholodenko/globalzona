<?
	session_start();
	
	$classesPrefix = "../";
	include "../classes/allClasses.php";


	if(Session::ValidateSession())
	{
		if($_POST['message_id'] != "" && $_POST['message_read_status_id'] != "")
		{
			Data::UpdateMessageReadStatus($_SESSION['USER_id'], $_POST['message_id'], $_POST['message_read_status_id']);
		}
	}
?>