<?
	include("../classes/database.class.php");	
	include("../classes/data.class.php");
	
	$top10BadCars = Data::GetTopBadCars(10);
	
	echo "<div class='subtitle'><a id='link_check_in' href='#'>Check-in with car trouble</a> | The Log</div>";
	echo "<div class='subtitle_log'>";
	echo "	Top 10 Problematic Cars";
	echo "</div>";
	
	echo "<table id='log_table' cellpadding='0' cellspacing='0' border='0'>";
	
	for($x = 0; $x < count($top10BadCars); $x++)
	{
		echo "	<tr>";
		echo "		<td>".($x + 1).".</td>";
		echo "		<td>".$top10BadCars[$x]['year']." ".$top10BadCars[$x]['make']." ".$top10BadCars[$x]['model']."</td>";
		echo "	</tr>";
	}

	echo "</table>";
?>