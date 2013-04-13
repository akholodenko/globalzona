<?
	include("../classes/database.php");	
	include("../classes/data.php");
	
	//get details from database
	//$info = Data::GetEventInfoById($_POST['eventId']);
	$info = Data::GetAddressBookItemsByType($_POST['addressBookTypeId'], 1);
	
	echo '{
		"addressBookTypeId": "'.$_POST['addressBookTypeId'].'",
		"count": "'.count($info).'",
		"contacts": [';
		
	for($x = 0; $x < count($info); $x++)
	{
		if($x > 0) echo ',';
		
		echo '{
				"id":"'.$info[$x]["id"].'",
				"name":"'.$info[$x]["full_name"].'",
				"company":"'.$info[$x]["company_name"].'",
				"email":"'.$info[$x]["email"].'",
				"phone":"'.$info[$x]["phone"].'",
				"address_street":"'.$info[$x]["address_street"].'",
				"city":"'.$info[$x]["city"].'",
				"state":"'.$info[$x]["state"].'",
				"zip":"'.$info[$x]["zip"].'",
				"type":"'.$info[$x]["type"].'"
			}';
	}	
	echo ']}';
?>