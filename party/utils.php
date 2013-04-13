<?
/*=================================== Classes ===================================*/
$pathPrefix = "";
$curDir = strpos(getCurrentDirectory(),".php");
if ($curDir == false) $pathPrefix = "../";

include $pathPrefix."classes/layout.php";
if (getCurrentDirectory() != "webUser") include $pathPrefix."classes/database.php";
include $pathPrefix."classes/poll.php";
include $pathPrefix."classes/api.php";
include $pathPrefix."classes/upload.php";
//include $pathPrefix."classes/stats.php";
include $pathPrefix."classes/event.php";
include $pathPrefix."classes/email.php";
include $pathPrefix."classes/article.php";
include $pathPrefix."classes/photoAlbum.php";
include $pathPrefix."../phpmailer/class.phpmailer.php";

/*=================================== Utility Functions =========================*/
include "includes/utils.city.php";
include "includes/utils.calendar.php";
include "includes/utils.event.php";
include "includes/utils.venue.php";
include "includes/utils.album.php";
include "includes/utils.seo.php";

/*=================================== Misc Functions ============================*/
function getCurrentDirectory ()
{
	strtok($_SERVER['PHP_SELF'],"/");
	$directory = strtok("/");

	return $directory;
}

function nav_cat ($id,$text, $link, $img)
{
	echo "<td width='20%' id='".$id."' align='center' valign='middle'>";

//onMouseOver=\"$('#eventDetailsBG".$eventId[$i]."').fadeIn(500);\"
	echo "<div style='height: 25px;'> ";
?>
<script>
	$(document).ready(function(){

		/*	NAVIGATION	*/
		var navId = '<? echo $id; ?>';

		$('#' + navId + 'LINK').mouseover(function(){	//MOUSE OVER functionality
			$('#' + navId).fadeTo(200, 0, function(){
				$(this).css('background-color','#C229CF');
				$(this).fadeTo(200, 1.00);
			});
		});

		$('#' + navId + 'LINK').mouseout(function(){	//MOUSE OUT functionality
			$('#' + navId).fadeTo(200, 0, function() {
				$(this).css('background-color','#000000');
				$(this).fadeTo(200, 1.00);
			});
		});
});
</script>
<?

//	echo "<div style='height: 25px;' onMouseOver=\"MM_changeProp('$text','','style.backgroundColor','#C229CF','DIV')\" onMouseOut=\"MM_changeProp('$text','','style.backgroundColor','#000000','DIV')\"> ";
//	if ($img != "") echo "<div style='float: left; margin-left: 10px; margin-bottom: -100px; padding-top: 2px; z-index: 100'><img src='".$img."'></div>";
//	if ($img != "") echo "<img style='float: left; padding: 3px; padding-top: 5px;' src='".$img."' width='20' align='left'>";
	echo "	<a id='".$id."LINK' href='$link' class='navTall2'>$text</a>";
	echo "</div>";
	echo "</td>";
}

function nav_cat_new ($text, $link)
{
	echo "<td width='11%' id='$text' align='center'>";
	echo "<div onMouseOver=\"MM_changeProp('$text','','style.backgroundColor','#003366','DIV')\" onMouseOut=\"MM_changeProp('$text','','style.backgroundColor','#000000','DIV')\"> ";
	echo "<a href='$link' class='navTall'><font color='red'>$text!</font></a>";
	echo "</div>";
	echo "</td>";
}

function nav_city ($city, $link, $cityId)
{
	echo "<tr><td id='$city' bgcolor='#";
	if ($_GET['cityId'] == $cityId) echo "888888'>";
	else echo "333333'>";
//	echo "<div onMouseOver=\"document.getElementById('navCityDetails".$cityId."').style.display = 'block';MM_changeProp('$city','','style.backgroundColor','#222222','DIV')\" onMouseOut=\"document.getElementById('navCityDetails".$cityId."').style.display = 'none';MM_changeProp('$city','','style.backgroundColor','#";
	echo "<div onMouseOver=\"MM_changeProp('$city','','style.backgroundColor','#222222','DIV')\" onMouseOut=\"MM_changeProp('$city','','style.backgroundColor','#";
	if ($_GET['cityId'] == $cityId) echo "888888','DIV')\"> ";
	else echo "333333','DIV')\"> ";
//	echo "<div onMouseOver=\"show_form('navCityDetails".$cityId."','open')\" onMouseOut=\"show_form('navCityDetails".$cityId."','')\">";
//	echo "<a href='$link'  class='nav' >&nbsp;&nbsp;&nbsp;$city</a> ";
	echo "<a href='city.php?cityId=".$cityId."' class='nav' >&nbsp;&nbsp;&nbsp;$city</a> ";
//	nav_city_details ($cityId);
	echo "</div>";
	echo "</td></tr>";
}

function nav_city_details ($cityId)
{
	echo "<div id='navCityDetails".$cityId."' style=\"display: none\">";
	echo "<table cellpadding=5 cellspacing=0 border=0 width='100%' bgcolor='#444444'";
	echo "	<tr>";
	echo "		<td class='textSmall'>";
	echo "			&nbsp;&nbsp;&nbsp;<a href='calendar.php?cityId=".$cityId."'>Calendar</a>";
	if (cityHasVenues($cityId)) echo "			&nbsp;<font color='#dddddd'>|</font>&nbsp;&nbsp;<a href='venueDirectory.php?cityId=".$cityId."'>Clubs/Bars</a>";
	if (cityHasPhotos($cityId)) echo "			&nbsp;<font color='#dddddd'>|</font>&nbsp;&nbsp;<a href='photo.php?cityId=".$cityId."'>Photos</a>";
	echo "		<div class='spacer'>&nbsp;</div></td>";
	echo "	</tr>";
	echo "</table>";
	echo "</div>";
	/*
	echo "<div id='navCityDetails".$cityId."' style='display: none;' class='layerCityDetails'>";
	echo "<div onMouseOut=\"document.getElementById('navCityDetails".$cityId."').style.display = 'none';\" id='eventDetailsText' style='z-index:11;'>";
	echo "<table cellpadding=1 cellspacing=0 border=0 width='100%' bgcolor='#222222'";
	echo "	<tr>";
	echo "		<td class='textSmall'>";
	echo "			&nbsp;&nbsp;&nbsp;<a href='calendar.php?cityId=".$cityId."'>Calendar</a>";
	if (cityHasVenues($cityId)) echo "			&nbsp;<font color='#dddddd'>|</font>&nbsp;&nbsp;<a href='venueDirectory.php?cityId=".$cityId."'>Clubs/Bars</a>";
	if (cityHasPhotos($cityId)) echo "			&nbsp;<font color='#dddddd'>|</font>&nbsp;&nbsp;<a href='photo.php?cityId=".$cityId."'>Photos</a>";
	echo "		</td>";
	echo "	</tr>";
	echo "</table>";
	echo "</div> "
	echo "</div>";	
	*/
}

function cityHasVenues ($cityId)
{	
	$query = "SELECT count(*) as cityVenueCount FROM venue WHERE cityId=$cityId";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) 
	{
		echo "Can't get venue per city count.";
		mysql_close();
	}
	else
	{
		$result = mysql_query($query);
		mysql_close();
					
		$results = mysql_fetch_array($result);
		if ($results['cityVenueCount'] > 0) return true;
		else return false;
	}
}

function cityHasPhotos ($cityId)
{	
	$query = "SELECT count(*) as cityPhotoCount FROM photoAlbum WHERE eventCityId=$cityId";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) 
	{
		echo "Can't get photos per city count.";
		mysql_close();
	}
	else
	{
		$result = mysql_query($query);
		mysql_close();
					
		$results = mysql_fetch_array($result);
		if ($results['cityPhotoCount'] > 0) return true;
		else return false;
	}
}

function displayFlyer ($image)
{
	list($width, $height, $type, $attr) = getimagesize("$image");
	$ratio = 200/$width;
	$height = $ratio * $height;
	echo "<img border='0' src='$image' width='200'>";
}

function displayImage ($image, $setSize)
{
	list($width, $height, $type, $attr) = getimagesize("$image");
	$ratio = $setSize/$width;
	$height = $ratio * $height;
	echo "<img class='imgBorder' border='0' src='$image' width='".$setSize."' height='$height'>";
}

class DB_Connect {
	//var $localhost="mysqldb";
	var $localhost="localhost";
	var $username="artemk";
	var $password="9QKRuh9Lw2nA5cJY";
	var $database="party";
}

function check_int($i) 
{
	if (ereg("^[0-9]+[.]?[0-9]*$", $i, $p)) return 1;
	else return 0;
}

