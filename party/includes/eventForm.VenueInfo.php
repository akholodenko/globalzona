<?
	echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";								
?>
		  <tr class="text"> 
			<td align='right'>
				<a href="#" onclick="return false;" class="textBig tooltip" title="If the venue of your event<br>is not listed on the left,<br>please select the checkbox" style="line-height: normal">Manually enter venue information</a>&nbsp;<input onClick='ShowManualVenueForm()' type='checkbox' id='EventFormManualVenueCheck'>
			</td>
		  </tr>		  
<?
	echo "</table>";
	echo "<div id='EventFormManualVenueForm' style='display: none;'>";
	echo "	<table cellpadding=2 cellspacing=0 border=0 width='100%'>";								
?>
			  <tr class="navTall"> 
				<td width="30%" valign="top" align="right">Venue Name</td>
				<td width="70%"><input name="venueName" id='venueName' type="text" class="formLarge" style='width: 200px;' maxlength="30" value="<? echo $_POST['venueName']; ?>"></td>
			  </tr>		  
			  <tr class="navTall"> 
				<td width="30%" valign="top" align="right">Address</td>
				<td width="70%"><input name="address" id='address' type="text" class="formLarge" style='width: 200px;' maxlength="100" value="<? echo $_POST['address']; ?>"></td>
			  </tr>		  		  
<?
	echo "	</table>";
	echo "</div>";
	echo "<div id='SelectedEventVenueInfo' style='display: none; text-align: center;'>";
	echo "	<table cellpadding=10 cellspacing=0 border=0 width='100%'><tr><td align='center'>";								
				$layoutLocal = new Layout();
				$layoutLocal->bubbleSub2BoxTop(81);
	echo "		<table cellpadding=0 cellspacing=0 border=0 width='100%'>";		
?>
				  <tr class="navTall"> 
					<td align='center'><span id='SelectedEventVenueImg'></span></td>
				  </tr>		  
				  <tr class="navTall"> 
					<td style='padding-left: 21px;'><span id='SelectedEventVenueName'></span></td>
				  </tr>		  
				  <tr class="textBig"> 
					<td style='padding-left: 21px;'><span id='SelectedEventVenueAddress'></span></td>
				  </tr>		  		  
<?
	echo "		</table>";
				$layoutLocal->bubbleSub2BoxBottom();
	echo "	</td></tr></table>";
	echo "</div>";
?>
<script>
	ShowManualVenueForm();
</script>