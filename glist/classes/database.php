<?
class Database {
	/*
	var $localhost="localhost";
	var $username="ykogan";
	var $password="5ka9qKka";
	var $database="addictionsf";
	*/
	var $localhost="localhost";
	var $username="artemk";
	var $password="gz5p@ss";
	var $database="party";

	function Database ()
	{
		mysql_connect($this->localhost,$this->username,$this->password);
		@mysql_select_db($this->database) or die( "Unable to select database");
	}

	function ExecuteQuery ($iQuery, $autoClose)
	{
		if(!$result=mysql_query($iQuery)) 
		{
			echo "Can't execute query.";
			mysql_close();
			return -1;
		}
		else
		{
			if($autoClose)
			{
				mysql_close();
			}
			return $result;
		}
	}
}
?>