function dbGetCity($type, $selected)
{	
	if ($type == 'nav')	$query = "SELECT c.id, c.name, c.state FROM city c, event e WHERE c.id = e.cityId AND (e.date >= '".date('Y-m-d 00:00:00', time())."' OR e.IsActive=1) group by c.name, c.id, c.state";
	else if ($type == 'dropDown')	$query = "SELECT * FROM city ORDER BY name";
	else if ($type == 'venue')	$query = "SELECT c.id, c.name, c.state, ct.name as countryName FROM city c, venue v, country ct WHERE c.countryId=ct.id AND c.id=v.cityId group by c.name, c.id, c.state ORDER BY name";
	else if ($type == 'album')	$query = "SELECT c.id, c.name, c.state FROM city c, photoAlbum p WHERE c.id=p.eventCityId group by c.name, c.id, c.state ORDER BY name";

	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get city information.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);
		
		if ($type == 'nav') for ( $i = 0; $i < $num; ++$i ) nav_city($results[$i]['name'].', '.$results[$i]['state'],'calendar.php?cityId='.$results[$i]['id'], $results[$i]['id']);
		else if ($type == 'dropDown')
		{
			$optionName = array();
			$optionValue = array();
			for ($i = 0; $i < $num; ++$i) $optionName[$i] = $results[$i]['name'].', '.$results[$i]['state'];
			for ($i = 0; $i < $num; ++$i) $optionValue[$i] = $results[$i]['id'];

			printDropDown("city","class='form' id='citySubmit'",$optionName,$optionValue,$selected);
		}
		else if ($type == 'venue') include "includes/venueCityList.php";
		else if ($type == 'album') include "includes/photoCityList.php";
	}
}

function GetLetterPosition ($letter)
{
	$alphabet = strtoupper("abcdefghijklmnopqrstuvwxyz");
	for ($x = 0; $x < 26; $x++)
		if ($alphabet{$x} == strtoupper($letter)) return ($x + 1);

	return 0;
}

function GetLetterByPosition ($pos)
{
	if ($pos > 0 && $pos <= 26) 
	{
		$alphabet = strtoupper("abcdefghijklmnopqrstuvwxyz"); 
		return $alphabet{$pos - 1};
	}
	else if ($pos == 0)	return "#";
	return "";
}

function printVenueByCityNavigation ($letterList)
{
	echo "here";
	for ($i = 0; $i < count($letterList); $i++)
	{
		echo $letterlist[$i];
		//if ($letterlist[$i] ==  true) echo "&nbsp;".GetLetterByPosition ($i);
	}
}

function dbGetTopVenueRandom($count)
{	
	$query = "SELECT v.id, v.name, c.name as city, v.address, c.state, v.imgURL, v.text, v.website, ct.name as countryName";
	$query = $query." FROM venue v, city c, country ct";
	$query = $query." WHERE c.countryId=ct.id AND c.id=v.cityId";
	
//	$query = "SELECT * FROM venue";
	
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get top events.";
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
		for ( $i = 0; $i < $runLoop; ++$i ) 
		{
			$selectVenue = rand(0,$num-1); //randomly select a venue to display
			while (IsUsedVenue ($usedVenues,$selectVenue))	//look for new, non-yet displayed venue
				$selectVenue = rand(0,$num-1);

			printTopVenue($results[$selectVenue]);
			$usedVenues[$i]=$selectVenue;
		}
	}
}

function dbGetTopVenueRandomByCity($count,$cityId)
{	
	$query = "SELECT v.id, v.name, c.name as city, v.address, c.state, v.imgURL, v.text, v.website, ct.name as countryName";
	$query = $query." FROM venue v, city c, country ct";
	$query = $query." WHERE c.countryId=ct.id AND c.id=v.cityId AND v.cityId=".$cityId;
	
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get top events by city.";
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
		for ( $i = 0; $i < $runLoop; ++$i ) 
		{
			$selectVenue = rand(0,$num-1); //randomly select a venue to display
			while (IsUsedVenue ($usedVenues,$selectVenue))	//look for new, non-yet displayed venue
				$selectVenue = rand(0,$num-1);

			printTopVenueByCity($results[$selectVenue]);
			$usedVenues[$i]=$selectVenue;
		}
	}
}

function dbGetRandomAlbumByCity($count,$cityId)
{	
	$query = "SELECT c.name as cityName, c.state, v.name as venueName, p.albumURL, p.eventDate, p.eventTitle, p.albumCoverURL, p.eventVenueId, p.id as eventId";
	$query = $query." FROM photoAlbum p, city c, venue v";
	$query = $query." WHERE p.eventCityId = c.Id AND p.eventVenueId=v.Id AND c.id=".$cityId;
	$query = $query." ORDER BY eventDate DESC";
	
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get random album by city.";
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
		for ( $i = 0; $i < $runLoop; ++$i ) 
		{
			$selectVenue = rand(0,$num-1); //randomly select a venue to display
			while (IsUsedVenue ($usedVenues,$selectVenue))	//look for new, non-yet displayed venue
				$selectVenue = rand(0,$num-1);

			printPhotoAlbumByCity($results[$selectVenue]);
			$usedVenues[$i]=$selectVenue;
		}
	}
}

function IsUsedVenue ($usedVenues,$newVenue) //check if selected venue has been already displayed in group
{
	for ($f = 0; $f < count($usedVenues); $f++)
		if($usedVenues[$f] == $newVenue) return true;

	return false;
}

function printTopVenueByCity ($venueInfo)
{
	echo "<table cellpadding='5' cellspacing='0' border='0' width='100%'>";
	echo "	<tr><td id='".$venueInfo['name']."'>";
	echo "		<div align='right' onMouseOver=\"document.getElementById('".$venueInfo['name']."').className='bgMouseOverDetails';\" onMouseOut=\"document.getElementById('".$venueInfo['name']."').className='';\"> ";
	echo "			<table cellpadding='2' cellspacing='3' border='0' width='100%'><tr><td width='125'>";
	echo "				<a href='venueDetails.php?venueId=".$venueInfo['id']."' class='textLink'>";
	echo "					<img src='".$venueInfo['imgURL']."' width='100' height='75' class='imgBorder' border='0'>";
	echo "				</a>";
	echo "				</td><td class='text'>";
	echo "					<a href='venueDetails.php?venueId=".$venueInfo['id']."' class='textLinkBig'>";
	echo "						<b>".str_replace("\'","'",urldecode($venueInfo['name']))."</b> - <i>".$venueInfo['city'].", ";
	
	if ($venueInfo['countryName'] != "" && $venueInfo['countryName'] != "USA") echo $venueInfo['countryName'];
	else echo $venueInfo['state'];

	echo "						</i><br>";
	echo str_replace("<p>"," ",substr($venueInfo['text'],0,120))."...";
	echo "					</a></td>";
	echo "			</tr></table>";
	echo "		</div>";
	echo "	</td></tr>";
	echo "</table>";
}

function printTopVenue ($venueInfo)
{
	$highlightColor = "aaaaaa";
	echo "<table cellpadding='0' cellspacing='0' border='0' width='100%'>";
	echo "	<tr><td id='".$venueInfo['name']."' background='layout/bgFeatured.jpg'>";
	echo "		<div align='right' onMouseOver=\"document.getElementById('".$venueInfo['name']."').className='bgMouseOverDetails';\" onMouseOut=\"document.getElementById('".$venueInfo['name']."').className='';\"> ";
//	echo "<div onMouseOver=\"MM_changeProp('".$venueInfo['name']."','','style.backgroundColor','#".$highlightColor."','DIV')\" onMouseOut=\"MM_changeProp('".$venueInfo['name']."','','style.backgroundColor','#333333','DIV')\"> ";
	echo "			<table cellpadding='2' cellspacing='3' border='0' width='100%'><tr><td width='125'>";
	echo "				<a href='venueDetails.php?venueId=".$venueInfo['id']."' class='textLink'>";
	echo "					<img src='".$venueInfo['imgURL']."' width='100' class='imgBorder' border='0'>";
	echo "				</a>";
	echo "				</td><td class='text'>";
	echo "					<a href='venueDetails.php?venueId=".$venueInfo['id']."' class='textLink'>";
	echo "						<b>".$venueInfo['name']."</b> - <i>".$venueInfo['city'].", ";
	
	if ($venueInfo['countryName'] != "" && $venueInfo['countryName'] != "USA") echo $venueInfo['countryName'];
	else echo $venueInfo['state'];

	echo "						</i><br>";
	echo str_replace("<p>"," ",substr($venueInfo['text'],0,120))."...";
	echo "					</a></td>";
	echo "			</tr></table>";
	echo "		</div>";
	echo "	</td></tr>";
	echo "</table>";
}

function printTopVenueNoHighlight ($venueInfo)
{
	$highlightColor = "aaaaaa";
	echo "<table cellpadding='10' cellspacing='1' border='0' width='100%'><tr><td width='125'>";
	echo "	<a href='venueDetails.php?venueId=".$venueInfo['id']."' class='textLink'>";
	echo "		<img src='".$venueInfo['imgURL']."' width='100' height='75' border='0' class='imgBorder'>";
	echo "	</a>";
	echo "</td><td>";
	echo "<a href='venueDetails.php?venueId=".$venueInfo['id']."' class='textLinkBig'>";
	echo "<b>".urldecode($venueInfo['name'])."</b> - <i>".$venueInfo['city'].", ";
	
	if ($venueInfo['countryName'] != "" && $venueInfo['countryName'] != "USA")
		echo $venueInfo['countryName'];
	else
		echo $venueInfo['state'];
	
	echo "</i><br>";	
	echo str_replace("<p>"," ",substr($venueInfo['text'],0,150))."...";
	echo "</a></td>";
	echo "</tr></table>";
}

