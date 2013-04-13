<?
include '../utils.php';

function recordAffiliate ($affiliateBannerId, $type)
{
	$query = "INSERT into displayClickLog (affiliateBannerId,type) values (";
	$query = $query.$affiliateBannerId.",";
	$query = $query."'".$type."'";
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
		mysql_close();
		return true;	
	}	
}
?>