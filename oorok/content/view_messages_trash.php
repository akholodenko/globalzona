<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		LayoutMessage::DisplayInboxMessages(Data::GetTrashMessagesByUserId($_SESSION['USER_id']), 'trash', true);
	}
?>