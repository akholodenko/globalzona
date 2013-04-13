<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if($_GET['sub_category_id'] != "")
	{
		LayoutHome::DisplayInstructorSubDirectoryUsers(	$_GET['sub_category_id'],
														Data::GetInstructorSubCategoryCount($_GET['sub_category_id']), 
														Data::GetUserInfoBySubCategoryId($_GET['sub_category_id'])
														);
	}

?>