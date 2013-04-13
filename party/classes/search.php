<?
	class Search
	{
		var $searchString;
		var $searchEventResults = array();
		var $searchVenueResults = array();

		function Search ($searchString)
		{
			$this->searchString = $searchString;
		}

		function SearchEvents ()
		{
			$query = "SELECT event.eventTitle as eventTitle, event.id, city.name as cityName, city.state as stateCode, event.flyerURL as ImgURL FROM event ";
			$query = $query."INNER JOIN city on event.cityId = city.Id ";
			$query = $query."WHERE (date > NOW() OR IsActive = 1) AND ";
			//$query = $query."(city.name like '%".$this->searchString."%' OR eventTitle like '%".$this->searchString."%' OR message like '%".$this->searchString."%') ";
			$query = $query."(".$this->BuildEventSearchQuery().") ";
			
			$query = $query."ORDER  BY date";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $this->searchEventResults[$i] = mysql_fetch_array($result);
				return true;

			}
			else echo "SearchEvents Failed";

			return false;
		}

		function SearchVenues ()
		{
			$query = "SELECT venue.name as name, venue.id, city.name as cityName, city.state as stateCode, venue.imgURL as ImgURL FROM venue ";
			$query = $query."INNER JOIN city on venue.cityId = city.Id ";
			$query = $query."WHERE venue.name like '%".$this->searchString."%' OR city.name like '%".$this->searchString."%' ";
			$query = $query."ORDER  BY venue.name";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $this->searchVenueResults[$i] = mysql_fetch_array($result);
				return true;

			}
			else echo "SearchVenues Failed";

			return false;
		}

		function PrintSearchEventResults ()
		{
			$JSONCode = "{\"ResultSet\":";
			$JSONCode = $JSONCode."{	\"totalResultsAvailable\":\"22000000\",";
			$JSONCode = $JSONCode."\"totalResultsReturned\":25,";
			$JSONCode = $JSONCode."\"firstResultPosition\":1,";
			$JSONCode = $JSONCode."\"Result\": [";

			for($x = 0; $x < count($this->searchEventResults); $x++)
			{
				$JSONCode = $JSONCode."{\"Title\":\"".urlDecode($this->searchEventResults[$x]['eventTitle'])."\",";
				$JSONCode = $JSONCode."\"Summary\":\"none\",";
				$JSONCode = $JSONCode."\"Url\":\"http:\/\/www.globalzona.com\/party\/eventDetails.php?eventId=".$this->searchEventResults[$x]['id']."\",";
				$JSONCode = $JSONCode."\"CityName\":\"".urlDecode($this->searchEventResults[$x]['cityName'])."\",";
				$JSONCode = $JSONCode."\"StateCode\":\"".urlDecode($this->searchEventResults[$x]['stateCode'])."\",";

				if ($this->searchEventResults[$x]['ImgURL'] != "")	
					$JSONCode = $JSONCode."\"ImgURL\":\"".$this->searchEventResults[$x]['ImgURL']."\",";
				else
					$JSONCode = $JSONCode."\"ImgURL\":\"http://www.globalzona.com/party/images/no_flyer.jpg\",";				

				$JSONCode = $JSONCode."\"ModificationDate\":1072684800,";
				$JSONCode = $JSONCode."\"MimeType\":\"text\/html\"";
				$JSONCode = $JSONCode. "}";

				if (count($this->searchEventResults) > ($x + 1))
					$JSONCode = $JSONCode.",";
			}

			$JSONCode = $JSONCode."]}";
			$JSONCode = $JSONCode."}";

			echo $JSONCode;
		}

		function PrintSearchVenueResults ()
		{
			$JSONCode = "{\"ResultSet\":";
			$JSONCode = $JSONCode."{	\"totalResultsAvailable\":\"22000000\",";
			$JSONCode = $JSONCode."\"totalResultsReturned\":25,";
			$JSONCode = $JSONCode."\"firstResultPosition\":1,";
			$JSONCode = $JSONCode."\"Result\": [";

			for($x = 0; $x < count($this->searchVenueResults); $x++)
			{
				$JSONCode = $JSONCode."{\"Title\":\"".urlDecode($this->searchVenueResults[$x]['name'])."\",";
				$JSONCode = $JSONCode."\"Url\":\"http:\/\/www.globalzona.com\/party\/venueDetails.php?venueId=".$this->searchVenueResults[$x]['id']."\",";
				$JSONCode = $JSONCode."\"CityName\":\"".urlDecode($this->searchVenueResults[$x]['cityName'])."\",";
				$JSONCode = $JSONCode."\"StateCode\":\"".urlDecode($this->searchVenueResults[$x]['stateCode'])."\",";

				if ($this->searchVenueResults[$x]['ImgURL'] != "")	
					$JSONCode = $JSONCode."\"ImgURL\":\"".$this->searchVenueResults[$x]['ImgURL']."\",";
				else
					$JSONCode = $JSONCode."\"ImgURL\":\"http://www.globalzona.com/party/images/no_flyer.jpg\",";				

				$JSONCode = $JSONCode."\"ModificationDate\":1072684800,";
				$JSONCode = $JSONCode."\"MimeType\":\"text\/html\"";
				$JSONCode = $JSONCode. "}";

				if (count($this->searchVenueResults) > ($x + 1))
					$JSONCode = $JSONCode.",";
			}

			$JSONCode = $JSONCode."]}";
			$JSONCode = $JSONCode."}";

			echo $JSONCode;
		}

		function BuildEventSearchQuery ()
		{			
			$query = "";
			$tok = strtok($this->searchString, " ");

			while ($tok !== false) 
			{
				$query = $query." city.name like '%".$tok."%' OR eventTitle like '%".$tok."%' OR message like '%".$tok."%'";
				$tok = strtok(" ");

				if ($tok !== false)
					$query = $query." OR ";

				//echo $query."<br />";
			}

			return $query;
		}
	}
?>