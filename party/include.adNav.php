<table width="97%" cellpadding=0 cellspacing=3 border=0><tr><td>
<?
	if ($_SERVER['PHP_SELF'] != "/party/index.php") include "includes/calendarYUI.php";


	//$layout->searchEventsBubble();
	//$layout->bubbleBoxSpacer();

/*
	if (getCurrentDirectory() != "webUser")  
	{
		$poll = new Poll(4);
		$poll->printPoll();
		$layout->bubbleBoxSpacer();
	}
*/

	$layout->mailListBubble();
	$layout->bubbleBoxSpacer();

	$layout->adBannerBubble();
	$layout->bubbleBoxSpacer();
?>
</td></tr></table>
		
		<table width="100%" border="0" cellspacing="3" cellpadding="2">
		<!--
			<tr><td bgcolor='#333333' class="nav">&nbsp;&nbsp;&nbsp;Search Events
				<table width="100%" cellpadding="0" cellspacing="2" border="0">
				<form action='calendar.php?showDay=1&cityId=<? echo $_GET['cityId']; ?>' method='POST'>
					<tr><td align="center" bgcolor="#444444" class="spacer">
						<br>
							<? /*
								calendar_month('',''); 
								calendar_day('','');
								calendar_year('','');
								*/
							?>
						<br><br><input type="submit" name="Submit" class="form" value="Get <? //if ($_GET['cityId'] != "") echo dbFindCity($_GET['cityId']); else echo 'All Cities'; ?> Party List"><br><br>
					</td></tr>
				</form>
				</table>
			</td></tr>
		-->
		<!--
			<tr><td bgcolor='#333333' class="nav">&nbsp;&nbsp;&nbsp;Recently Posted Events
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<? //dbGetRecentEvents (5); ?>
					<tr><td align='center' class='nav'><a href='submitEvent.php'>Submit Your Event Now!</a></td></tr>
				</table>
			</td></tr>
		-->
		<!--	
		<? if ($_SERVER['PHP_SELF'] != "/party/eventDetails.php") 
		{ 
			if ($_POST['guestlist'] == "true") 	
			{
				$maillistInfo['plusMinus'] = "-";
				$maillistInfo['blockNone'] = "block";
			}
			else	//changes values to show/hide by default
			{
				$maillistInfo['plusMinus'] = "-";
				$maillistInfo['blockNone'] = "block";
			}
		?>
			<tr><td bgcolor='#333333' class="nav">
				&nbsp;&nbsp;<a href='#' class='nav' onClick="return showHideBlock('Mailinglist');">
				<span id='MailinglistSpan'><? echo $maillistInfo['plusMinus']; ?></span>&nbsp;&nbsp;Get All the Updates!</a>
				<div id='Mailinglist' style='display: <? echo $maillistInfo['blockNone']; ?>;'>
					<table width="100%" cellpadding="0" cellspacing="2" border="0">		
						<tr><td align="center" bgcolor="#444444" class="spacer"><br>
					<? if ($_POST['guestlist'] == "true") 
						{ 
							//recordGuestList($_POST['firstname'],$_POST['lastname'],$_POST['email2'],'');	//record guestlist entry	
						?>
						<div class='text'>Thank you for signing up.</div>
						<? } else { ?>
							<div id='guestListSideBar'>
								<table bgcolor="#444444" width='100%' cellpadding='1' cellspacing='0' border='0'>
								<form onSubmit='return check_submitGuestList(this);' method='POST'>
									<input type="hidden" name="guestlist" value="true">
									<tr class='text'><td width='10%'>&nbsp;</td><td><input onClick="if(document.getElementById('firstname').value=='First Name') document.getElementById('firstname').value='';" type='text' id='firstname' name='firstname' class='form' size='25' maxlength='50' value='First Name'></td></tr>
									<tr class='text'><td width='10%'>&nbsp;</td><td><input onClick="if(document.getElementById('lastname').value=='Last Name') document.getElementById('lastname').value='';" type='text' id='lastname' name='lastname' class='form' size='25' maxlength='50' value='Last Name'></td></tr>
									<tr class='text'><td width='10%'>&nbsp;</td><td><input onClick="if(document.getElementById('email2').value=='Email') document.getElementById('email2').value='';" type='text' id='email2' name='email2' class='form' size='25' maxlength='50' value='Email'></td></tr>
									<tr class='text'><td width='10%'>&nbsp;</td><td><input type='submit' name='submit' value='Sign-up!' class='form'></td></tr>					
								</form>
								</table>
							</div>
						<? } ?>
							<br>
						</td></tr>
					</table>
				</div>
			</td></tr>
		<?	}	?>
		-->
		<!--
			<tr>
				<td bgcolor='#333333' class="nav">
					&nbsp;&nbsp;<a href='#' class='nav' onClick="return showHideBlock('TopAssociates');">
					<span id='TopAssociatesSpan'>+</span>&nbsp;&nbsp;Top Associates</a>
					<div id='TopAssociates' style='display: none;'>
					<table width="100%" cellpadding="0" cellspacing="2" border="0">
						<tr>
							<td bgcolor="#444444" class='text'>
								<? dbGetAssociate(); //print list of associates?>
							</td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
			-->
