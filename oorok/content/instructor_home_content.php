<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		LayoutHome::MainHeaderContainer("instructor_home", "Welcome!");//home sub-navigation

		echo "<div id='container_home'>";
				LayoutHome::DisplayInstructorMain();
		echo "</div>";
	}
?>