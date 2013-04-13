<?
	$classesIncludePrefix = "../";
	include "../classes/allClasses.php";
	
	if($_GET['categoryId'] == "") $categoryId = 0;
	else $categoryId = $_GET['categoryId'];

	$pages = Data::GetTotalPageCount($categoryId);

	echo ceil($pages[0]['pages'] / Config::$GET_RECENT_POSTS_MAX);
?>