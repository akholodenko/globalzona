<html>
<? include 'utils.php'; ?>
<?

function dbGetRecentEventsTest ($limit)
{
	$query = "SELECT e.date, e.Id as eventId, e.eventTitle, e.venueName, c.name as cityName, e.message, c.state as cityState ";
	$query = $query."FROM event e, city c ";
	$query = $query."WHERE c.Id = e.cityId AND e.date >= '".date('Y-m-d 00:00:00', time())."'";
	$query = $query." ORDER BY e.submitted desc";
	$db = new DB_Connect();

	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");

	if(!mysql_query($query)) 
	{
		echo "Can't get most recent events.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);

		$eventDate = array();		
		$eventId = array();
		$eventTitle = array();
		$venueName = array();
		$cityName = array();
		$message = array();
		$state = array();				
		for ($i = 0; $i < $num; ++$i) $eventDate[$i] = $results[$i]['date'];
		for ($i = 0; $i < $num; ++$i) $eventId[$i] = $results[$i]['eventId'];
		for ($i = 0; $i < $num; ++$i) $eventTitle[$i] = urldecode($results[$i]['eventTitle']);
		for ($i = 0; $i < $num; ++$i) $venueName[$i] = $results[$i]['venueName'];
		for ($i = 0; $i < $num; ++$i) $cityName[$i] = $results[$i]['cityName'];
		for ($i = 0; $i < $num; ++$i) $state[$i] = $results[$i]['cityState'];		
		for ($i = 0; $i < $num; ++$i) $message[$i] = urldecode($results[$i]['message']);
		printRecentEventLayer($eventDate,$eventId,$eventTitle,$venueName,$cityName,$message, $state, $limit);
	}
}

function printRecentEventLayer ($eventDate, $eventId, $eventTitle, $venueName, $cityName, $message, $state, $limit)
{
	if (count($eventId) == 0) 
	{
			echo "<tr bgcolor='#888888' class='text'>";
			echo "<td align='center'>&nbsp;&nbsp;&nbsp;No events listed for this date.</td>";
			echo "</tr>";
	}
	else
	{
		if (count($eventId) < $limit) $loopRun = count($eventId);
		else $loopRun = $limit;

		for ($i = 0; $i < $loopRun; ++$i)
		{
			$bgColor = "#bbbbbb";
			if ($i%2 != 0) $bgColor = "#aaaaaa";
			echo "<tr bgcolor='$bgColor' class='text'>";
			echo "<td align='justify'>";
			echo "&nbsp;&nbsp;&nbsp;<a href='eventDetails.php?eventId=".$eventId[$i]."' onMouseOver=\"document.getElementById('eventDetailsBG".$eventId[$i]."').style.display = 'block'\" onMouseOut=\"document.getElementById('eventDetailsBG".$eventId[$i]."').style.display = 'none'\"><font color='#000000'><b>".$eventTitle[$i]."</b></font></a>";
			echo "<div id='eventDetailsBG".$eventId[$i]."' style='display: none;' class='layerEventTrans'>";
		?>
				<div id="eventDetailsText" style="z-index:11;">
					<table align='center' width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr><td class='nav' colspan='2' align='center' bgcolor='#333333'>Event Summary</td></tr>
						<tr><td align='right' class='nav' width='30%'><font color=black>&nbsp;Date:&nbsp;</font></td><td class='text'><font color=black>&nbsp;<? echo date("m.d.Y", strtotime($eventDate[$i])); ?></font></td></tr>
						<tr><td align='right' class='nav' width='30%'><font color=black>&nbsp;Venue:&nbsp;</font></td><td class='text'><font color=black>&nbsp;<? echo $venueName[$i]; ?></font></td></tr>
						<tr><td align='right' class='nav' width='30%'><font color=black>&nbsp;City:&nbsp;</font></td><td class='text'><font color=black>&nbsp;<? echo $cityName[$i].', '.$state[$i]; ?></font></td></tr>
						<tr><td align='right' class='nav' width='30%' valign='top'><font color=black>&nbsp;Description:&nbsp;</font></td><td class='text'><font color=black><? echo substr($message[$i],0,100)."..."; ?></font></td></tr>
					</table>
				</div> 
		<?
			echo "</div>";
			echo "</td>";
			echo "</tr>";	
		}
	}
}
?>

<link href="http://www.globalzona.com/party/style.css" rel="stylesheet" type="text/css">
<link href="http://www.globalzona.com/party/layer.css" rel="stylesheet" type="text/css">
<table cellpadding="0" cellspacing="0" border="0" width="50%">
					<tr class='nav'><td bgcolor="#666666" align='center'>Test Most Recently Posted Events</td></tr>
					<? dbGetRecentEventsTest (5); ?>
					<tr><td class='spacer'>&nbsp;</td></tr>
				</table>


</html>