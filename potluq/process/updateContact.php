<? 
	session_start();
	
	include "../classes/allClasses.php"; 
	
	if(Session::ValidateSession())
	{
		Data::UpdateContact($_GET['contact_id'], $_GET['f_name'], $_GET['l_name'], $_GET['email']);
		echo "<b>Updated</b>";
	}
?>