function dbFindState($index)
{	
	$query = "SELECT * FROM city WHERE id=$index";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) 
	{
		echo "Can't find state.";
		mysql_close();
	}
	else
	{
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		$results = mysql_fetch_array($result);		
		return $results['state'];
	}
}

function dbFindVideo($index)
{	
	$query = "SELECT v.id, a.name, v.title, v.code, v.imgURL FROM video v, artist a WHERE v.artistId=a.id AND v.id=$index";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) 
	{
		echo "Can't find video.";
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

function dbFindArtist($index)
{	
	$query = "SELECT * FROM artist WHERE id=$index";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) 
	{
		echo "Can't find artist.";
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

function dbFindAlbum($index)
{	
	$query = "SELECT p.albumUrl, p.eventTitle, p.eventDate, v.id as venueId, v.name as venueName, c.id as cityId, c.name as city, v.address as venueAddress, c.state";
	$query = $query." FROM photoAlbum p, venue v, city c WHERE p.eventCityId=c.Id AND p.eventVenueId=v.id AND p.id=$index";

//	echo $query;
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to find specific venue");
	
	if(!mysql_query($query)) 
	{
		echo "Can't find album.";
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

function dbDeleteEvent($index)
{	
	$query = "DELETE FROM event WHERE id=$index";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) return false;
	else return true;
}

function dbFindFeatured($table)
{	
	$query = "SELECT * FROM ".$table." WHERE startDate <= '".date("Y-m-d")."' AND endDate > '".date("Y-m-d")."'";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) echo "Can't find featured venue.";
	else
	{
		$result = mysql_query($query);
		$num = mysql_numrows($result);

		if ($num > 0)	//if an item is scheduled to be featured during for this day
		{
			mysql_close();
						
			$results = mysql_fetch_array($result);
			return $results;
		}
		else if ($num == 0)	//if no item is schedule, retrieve 1st item
		{
			$query = "SELECT top 1 * FROM host order by id";
			if(!mysql_query($query)) echo "Can't find 1st featured venue.";
			else
			{
				$result = mysql_query($query);
				mysql_close();

				$results = mysql_fetch_array($result);
				return $results;
			}//close else
		}//close else if
	}//close else
}

function dbFindPrintBriefHostInfo($index)
{	
	$query = "SELECT * FROM host WHERE id=$index";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) 
	{
		echo "Can't find host.";
		mysql_close();
	}
	else
	{
		$result = mysql_query($query);
		mysql_close();
					
		$results = mysql_fetch_array($result);		
		echo "<a target='_blank' href='".$results['website']."'><b>Previously featured: ".$results['name']."</b></a>";
	}
}

function dbFindPrintBriefVenueInfo($index)
{	
	$query = "SELECT * FROM venue WHERE id=$index";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
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
		echo "<a target='_blank' href='".$results['website']."'><b>Previously featured: ".$results['name']."</b></a>";
	}
}

function dbGetFAQ()
{	
	$query = "SELECT * FROM faq ORDER BY id";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) 
	{
		echo "Can't get faq information.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);
		
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
		echo "<tr bgcolor='#555555' class='nav'><td align='right' colspan='2'>Help/FAQ&nbsp;&nbsp;&nbsp;</td></tr>";
		
		for ($i = 0; $i < $num; ++$i) echo "<tr bgcolor='#777777' class='text'><td colspan='2'>&nbsp;&nbsp;&nbsp;Q:&nbsp;<a href='#".$results[$i]['id']."'>".$results[$i]['question']."</a><br><br></td></tr>"; //question list

		for ( $i = 0; $i < $num; ++$i ) //full faq
		{
			echo "<tr bgcolor='#dddddd' class='nav'><td valign='top'><font color='black'>&nbsp;&nbsp;&nbsp;Q:&nbsp;</font></td><td><font color='black'>".$results[$i]['question']."</font></td></tr>";
			echo "<tr bgcolor='#777777' class='text'><td valign='top'>&nbsp;&nbsp;&nbsp;<a name='".$results[$i]['id']."'>A:</a>&nbsp;</td><td>".$results[$i]['answer']."</td></tr>";
		}
		echo "</table>";
	}
}

function printDropDown ($Name, $HTMLparams, $optionName, $optionValue, $selected)
{
	echo "<select name='$Name' $HTMLparams>";
	for ($i = 0; $i < count($optionName); ++$i)
	{
		if ($optionValue[$i] == $selected) echo "<option value='".$optionValue[$i]."' selected>".$optionName[$i]."</option>";
		else echo "<option value='".$optionValue[$i]."'>".$optionName[$i]."</option>";
	}
	echo "</select>";
}

function dbGetWeeklyEvent ($day, $cityId)
{
	$query = "SELECT e.sponsor, e.date, e.Id as eventId, e.eventTitle, e.venueName, e.venueId, e.flyerURL, c.name as cityName, e.message, c.state as cityState ";
	$query = $query."FROM event e, city c ";
	$query = $query."WHERE c.Id = e.cityId AND e.weekDay = '".date("w", strtotime($day))."' AND e.IsActive = 1 ";
	if (check_int($cityId) == 1 && $cityId > 0 ) $query = $query."AND e.cityId = ".$cityId;
	$query = $query." ORDER BY e.date";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");

	if(!mysql_query($query)) 
	{
		echo "Can't get event information.";
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
		$venueId = array();	
		$flyerURL = array();
		$sponsor = array();

		for ($i = 0; $i < $num; ++$i) $eventDate[$i] = $results[$i]['date'];
		for ($i = 0; $i < $num; ++$i) $eventId[$i] = $results[$i]['eventId'];
		for ($i = 0; $i < $num; ++$i) $eventTitle[$i] = str_replace("\'","'",urldecode($results[$i]['eventTitle']));
		for ($i = 0; $i < $num; ++$i) $venueName[$i] = str_replace("\'","'",urldecode($results[$i]['venueName']));
		for ($i = 0; $i < $num; ++$i) $venueId[$i] = $results[$i]['venueId'];
		for ($i = 0; $i < $num; ++$i) $cityName[$i] = $results[$i]['cityName'];
		for ($i = 0; $i < $num; ++$i) $state[$i] = $results[$i]['cityState'];		
		for ($i = 0; $i < $num; ++$i) $message[$i] = str_replace("\'","'",urldecode($results[$i]['message']));
		for ($i = 0; $i < $num; ++$i) $flyerURL[$i] = $results[$i]['flyerURL'];		
		for ($i = 0; $i < $num; ++$i) $sponsor[$i] = $results[$i]['sponsor'];		

		echo "<tr bgcolor='#777777' class='navTall'>";
		echo "	<td colspan=4 align='left' class='lightGradient'>&nbsp;&nbsp;&nbsp;Regular ".date("l", strtotime($day))." Events</td>";
		echo "</tr>";

		if (count($eventId) == 0) 
		{
				echo "<tr class='textBig'>";
				echo "<td colspan=4 align='center'><i>No regularly scheduled events listed for this day.</i></td>";
				echo "</tr>";
		}
		else printSpecialEvent($eventDate,$eventId,$eventTitle,$venueName,$venueId, $cityName,$message, $state, date("l", strtotime($day)), $flyerURL, $sponsor);
	}
}

function dbGetEvent ($startDate, $endDate, $cityId, $type)
{
	$query = "SELECT e.flyerURL, e.date, e.Id as eventId, e.eventTitle, e.venueName, e.venueId, c.name as cityName, e.message, c.state as cityState ";
	$query = $query."FROM event e, city c ";
	$query = $query."WHERE c.Id = e.cityId AND e.date >= '".$startDate."' AND e.date <= '".$endDate."' ";
	if (check_int($cityId) == 1 && $cityId > 0 ) $query = $query."AND e.cityId = ".$cityId;
	if ($type == "main") $query = $query." AND e.startDate = '0000-00-00' AND e.endDate = '0000-00-00' AND e.flyerURL <> '' ";
	$query = $query." ORDER BY e.date";
	//echo $query;
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");

	if(!mysql_query($query)) 
	{
		echo "Can't get event information.";
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
		$venueId = array();
		$cityName = array();
		$message = array();
		$state = array();		
		$flyer = array();

		for ($i = 0; $i < $num; ++$i) $eventDate[$i] = $results[$i]['date'];
		for ($i = 0; $i < $num; ++$i) $eventId[$i] = $results[$i]['eventId'];
		for ($i = 0; $i < $num; ++$i) $eventTitle[$i] = str_replace("\'","'",urldecode($results[$i]['eventTitle']));
		for ($i = 0; $i < $num; ++$i) $venueName[$i] = str_replace("\'","'",urldecode($results[$i]['venueName']));
		for ($i = 0; $i < $num; ++$i) $venueId[$i] = $results[$i]['venueId'];
		for ($i = 0; $i < $num; ++$i) $cityName[$i] = $results[$i]['cityName'];
		for ($i = 0; $i < $num; ++$i) $state[$i] = $results[$i]['cityState'];		
		for ($i = 0; $i < $num; ++$i) $message[$i] = str_replace("\'","'",urldecode($results[$i]['message']));
		for ($i = 0; $i < $num; ++$i) $flyer[$i] = $results[$i]['flyerURL'];		

		if ($type != "main" && count($eventId) > 0)
		{
			echo "<tr bgcolor='#777777' class='navTall'>";
			echo "<td colspan=4 align='left' class='lightGradient'>&nbsp;&nbsp;&nbsp;Special Events</td>";
			echo "</tr>";
		}

		if (count($eventId) == 0 && $type != "main") 
		{
			/*
				echo "<tr class='textBig'>";
				echo "<td colspan=4 align='center'><i>No special events listed for this date.</i></td>";
				echo "</tr>";
			*/
			echo "";
		}
		else if ($type == "main") printEventMain($flyer,$eventDate,$eventId,$eventTitle,$venueName,$venueId,$cityName,$message, $state, "");
		else if ($type == "Special") printSpecialEvent($eventDate,$eventId,$eventTitle,$venueName,$venueId,$cityName,$message, $state, "",$flyer);
		else printEvent($eventDate,$eventId,$eventTitle,$venueName,$venueId,$cityName,$message, $state, "","");
	}
}

