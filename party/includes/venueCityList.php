<?
	$layout = new Layout();
	$cityNamePrev = '';

	$layout->bubbleSubBoxTop(100);

	echo "<table width='100%' cellpadding=1 cellspacing=0 border=0>";
	for ( $i = 0; $i < $num; ++$i )
	{	
		if ($cityNamePrev != substr($results[$i]['name'],0,1))
		{
			if ($cityNamePrev != '') 
			{
				echo "</table>";
				$layout->bubbleSubBoxBottom();
				$layout->bubbleBoxSpacer();
				$layout->bubbleSubBoxTop(100);
				echo "<table width='100%' cellpadding=1 cellspacing=0 border=0>";
			}
			$cityNamePrev = substr($results[$i]['name'],0,1);
			echo "	<tr bgcolor='#bbbbbb' class='nav'><td colspan='2' class='lightGradient' align='right'><a name='cityAlpha".$cityNamePrev."'>&nbsp;</a>$cityNamePrev&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
			echo "	<tr><td colspan='2' class='spacer' align='center'>&nbsp;</td></tr>";
		}
		?>
		<tr>
			<td class='navTall' width='30%' valign='center' align='center'>			
				<?	
					echo $results[$i]['name'].", ";
			
					if ($results[$i]['countryName'] != "" && $results[$i]['countryName'] != "USA") echo $results[$i]['countryName'];
					else echo $results[$i]['state'];
				?>
				<div>
					<a href="venueDirectory.php?cityId=<? echo $results[$i]['id']; ?>">view all <?=$layout->getCityVenueCount($results[$i]['id'])?> venues</a>				
				</div>
			</td>
			<td width='70%'>
				<? dbGetTopVenueRandomByCity(1,$results[$i]['id']); ?>
			</td>
		</tr>
<?	}
	echo "</table>";
	$layout->bubbleSubBoxBottom();
?>