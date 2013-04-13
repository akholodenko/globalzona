<?
	$classesIncludePrefix = "../";
	include "../classes/allClasses.php";

	Layout::DisplayTopPosts(Data::GetTopPosts(Config::$GET_TOP_POSTS_MAX));
?>