<?
	$classesIncludePrefix = "../";
	include "../classes/allClasses.php";

	if($_GET['postId'] != "")
	{
		Data::SetView($_GET['postId']);
	}
?>