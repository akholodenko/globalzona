<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		LayoutProfile::DisplayInstructorProfile(Data::GetUserInfoById($_SESSION['USER_id']));
	}
?>