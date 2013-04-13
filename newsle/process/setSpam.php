<?
	$classesIncludePrefix = "../";
	include "../classes/allClasses.php";

	if($_GET['postId'] != "")
	{
		Data::SetSpam($_GET['postId']);
	}
?>