<? 
	if ($_GET['venueId'] != "")
	{
		//$venueDetails = dbFindVenue($_GET['venueId']); 
		if ($venueDetails["countryName"] != "" && $venueDetails["countryName"] != "USA")
			$venueAddress = $venueDetails["address"].", ".$venueDetails["city"].", ".$venueDetails["countryName"];
		else
			$venueAddress = $venueDetails["address"].", ".$venueDetails["city"].", ".$venueDetails["state"];
?>
<table width="93%" border="0" cellspacing="3" cellpadding="10">
    <tr> 
    	<td bgcolor="#333333" class="text" align="justify">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#555555" class="text"> 
					<td colspan='2'>&nbsp;&nbsp;&nbsp;<b><? echo urldecode($venueDetails['name']); ?></b></td>
				</tr>
				<tr bgcolor='#777777'><td colspan=4>
					<div align='center'>
						<script type="text/javascript"><!--
						google_ad_client = "pub-2855839175509987";
						google_ad_width = 468;
						google_ad_height = 60;
						google_ad_format = "468x60_as";
						google_ad_type = "text";
						//2007-01-11: Center Text Ad
						google_ad_channel = "5359080215";
						google_color_border = "888888";
						google_color_bg = "888888";
						google_color_link = "DDDDDD";
						google_color_text = "CCCCCC";
						google_color_url = "888888";
						//--></script>
						<script type="text/javascript"
						  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>
					</div>
				</td></tr>
				<tr bgcolor="#888888" class="text">
					<td valign="top" align='center'>
						<table width="90%" cellpadding="4" cellspacing="0" border="0">					
							<tr bgcolor="#888888" class="text"> 
								<td align="justify"><? echo urldecode($venueDetails['text']); ?></td>		
							</tr>	
						</table>
					</td>
					<td valign="top" width='207'>
						<?	if ($venueDetails['imgURL'] != "") { ?>
							<table bgcolor="black" cellpadding="1" cellspacing="0" border="0"><tr><td><? displayFlyer($venueDetails["imgURL"]); ?></td></tr></table>
						<? } ?>
						<div class="spacer"><br></div>
						<table width='202' cellpadding="0" cellspacing="1" border="0" bgcolor='#000000'>
							<tr><td>
								<table width='100%' cellpadding="2" cellspacing="0" border="0">
									<tr class='text' bgcolor='#555555'>
										<td valign='top'>&nbsp;Address:</td>
										<td width='150'>
											<a target="_blank" href="http://maps.google.com/?q=<? echo $venueAddress;?>">
												<?	echo $venueDetails["address"]; ?><br>
												<?	echo $venueDetails["city"].", ";

											  		if ($venueDetails["countryName"] != "" && $venueDetails["countryName"] != "USA") echo $venueDetails["countryName"];
													else echo $venueDetails["state"]; ?>
											</a>
										</td>
									</tr>
									<tr class='text' bgcolor='#555555'>
										<td>&nbsp;Website:</td>
										<td><a target="_blank" href="<? echo $venueDetails["website"];?>"><? echo substr($venueDetails["website"],0,20);?>...</a>&nbsp;</td>
									</tr>
									<tr class='text' bgcolor='#555555'>
										<td colspan=2><div id="map" style="width: 196; height: 250px"></div></td>
									</tr>
									<tr class='text' bgcolor='#444444'>
										<form action="http://maps.google.com/maps" method="get">
										<td colspan=2 align='center'>
											<div class='spacer'>&nbsp;</div>
											<input onClick="document.getElementById('fromAddress').value='';" id="fromAddress" type="text" size=30 name="saddr" id="saddr" value="&nbsp;Click here to enter start address"  class='form'/>
											<div class='spacer'>&nbsp;</div>
											<input type="submit" value="Get Driving Directions" class='form' />
											<input type="hidden" name="daddr" value="<? echo $venueAddress; ?>" />
											<input type="hidden" name="hl" value="en" />
											<div class='spacer'>&nbsp;</div>
										</td>
										</form>
									</tr>
								</table>
							</td></tr>
						</table>
						<div class="spacer"><br></div>
					</td>	
				</tr>
			</table>
		</td>
	</tr>
</table>
<? } ?>