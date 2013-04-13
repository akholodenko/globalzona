<?
	class API
	{
		//returns raw results of the input query or -1 (error)
		private static function GetData ($query)
		{
			$db = new Database();
			return $db->ExecuteQuery($query);
		}

		//returns array of objects containing data for each column queried
		private static function GetDataMatrix ($query)
		{
			$result = API::GetData($query);

			if ($result != -1)
			{
				$data = array();
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $data[$i] = mysql_fetch_array($result);
				return $data;
			}
			else echo "API::GetDataMatrix Failed";
			return false;
		}

		//returns array of objects containing data for each column queried (single row)
		private static function GetDataRow ($query)
		{
			$result = API::GetData($query);

			if ($result != -1) return mysql_fetch_array($result);
			else echo "API::GetDataRow Failed";

			return false;
		}

		//returns array of all state abbreviations
		public static function GetStates ()
		{
			return API::GetDataMatrix("SELECT state FROM city WHERE state <> '' GROUP BY state ORDER BY state");
		}

		//returns array of city id and name for input state
		public static function GetCitiesByState ($state)
		{
			return API::GetDataMatrix("SELECT id, name FROM city WHERE state = '".$state."' ORDER BY name");
		}

		//returns array of all cities
		public static function GetCities ()
		{
			return API::GetDataMatrix("SELECT c.id as city_id, c.name as city_name, state, o.id as country_id, o.name as country_name FROM city c, country o WHERE c.CountryId = o.id ORDER BY c.name");
		}

		//returns array of the next COUNT events
		public static function GetUpcomingEvents ($count)
		{
			return API::GetDataMatrix("SELECT * FROM event WHERE date > NOW() ORDER BY date LIMIT ".$count);
		}

		//return count of upcoming events (and recurring) for a specific city
		public static function GetUpcomingEventsByCityId ($city_id)
		{
			$currentDate = getdate();

			$data = API::GetDataRow("SELECT count(*) as event_count FROM event WHERE cityId = ".$city_id." AND (Date >= '".$currentDate['year']."-".$currentDate['mon']."-".$currentDate['mday']."' OR IsActive = 1)");
			return $data['event_count'];
		}
		/*
		function getCityEventCount ($cityId)
		{
			$currentDate = getdate();
			$query = "SELECT count(*) as eventCount FROM event WHERE cityId = ".$cityId." and (Date >= '".$currentDate['year']."-".$currentDate['mon']."-".$currentDate['mday']."' or IsActive = 1)";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = mysql_fetch_array($result);
				return $results['eventCount'];
			}
			else echo "getCityEventCount Failed";
			return false;
		}

		function getCityVenueCount ($cityId)
		{
			$currentDate = getdate();
			$query = "SELECT count(*) as venueCount FROM venue WHERE cityId = ".$cityId;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = mysql_fetch_array($result);
				return $results['venueCount'];
			}
			else echo "getCityVenueCount Failed";
			return false;
		}

		function getCityAlbumCount ($cityId)
		{
			$currentDate = getdate();
			$query = "SELECT count(*) as albumCount FROM photoAlbum WHERE eventCityId = ".$cityId;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = mysql_fetch_array($result);
				return $results['albumCount'];
			}
			else echo "getCityAlbumCount Failed";
			return false;
		}
		*/
	}
?>