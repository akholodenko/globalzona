<!--
<table width="98%" border="0" cellspacing="3" cellpadding="10">
	<tr>
		<td align="justify" valign="top">
			<? $selectTab = rand(1,3); 
			   $selectTab = 2; //turn random off ?>
			<ul id="maintab" class="shadetabs">
				<li<? if ($selectTab == 1) echo " class='selected'"; ?>><a href="#" rel="tcontent1" class="nav">Welcome Message</a></li>-->
			<!--<li<? if ($selectTab == 2) echo " class='selected'"; ?>><a href="#" rel="tcontent2" class="nav">Featured Venue</a></li>-->
			<!--<li<? if ($selectTab == 2) echo " class='selected'"; ?>><a href="#" rel="tcontent3" class="nav">Featured Host</a></li>-->
<!--				<li<? if ($selectTab == 2) echo " class='selected'"; ?>><a href="#" rel="tcontent4" class="nav">Featured Events</a></li>				
			</ul>	
			<div class="tabcontentstyle">
				<? //include "index.contentMain.welcome.php"; ?>				
				<? //include "index.contentMain.venue.php"; ?>								
				<? //include "index.contentMain.host.php"; ?>								
				<? //include "index.contentMain.event.php"; ?>	

			</div>			
			<script type="text/javascript">
			//Start Tab Content script for UL with id="maintab" Separate multiple ids each with a comma.
			initializetabcontent("maintab")
			</script>
			<? //include 'index.contentMain.topVenues.php'; ?>
			<? //include 'index.contentMain.footer.php'; ?>
		</td>
	</tr>
</table>
-->

<table width="93%" border="0" cellspacing="3" cellpadding="10">
    <tr> 
    	<td bgcolor="#333333" class="text" align="justify">
			<table width="100%" border="0" cellspacing="0" cellpadding="1">
				  <tr class="nav" background="layout/bgFeatured.jpg">
					<td class="featuredBG" align="right" colspan="2">&nbsp;</td>
				  </tr>	  
				  <tr background="layout/bgFeatured.jpg" class="nav"> 
					<td class="featuredBGBottom">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr class="text">
							    <?
									$layout = new Layout();
									//$layout->cityList();
								?>
								<? $featuredEventInfo = dbFindFeatured('event'); ?>
								<td width="208" valign="top" align="center">
									<? list($width, $height, $type, $attr) = getimagesize($featuredEventInfo['flyerURL']); ?>
									<a href="#" onclick="window.open('<? echo $featuredEventInfo['flyerURL']; ?>','','scrollbars=no,location=no,width=<? echo $width+20;?>,height=<? echo $height+20;?>'); return false;">
										<img class="imgBorder" src="<? echo $featuredEventInfo['flyerURL']; ?>" border="0" width="180"></a><br>
									<a href="eventDetails.php?eventId=<? echo $featuredEventInfo['id'];?>"><b>Get more details about this event!</b></a>
								</td>
								<td valign="top">&nbsp;&nbsp;</td>
								<td valign="top" align="justify">
									<table width="100%" bgcolor="gray" cellpadding="0" cellspacing="0" border="0"><tr class="nav"><td>&nbsp;&nbsp;&nbsp;<? echo urldecode($featuredEventInfo["eventTitle"]);?></td></tr></table>
									<div style="width: 90%; margin-left: auto; margin-right: auto;">
										<span class='textBig'><? echo urldecode($featuredEventInfo['message']);?></span>
									</div>
								</td>
							</tr>						
						</table>
						<br>
					</td>					
				  </tr>				  
			</table>
			<div align='center'>
				<script type="text/javascript"><!--
				google_ad_client = "pub-2855839175509987";
				google_ad_width = 468;
				google_ad_height = 60;
				google_ad_format = "468x60_as";
				google_ad_type = "text";
				//2007-01-11: Center Text Ad
				google_ad_channel = "5359080215";
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
			<!--UPCOMING 3 EVENTS
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr class='text'>
					<td valign="top"><div class='spacer'>&nbsp;</div>
					<? 
						/*
						$currentTime = time() + (1 * 24 * 60 * 60);
						$weekPlusTime = time() + (7 * 24 * 60 * 60);
						$startDay = date("Y",$currentTime).'-'.date("m",$currentTime).'-'.date("d",$currentTime).' 00:00:00';
						$endDay = date("Y",$weekPlusTime).'-'.date("m",$weekPlusTime).'-'.date("d",$weekPlusTime).' 23:59:59';	
						dbGetEvent ($startDay,$endDay, $_GET['cityId'],"main"); 
						*/
					?>			
					</td>
				</tr>
			</table>
			<div class='spacer'>&nbsp;</div>
			<div class='spacer'>&nbsp;</div>
			-->
			<!--
			<table background="layout/bgFeatured.jpg" cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr class="nav" background="layout/bgFeatured.jpg">
					<td class="featuredBG" align="right" colspan="2">&nbsp;</td>
			    </tr>	
				<tr class='nav' bgcolor='#777777'><td colspan='2' align='center'>Top Recommended Clubs and Bars</td></tr>
				<tr><td>
					<div align='center'>
						<script type="text/javascript">
							google_ad_client = "pub-2855839175509987";
							google_ad_width = 468;
							google_ad_height = 15;
							google_ad_format = "468x15_0ads_al_s";
							//2006-12-28: textLinks
							google_ad_channel = "9368009086";
							google_color_border = "404040";
							google_color_bg = "404040";
							google_color_link = "DDDDDD";
							google_color_text = "CCCCCC";
							google_color_url = "BBBBBB";
							</script>
							<script type="text/javascript"
							  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>
					</div>
				</td></tr>
				<tr class='text'><td valign="top"><div class='spacer'>&nbsp;</div><? dbGetTopVenueRandom(3); ?></td></tr>
				<tr class='text'>
					<td class="featuredBGBottom" valign="top" align='center' id='recommendedClubs'>			
						<a href='venueDirectory.php'>
							View all of the recommended clubs and bars

							<div onMouseOver="style.color='#000000'; MM_changeProp('recommendedClubs','','style.backgroundColor','#99CCFF','DIV')" onMouseOut="style.color='#dddddd'; MM_changeProp('recommendedClubs','','style.backgroundColor','#333333','DIV')">
								<b>View all of the recommended clubs and bars</b>
							</div>

						</a>
						<br><br>
					</td>
				</tr>
			</table>
			-->
		</td>
	</tr>
</table>
