<div id="tcontent2" class="tabcontent">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr class="text">
			<? 
				$featuredVenueInfo = dbFindFeatured('venue'); 
				$featuredVenueAddress = $featuredVenueInfo["address"].", ".$featuredVenueInfo["city"].", ".$featuredVenueInfo["state"];
			?>
			<td width="200" valign="top">
				<table bgcolor="gray" cellpadding="1" cellspacing="0" border="0"><tr><td><? displayFlyer($featuredVenueInfo["imgURL"]); ?></td></tr></table>
				<a target="_blank" href="http://maps.google.com/?q=<? echo $featuredVenueAddress; ?>"><? echo $featuredVenueAddress; ?></a>
				<br><a target="_blank" href="<? echo $featuredVenueInfo["website"];?>">Club Website</a>
				<script type="text/javascript"><!--
				google_ad_client = "pub-2855839175509987";
				google_ad_width = 180;
				google_ad_height = 60;
				google_ad_format = "180x60_as_rimg";
				google_cpa_choice = "CAAQ56j8zwEaCHvU9tBAqJJaKMu293M";
				google_ad_channel = "";
				//--></script>
				<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>								
			</td>
			<td valign="top">&nbsp;&nbsp;</td>
			<td valign="top" align="justify">
				<table width="100%" bgcolor="gray" cellpadding="0" cellspacing="0" border="0">
					<tr class="nav"><td>&nbsp;&nbsp;&nbsp;<? echo $featuredVenueInfo["name"];?></td></tr>
				</table>
				<? echo $featuredVenueInfo["text"]; ?>
				<p>
					<br><div align="right"><? dbFindPrintBriefVenueInfo($featuredVenueInfo["prevVenueId"]);?>
					<br><a href="contact.php?emailSubject=Featured Venue Request">Want your venue to be featured?</a></div>
				</p>
			</td>
		</tr>						
	</table>	
</div>