<?
	include("../classes/database.php");	
	include("../classes/data.php");
	
	//get details from database
	$info = Data::GetAddressBookItemById($_POST['addressBookId']);
	
	echo '{
			"id": "'.$_POST['addressBookId'].'",
			"typeId": "'.$info['type_id'].'",
			"company":"'.$info["company"].'",
			"address": {
				"addressStreet":"'.$info["address_street"].'",
				"city":"'.$info["city"].'",
				"state":"'.$info["state"].'",
				"zip":"'.$info["zip"].'"
			},
			"contact": {
				"name":"'.$info["full_name"].'",
				"email":"'.$info["email"].'",
				"phone":"'.$info["phone"].'"
			},
			"opportunityId": "'.$info["opportunity_id"].'",
			"event": {
				"calendarId":"'.$info["calendar_id"].'",
				"date": {
					"year": "'.date("o", strtotime($info["event_date"])).'",
					"month": "'.date("m", strtotime($info["event_date"])).'",
					"day": "'.date("d", strtotime($info["event_date"])).'",
					"dayOfWeek": "'.date("l", strtotime($info["event_date"])).'",
					"time": "'.date("h:ia", strtotime($info["event_date"])).'"
				},
				"type":"'.$info["event_type"].'"
			}			
		}';
?>