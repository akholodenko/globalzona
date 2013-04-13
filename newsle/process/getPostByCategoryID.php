<?
	$classesIncludePrefix = "../";
	include "../classes/allClasses.php";

	if($_GET['categoryId'] == 0) $showCategories = true;	//for all posts show individual category
	else $showCategories = false;

	if($_GET['page'] != "") $page = $_GET['page'];
	else $page = 0;

	Layout::DisplayHomePagePosts(Data::GetPostByCategoryID(Config::$GET_RECENT_POSTS_MAX,$_GET['categoryId'],$page), $showCategories);
?>