function dbGetAllEvents ($startDate, $endDate, $cityId, $type)
{
	$query = "SELECT e.flyerURL, e.date, e.Id as eventId, e.eventTitle, e.venueName, c.name as cityName, e.message, c.state as cityState, e.IsActive ";
	$query = $query."FROM event e, city c ";
	$query = $query."WHERE c.Id = e.cityId AND e.date >= '".$startDate."' AND e.date <= '".$endDate."' ";
	if (check_int($cityId) == 1 && $cityId > 0 ) $query = $query."AND e.cityId = ".$cityId;
	if ($type == "main") $query = $query." AND e.startDate = '0000-00-00' AND e.endDate = '0000-00-00' AND e.flyerURL <> '' ";
	//$query = $query." ORDER BY e.date";

	$query = $query." UNION ";

	$query = $query."SELECT e.flyerURL, e.date, e.Id as eventId, e.eventTitle, e.venueName, e.venueId, c.name as cityName, e.message, c.state as cityState, e.IsActive ";
	$query = $query."FROM event e, city c ";
	$query = $query."WHERE c.Id = e.cityId AND e.IsActive=1 ";
	if (check_int($cityId) == 1 && $cityId > 0 ) $query = $query."AND e.cityId = ".$cityId;
	$query = $query." ORDER BY date";
	//echo $query;
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");

	if(!mysql_query($query)) 
	{
		echo "Can't get event information.";
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
		$venueId = array();
		$cityName = array();
		$message = array();
		$state = array();		
		$flyer = array();
		$weekly = array();

		for ($i = 0; $i < $num; ++$i) $eventDate[$i] = $results[$i]['date'];
		for ($i = 0; $i < $num; ++$i) $eventId[$i] = $results[$i]['eventId'];
		for ($i = 0; $i < $num; ++$i) $eventTitle[$i] = urldecode($results[$i]['eventTitle']);
		for ($i = 0; $i < $num; ++$i) $venueName[$i] = urldecode($results[$i]['venueName']);
		for ($i = 0; $i < $num; ++$i) $venueId[$i] = $results[$i]['venueId'];
		for ($i = 0; $i < $num; ++$i) $cityName[$i] = $results[$i]['cityName'];
		for ($i = 0; $i < $num; ++$i) $state[$i] = $results[$i]['cityState'];		
		for ($i = 0; $i < $num; ++$i) $message[$i] = urldecode($results[$i]['message']);
		for ($i = 0; $i < $num; ++$i) $flyer[$i] = $results[$i]['flyerURL'];		
		for ($i = 0; $i < $num; ++$i) $weekly[$i] = $results[$i]['IsActive'];

		if ($type != "main")
		{
			echo "<tr bgcolor='#777777' class='nav'>";
			echo "<td colspan=4 align='left'>&nbsp;&nbsp;&nbsp;Special Events</td>";
			echo "</tr>";
		}

		if (count($eventId) == 0 && $type != "main") 
		{
				echo "<tr bgcolor='#888888' class='text'>";
				echo "<td colspan=4 align='center'>No special events listed for this date.</td>";
				echo "</tr>";
		}
		else if ($type == "main") printEventAllMain($flyer,$eventDate,$eventId,$eventTitle,$venueName,$cityName,$message, $state, "",$weekly);
		else printEvent($eventDate,$eventId,$eventTitle,$venueName,$venueId,$cityName,$message, $state, "");
	}
}

function printEventAllMain ($flyer, $eventDate, $eventId, $eventTitle, $venueName, $cityName, $message, $state, $setDay, $weekly)
{
	$loopRun = 3;
	if (count($eventId) < $loopRun) $loopRun = count($eventId);

	for ($i = 0; $i < $loopRun; ++$i)
	{
		$highlightColor = "aaaaaa";
		echo "<table cellpadding='0' cellspacing='0' border='0' width='100%'>";
		echo "<tr><td id='".urlencode($eventTitle[$i])."' bgcolor='#777777' align='right'>";
		echo "<div align='right' onMouseOver=\"document.getElementById('".urlencode($eventTitle[$i])."').className='bgMouseOverDetails';\" onMouseOut=\"document.getElementById('".urlencode($eventTitle[$i])."').className='';\"> ";
		echo "<table cellpadding='2' cellspacing='3' border='0' width='99%'><tr>";
		echo "<td class='text'>";
		echo "<a href='eventDetails.php?eventId=".$eventId[$i]."' class='textLink'>";
		
		if($weekly[$i] == "1")
			echo "<b>".$eventTitle[$i]."</b> - Weekly - <i>".$cityName[$i]."</i><br>";
		else
			echo "<b>".$eventTitle[$i]."</b> - ".date("m/d/Y", strtotime($eventDate[$i]))." - <i>".$cityName[$i]."</i><br>";

		echo substr($message[$i],0,120)."...";
		echo "</a></td>";
		echo "<td width='125' align='right' valign='top'>";
		echo "<a href='eventDetails.php?eventId=".$eventId[$i]."' class='textLink'>";
		echo "<img src='".$flyer[$i]."' width='100' height='50' class='imgBorder'>";
		echo "</a></td>";
		echo "</tr></table>";
		echo "</div>";
		echo "</td></tr>";
		echo "</table>";
	}
}

function printEventMain ($flyer, $eventDate, $eventId, $eventTitle, $venueName, $venueId, $cityName, $message, $state, $setDay)
{
	$loopRun = 3;
	if (count($eventId) < $loopRun) $loopRun = count($eventId);

	for ($i = 0; $i < $loopRun; ++$i)
	{
		echo "<table cellpadding='5' cellspacing='0' border='0' width='100%'>";
		echo "	<tr><td id='".urlencode($eventTitle[$i])."' align='right'>";
		echo "		<div align='right' onMouseOver=\"document.getElementById('".urlencode($eventTitle[$i])."').className='bgMouseOverDetails';\" onMouseOut=\"document.getElementById('".urlencode($eventTitle[$i])."').className='';\"> ";
		echo "			<table cellpadding='2' cellspacing='3' border='0' width='99%'><tr>";
		echo "				<td class='text'>";
		echo "					<a href='eventDetails.php?eventId=".$eventId[$i]."' class='textLinkBig'>";
		echo "						<b>".$eventTitle[$i]."</b> - ".date("m/d/Y", strtotime($eventDate[$i]))." - <i>".$cityName[$i]."</i><br>";
		echo						str_replace("<br>"," ",substr($message[$i],0,170))."...";						
		echo "					</a></td>";
		echo "				<td width='125' align='right' valign='top'>";
		echo "					<a href='eventDetails.php?eventId=".$eventId[$i]."' class='textLink'>";
		echo "						<img src='".$flyer[$i]."' width='100' height='75' class='imgBorder'>";
		echo "					</a></td>";
		echo "				</tr></table>";
		echo "		</div>";
		echo "	</td></tr>";
		echo "</table>";
	}
}

/*
function printEvent ($eventDate, $eventId, $eventTitle, $venueName, $cityName, $message, $state, $setDay)
{
	for ($i = 0; $i < count($eventId); ++$i)
	{
		$bgColor = "#bbbbbb";
		if ($i%2 != 0) $bgColor = "#aaaaaa";
		echo "<tr bgcolor='$bgColor' class='text'>";
		echo "<td>&nbsp;&nbsp;&nbsp;<font color='#000000'>".date("g:i a", strtotime($eventDate[$i]))."</font></td>";
		echo "<td colspan='3' align='justify'>&nbsp;&nbsp;&nbsp;<a href='eventDetails.php?weeklyDay=".$setDay."&eventId=".$eventId[$i]."'><font color='#000000'><b>".$eventTitle[$i]."</b></font></a></td>";
		echo "</tr>";
		echo "<tr bgcolor='$bgColor' class='text'>";
		echo "<td align='jusity'>&nbsp;</td>";
		echo "<td colspan='3'>&nbsp;&nbsp;&nbsp;<font color='#000000'><i>".$venueName[$i]."</i>";
		echo "&nbsp;-&nbsp;".$cityName[$i].', '.$state[$i]."</font></td>";
		echo "</tr>";
		echo "<tr bgcolor='$bgColor' class='text'>";
		echo "<td align='jusity'>&nbsp;</td>";
		echo "<td colspan='3' align='jusity'>&nbsp;&nbsp;&nbsp;<font color='#444444'>".substr($message[$i],0,60)."...&nbsp;</font></td>";
		echo "</tr>";			
	}
}
*/

