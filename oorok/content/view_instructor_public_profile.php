<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if($_GET['user_id'] != "")
	{
		Layout::MainHeaderContainer('instructor_public_profile');
		LayoutHome::DisplayInstructorPublicProfile(Data::GetUserInfoById($_GET['user_id']));
	}

?>