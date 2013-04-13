<?
	session_start();
	include "classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
		Layout::AdminTemplate("content/admin_news_content.php","content/admin_navigation.php");
	}
?>

