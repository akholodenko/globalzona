<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		Layout::MainHeaderContainer('instructor_calendar');//calendar sub-navigation

		echo "<div id='container_profile' style='padding: 0px 20px 0px 20px'>";
				LayoutCalendar::DisplayInstructorCalendar(Data::GetUserInfoById($_SESSION['USER_id']));
		echo "</div>";
	}
?>