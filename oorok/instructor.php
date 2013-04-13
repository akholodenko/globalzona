<?
	session_start();
	include "classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
?>
		<script>
			var current_nav_tab_id = 'instructor_home_content';	//defaults to instructor tab
		</script>

<?
		Layout::DefaultTemplate("content/instructor_home_content.php", "content/instructor_home_content_side.php", "content/nav_instructor_content.php");
	}
?>