<?
	function dbFindCity($index)
	{	
		$query = "SELECT * FROM city WHERE id=$index";
		$db = new DB_Connect();
		mysql_connect($db->localhost,$db->username,$db->password);
		@mysql_select_db($db->database) or die( "Unable to select database");
		
		if(!mysql_query($query)) 
		{
			echo "Can't find city.";
			mysql_close();
		}
		else
		{
			//$results = array();
			$result = mysql_query($query);
			$num = mysql_numrows($result);
			mysql_close();
						
			//for ( $i = 0; $i < $num; ++$i ) 
			$results = mysql_fetch_array($result);		
			return $results['name'];
		}
	}
?>