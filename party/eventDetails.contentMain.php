<? 
	if ($_GET['eventId'] != "")
	{
		//DECLARED IN INCLUDE.HEADER.PHP
		//$eventDetails = dbFindEvent($_GET['eventId']); 
		$eventAddress = $eventDetails['address'].', '.dbFindCity($eventDetails['cityId']).', '.dbFindState($eventDetails['cityId']);		
?>


<table width="93%" border="0" cellspacing="3" cellpadding="10">
    <tr> 
    	<td bgcolor="#333333" class="text" align="justify">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#555555" class="text"> 
					<td>&nbsp;&nbsp;&nbsp;<b><? echo urldecode($eventDetails['eventTitle']); ?></b></td>
					<td align="right"><a href="login.php?edit=true&eventId=<? echo $_GET['eventId']; ?>">edit</a>&nbsp;|&nbsp;<a href="login.php?delete=true&eventId=<? echo $_GET['eventId']; ?>">delete</a>&nbsp;&nbsp;&nbsp;</td>					
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
					<td valign="top">
						<table width="97%" cellpadding="2" cellspacing="0" border="0">
							<tr bgcolor="#888888" class="text"> 
							<? if ($_GET['weeklyDay'] == "") { ?>
								<td align="right" width="20%">Date:</td>
								<td><? echo date("l, F j, Y", strtotime($eventDetails['date'])); ?></td>		
							<? } else { ?>
								<td align="right" width="20%">Day:</td>
								<td><? echo $_GET['weeklyDay']." (weekly)"; ?></td>
							<? } ?>
							</tr>
							<tr bgcolor="#888888" class="text"> 
								<td align="right" width="20%">Time:</td>
								<td><? echo date("g:i a", strtotime($eventDetails['date'])); ?></td>		
							</tr>							
							<tr bgcolor="#888888" class="text"> 
								<td align="right" width="20%" valign="top">Venue:</td>
								<td><? echo $eventDetails['venueName']; ?></td>		
							</tr>
							<tr bgcolor="#888888" class="text"> 
								<td align="right" width="20%" valign="top">Address:</td>
								<td><a target="_blank" href="http://maps.google.com/?q=<? echo printMapLink($eventDetails,0);?>"><? echo printMapLink($eventDetails,1);?></a></td>		
							</tr>							
							<tr bgcolor="#888888" class="text"> 
								<td align="right" width="20%" valign="top">Details:</td>
								<td align="justify"><? echo urldecode($eventDetails['message']); ?></td>		
							</tr>	
						</table>
					</td>
					<td align="right" valign="top">
						<? if ($eventDetails['flyerURL'] != "") { ?>
							<a target="_blank" href="<? echo $eventDetails['flyerURL']; ?>"><?  displayFlyer($eventDetails['flyerURL']); ?></a>
						<? } ?>
						<div class='spacer'>&nbsp;</div>
						<? if ($_GET['guestList'] == "false") { ?>
							<div align='center' class='test' style="padding-left: 5px; padding-right: 5px; background-color: red; width: 190px;">Sorry, no guestlist for this event.</div>
						<? } else if ($_GET['guestList'] == "email") {?>
							<div align='left' class='test' style="padding-left: 5px; padding-right: 5px; color: black; background-color: yellow; width: 190px;">For guestlist, please email <a href='<?echo $_GET['guestListEmail'];?>'><font color='#555555'><?echo $_GET['guestListEmail'];?></font></a></div>
						<? } else { ?>
							<table bgcolor='#222222' width='200' cellpadding='1' cellspacing='0' border='0'>
								<tr><td>
									<form onSubmit='return check_submitGuestList(this);' action='process.GuestList.php?eventId=<? echo $_GET['eventId']; ?>&guestListURL=<? echo $eventDetails['guestListURL']; ?>' method='POST'>
										<tr class='text' bgcolor='#333333'><td colspan='2' align='center'><b>Get on the guestlist</b></td></tr>
										<tr class='text' bgcolor='#aaaaaa'><td width='15%'>&nbsp;</td><td><input onClick="if(document.getElementById('firstname').value=='First Name') document.getElementById('firstname').value='';" type='text' id='firstname' name='firstname' class='form' size='20' maxlength='50' value='First Name'></td></tr>
										<tr class='text' bgcolor='#aaaaaa'><td width='15%'>&nbsp;</td><td><input onClick="if(document.getElementById('lastname').value=='Last Name') document.getElementById('lastname').value='';" type='text' id='lastname' name='lastname' class='form' size='20' maxlength='50' value='Last Name'></td></tr>
										<tr class='text' bgcolor='#aaaaaa'><td width='15%'>&nbsp;</td><td><input onClick="if(document.getElementById('email2').value=='Email') document.getElementById('email2').value='';" type='text' id='email2' name='email2' class='form' size='20' maxlength='50' value='Email'></td></tr>
										<tr class='text' bgcolor='#aaaaaa'><td width='15%'>&nbsp;</td><td><input type='submit' name='submit' value='register' class='form'></td></tr>					
									</form>
								</td></tr>
							</table>
						<? } ?>
					</td>	
				</tr>
				<!--
				<? if ($eventDetails['guestListURL'] != "") { ?>
					<tr bgcolor="#666666"><td class="text" colspan="2" align="center">Get on the guestlist or buy tickets, <a target="_blank" href="<? if (strstr($eventDetails['guestListURL'], '@') != false) echo "mailto:";?><? echo urldecode($eventDetails['guestListURL']); ?>">click here</a>.</td></tr>
				<? } ?>
				-->

				<tr bgcolor="#888888">
					<td colspan=2>
						<table bgcolor='#888888' width='200' cellpadding='5' cellspacing='0' border='0'>
							<tr><td align='center'>
								<div class='DrivingDirections'><div class="text" align="right">
									<table width='100%' cellpadding='5' cellspacing='0' border='0'>
										<tr class='text'>
											<form action="http://maps.google.com/maps" method="get">
											<td align='center'>
												<input onClick="document.getElementById('fromAddress').value='';" id="fromAddress" type="text" size=30 name="saddr" id="saddr" value="&nbsp;Click here to enter start address"  class='form'/>
											</td>
											<td align='center'>
												<input type="submit" value="Get Driving Directions" class='form' />
												<input type="hidden" name="daddr" value="<? echo $eventAddress; ?>" />
												<input type="hidden" name="hl" value="en" />
											</td>
											</form>
										</tr>
									</table>
								</div></div>
								<div id="map" style="width: 458px; height: 250px"></div>
							</td></tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? } ?>