function printSpecialEvent ($eventDate, $eventId, $eventTitle, $venueName, $venueId, $cityName, $message, $state, $setDay,$flyer, $sponsor = "")
{
	$layout = new Layout();

	$sponsorIndex = array();

	//make array of indexes of sponsored events
	if($sponsor != "")
	{
		for ($q = 0; $q < count($eventId); ++$q)
		{
			if($sponsor[$q] == 1)
				array_push($sponsorIndex, $q);
		}
	}

	for($x = 0; $x < count($sponsorIndex); $x++)
		echo "sponsor: ".$sponsorIndex[$x];

	//print only sponsored events
	for ($i = 0; $i < count($eventId); ++$i)
	{
		if(in_array($i, $sponsorIndex))
		{
			echo "<tr style='background-color: #C229CF;'><td colspan='4' align='center'>&nbsp;</td></tr>";
			echo "<tr class='textBig' style='background-color: #C229CF;'>";
			echo "	<td rowspan='3' width='15%' align='center' style='padding-left: 10px; padding-top: 3px;'>";
						if($flyer[$i] != "") echo "<img style='margin-left: 5px;' class='imgBorder' src='".$flyer[$i]."' width='100' height='75'>";
						else echo "<img style='margin-left: 5px;' class='imgBorder' src='http://www.globalzona.com/party/images/no_flyer.jpg' width='100' height='75'>";
			echo "	</td>";
			echo "	<td colspan='3' align='justify'>&nbsp;&nbsp;&nbsp;<a href='eventDetails.php?weeklyDay=".$setDay."&eventId=".$eventId[$i]."'><b>".$eventTitle[$i]."</b></a></td>";
			echo "</tr>";
			echo "<tr class='textBig' style='background-color: #C229CF;'>";
			echo "	<td colspan='3'>&nbsp;&nbsp;&nbsp;".date("g:i a", strtotime($eventDate[$i]))."&nbsp;&nbsp;&nbsp;";
						$layout->printVenueName($venueName[$i],$venueId[$i],true);
			echo "		&nbsp;-&nbsp;".$cityName[$i].', '.$state[$i];
			echo "	</td>";
			echo "</tr>";
			echo "<tr class='textBig' style='background-color: #C229CF;'>";
			echo "	<td colspan='3' align='jusity'>&nbsp;&nbsp;&nbsp;<font color='#dddddd'>".str_replace("<br>"," ",substr($message[$i],0,75))."...&nbsp;</font></td>";
			echo "</tr>";
		
			echo "<tr style='background-color: #C229CF;'><td colspan='4' align='center'>&nbsp;</td></tr>";
		}
	}
	
	//print only non-sponsored events
	for ($i = 0; $i < count($eventId); ++$i)
	{
		if(!in_array($i, $sponsorIndex))
		{
			echo "<tr><td colspan='4' align='center'>&nbsp;</td></tr>";
			echo "<tr class='textBig'>";
			echo "	<td rowspan='3' width='15%' align='center' style='padding-left: 10px; padding-top: 3px;'>";
						if($flyer[$i] != "") echo "<img style='margin-left: 5px;' class='imgBorder' src='".$flyer[$i]."' width='100' height='75'>";
						else echo "<img style='margin-left: 5px;' class='imgBorder' src='http://www.globalzona.com/party/images/no_flyer.jpg' width='100' height='75'>";
			echo "	</td>";
			echo "	<td colspan='3' align='justify'>&nbsp;&nbsp;&nbsp;<a href='eventDetails.php?weeklyDay=".$setDay."&eventId=".$eventId[$i]."'><b>".$eventTitle[$i]."</b></a></td>";
			echo "</tr>";
			echo "<tr class='textBig'>";
			echo "	<td colspan='3'>&nbsp;&nbsp;&nbsp;".date("g:i a", strtotime($eventDate[$i]))."&nbsp;&nbsp;&nbsp;";
			$layout->printVenueName($venueName[$i],$venueId[$i],true);
			echo "&nbsp;-&nbsp;".$cityName[$i].', '.$state[$i]."</td>";
			echo "</tr>";
			echo "<tr class='textBig'>";
			echo "	<td colspan='3' align='jusity'>&nbsp;&nbsp;&nbsp;<font color='#dddddd'>".str_replace("<br>"," ",substr($message[$i],0,75))."...&nbsp;</font></td>";
			echo "</tr>";
		
			echo "<tr><td colspan='4' align='center'>&nbsp;</td></tr>";
		}
	}
}


function printEvent ($eventDate, $eventId, $eventTitle, $venueName, $venueId, $cityName, $message, $state, $setDay, $flyer)
{
	$layout = new Layout();

	for ($i = 0; $i < count($eventId); ++$i)
	{
		if ($i != 0) echo "<tr><td colspan='4' align='center'>&nbsp;</td></tr>";
		echo "<tr class='textBig'>";
		echo "	<td width='15%'>&nbsp;&nbsp;&nbsp;".date("g:i a", strtotime($eventDate[$i]))."</td>";
		echo "	<td colspan='3' align='justify'>&nbsp;&nbsp;&nbsp;<a href='eventDetails.php?weeklyDay=".$setDay."&eventId=".$eventId[$i]."'><b>".$eventTitle[$i]."</b></a></td>";
		echo "</tr>";
		echo "<tr class='textBig'>";
		echo "	<td align='justify'>";
		if($flyer[$i] != "") echo "<img style='margin-left: 5px;' class='imgBorder' src='".$flyer[$i]."' width='100' height='75'>";
		else echo "&nbsp;";
		echo "	</td>";
		echo "	<td colspan='3'>&nbsp;&nbsp;&nbsp;";
		$layout->printVenueName($venueName[$i],$venueId[$i],true);
		echo "&nbsp;-&nbsp;".$cityName[$i].', '.$state[$i]."</td>";
		echo "</tr>";
		echo "<tr class='textBig'>";
		echo "	<td align='justify'>&nbsp;</td>";
		echo "	<td colspan='3' align='jusity'>&nbsp;&nbsp;&nbsp;<font color='#dddddd'>".str_replace("<br>"," ",substr($message[$i],0,75))."...&nbsp;</font></td>";
		echo "</tr>";
	}
}

function dbGetRecentEvents ($limit)
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
		for ($i = 0; $i < $num; ++$i) $venueName[$i] = urldecode($results[$i]['venueName']);
		for ($i = 0; $i < $num; ++$i) $cityName[$i] = $results[$i]['cityName'];
		for ($i = 0; $i < $num; ++$i) $state[$i] = $results[$i]['cityState'];		
		for ($i = 0; $i < $num; ++$i) $message[$i] = str_replace("\'","'",urldecode($results[$i]['message']));

		printRecentEventLayer($eventDate,$eventId,$eventTitle,$venueName,$cityName,$message, $state, $limit);
	}
}

