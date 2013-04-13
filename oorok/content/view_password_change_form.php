<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		$style = "background-color: #ffffff; width: 400px; padding: 10px; margin: 10px 0px; border: 1px solid #777777;";
		LayoutProfile::DisplayPasswordChangeForm(Data::GetUserInfoById($_SESSION['USER_id']), $style);
	}
	else
	{
		echo "Not logged in.";
	}
?>