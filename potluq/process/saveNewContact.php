<? 
	session_start();
	
	include "../classes/allClasses.php"; 
	
	if(Session::ValidateSession())
	{
		Data::SetNewContact($_SESSION['USER_id'], $_GET['f_name'], $_GET['l_name'], $_GET['email']);
		echo "<b>Added</b>";
	}
?>