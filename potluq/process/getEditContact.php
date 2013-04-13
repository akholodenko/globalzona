<?
	session_start();
	
	include "../classes/allClasses.php"; 
	
	if(Session::ValidateSession())
	{
		$addressBook = Data::GetContact($_GET['contact_id']);
		Layout::AddressBookEditContact($addressBook);
	} 
?>