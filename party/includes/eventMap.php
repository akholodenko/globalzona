<table width='100%' cellpadding='0' cellspacing='0' border='0'>
	<tr><td align='center'>
		<a name="eventMap"></a>
		<div id="map" style="width: 423px; height: 400px"></div>
		<div class='//DrivingDirections'><div class="text" align="center">
			<table width='75%' cellpadding='5' cellspacing='0' border='0'>
				<tr class='text'>
					<form action="http://maps.google.com/maps" method="get">
					<td align='right'>
						<input onClick="document.getElementById('fromAddress').value='';" id="fromAddress" type="text" size=30 name="saddr" id="saddr" value="&nbsp;Click here to enter start address"  class='form'/>
					</td>
					<td align='left'>
						<input type="submit" value="Get Driving Directions" class='form' />
						<input type="hidden" name="daddr" value="<? echo $eventAddress; ?>" />
						<input type="hidden" name="hl" value="en" />
					</td>
					</form>
				</tr>
			</table>
		</div></div>
	</td></tr>
</table>