<?
	$classesIncludePrefix = "../";
	include "../classes/allClasses.php";
	
	if($_GET['postId'] != "")
		Layout::DisplayPost(Data::GetPostByID($_GET['postId']));
?>