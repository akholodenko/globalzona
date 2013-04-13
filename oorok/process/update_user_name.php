<?
	session_start();
	
	$classesPrefix = "../";
	include "../classes/allClasses.php";


	if(Session::ValidateSession())
	{
		if($_POST['f_name'] != "" && $_POST['l_name'] != "")
		{
			Data::UpdateUserNameByUserId($_SESSION['USER_id'], $_POST['f_name'], $_POST['l_name']);
			$_SESSION['USER_f_name'] = stripslashes(urldecode($_POST['f_name']));
			$_SESSION['USER_l_name'] = stripslashes(urldecode($_POST['l_name']));
		}
	}
?>