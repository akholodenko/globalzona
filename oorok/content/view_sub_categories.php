<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if($_GET['category_id'] != "")
		LayoutHome::DisplayInstructorSubDirectory(Data::GetInstructorSubCategoriesByCategoryId($_GET['category_id']));

?>