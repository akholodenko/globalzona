<?
	$counter = 0;

	echo "<table>";
	echo "	<tr>";	
	foreach($venues as $venue)
	{

		if($counter % 4 == 0)
		{
			echo '</tr><tr>';
		}
		
		/*
		echo "		<td>";
		echo			$html->image($venue['Venue']['imgURL'], array('width' => '50px', 'title' => urldecode($venue['Venue']['name'])));
		echo "		</td>";
		*/
		echo "		<td>";
		echo "			<div>";
		echo				$html->link(urldecode($venue['Venue']['name']), '/venues/view/'.$venue['Venue']['id']);
		echo "			</div>";
		echo "			<div>";
		echo				urldecode($venue['Venue']['address']).', '.urldecode($venue['City']['name']).', '.urldecode($venue['City']['state']);
		echo "			</div>";
		echo "		</td>";

		$counter++;
	}

	echo "	</tr>";		
	echo "</table>";
?>