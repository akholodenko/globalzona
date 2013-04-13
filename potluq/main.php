<?
	session_start(); 
	include "classes/allClasses.php";

	Session::ValidateSessionWithRedirect();

	Layout::DefaultTemplate("content/main.php","content/mainNavigation.php");
?>