<!--
			<tr>
				<td bgcolor='#333333'>
					<? //list($width, $height, $type, $attr) = getimagesize("http://i104.photobucket.com/albums/m182/artem_k/GZ%20Pics/Flyers/Fluid_Thursdays_MWeb.jpg"); ?>
					<a href="#" onclick="window.open('http://www.globalzona.com/party/associate/processAssociate.php?associateId=1&associateURL=http://i104.photobucket.com/albums/m182/artem_k/GZ%20Pics/Flyers/Fluid_Thursdays_MWeb.jpg','','scrollbars=no,location=no,width=<? echo $width+20;?>,height=<? echo $height+20;?>'); return false;">
						<img src="http://www.globalzona.com/party/images/banners/Fluid_Thursdays_MWeb_tmb.jpg" border="0" width="211" alt="RhythmEthics">
					</a>
				</td>
			</tr>
-->
<!--
			<tr>
				<td bgcolor='#333333' class="nav">
					&nbsp;&nbsp;<a href='#' class='nav' onClick="return showHideBlock('DJPlaydoughboy');">
					<span id='DJPlaydoughboySpan'>+</span>&nbsp;&nbsp;<b>DJ Playdoughboy</b></a><br>
					<table width="100%" cellpadding="0" cellspacing="2" border="0">
						<tr><td bgcolor="#444444">
							<table width="98%" cellpadding="0" cellspacing="8" border="0">
								<tr><td class='textSmall' style="color: white;" align="justify">
								<a href='#' class='textSmall' style="color: white;" onClick="return showHideBlock('DJPlaydoughboy');">
									Ukraine born producer/remixer/DJ. DJing since 1998, and composing
									music since 1996. As part of Asylum Group (Ukraine) - had his tracks
									featured on radio stations in Ukraine as early as 1997. <u>Read more</u>
									<div class='spacer'>&nbsp;</div>
									<img class="imgBorder" src="http://www.globalzona.com/party/images/banners/playdoughboy_tmb.jpg" width="187" border="0">
									<div id='DJPlaydoughboy' style='display: none;'>
										<div class='spacer'>&nbsp;</div>
										After moving
										to California in 2000 Playdoughboy continued collaborating with Asylum
										Group as well as starting up a solo project, integrating some hardware
										pieces into the software based studio, concentrating on dirty electro
										house and minimal techno sound.
										<div class='spacer'>&nbsp;</div>
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
								</a>
								</td></tr>
							</table>
						</td></tr>
					</table>
				</td>
			</tr>
-->
<!--
			<tr>
				<td bgcolor='#333333' class="nav">
					&nbsp;&nbsp;&nbsp;Random Party Pix
					<br><? //displayPhoto(); ?><br>
					<div align='center'><a href="http://www.globalzona.com/party/contact.php?emailSubject=Random Pix Suggestion&specialMessage=paste image url here">get your pix in the mix</a></div>
				</td>
			</tr>
-->		
		</table>