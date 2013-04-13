<?
class DB_Connect_AJAX {
	var $localhost="mysqldb";
	var $username="artem_k";
	var $password="Kiev-1982";
	var $database="party";
}

function dbGetAssociateAdminAjax($id, $password, $date)	//print out associates and number of clicks
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
	$db = new DB_Connect_AJAX();
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
?>

<table align='center' width='95%' border=0 cellpadding=1 cellspacing=1>
	<tr class='nav' bgcolor='#bbbbbb'>
		<td width='70%' valign='top' align='center'><font color=black>Date</font></td>
		<td width='30%' bgcolor='#aaaaaa' align='center'>Clicks</td>
	</tr>
	<tr class='text' bgcolor='#bbbbbb'>
		<td valign='top' align='center'>
			<font color=black>
			<?
				$Day = $_GET['pYear'].'-'.$_GET['pMonth'].'-'.$_GET['pDay'];								
				echo $_GET['pMonth'].'-'.$_GET['pDay'].'-'.$_GET['pYear'];
				echo "</td><td bgcolor='#aaaaaa' align='center'>";
				dbGetAssociateAdminAjax($_GET['associateId'],'',$Day);
			?>
			</font>
		</td>
	</tr>
</table>
