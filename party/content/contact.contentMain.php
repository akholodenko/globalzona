<table width='97%' cellpadding='0' cellspacing='3' border='0'><tr><td>
<?
	$layout = new Layout();
	$leftLink = "";
	$layout->bubbleBoxTop("Contact Us",$leftLink);
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
		<? if ($_POST['send'] == "true" && sendDetailedMail ($_POST['emailSubject'], $_POST['name'], $_POST['email'], $_POST['message'])) { ?>
				<tr class="navTall"><td align="center" colspan="2">Thank You! <span class="textBig">Your email has been sent and will be addressed in a timely manner.</span></td></tr>
		<? } else { ?>
		  <tr class="navTall">
			<td align="right" colspan="2">
				<? if ($_POST['send'] == "true") echo "There was an error sending your message - "; ?>
			</td>
		  </tr>
	 <form action="contact.php" method="post" onSubmit="return check_contact_fields(this);">
		  <input name="send" value="true" type="hidden">
		  <tr class="navTall"> 
			<td width="30%" valign="top" align="right">Subject</td>
			<td width="70%">
				<? if ($_GET['emailSubject'] == "" && $_POST['emailSubject'] == "") { ?>
					<input name="emailSubject" type="text" class="form" size="40" maxlength="100">
				<? } else if ($_GET['emailSubject'] != "" || $_POST['emailSubject'] != "") { ?>
					<input READONLY name="emailSubject" type="text" class="formRO" size="40" maxlength="100" value="<? if ($_GET['emailSubject'] != "") { echo $_GET['emailSubject']; } else if ($_POST['emailSubject'] != "") { echo $_POST['emailSubject']; } ?>">
				<? } ?>
			</td>
		  </tr>
		  <tr class="navTall"> 
			<td  valign="top" align="right">Name</td>
			<td><input name="name" type="text" class="form" size="40" maxlength="100" value="<? echo $_POST['name']; ?>"></td>
		  </tr>
		  <tr class="navTall"> 
			<td valign="top" align="right">Email</td>
			<td><input name="email" type="text" class="form" size="40" maxlength="100" value="<? echo $_POST['email']; ?>"></td>
		  </tr>
		  <tr class="navTall"> 
			<td valign="top" align="right">Detailed&nbsp;Message</td>
			<td>
				<textarea name="message" cols="40" rows="5" wrap="VIRTUAL" class="form" id="info"><? if ($_POST['message'] != "") echo $_POST['message']; else if ($_GET['specialMessage'] != "") echo $_GET['specialMessage']; ?></textarea>
			</td>
		  </tr>
		  <tr class="nav"> 
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" class="form" value="Send Message"></td>
		  </tr>
	</form>		
		<? } ?>
	</table>
<? 
	$layout->bubbleBoxSpacer();
	$layout->bubbleBoxBottom(); 
	$layout->bubbleBoxSpacer();
?>
</td></tr></table>