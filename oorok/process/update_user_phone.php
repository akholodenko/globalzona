<?
	session_start();
	
	$classesPrefix = "../";
	include "../classes/allClasses.php";


	if(Session::ValidateSession())
	{
		if($_POST['phone'] != "")
		{
			Data::UpdateUserPhoneByUserId($_SESSION['USER_id'], $_POST['phone']);
			$_SESSION['USER_phone'] = $_POST['phone'];	//update session info for validation
		}
	}
?>