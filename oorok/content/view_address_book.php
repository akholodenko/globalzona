<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		LayoutAddressBook::DisplayAddressBook(Data::GetAddressBookByUserId($_SESSION['USER_id']));
	}
?>