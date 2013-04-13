<table width="100%" border="0" cellspacing="0" cellpadding="1">
<?
	if ($_GET['confirm'] == 'true') 
	{ 
		include "include.submitEvent.submit.php"; 
		if ($insertEventResult != false) {	?>
			<tr class="textBig"><td align="center" colspan="2">
				An email has been sent to <? echo $_GET['email']; ?>, with your password.<br>
				<a href="http://www.globalzona.com/party/eventDetails.php?eventId=<? echo $insertEventResult; ?>">http://www.globalzona.com/party/eventDetails.php?eventId=<? echo $insertEventResult; ?></a>
			</td></tr>	
<?		}
	} 
	else 
	{ 
?> 
	<form action="submitEvent.php" name="myform" method="post" onSubmit="return check_submitEvent(this);">
		  <tr class="nav">
			<td colspan="2">
				<div id="confirmFormBG" style="display: none;" class="layerTrans">
					<div id="confirmFormText" style="z-index:11;">
						<table align='center' width="100%" border="0" cellspacing="1" cellpadding="1">
							<tr><td class='nav' colspan='2' align='center' bgcolor='#555555'>Please Confirm Your Event Information</td></tr>
							<tr><td align='right' class='nav' width='30%'>Event Title:</td><td class='text'><div id="eventTitleX">&nbsp;</div></td></tr>
							<tr><td align='right' class='nav' valign='top'>Date&nbsp;and&nbsp;Time:</td><td class='text'><div id="eventDate">&nbsp;</div></td></tr>
							<tr><td align='right' class='nav' valign='top'>Flyer:</td><td class='text'><div id="flyerX">&nbsp;</div></td></tr>
							<tr><td align='right' class='nav' valign='top'>Guestlist/Ticket URL:</td><td class='text'><div id="guestlistX">&nbsp;</div></td></tr>
							<tr><td align='right' class='nav' valign='top'>Detailed&nbsp;Message:</td><td class='text'><div id="messageX">&nbsp;</div></td></tr>
							<tr><td align='right' class='nav' valign='top'>Venue&nbsp;Name:</td><td class='text'><div id="venueNameX">&nbsp;</div></td></tr>
							<tr><td align='right' class='nav' valign='top'>Address:</td><td class='text'><div id="addressX">&nbsp;</div></td></tr>
							<tr><td align='right' class='nav' valign='top'>Name:</td><td class='text'><div id="nameX">&nbsp;</div></td></tr>
							<tr><td align='right' class='nav' valign='top'>Email:</td><td class='text'><div id="emailX">&nbsp;</div></td></tr>
							<tr bgcolor="#555555">
								<td class='nav' align='center' bgcolor='orange'>
									<a href="#" onClick="hideConfirmLayer();"><font color='black'>Edit</font></a>
								</td>
								<td class='nav' align='center'><a href="#" onClick="submitCofirmLayer();"><b>Confirm</b></a></td>
							</tr>
						</table>
					</div> 
				</div>
				<div id="submitFormBG" style="display: none;" class="submitTrans">&nbsp;</div>
				<div id="submitFormText" style="display: none;" class="submitText"><br><br>Submitting your event...</div>
				<? include "includes/eventForm.PartyInformation.php"; ?>
			</td>
		  </tr>	
          <tr class="nav">
			<td colspan="2">
				<? include "includes/eventForm.VenueInformation.php"; ?>			
			</td>
		  </tr>	
          <tr class="nav">
			<td colspan="2">
				<? include "includes/eventForm.HostInformation.php"; ?>	
			</td>
		  </tr>	
          <tr class="nav"><td colspan="2">&nbsp;</td></tr>
          <tr class="nav"> 
            <td width='25%' align='right' valign='top'><input type="submit" name="Submit" class="form" value="Submit Event">&nbsp;</td>
            <td>
				<a name="guestlistInfo">&nbsp;&nbsp;&nbsp;(1) To use an email address for guestlist sign-up, type in (example) <b>mailto:email@domain.com</b>.</a>
		  		<br><a name="hostDiscInfo">&nbsp;&nbsp;&nbsp;(2) This information will not be shown to visitors; used for post editing only.</a>				
			</td>
          </tr>
	</form>		  
<? } ?>
</table>