<? 
	session_start();
	
	include "../classes/allClasses.php"; 
	
	if(Session::ValidateSession())
	{
		Data::DeleteContact($_GET['id']);
		echo "<b>Deleted</b>";
	}
?>