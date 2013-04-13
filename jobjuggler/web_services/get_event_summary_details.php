<?
	include("../classes/database.php");	
	include("../classes/data.php");
	
	//get details from database
	$info = Data::GetEventInfoById($_POST['eventId']);
	
	echo '{
		"eventId": "'.$_POST['eventId'].'",
		"eventType": "'.$info['event_type'].'",
		"position": {
			"title": "'.$info['position_title'].'",
			"description": "'.$info['position_description'].'",
			"notes": "'.$info['notes'].'"
		},
		"company": {
			"name": "'.$info['company_name'].'",
			"address": {
				"street": "'.$info['company_street_address'].'",
				"city": "'.$info['company_city'].'",
				"state": "'.$info['company_state'].'",
				"zip": "'.$info['company_zip'].'"
			},
			"contact": {
				"email": "'.$info['company_email'].'",
				"name": "'.$info['company_contact'].'",
				"phone": "'.$info['company_phone'].'"
			}
		}
	}';
?>