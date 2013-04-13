<?
	$counter = 0;

	echo "<table width='100%'>";
	echo "	<tr>";	
	foreach($cities as $city)
	{

		if($counter % 4 == 0)
		{
			echo '</tr><tr>';
		}
		
		echo "		<td>";
		echo "			<div>";
		echo				$html->link(urldecode($city['City']['name']).', '.urldecode($city['City']['state']), '/cities/view/'.$city['City']['id']);
		echo "			</div>";
		echo "		</td>";

		$counter++;
	}

	echo "	</tr>";		
	echo "</table>";
?>