function printRecentEvent ($eventDate, $eventId, $eventTitle, $venueName, $cityName, $message, $state, $limit)
{
	if (count($eventId) == 0) 
	{
			echo "<tr bgcolor='#888888' class='text'>";
			echo "<td colspan=4 align='center'>&nbsp;&nbsp;&nbsp;No events listed for this date.</td>";
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
			echo "<td>&nbsp;&nbsp;&nbsp;<font color='#000000'>".date("m.d.Y", strtotime($eventDate[$i]))."</font></td>";
			echo "<td align='justify'>&nbsp;&nbsp;&nbsp;<a href='eventDetails.php?eventId=".$eventId[$i]."'><font color='#000000'><b>".$eventTitle[$i]."</b></font></a></td>";
			echo "<td align='right'><font color='#000000'><i>".$venueName[$i]."</i></font></td>";
			echo "<td><font color='#000000'>&nbsp;-&nbsp;".$cityName[$i].', '.$state[$i]."</font></td>";
			echo "</tr>";	
		}
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
			echo "<td>";
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

function ampmConvert ($time, $type)
{
	if ($type == 'pm') 
	{
		if ($time == '01') return '13';
		else if ($time == '02') return '14';
		else if ($time == '03') return '15';
		else if ($time == '04') return '16';
		else if ($time == '05') return '17';
		else if ($time == '06') return '18';
		else if ($time == '07') return '19';
		else if ($time == '08') return '20';
		else if ($time == '09') return '21';
		else if ($time == '10') return '22';
		else if ($time == '11') return '23';
	}
	else return $time;
}

function calendar_month ($selected, $id) //prints out months
{
	print "<select class='form' name='pMonth' id='".$id."'>";
	for ($x = 1; $x <= 12; $x++) 
	{
		if ($x == $selected && $selected != '') print "<option value='$x' selected>$x</option>";
		else if ($x == date("n") && $selected == '') print "<option value='$x' selected>$x</option>";
		else print "<option value='$x'>$x</option>";
	}
	print "</select>";
}

function calendar_day ($selected, $id) //prints out days
{
	//print "<select class='form' name='pDay'>";
	?> <select class='form' name="pDay" <? echo "id='".$id."'"; ?> > <?
	for ($x = 1; $x <= 31; $x++)
	{
		if ($x == $selected && $selected != '') print "<option value='$x' selected>$x</option>";
		else if ($x == date("j") && $selected == '') print "<option value='$x' selected>$x</option>";
		else print "<option value='$x'>$x</option>";
	}
	print "</select>";
}

function calendar_year ($selected, $id) //prints out years
{
	print "<select class='form' name='pYear' id='".$id."'>";
	for ($x = date("Y"); $x < date("Y")+2; $x++)
	{
		if ($x == $selected) print "<option value='$x' selected>$x</option>";
		else print "<option value='$x'>$x</option>";
	}
	print "</select>";
}

function calendar_hour ($selected)
{
	print "<select class='form' name='hour' id='hour'>";
	for($x = 1; $x <= 12; $x++)
	{
		if ($x == $selected && $selected != '')
		{
			if ($x < 10) print "<option value='0$x' selected >0$x</option>";
			else print "<option value='$x' selected>$x</option>";
		}
		else
		{
			if ($x == 9 && $selected == '') $selectText = 'selected';
			else $selectText = '';

			if ($x < 10) print "<option value='0$x' ".$selectText.">0$x</option>";
			else print "<option value='$x' ".$selectText.">$x</option>";
		}
	}
	print "</select>";
}

function calendar_minute ($selected)
{
	print "<select class='form' name='minute' id='minute'>";
	for($x = 0; $x < 46; $x=$x+15)
	{
		if ($x == 0 && $selected == "00") print "<option value='0$x' selected>:0$x</option>";
		else if ($x == 0 && $selected != "00") print "<option value='0$x'>:0$x</option>";
		else 
		{
			if ($x == $selected && $selected != "") print "<option value='$x' selected>:$x</option>";
			else print "<option value='$x'>:$x</option>";
		}
	}
	print "</select>";
}

function calendar_ampm ($selected)
{
	print "<select class='form' name='ampm' id='ampm'>";

	if ($selected == "am") 
	{
		print "<option value='am' selected>am</option>";
		print "<option value='pm'>pm</option>";
	}
	else 
	{
		print "<option value='am'>am</option>";
		print "<option value='pm' selected>pm</option>";
	}
	
	print "</select>";
}

function getPostParams ()
{	
	$queryString = 'eventTitle='.urlencode(stripslashes(urldecode($_POST['eventTitle'])));
	$queryString = $queryString.'&pMonth='.$_POST['pMonth'];
	$queryString = $queryString.'&pDay='.$_POST['pDay'];
	$queryString = $queryString.'&pYear='.$_POST['pYear'];
	$queryString = $queryString.'&hour='.$_POST['hour'];
	$queryString = $queryString.'&minute='.$_POST['minute'];
	$queryString = $queryString.'&ampm='.$_POST['ampm'];
	$queryString = $queryString.'&name='.$_POST['name'];
	$queryString = $queryString.'&flyer='.$_POST['flyer'];
	$queryString = $queryString.'&guestlist='.urlencode($_POST['guestlist']);
	$queryString = $queryString.'&message='.urlencode(stripslashes(urldecode($_POST['message'])));
	$queryString = $queryString.'&venueName='.urlencode(stripslashes(urldecode($_POST['venueName'])));
	$queryString = $queryString.'&address='.$_POST['address'];
	$queryString = $queryString.'&email='.$_POST['email'];
	$queryString = $queryString.'&city='.$_POST['city'];
	$queryString = $queryString.'&password='.$_POST['password'];		

	return $queryString;
}

function printMapLink($eventDetails,$display)
{
	if ($display) return $eventDetails['address'].'<br>'.dbFindCity($eventDetails['cityId']).', '.dbFindState($eventDetails['cityId']);
	else return $eventDetails['address'].', '.dbFindCity($eventDetails['cityId']).', '.dbFindState($eventDetails['cityId']);	
}

function sendMail ($subject, $message)
{
	$to = 'artemk@gmail.com';
	//$headers = 'From: webmaster@example.com' . "\r\n";
	$headers = "From: GZP Visitor <info@globalzona.com>\n";
	return mail($to, $subject, $message, $headers);
}

function confirmIdentity ($eventId, $email, $password)
{
	
	$query = "SELECT hostEmail, hostPassword FROM event WHERE id=$eventId";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) echo "Unable to confirm identity.";
	else
	{
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		$results = mysql_fetch_array($result);

		if ($results['hostEmail'] == $email && $results['hostPassword'] == $password) return true;
		else return false;
	}
}

function IsValidImageURL ($imageURL)
{
	$validImgType = array('.jpg','.gif','.jpeg');

	for($i = 0; $i < count($validImgType); $i++)
		if (strpos($imageURL,$validImgType[$i])) 
			return true;

	return false;
}

function eventSubmitValidated ()	//validate user input for event submittion
{
	$errors = "";
	
	if ($_POST['flyer'] != "" && !IsValidImageURL($_POST['flyer'])) $errors = $errors."<li>The flyer image url is invalid (must be *.jpg, *.jpeg, or *.gif)</li>";
	
	if ($_POST['eventTitle'] == "") $errors = $errors."<li>Event title is blank</li>";
	
	if ($_POST['message'] == "") $errors = $errors."<li>Detailed message is blank</li>";

	if ($_POST['venueName'] == "") $errors = $errors."<li>Venue name is blank</li>";	

	if ($_POST['address'] == "") $errors = $errors."<li>Street address is blank</li>";	

	if ($_POST['name'] == "") $errors = $errors."<li>Host name is blank</li>";	
	//else if (!ctype_alpha($_POST['name'])) $errors = $errors."<li>Host name has invalid characters</li>";		

	if ($_POST['email'] == "") $errors = $errors."<li>Host email is blank</li>";	
	else if (!is_valid_email($_POST['email'])) $errors = $errors."<li>Host email is invalid</li>";		

	if ($_POST['password'] == "") $errors = $errors."<li>Password is blank</li>";	
	
	if ($errors == "") return true;
	else
	{
		echo "<tr class='nav'><td bgcolor='red' colspan='2' align='center'>The following fields are either blank or invalid";
		echo "<table width='100%' cellpadding='2' cellspacing='1' border='0'  bgcolor='#444444'><tr><td>&nbsp;&nbsp;&nbsp;</td><td class='text'><ul>";
		echo $errors;	
		echo "</ul></td></tr></table></td></tr>";
		return false;
	}
}

function is_valid_email($email) //validate email
{
  $result = true;
  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) $result = false;
  return $result;
}

function sendDetailedMail ($subject, $fromName, $fromEmail, $message)
{
	$to      = 'artemk@gmail.com';
	$headers = "From: ".$fromName." <".$fromEmail.">\n";

	return mail($to, $subject, $message, $headers);
}

function recordAffiliate ($affiliateBannerId, $type)	//record showing or clicking of banner
{
	$query = "INSERT into displayClickLog (affiliateBannerId,type) values (";
	$query = $query.$affiliateBannerId.",'".$type."')";

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
		$query = "SELECT * from affiliateBanner where id = ".$affiliateBannerId;
		$results = mysql_query($query);	//get current totals for shows and clicks for this banner
		$results = mysql_fetch_array($results);

		if($type == "click")	//update the total numbers a banner has been clicked
		{
			$newTotalClicked = $results['totalClicked'] + 1;
			$query = "UPDATE affiliateBanner set totalClicked = ".$newTotalClicked." where id = ".$affiliateBannerId;
		}
		else if($type == "show")	//update the total numbers a banner has been displayed
		{
			$newTotalDisplayed = $results['totalDisplayed'] + 1;
			$query = "UPDATE affiliateBanner set totalDisplayed = ".$newTotalDisplayed." where id = ".$affiliateBannerId;
		}
		mysql_query($query);
		mysql_close();
		return true;	
	}	
}

function displayAffiliate ()	//display rotation banner
{
	$query = "SELECT * FROM affiliateBanner WHERE current_date() > startCampaign AND (totalClicked/datediff(current_date(),startCampaign)) < maxDailyClickAvg AND IsActive = 1";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");

	if(!mysql_query($query)) 
	{
		echo "Can't get banner.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);		
		$selectBanner = rand(0,$num-1); //randomly select a banner to display

		//for ( $i = 0; $i < $num; ++$i ) echo $results[$i]['id']."(".$results[$i]['totalClicked']." out of ".$results[$i]['maxDailyClickAvg'].")-";		
		//echo "<br>Selected Banner: ".($selectBanner+1)." out of ".$num."<br>";

		echo "<div align='center'><a href='http://www.globalzona.com/party/affiliate/processAffiliate.php";
		echo "?affiliateBannerId=".$results[$selectBanner]['id'];
		echo "&affiliateClickURL=".$results[$selectBanner]['clickURL']."'>";
		echo "<img src='".$results[$selectBanner]['imgURL']."' border='0'>";
		echo "</a></div>";
	}
	recordAffiliate($results[$selectBanner]['id'],'show');	//record the displayed banner
}

