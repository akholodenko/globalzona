<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		Layout::MainHeaderContainer('instructor_profile');//profile sub-navigation

		echo "		<div id='container_profile'>";
						LayoutProfile::DisplayInstructorProfile(Data::GetUserInfoById($_SESSION['USER_id']));
		echo "		</div>";

	}
?>