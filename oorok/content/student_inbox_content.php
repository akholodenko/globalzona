<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		Layout::MainHeaderContainer('student_inbox');//inbox sub-navigation

		echo "<div id='container_messages'>";
				LayoutMessage::DisplayInboxMessages(Data::GetInboxMessagesByUserId($_SESSION['USER_id']), 'from');
		echo "</div>";
	}
?>