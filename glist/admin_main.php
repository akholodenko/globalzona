<?
	session_start();
	include "classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
		Layout::AdminTemplate("content/admin_main_content.php","content/admin_navigation.php");
	}
?>

