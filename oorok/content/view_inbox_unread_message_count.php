<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		$message_count = Data::GetUserUnreadMessageCountByUserId($_SESSION['USER_id']);
		echo $message_count['message_count'];
	}
	else
	{
		echo "Not logged in.";
	}
?>