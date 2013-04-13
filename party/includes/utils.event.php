<?
function dbFindEvent($index)
{	
	$query = "SELECT * FROM event WHERE id=$index";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) 
	{
		echo "Can't find event.";
		mysql_close();
	}
	else
	{
		$result = mysql_query($query);
		mysql_close();
					
		$results = mysql_fetch_array($result);
		$results['venueName'] = urldecode($results['venueName']);
		$results['eventTitle'] = str_replace("\'","'",urldecode($results['eventTitle']));
		$results['message'] = str_replace("\'","'",urldecode($results['message']));
		
		return $results;
	}
}

function insertNewEvent ()
{
	$query = "INSERT into event (eventTitle,cityId,venueName,address,state,flyerURL,date,message,guestListURL,hostName,hostEmail,hostPassword) values (";
	$query = $query."'".urlencode(stripslashes(urldecode($_GET['eventTitle'])))."',";
	$query = $query.$_GET['city'].',';
	$query = $query."'".urlencode(stripslashes(urldecode($_GET['venueName'])))."',";
	$query = $query."'".$_GET['address']."',";		
	$query = $query."'".$_GET['state']."',";	
	$query = $query."'".$_GET['flyer']."',";		
	$query = $query."'".$_GET['pYear']."-".$_GET['pMonth']."-".$_GET['pDay']." ".ampmConvert($_GET['hour'], $_GET['ampm']).":".$_GET['minute'].":00',";		//0000-00-00 00:00:00
	$query = $query."'".urlencode(stripslashes(urldecode($_GET['message'])))."',";		
	$query = $query."'".urlencode($_GET['guestlist'])."',";		
	$query = $query."'".$_GET['name']."',";		
	$query = $query."'".$_GET['email']."',";
	$query = $query."'".$_GET['password']."'";					
	$query = $query.')';
	//echo $query;

	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		mysql_close();
		return false;
	}
	else
	{
		$query = "SELECT id from event WHERE date = '".$_GET['pYear']."-".$_GET['pMonth']."-".$_GET['pDay']." ".ampmConvert($_GET['hour'], $_GET['ampm']).":".$_GET['minute'].":00' AND eventTitle = '".urlencode($_GET['eventTitle'])."' AND hostEmail = '".$_GET['email']."' AND cityId = ".$_GET['city'];
		
		//$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();

		//for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);
		$results = mysql_fetch_array($result);
		$message = "Password: ".$_GET['password']."\nEvent URL: http://www.globalzona.com/party/eventDetails.php?eventId=".$results['id'];
		$headers = "From: info@globalzona.com";
		mail($_GET['email'], 'Thank You for Posting Your Event!', $message, $headers);
		return $results['id'];
	}	
}

function updateCurrentEvent ()
{
	$query = "UPDATE event set ";
	$query = $query." eventTitle = '".urlencode(stripslashes(urldecode($_GET['eventTitle'])))."',";
	$query = $query." cityId = ".$_GET['city'].',';
	$query = $query." venueName = '".urlencode(stripslashes(urldecode($_GET['venueName'])))."',";
	$query = $query." address = '".$_GET['address']."',";		
	$query = $query." state = '".$_GET['state']."',";	
	$query = $query." flyerURL = '".$_GET['flyer']."',";		
	$query = $query." date = '".$_GET['pYear']."-".$_GET['pMonth']."-".$_GET['pDay']." ".ampmConvert($_GET['hour'], $_GET['ampm']).":".$_GET['minute'].":00',";		//0000-00-00 00:00:00
	$query = $query." message = '".urlencode(stripslashes(urldecode($_GET['message'])))."',";		
	$query = $query." guestListURL = '".urlencode($_GET['guestlist'])."',";		
	$query = $query." hostName = '".$_GET['name']."',";		
	$query = $query." hostEmail = '".$_GET['email']."',";
	$query = $query." hostPassword = '".$_GET['password']."'";					
	$query = $query." WHERE id = ".$_GET['eventId'];
	//echo $query;

	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) echo "Unable to update event.";
	mysql_close();
}
?>