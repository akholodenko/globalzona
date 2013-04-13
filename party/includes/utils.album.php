<?
function dbGetAlbumByVenue($venueId)
{	
	$query = "SELECT p.id as photoAlbumId, c.name as cityName, c.state, c.id as cityId, v.name as venueName, p.albumURL, p.eventDate, p.eventTitle, p.albumCoverURL, p.eventVenueId";
	$query = $query." FROM photoAlbum p, city c, venue v";
	$query = $query." WHERE p.eventCityId = c.Id AND p.eventVenueId=v.Id AND v.id=".$venueId;
	$query = $query." ORDER BY eventDate DESC";

	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get albums by city.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);		
		if ($num > 0) for ( $i = 0; $i < $num; ++$i ) printPhotoAlbumByVenue($results[$i]);
		else printBlankMessage("<br><br><div class='textBig' padding='10' style='text-align: center'>No photo albums found for this venue.<br>To submit a photo album link, please <a href='contact.php?emailSubject=Please Add My Photo Album&specialMessage=paste link to your album here'>click here</a>.</div>");
	}
}

function dbGetRecentAlbumByCity($count,$cityId)
{	
	$query = "SELECT p.id as photoAlbumId, c.name as cityName, c.state, c.id as cityId, v.name as venueName, p.albumURL, p.eventDate, p.eventTitle, p.albumCoverURL, p.eventVenueId, p.id as eventId";
	$query = $query." FROM photoAlbum p, city c, venue v";
	$query = $query." WHERE p.eventCityId = c.Id AND p.eventVenueId=v.Id AND c.id=".$cityId;
	$query = $query." ORDER BY eventDate DESC LIMIT ".$count;
	
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get recent album by city.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		$runLoop = $num;
		if ($num > $count) $runLoop = $count; //if limit to run is less than max venues

		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);		
		for ( $i = 0; $i < $runLoop; ++$i ) printPhotoAlbumByCity($results[$i]);
	}
}

function dbGetAlbumByCity($cityId)
{	
	$query = "SELECT p.id as photoAlbumId, c.name as cityName, c.state, c.id as cityId, v.name as venueName, p.albumURL, p.eventDate, p.eventTitle, p.albumCoverURL, p.eventVenueId";
	$query = $query." FROM photoAlbum p, city c, venue v";
	$query = $query." WHERE p.eventCityId = c.Id AND p.eventVenueId=v.Id AND c.id=".$cityId;
	$query = $query." ORDER BY eventDate DESC";

	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get albums by city.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);		
		$layout = new Layout();
		$layout->bubbleTab("<span id='albumNavigation'>&nbsp;</span>", 70);
		$layout->bubbleSubBoxTop(100);
		echo "<div id='Page1'>";
		$pageCount = 1;
		for ( $i = 0; $i < $num; ++$i )
		{
			if ($i%8 == 0 && $i != 0)	//show 8 per page
			{
				$pageCount++;
				echo "</div><div style='display: none' id='Page".($pageCount)."'>";
			}

			printPhotoAlbumByCity($results[$i]);
		}
		echo "</div>";
		$layout->bubbleSubBoxBottom();
		if ($pageCount > 1) 
		{
			echo "<script>document.getElementById('albumNavigation').innerHTML='".addslashes(getPhotoAlbumNavigation ($pageCount))."';</script>";
			//printPhotoAlbumNavigation ($pageCount);
		}
	}
}

function getPhotoAlbumNavigation ($pageCount)
{
	$nav = "<table align='center' cellpadding='0' cellspacing='0' border='0'>";
	$nav = $nav."	<tr>";

	for ( $i = 0; $i < $pageCount; $i++ )
	{
		$nav = $nav."<td align='center' style='padding-left: 3px; padding-right: 3px;'>";
		$nav = $nav."	<a onClick=\"showPhotoAlbumPage(".($i+1).",".$pageCount."); return false;\" class='textBig' style='text-decoration: underline' href=''>".($i+1)."</a>";
		$nav = $nav."</td>";
	}

	$nav = $nav."	</tr>";
	$nav = $nav."</table>";

	return $nav;
}

function printPhotoAlbumNavigation ($pageCount)
{
	echo "<table align='center' cellpadding='0' cellspacing='0' border='0'>";
	echo "	<tr>";

	for ( $i = 0; $i < $pageCount; $i++ )
	{
		echo "<td align='center' style='padding-left: 10px; padding-right: 10px;'>";
		echo "	<a onClick=\"showPhotoAlbumPage(".($i+1).",".$pageCount."); return false;\" class='textBig' style='text-decoration: underline' href=''>".($i+1)."</a>";
		echo "</td>";
	}

	echo "	</tr>";
	echo "</table>";
}

