<? 
	session_start();
	
	include "../classes/allClasses.php"; 
	
	if(Session::ValidateSession())
	{
		Data::UpdateProfile($_SESSION['USER_id'], urlencode($_GET['f_name']), urlencode($_GET['l_name']), $_GET['email'], urlencode($_GET['password']));
		Session::SetUserInfo(Data::GetUserInfoById($_SESSION['USER_id']));
	}
?>