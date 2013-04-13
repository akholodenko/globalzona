<?
	session_start();
	include "classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
?>
		<script>
			var current_nav_tab_id = 'student_home_content';
		</script>

<?
		Layout::DefaultTemplate("content/student_home_content.php", "content/student_home_content_side.php", "content/nav_student_content.php");
	}
?>