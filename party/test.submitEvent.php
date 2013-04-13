<? //include 'utils.php'; ?>
<!--<link href="http://www.globalzona.com/party/style.css" rel="stylesheet" type="text/css">-->
<!--<script language="javascript" type="text/JavaScript" src="js/check.contact.fields.js"></script>-->
<!--
<link href="http://www.globalzona.com/party/layer.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/JavaScript" src="js/submitEvent.js"></script>
-->
<!--ORIGINAL START-->
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
			<?
				$layout->bubbleSubBoxTop(100);

				echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
				echo "	<tr class='nav'>";
				echo "		<td class='lightGradient'>&nbsp;&nbsp;&nbsp;Party Information</td>";
				echo "	</tr>";								
				echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
				echo "	<tr><td align='center'>";
				echo "		<table cellpadding=2 cellspacing=0 border=0 width='98%'>";								
			?>
					  <tr class="navTall"> 
						<td width="30%" valign="top" align="right">Event Title</td>
						<td width="70%"><input name="eventTitle" id="eventTitle" type="text" class="form" size="31" maxlength="30" value="<? echo $_POST['eventTitle']; ?>"></td>
					  </tr>
					  <tr class="navTall"> 
						<td width="30%" valign="top" align="right"><div id="calendar1a">Date</div></td>
						<td width="70%"><div id="calendar1b">
							<? 
								calendar_month ($_POST['pMonth'],'pMonthSubmit');
								calendar_day ($_POST['pDay'],'pDaySubmit');
								calendar_year ($_POST['pYear'],'pYearSubmit'); 
							?></div>
						</td>		
					  </tr>
					  <tr class="navTall"> 
						<td width="30%" valign="top" align="right"><div id="calendar2a">Time</div></td>
						<td width="70%"><div id="calendar2b">
							<? 
								calendar_hour ($_POST['hour']);
								calendar_minute ($_POST['minute']);
								calendar_ampm ($_POST['ampm']); 
							?></div>
						</td>
					  </tr>		  
					  <tr class="navTall"> 
						<td valign="top" align="right">Flyer&nbsp;Image&nbsp;URL</td>
						<td><input name="flyer" id="flyer" type="text" class="form" id="flyer" size="40" value="<? echo $_POST['flyer']; ?>">&nbsp;<font class='text'>(*.jpg, *.gif)</font></td>
					  </tr>
					  <tr class="navTall"> 
						<td valign="top" align="right">Guestlist/Buy&nbsp;Tix&nbsp;URL</td>
						<td><input name="guestlist" id="guestlist" type="text" class="form" id="flyer" size="40" value="<? echo urldecode($_POST['guestlist']); ?>">&nbsp;<a href="#guestlistInfo">(1) sign-up via email</a></td>
					  </tr>		  
					  <tr class="navTall"> 
						<td width="30%" valign="top" align="right">Detailed&nbsp;Message</td>
						<td>
							<textarea onKeyDown="limitText(this.form.message,this.form.countdown,1000);" onKeyUp="limitText(this.form.message,this.form.countdown,1000);" id='message' name="message" cols="70" rows="5" wrap="VIRTUAL" class="form" id="info"><? echo $_POST['message']; ?></textarea>
							<br>You have <input class='form' readonly type="text" name="countdown" size="3" value="1000"> characters left.
						</td>
					  </tr>
			<?
				echo "		</table>";
				echo "	</td></tr>";
				echo "</table>";
				$layout->bubbleSubBoxBottom();	
			?>
			</td>
		  </tr>	
          <tr class="nav">
			<td colspan="2">
			<?
				$layout->bubbleBoxSpacer();
				$layout->bubbleSubBoxTop(100);

				echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
				echo "	<tr class='nav'>";
				echo "		<td class='lightGradient'>&nbsp;&nbsp;&nbsp;Venue Information</td>";
				echo "	</tr>";								
				echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
				echo "	<tr><td align='center'>";
				echo "		<table cellpadding=2 cellspacing=0 border=0 width='98%'>";								
			?>
					  <tr class="navTall"> 
						<td width="30%" valign="top" align="right">Venue Name</td>
						<td width="70%"><input name="venueName" id='venueName' type="text" class="form" size="33" maxlength="30" value="<? echo $_POST['venueName']; ?>"></td>
					  </tr>		  
					  <tr class="navTall"> 
						<td width="30%" valign="top" align="right">Address</td>
						<td width="70%"><input name="address" id='address' type="text" class="form" size="40" maxlength="100" value="<? echo $_POST['address']; ?>"></td>
					  </tr>		  		  
					  <tr class="navTall">
						<td width="30%" valign="top" align="right"><div id="calendar3a">City</div></td>
						<td><div id="calendar3b"><? dbGetCity('dropDown', $_POST['city']); ?></div></td>
					  </tr>	  
			<?
				echo "		</table>";
				echo "	</td></tr>";
				echo "</table>";
				$layout->bubbleSubBoxBottom();	
			?>
			</td>
		  </tr>	
	<? if ($_GET['edit'] == "true") { ?>
			<input name="email" type="hidden" value="<? echo $_POST['emailLog']; ?>">
			<input name="name" type="hidden" value="<? echo $_POST['name']; ?>">
			<input name="password" type="hidden" value="<? echo $_POST['passwordLog']; ?>">						
	<? } else { ?>
          <tr class="nav">
			<td colspan="2">
			<?
				$layout->bubbleBoxSpacer();
				$layout->bubbleSubBoxTop(100);

				echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
				echo "	<tr class='nav'>";
				echo "		<td class='lightGradient'>&nbsp;&nbsp;&nbsp;Host Information</td>";
				echo "	</tr>";								
				echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
				echo "	<tr><td align='center'>";
				echo "		<table cellpadding=2 cellspacing=0 border=0 width='98%'>";								
			?>
				  <tr class="navTall"> 
					<td width="30%" valign="top" align="right">Name</td>
					<td width="70%"><input name="name" id="name" type="text" class="form" size="40" value="<? echo $_POST['name']; ?>">&nbsp;<a href="#guestlistInfo">(2) purpose for info.</a></td>
				  </tr>		  
				  <tr class="navTall"> 
					<td valign="top" align="right">Email</td>
					<td><input name="email" id="email" type="text" class="form" id="email" size="40" value="<? echo $_POST['email']; ?>"></td>
				  </tr>
				  <tr class="navTall"> 
					<td valign="top" align="right">Password</td>
					<td><input name="password" id="password" type="password" class="form" id="email" size="40" value="<? echo $_POST['password']; ?>"></td>
				  </tr>		  
			<?
				echo "		</table>";
				echo "	</td></tr>";
				echo "</table>";
				$layout->bubbleSubBoxBottom();	
			?>
			</td>
		  </tr>	
	<? } ?>
          <tr class="nav"><td colspan="2">&nbsp;</td></tr>
          <tr class="nav"> 
            <td width='35%' align='right' valign='top'><input type="submit" name="Submit" class="form" value="Submit Event">&nbsp;</td>
            <td>
				<a name="guestlistInfo">&nbsp;&nbsp;&nbsp;(1) To use an email address for guestlist sign-up, type in <b>mailto:[email here]</b>.</a>
		  		<br><a name="hostDiscInfo">&nbsp;&nbsp;&nbsp;(2) This information will not be shown to visitors; used for post editing only.</a>				
			</td>
          </tr>
	</form>		  
<? } ?>
</table>