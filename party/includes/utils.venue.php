<?
	function dbFindVenue($index)
	{	
		$query = "SELECT v.id, v.name, c.id as cityId, c.name as city, v.address, c.state, v.imgURL, v.text, v.website, ct.name as countryName";
		$query = $query." FROM venue v, city c, country ct WHERE c.countryId=ct.Id AND v.cityId=c.Id AND v.id=$index";

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

	function dbGetVenueName ($venueId)
	{
		$query = "SELECT name FROM venue WHERE id = ".$venueId;
		$db = new Database($query);
		$result = $db->ExecuteQuery($query);
		$num = mysql_numrows($result);
		if ($num == 1)
		{
			$results = mysql_fetch_array($result);
			return $results['name'];
		}
		else echo "dbGetVenueName Failed";
		return false;
	}

	function dbGetTopVenue($count)
	{	
		$query = "SELECT v.id, v.name, c.name as city, v.address, c.state, v.imgURL, v.text, v.website";
		$query = $query." FROM venue v, city c";
		$query = $query." where c.id=v.cityId";
		$query = $query." ORDER BY name";

		//$query = "SELECT * FROM venue ORDER BY name";
		
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
			for ( $i = 0; $i < $runLoop; ++$i ) printTopVenue($results[$i]);
		}
	}

	function dbGetTopVenueByCity($cityId)
	{	
		$query = "SELECT v.id, v.name, c.name as city, v.address, c.state, v.imgURL, v.text, v.website, ct.name as countryName";
		$query = $query." FROM venue v, city c, country ct";
		$query = $query." where c.id=v.cityId AND c.countryId=ct.id AND c.id=".$cityId;
		$query = $query." ORDER BY name";

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
						
			for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);		
			//for ( $i = 0; $i < $num; ++$i ) printTopVenueNoHighlight($results[$i]);

			$currentLetter = GetLetterPosition($results[0][name]{0});
			$venueNav = "<a style=\"text-decoration: underline\" class=\"textBig\" href=\"#\" onClick=\"showVenuePage(".$currentLetter.");return false;\">".GetLetterByPosition($currentLetter)."</a>&nbsp;&nbsp;";
			$layout = new Layout();
			$layout->bubbleTab("<span id='venueNavigation'>&nbsp;</span>", 60);
			echo "<div id='Page".$currentLetter."'>";

			$layout->bubbleSubBoxTop(100);
			
			for ( $i = 0; $i < $num; ++$i )
			{
				if (GetLetterPosition($results[$i][name]{0}) != $currentLetter && $i > 0)
				{
					$currentLetter = GetLetterPosition($results[$i][name]{0});	
					$venueNav = $venueNav."<a style=\"text-decoration: underline\" class=\"textBig\" href=\"#\" onClick=\"showVenuePage(".$currentLetter.");return false;\">".GetLetterByPosition($currentLetter)."</a>&nbsp;&nbsp;";
					$layout->bubbleSubBoxBottom();	
					echo "</div>";
					echo "<div style='display: none' id='Page".($currentLetter)."'>";
					$layout->bubbleSubBoxTop(100);
				}

				printTopVenueNoHighlight($results[$i]);
			}
			$layout->bubbleSubBoxBottom();	
			echo "</div>";
			//echo "<script>document.getElementById('cityAlphaLinkListVenues').style.visibility = 'visible'; document.getElementById('cityAlphaLinkListVenues').innerHTML = '".$venueNav."';</script>";
			echo "<script>document.getElementById('venueNavigation').innerHTML = '".$venueNav."';</script>";
		}
	}
?>