function dbFindAffiliateBanner($index)
{	
	$query = "SELECT * from affiliateBanner WHERE id=$index";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) 
	{
		echo "Can't find banner.";
		mysql_close();
	}
	else
	{
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		$results = mysql_fetch_array($result);		
		return $results;
	}
}

function displayPhoto ()	//display rotation banner
{
	$query = "SELECT * FROM photo";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");

	if(!mysql_query($query)) 
	{
		echo "Can't get photo.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);		
		$selectPhoto = rand(0,$num-1); //randomly select a banner to display
		
		echo "<img class='imgBorder' src='".$results[$selectPhoto]['location']."' style=\"width: 209px;\">";
	}
}

function recordGuestList ($firstname, $lastname, $email, $eventId)
{
	if ($eventId != '')	//from eventDetails.php
	{
		$query = "INSERT into userList (fname,lname,email,eventId) values (";
		$query = $query."'".$firstname."','".$lastname."','".$email."',".$eventId.")";
	}
	else	//from side bar
	{
		$query = "INSERT into userList (fname,lname,email) values (";
		$query = $query."'".$firstname."','".$lastname."','".$email."')";
	}

	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		mysql_close();
		return false;
	}
	else return true;
}

function printBlankMessage ($message)
{
	echo "<table cellpadding='0' cellspacing='8' border='0' width='100%'>";
	echo "	<tr><td valign='middle'>";
	echo "		<div style='width: 100%; height: 140px'>".$message."</div>";	
	echo	"</td></tr>";
	echo "</table>";
}

function dbGetAssociate()
{	
	$query = "SELECT * FROM associate WHERE IsActive=1 ORDER BY name";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get associate information.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);			
		
//		echo "<div id='TopAssociates' style='display: none;'>";
		echo "<table width='100%' border=0 cellpadding=0 cellspacing=0>";
		for ($i = 0; $i < $num; ++$i)
		{
			echo "<tr class='text'><td>&nbsp;&nbsp;&nbsp;";
			echo "<a href='http://www.globalzona.com/party/associate/processAssociate.php?";
			echo "associateId=".$results[$i]['id']."&associateURL=".$results[$i]['url']."'>";
			echo $results[$i]['name']."</a></td>";
			echo "<td align='right'>[".$results[$i]['type']."]&nbsp;&nbsp;&nbsp;</td></tr>";
		}			
		echo "</table>";
//		echo "</div>";
	}
}

function recordAssociate ($associateId)
{
	$query = "INSERT into associateClickLog (associateId) values (";
	$query = $query.$associateId.")";

	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		mysql_close();
		return false;
	}
	else return true;
}

function dbGetAssociateLog()	//print out associates and number of clicks
{	
	$query = "SELECT count(*) as clicks, a.name FROM associateClickLog aCL, associate a ";
	$query = $query."WHERE a.Id = aCL.associateId GROUP BY a.name ORDER BY name";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get associate information.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);
		for ($i = 0; $i < $num; ++$i) echo $results[$i]['name'].": ".$results[$i]['clicks']."<br>";
	}
}

function dbGetAssociateAdmin($id, $password, $date)	//print out associates and number of clicks
{	
	if ($date == "")
	{
		$query = "SELECT count(*) as clicks, a.name FROM associateClickLog aCL, associate a ";
		$query = $query."WHERE a.Id = aCL.associateId ";
		$query = $query."AND a.Id = ".$id." GROUP BY a.name ORDER BY name";
	}
	else
	{
		$query = "SELECT count(*) as clicks FROM associateClickLog ";
		$query = $query."WHERE associateId = ".$id." ";
		$query = $query."AND submitted >= '".$date." 00:00:00' ";
		$query = $query."AND submitted <= '".$date." 23:59:59'";
		$query = $query." GROUP BY associateId";
	}
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get associate information.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);
		if ($date == "")
		{
			for ($i = 0; $i < $num; ++$i)
			{
				echo "<table width='100%' border=0 cellpadding=0 cellspacing=0>";
				echo "<tr><td align='right' class='nav'>";
				echo "Associate:&nbsp;</td><td class='text'>".$results[$i]['name'];
				echo "</td></tr>";
				echo "<tr><td align='right' class='nav'>";
				echo "Lifetime Clicks:&nbsp;</td><td class='text'>".$results[$i]['clicks']."<br>";
				echo "</td></tr>";
				echo "</table>";
			}
		}
		else
		{
			if ($results[0]['clicks'] == "") echo 0;
			else echo $results[0]['clicks'];
		}
	}
}

function dbGetActiveVideos ()
{
	$query = "SELECT * ";
	$query = $query."FROM video ";
	$query = $query."WHERE IsActive=1 ";
	$query = $query." ORDER BY artist";
	$db = new DB_Connect();

	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");

	if(!mysql_query($query)) 
	{
		echo "Can't get videos.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);

		$artist = array();		
		$title = array();
		$imgURL = array();
		$id = array();

		for ($i = 0; $i < $num; ++$i) $artist[$i] = $results[$i]['artist'];
		for ($i = 0; $i < $num; ++$i) $title[$i] = $results[$i]['title'];
		for ($i = 0; $i < $num; ++$i) $imgURL[$i] = $results[$i]['imgURL'];
		for ($i = 0; $i < $num; ++$i) $id[$i] = urldecode($results[$i]['id']);

		printVideos($artist,$title,$imgURL,$id);
	}
}

function dbGetActiveVideosByArtist ($artistId)
{
	$query = "SELECT * ";
	$query = $query."FROM video ";
	$query = $query."WHERE IsActive=1 AND artistId=".$artistId;
	$query = $query." ORDER BY artist";
	$db = new DB_Connect();

	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");

	if(!mysql_query($query)) 
	{
		echo "Can't get videos.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);

		$artist = array();		
		$title = array();
		$imgURL = array();
		$id = array();

		for ($i = 0; $i < $num; ++$i) $artist[$i] = $results[$i]['artist'];
		for ($i = 0; $i < $num; ++$i) $title[$i] = $results[$i]['title'];
		for ($i = 0; $i < $num; ++$i) $imgURL[$i] = $results[$i]['imgURL'];
		for ($i = 0; $i < $num; ++$i) $id[$i] = urldecode($results[$i]['id']);

		printVideos($artist,$title,$imgURL,$id);
	}
}

function dbGetArtists ()
{
	$query = "SELECT * ";
	$query = $query."FROM artist ";
	$query = $query." ORDER BY name";
	$db = new DB_Connect();

	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");

	if(!mysql_query($query)) 
	{
		echo "Can't get artist.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);

		$name = array();		
		$id = array();

		for ($i = 0; $i < $num; ++$i) $name[$i] = $results[$i]['name'];
		for ($i = 0; $i < $num; ++$i) $id[$i] = urldecode($results[$i]['id']);

		printArtist($name,$id,$num);
	}
}

function printArtist($artistName, $artistId, $count)
{
	$artistNamePrev = '';
	echo "<table width='100%' cellpadding=0 cellspacing=0 border=0>";

	for ( $i = 0; $i < $count; ++$i )
	{	
		if ($artistNamePrev != substr($artistName[$i],0,1))
		{
			if ($artistNamePrev != '') echo "	<tr bgcolor='#444444'><td class='spacer' align='center'>&nbsp;</td></tr>";
			$artistNamePrev = substr($artistName[$i],0,1);
			echo "	<tr bgcolor='#bbbbbb'><td class='nav' align='right'><font color='black'>$artistNamePrev</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
			echo "	<tr bgcolor='#444444'><td class='spacer' align='center'>&nbsp;</td></tr>";
		}
		?>
		<tr bgcolor='#444444'><td class='nav'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
			<a href="videoDetails.php?artistId=<? echo $artistId[$i]; ?>"><? echo $artistName[$i]; ?></a>
		</td></tr>
<?	}
	echo "	<tr bgcolor='#444444'><td class='spacer' align='center'>&nbsp;</td></tr>";
	echo "</table>";
}

function printVideos($artist, $title, $imgURL, $id)
{
	echo "<table width='100%' border=0 cellpadding=0 cellspacing=5><tr>";
	for ($i = 0; $i < count($id); ++$i)
	{
		if ($i%2 == 0) echo "</tr><tr>";
		echo "<td width='50%' bgcolor='#dddddd' align='center' class='spacer'>";
		echo "&nbsp;<br>&nbsp;";
		echo "<a href='videoDetails.php?videoId=".$id[$i]."'><img align='center' src='".$imgURL[$i]."' width='130' height='100' border='0'></a>";
		echo "&nbsp;<br>&nbsp;";
		echo "	<table bgcolor='#888888' width='100%' border=0 cellpadding=0 cellspacing=0><tr><td class='nav'>"; 
		//echo "		&nbsp;&nbsp;<a href='videoDetails.php?videoId=".$id[$i]."'><font color='white'><b>".$artist[$i]."</b></font></a><br>";
		echo "		&nbsp;&nbsp;<a href='videoDetails.php?videoId=".$id[$i]."'><font color='white'>".$title[$i]."</font></a>";
		echo "	</td></tr></table>";
		echo "<div style='background-color: #888888;' class='spacer' align='center'>&nbsp;<br>&nbsp;</div>";
		echo"</td>";
	}
	echo "</tr></table>";
}

