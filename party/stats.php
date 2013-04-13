<? 
	include "utils.php"; 
	$stats = new Stats();
?>
<html>
<title>GlobalZona.com Statistics</title>
<style>
	.infoModHeader
	{
		border: 1px solid black; 
		background-color: #000000;
		color: white;
		padding: 2px;
		font-family: Tahoma;
		font-size: 12px;
		font-weight: bold;
		text-align: center;
		margin-bottom: 5px;
	}

	.infoMod
	{
		border: 1px solid black; 
		background-color: #eeeeee;
		padding: 5px;
		font-family: Tahoma;
		font-size: 12px;
		margin-bottom: 10px;
	}

	.infoMod table
	{
		font-family: Tahoma;
		font-size: 12px;
	}

</style>
<body>
	<table border='0' cellpadding='5' cellspacing='0' width='100%' align='center'>
		<tr>
			<td valign='top' width='50%'>
<? 
				echo "<div class='infoMod'>";
				echo "	<div class='infoModHeader'>All-Time Page Views By Page</div>";
						$stats->SetAllPageViews();
						$stats->PrintAllPageViewCountsByPage();
				echo "</div>";
				echo "<div class='infoMod'>";
				echo "	<div class='infoModHeader'>All-Time Referers</div>";
						$stats->SetAllReferers();
						$stats->PrintAllReferersCountByReferer();
				echo "</div>";
?>
			</td>
			<td valign='top' width='50%'>
<? 
				echo "<div class='infoMod'>";
				echo "	<div class='infoModHeader'>All-Time Unique Visitors</div>";
						$stats->SetAllUniqueVisitors();
						$stats->PrintAllUniqueVisitors();
				echo "</div>";
				echo "<div class='infoMod'>";
				echo "	<div class='infoModHeader'>Unique Visitors By Date</div>";	
						$stats->SetUniqueVisitorsByDay();
						$stats->PrintDateIPCount();
				echo "</div>";
?>
			</td>
		</tr>
	</table>
</body>
</html>