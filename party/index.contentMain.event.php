<div id="tcontent4" class="tabcontent">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr class="text">
			<? $featuredEventInfo = dbFindFeatured('event'); ?>
			<td width="200" valign="top">
				<table bgcolor="gray" cellpadding="1" cellspacing="0" border="0"><tr><td>
					<a href="#" onclick="window.open('<? echo $featuredEventInfo['flyerURL']; ?>','','scrollbars=no,location=no,width=555,height=820'); return false;">
						<img src="<? echo $featuredEventInfo['flyerURL']; ?>" border="0" width="200">
					</a>
				</td></tr></table>
			</td>
			<td valign="top">&nbsp;&nbsp;</td>
			<td valign="top" align="justify">
				<table width="100%" bgcolor="gray" cellpadding="0" cellspacing="0" border="0"><tr class="nav"><td>&nbsp;&nbsp;&nbsp;<? echo urldecode($featuredEventInfo["eventTitle"]);?></td></tr></table>
				<div style="width: 95%; margin-left: auto; margin-right: auto;">
					<span class='textBig'><? echo urldecode($featuredEventInfo['message']);?></span>
					<br><a href="eventDetails.php?eventId=<? echo $featuredEventInfo['id'];?>"><b>More details</b></a>
				</div>
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

	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr class='text'>
			<td valign="top"><div class='spacer'>&nbsp;</div>
			<? 
				$currentTime = time() + (1 * 24 * 60 * 60);
				$weekPlusTime = time() + (7 * 24 * 60 * 60);
				$startDay = date("Y",$currentTime).'-'.date("m",$currentTime).'-'.date("d",$currentTime).' 00:00:00';
				$endDay = date("Y",$weekPlusTime).'-'.date("m",$weekPlusTime).'-'.date("d",$weekPlusTime).' 23:59:59';	
				dbGetEvent ($startDay,$endDay, $_GET['cityId'],"main"); 
			?>			
			</td>
		</tr>
	</table>
	<div class='spacer'>&nbsp;</div>

	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr class="text">
			<td width="130" valign="top">
				<table bgcolor="gray" cellpadding="1" cellspacing="0" border="0"><tr><td><img src="http://myspace-130.vo.llnwd.net/00920/03/14/920424130_m.jpg" width="130"></td></tr></table>
			</td>
			<td valign="top">&nbsp;&nbsp;</td>
			<td valign="top" align="justify">
				<table width="100%" bgcolor="gray" cellpadding="0" cellspacing="0" border="0"><tr class="nav"><td>&nbsp;&nbsp;&nbsp;DJ Playdoughboy</td></tr></table>
				<div  class="textSmall" style="width: 95%; margin-left: auto; margin-right: auto; color: #ffffff">
					Ukraine born producer/remixer/DJ. DJing since 1998, and composing
					music since 1996. As part of Asylum Group (Ukraine) - had his tracks
					featured on radio stations in Ukraine as early as 1997. After moving
					to California in 2000 Playdoughboy continued collaborating with Asylum
					Group as well as starting up a solo project, integrating some hardware
					pieces into the software based studio, concentrating on dirty electro
					house and minimal techno sound.<p>
					In the past Playdoughboy played records and performed live at numerous
					San Francisco clubs - Mighty, BOCA, Supperclub, Roe/Prive, Studio Z,
					Club 6, RX Gallery, Whisper to name a few... Playdoughboy also
					appeared on El Otro Mundo Sessions on Pulse Radio and his tracks were
					aired on SF Bay Area radio stations, as well as Master Radio in
					Kharkov and radio stations in Ireland and Canada. His bootleg remix on
					Justin Timberlake's "Sexy Back" became a cult hit in Russia in the
					summer of 2006, and two tracks are scheduled for major realease on
					compilations in Greece and the US.
				</div>
			</td>
		</tr>						
	</table>

	<div class='spacer'>&nbsp;</div>
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr class='nav' bgcolor='#777777'><td colspan='2' align='center'>Top Recommended Clubs and Bars</td></tr>
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
		<tr class='text'>
			<td valign="top"><div class='spacer'>&nbsp;</div>				
					<? dbGetTopVenueRandom(3); ?>				
			</td>
		</tr>
		<tr class='text'>
			<td valign="top" align='center' id='recommendedClubs'>			
				<a href='venueDirectory.php'>
					<div onMouseOver="style.color='#000000'; MM_changeProp('recommendedClubs','','style.backgroundColor','#99CCFF','DIV')" onMouseOut="style.color='#dddddd'; MM_changeProp('recommendedClubs','','style.backgroundColor','#333333','DIV')">
						<b>View all of the recommended clubs and bars</b>
					</div>
				</a>
			</td>
		</tr>
	</table>
</div>