function GetVideoCount ()
{
	$query = "SELECT count(*) as videoCount FROM video";
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");

	if(!mysql_query($query)) 
	{
		echo "Can't get video count.";
		mysql_close();
	}
	else
	{
		$result = mysql_query($query);
		mysql_close();

		$results = mysql_fetch_array($result);
		return $results['videoCount'];
	}
}

function displayRandomVideo ()	//display random video
{
	$selectVideo = rand(1,GetVideoCount()); //randomly select a video to display
	$results=dbFindVideo($selectVideo);
	echo "<table border=0 cellpadding='5' cellspacing=0>";
	echo "<tr><td valign='top'>";
	echo "<a href='videoDetails.php?videoId=".$results['id']."' class='textSmall'><b>".$results['name']."</b><br>".$results['title']."</a>";
	echo "</td><td rowspan='2'>";
	echo "<a href='videoDetails.php?videoId=".$results['id']."'>";
	echo "<img src='".$results['imgURL']."' width='75' height='55' border='0' alt='".$results['name']." - ".$results['title']."'>";
	echo "</a>";
	echo "</td></tr>";
	echo "<tr><td valign='bottom'><a href='videoDetails.php?videoId=".$results['id']."' class='textSmall'><font color='red'><u>Watch&nbsp;It&nbsp;Now!</u></font></a></td></tr>";
	echo "</table>";
}

function NewsUpdate()
{
	$recentAlbum = dbFindMostRecentAlbum();
	echo " <a href='http://www.globalzona.com/party/photo.php?cityId=".$recentAlbum['eventCityId']."'>".$recentAlbum['eventTitle']." (".date("F j, Y", strtotime($recentAlbum['eventDate'])).") photo album</a> added.";
}

/*TEST*/


function dbGetCityTest($type, $selected)
{	
	if ($type == 'nav')	$query = "SELECT c.id, c.name, c.state FROM city c, event e WHERE c.id = e.cityId AND (e.date >= '".date('Y-m-d 00:00:00', time())."' OR e.IsActive=1) group by c.name, c.id, c.state";
	else if ($type == 'dropDown')	$query = "SELECT * FROM city ORDER BY name";
	else if ($type == 'venue')	$query = "SELECT c.id, c.name, c.state, ct.name as countryName FROM city c, venue v, country ct WHERE c.countryId=ct.id AND c.id=v.cityId group by c.name, c.id, c.state ORDER BY name";
	else if ($type == 'album')	$query = "SELECT c.id, c.name, c.state FROM city c, photoAlbum p WHERE c.id=p.eventCityId group by c.name, c.id, c.state ORDER BY name";

	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query))
	{
		echo "Can't get city information.";
		mysql_close();
	}
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
					
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);
		
		if ($type == 'nav') for ( $i = 0; $i < $num; ++$i ) nav_city_test($results[$i]['name'].', '.$results[$i]['state'],'calendar.php?cityId='.$results[$i]['id'], $results[$i]['id']);
		else if ($type == 'dropDown')
		{
			$optionName = array();
			$optionValue = array();
			for ($i = 0; $i < $num; ++$i) $optionName[$i] = $results[$i]['name'].', '.$results[$i]['state'];
			for ($i = 0; $i < $num; ++$i) $optionValue[$i] = $results[$i]['id'];

			printDropDown("city","class='form' id='citySubmit'",$optionName,$optionValue,$selected);
		}
		else if ($type == 'venue')
		{	
			$cityNamePrev = '';
			echo "<table width='100%' cellpadding=0 cellspacing=0 border=0>";
			echo "	<tr bgcolor='#555555'><td class='nav' align='center'>Please select a city below</td></tr>";
			for ( $i = 0; $i < $num; ++$i )
			{	
				if ($cityNamePrev != substr($results[$i]['name'],0,1))
				{
					if ($cityNamePrev != '') echo "	<tr bgcolor='#444444'><td class='spacer' align='center'>&nbsp;</td></tr>";
					$cityNamePrev = substr($results[$i]['name'],0,1);
					echo "	<tr bgcolor='#bbbbbb'><td class='nav' align='right'><font color='black'>$cityNamePrev</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
					echo "	<tr bgcolor='#444444'><td class='spacer' align='center'>&nbsp;</td></tr>";
				}
				?>
				<tr bgcolor='#444444'><td class='nav'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
					<a href="venueDirectory.php?cityId=<? echo $results[$i]['id']; ?>">
						<?	echo $results[$i]['name'].", ";
					
							if ($results[$i]['countryName'] != "" && $results[$i]['countryName'] != "USA") echo $results[$i]['countryName'];
							else echo $results[$i]['state'];
						?>
					</a>
				</td></tr>
		<?	}
			echo "	<tr bgcolor='#444444'><td class='spacer' align='center'>&nbsp;</td></tr>";
			echo "</table>";
		}
		else if ($type == 'album')
		{	
			$cityNamePrev = '';
			echo "<table width='100%' cellpadding=0 cellspacing=0 border=0>";
			echo "	<tr bgcolor='#555555'><td class='nav' align='center'>Please select a city below</td></tr>";
			for ( $i = 0; $i < $num; ++$i )
			{	
				if ($cityNamePrev != substr($results[$i]['name'],0,1))
				{
					if ($cityNamePrev != '') echo "	<tr bgcolor='#444444'><td class='spacer' align='center'>&nbsp;</td></tr>";
					$cityNamePrev = substr($results[$i]['name'],0,1);
					echo "	<tr bgcolor='#bbbbbb'><td class='nav' align='right'><font color='black'>$cityNamePrev</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
					echo "	<tr bgcolor='#444444'><td class='spacer' align='center'>&nbsp;</td></tr>";
				}
				?>
				<tr bgcolor='#444444'><td class='nav'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
					<a href="photo.php?cityId=<? echo $results[$i]['id']; ?>"><? echo $results[$i]['name'].", ".$results[$i]['state']; ?></a>
				</td></tr>
		<?	}
			echo "	<tr bgcolor='#444444'><td class='spacer' align='center'>&nbsp;</td></tr>";
			echo "</table>";
		}
	}
}

function nav_city_test ($city, $link, $cityId)
{
	echo "<tr><td id='$city' bgcolor='#";
	if ($_GET['cityId'] == $cityId) echo "888888'>";
	else echo "333333'>";
	echo "<div onMouseOver=\"document.getElementById('navCityDetails".$cityId."').style.display = 'block';MM_changeProp('$city','','style.backgroundColor','#222222','DIV'); expandForCityInfo('SearchByCity');\" onMouseOut=\"collapseForCityInfo('SearchByCity');document.getElementById('navCityDetails".$cityId."').style.display = 'none';MM_changeProp('$city','','style.backgroundColor','#";
	if ($_GET['cityId'] == $cityId) echo "888888','DIV')\"> ";
	else echo "333333','DIV')\"> ";
	echo "<a href='#' onClick=\"return false;\"  class='nav' >&nbsp;&nbsp;&nbsp;$city</a> ";
	nav_city_details_test ($cityId);
	echo "</div>";
	echo "</td></tr>";
}

function nav_city_details_test ($cityId)
{
	echo "<div id='navCityDetails".$cityId."' style=\"display: none\">";
	echo "<table cellpadding=5 cellspacing=0 border=0 width='100%' bgcolor='#444444'";
	echo "	<tr>";
	echo "		<td class='textSmall'>";
	echo "			&nbsp;&nbsp;&nbsp;<a href='calendar.php?cityId=".$cityId."'>Calendar</a>";
	if (cityHasVenues($cityId)) echo "			&nbsp;<font color='#dddddd'>|</font>&nbsp;&nbsp;<a href='venueDirectory.php?cityId=".$cityId."'>Clubs/Bars</a>";
	if (cityHasPhotos($cityId)) echo "			&nbsp;<font color='#dddddd'>|</font>&nbsp;&nbsp;<a href='photo.php?cityId=".$cityId."'>Photos</a>";
	echo "		</td>";
	echo "	</tr>";
	echo "</table>";
	echo "</div>";
}

function randomPassword ()
{
	// *************************
	// Random Password Generator
	// *************************
	$totalChar = 7; // number of chars in the password
	$salt = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";  // salt to select chars from
	srand((double)microtime()*1000000); // start the random generator
	$password=""; // set the inital variable
	for ($i=0;$i<$totalChar;$i++)  // loop and create password
				$password = $password . substr ($salt, rand() % strlen($salt), 1);
	// *************************
	// Display Password
	// *************************
	echo "password is " . $password;
}

function AdExample($width, $height)
{
	echo "<div class='textBig' style='width: ".$width."px; height: ".$height."; background-color: #666666; text-align: center; border: 1px solid #bbbbbb'>".$width." x ".$height."</div>";
}

function IsValidId ($id)
{
	if(check_int($id) == 1 && $id > 0)
		return true;
	else
		return false;
}
?>