function printPhotoAlbum ($albumInfo)
{
	echo "<table cellpadding='0' cellspacing='8' border='0' width='100%'>";
	echo "	<tr><td id='".$albumInfo['name']."'>";
	echo "		<table cellpadding='2' cellspacing='1' border='0' width='100%'><tr><td width='125'>";
	echo "				<a href='photoView.php?photoAlbumId=".$albumInfo['photoAlbumId']."' class='textLinkBig'>";
	echo "				<img class='imgBorder' src='".$albumInfo['albumCoverURL']."' width='100' border='0'>";
	echo "			</a>";
	echo "			</td><td class='textBig'>";
	echo "				<a href='photoView.php?photoAlbumId=".$albumInfo['photoAlbumId']."' class='textLinkBig' style='text-decoration: underline; color: #dddddd'>";
	echo "					<b>".$albumInfo['eventTitle']."</b>";
	echo "				</a>";
	echo "				<div class='textSmallWhiteBold'>";
	echo "					on ".date("F j, Y", strtotime($albumInfo['eventDate']));
	echo "				</div>";
	echo "				<div style='padding-top: 10px;'>";
	echo "					<a href='venueDetails.php?venueId=".$albumInfo['eventVenueId']."'>";
	echo						urldecode($albumInfo['venueName'])."</a> in <a href='city.php?cityId=".$albumInfo['cityId']."'>".$albumInfo['cityName'].", ".$albumInfo['state'];
	echo "					</a>";
	echo "				</div>";
	echo "			</td>";
	echo "		</tr></table>";
	echo	"</td></tr>";
	echo "</table>";
}

function printPhotoAlbumByVenue ($albumInfo)
{
	echo "<table cellpadding='0' cellspacing='8' border='0' width='100%'>";
	echo "	<tr><td id='".$albumInfo['name']."'>";
	echo "		<table cellpadding='2' cellspacing='1' border='0' width='100%'><tr><td width='125'>";
	echo "				<a href='photoView.php?photoAlbumId=".$albumInfo['photoAlbumId']."' class='textLinkBig'>";
	echo "				<img class='imgBorder' src='".$albumInfo['albumCoverURL']."' width='100' border='0'>";
	echo "			</a>";
	echo "			</td><td class='textBig'>";
	echo "				<a href='photoView.php?photoAlbumId=".$albumInfo['photoAlbumId']."' class='textLinkBig' style='text-decoration: underline; color: #dddddd'>";
	echo "					<b>".urldecode($albumInfo['eventTitle'])."</b>";
	echo "				</a>";
	echo "				<div class='textBig'>";
	echo "					on ".date("F j, Y", strtotime($albumInfo['eventDate']));
	echo "				</div>";
	echo "			</td>";
	echo "		</tr></table>";
	echo	"</td></tr>";
	echo "</table>";
}

function printPhotoAlbumByCity ($albumInfo)
{
	echo "<table cellpadding='5' cellspacing='0' border='0' width='100%'>";
	echo "<tr><td id='".$albumInfo['eventId']."'>";
	echo "		<div align='right' onMouseOver=\"document.getElementById('".$albumInfo['eventId']."').className='bgMouseOverDetails';\" onMouseOut=\"document.getElementById('".$albumInfo['eventId']."').className='';\"> ";
	echo "			<table cellpadding='2' cellspacing='3' border='0' width='100%'><tr><td width='125'>";
	echo "					<a href='photoView.php?photoAlbumId=".$albumInfo['photoAlbumId']."' class='textLinkBig'>";
	echo "						<img class='imgBorder' src='".$albumInfo['albumCoverURL']."' width='100' border='0'>";
	echo "					</a>";
	echo "				</td><td class='textBig'>";
	echo "					<a href='photoView.php?photoAlbumId=".$albumInfo['photoAlbumId']."' class='textLinkBig'>";
	echo "					<b>".urldecode($albumInfo['eventTitle'])." on ";
	echo					date("F j, Y", strtotime($albumInfo['eventDate']))."</b></a><br>";
	echo "					at <a href='venueDetails.php?venueId=".$albumInfo['eventVenueId']."'>".urldecode($albumInfo['venueName'])."</a>";
	echo "				</td>";
	echo "			</tr></table>";
	echo "		</div>";
	echo "	</td></tr>";
	echo "</table>";
}

function dbFindMostRecentAlbum()
{	
	$query = "SELECT *";
	$query = $query." FROM photoAlbum ORDER BY id desc LIMIT 1";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to find specific venue");
	
	if(!mysql_query($query)) 
	{
		echo "Can't find venue.";
		mysql_close();
	}
	else
	{
		$result = mysql_query($query);
		mysql_close();
					
		$results = mysql_fetch_array($result);
		return $results;
	}
}
?>