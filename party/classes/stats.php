<?
	class Stats
	{
		var $IPAddress;
		var $URL;
		var $QueryString;
		var $Referer;
		var $BrowserInfo;

		var $AllUniqueVisitors;
		var $DateResult = array();
		var $IPCount = array();
		var $AllPagesViewed = array();
		var $AllPageViewsCount = array();
		var $AllReferers = array();
		var $AllReferersCount = array();

		var $AllRefererGroupedArray = array();
		var $AllRefererBoolArray = array();

		function Stats ()
		{
			$this->IPAddress = $_SERVER['REMOTE_ADDR'];
			$this->URL = "http://www.globalzona.com".$_SERVER['PHP_SELF'];
			$this->QueryString = $_SERVER['QUERY_STRING'];
			$this->Referer = $_SERVER['HTTP_REFERER'];
			$this->BrowserInfo = $_SERVER['HTTP_USER_AGENT'];
		}

		function RecordVisitor ()
		{
			$query = "INSERT INTO visitor (ipAddress,url,queryString,referer,browserInfo) values ";
			$query = $query."('".$this->IPAddress."','".$this->URL."','".$this->QueryString."','".$this->Referer."','".$this->BrowserInfo."')";
			$db = new Database($query);
			$db->ExecuteQuery($query);
		}

		function SetAllUniqueVisitors ()
		{
			$query = "SELECT count(DISTINCT ipAddress) as countUnique ";
			$query = $query."FROM visitor ";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				$results = mysql_fetch_array($result);	
				
				$this->AllUniqueVisitors = $results['countUnique'];
				return true;
			}
			else echo "SetAllUniqueVisitors Failed";
			return false;
		}

		function SetUniqueVisitorsByDay ()
		{
			$query = "SELECT DATE(timestamp) as countDate, count(distinct ipAddress) as countIP ";
			$query = $query."FROM visitor GROUP BY date(timestamp)";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				$results = array();
				for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);	
				for ( $i = 0; $i < $num; ++$i ) $this->DateResult[$i] = $results[$i]['countDate'];
				for ( $i = 0; $i < $num; ++$i ) $this->IPCount[$i] = $results[$i]['countIP'];
				return true;
			}
			else echo "SetUniqueVisitorsByDay Failed";
			return false;
		}

		function SetAllPageViews ()
		{
			$query = "SELECT url, COUNT(url) as countURL FROM visitor GROUP BY url ORDER BY COUNT(url) DESC";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				$results = array();
				for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);	
				for ( $i = 0; $i < $num; ++$i ) $this->AllPageViewsCount[$i] = $results[$i]['countURL'];
				for ( $i = 0; $i < $num; ++$i ) $this->AllPagesViewed[$i] = $results[$i]['url'];
				return true;
			}
			else echo "SetAllPageViews Failed";
			return false;
		}

		function SetAllReferers ()
		{
			$query = "SELECT referer, COUNT(referer) as countReferer FROM visitor WHERE referer not like '%globalzona%' and referer <> '' GROUP BY referer ORDER BY referer";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				$results = array();
				for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);	
				for ( $i = 0; $i < $num; ++$i ) $this->AllReferers[$i] = $results[$i]['referer'];
				for ( $i = 0; $i < $num; ++$i ) $this->AllReferersCount[$i] = $results[$i]['countReferer'];
				return true;
			}
			else echo "SetAllReferer Failed";
			return false;
		}

		function PrintDateIPCount ()
		{
			$monthCount = 0;
			$curMonth = date("n", strtotime($this->DateResult[0]));
			$prevMonth = 0;

			echo "<center><table width='95%' cellpadding='1' cellspacing='0' border='0'>";
			for ( $i = 0; $i < count($this->DateResult); $i++)
			{
				if ($i != 0)
				{
					$prevMonth = $curMonth;
					$curMonth = date("n", strtotime($this->DateResult[$i]));
				}

				if ($curMonth != $prevMonth)
				{
					if ($i != 0) $this->PrintMonthTotal ($monthCount);
					$monthCount = 0;
					echo "<tr><td colspan='3'><hr noshade size=1 color='#bbbbbb'><b>".date("F Y", strtotime($this->DateResult[$i]))."</b><hr noshade size=1 color='#bbbbbb'></td></tr>";
				}
				$monthCount = $monthCount + $this->IPCount[$i];
				echo "<tr><td width='25%'>".date("l", strtotime($this->DateResult[$i]))."</td><td width='50%'>".date("F j, Y", strtotime($this->DateResult[$i]))."</td><td align='right' width='25%'>".$this->IPCount[$i]. "</td></tr>";
				
				if ($i + 1 == count($this->DateResult)) $this->PrintMonthTotal ($monthCount);
			}
			echo "</table></center>";
		}

		function PrintAllUniqueVisitors ()
		{
			echo "<center>".$this->AllUniqueVisitors." visitors.</center>";
		}

		function PrintMonthTotal ($monthCount)
		{
			echo "<tr><td colspan='3' align='right'><hr noshade size=1 color='#bbbbbb'><b>".$monthCount."</b></td></tr>";
		}

		function PrintAllPageViewCountsByPage ()
		{
			echo "<center><table width='95%' cellpadding='1' cellspacing='0' border='0'>";
			for ( $i = 0; $i < count($this->AllPagesViewed); $i++)
			{
				echo "<tr><td>".$this->AllPagesViewed[$i]."</td><td>".$this->AllPageViewsCount[$i]."</td></tr>";
			}
			echo "</table></center>";
		}

		function PrintAllReferersCountByReferer ()
		{
			$this->SetAllRefererGroupedArray();
			echo "<center><table width='95%' cellpadding='1' cellspacing='0' border='0'>";
			for ( $i = 0; $i < count($this->AllReferers); $i++)
			{
				if ($this->AllRefererBoolArray[$this->parse_url_domain($this->AllReferers[$i])] != true)
				{
					echo "<tr><td>".$this->parse_url_domain($this->AllReferers[$i])."</td><td>".$this->AllRefererGroupedArray[$this->parse_url_domain($this->AllReferers[$i])]."</td></tr>";
					$this->AllRefererBoolArray[$this->parse_url_domain($this->AllReferers[$i])] = true;
				}
			}
			echo "</table></center>";
		}

		function parse_url_domain ($url) 
		{
			if ($url[strlen($url)-1] == "/") 
			{
				$url = substr($url, 0, -1);
			}

			$raw_url= parse_url($url);
			preg_match ("/\.([^\/]+)/", $raw_url['host'], $domain_only);
			return strtolower($domain_only[1]);
		} 

		function SetAllRefererGroupedArray ()
		{
			for ($i = 0; $i < count($this->AllReferers); $i++)
				$this->AllRefererGroupedArray[$this->parse_url_domain($this->AllReferers[$i])] += $this->AllReferersCount[$i];

			//print_r($this->AllRefererGroupedArray);
		}
	}
?>