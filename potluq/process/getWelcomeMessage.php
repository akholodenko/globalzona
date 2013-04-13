<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSession())
	{
		echo "Welcome, ".$_SESSION['USER_f_name']." ".$_SESSION['USER_l_name']." (<a href='validate.php?type=logout'>log out</a>)";
	}
?>