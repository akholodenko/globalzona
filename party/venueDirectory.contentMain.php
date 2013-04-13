<table width="93%" border="0" cellspacing="3" cellpadding="10">
    <tr> 
    	<td bgcolor="#333333" class="text" align="justify">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#555555" class="nav"> 
					<td align='right'>Clubs, Lounges, and Bars <? if(check_int($_GET['cityId']) == 1 && $cityId > 0) echo ": ".dbFindCity($_GET['cityId']); ?>&nbsp;&nbsp;&nbsp;</td>
				</tr>
				<tr bgcolor='#777777'><td>
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
						google_color_link = "ffffff";
						google_color_text = "dddddd";
						google_color_url = "dddddd";
						//--></script>
						<script type="text/javascript"
						  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>						
					</div>
				</td></tr>
				<tr bgcolor="#888888" class="text">
					<td valign="top" align='center'>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">					
							<tr bgcolor="#888888" class="text"> 
								<td align="justify">
									<?	
										if (check_int($_GET['cityId']) == 1 && $cityId > 0) dbGetTopVenueByCity($_GET['cityId']); 
										else dbGetCity("venue", "");
									?>		
								</td>		
							</tr>	
						</table>
					</td>
				</tr>
				<tr><td>
					<div align='center'>
							<script type="text/javascript"><!--
								google_ad_client = "pub-2855839175509987";
								google_ad_width = 468;
								google_ad_height = 15;
								google_ad_format = "468x15_0ads_al_s";
								//2006-12-28: textLinks
								google_ad_channel = "9368009086";
								google_color_border = "333333";
								google_color_bg = "333333";
								google_color_link = "DDDDDD";
								google_color_text = "CCCCCC";
								google_color_url = "BBBBBB";
								//--></script>
								<script type="text/javascript"
								  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
							</script>
						</div>
					</td></tr>
			</table>
		</td>
	</tr>
</table>