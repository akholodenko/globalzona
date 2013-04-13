<?
	$count_events = Data::GetEventsCount("future");
	$count_events = $count_events['count_events'];

	$count_venues = Data::GetVenuesCount();
	$count_venues = $count_venues['count_venues'];
	
	$count_vip = Data::GetVIPCount();
	$count_vip = $count_vip['count_vip'];
?>

<table style='line-height: 20px;' bgcolor='#C11B17' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr class='text_nav'>
		<td width='15%' align='center'>
			<a href='admin_main.php'>Main / Events (<? echo $count_events; ?>)</a>
		</td>
		<td width='15%' align='center'>
			<a href='admin_venues.php'>Venues (<? echo $count_venues; ?>)</a>
		</td>
		<td width='15%' align='center'>
			<a href='admin_vip.php'>VIP (<? echo $count_vip; ?>)</a>
		</td>
		<td width='15%' align='center'>
			<a href='admin_news.php'>News/Updates</a>
		</td>
		<td width='30%'>&nbsp;</td>		
		<td width='10%' align='center'>
			<a href='admin_validate.php?type=logout'>Log-out</a>
		</td>
	</tr>
</table>