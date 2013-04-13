<table width="93%" border="0" cellspacing="3" cellpadding="10">
    <tr> 
    	<td bgcolor="#333333" class="text" align="justify">
			<table width="100%" border="0" cellspacing="0" cellpadding="1">
				<? if ($_POST['send'] == "true" && sendDetailedMail ($_POST['emailSubject'], $_POST['name'], $_POST['email'], $_POST['message'])) { ?>
						<tr class="nav"><td bgcolor="#555555" align="right" colspan="2">Thank You&nbsp;&nbsp;&nbsp;</td></tr>
						<tr bgcolor="#777777" class="nav"><td>&nbsp;</td></tr>
						<tr bgcolor="#777777" class="text">
							<td align='center'>Your email has been sent and will be addressed in a timely manner.</td>
						</tr>
						<tr bgcolor="#777777" class="nav"><td>&nbsp;</td></tr>
				<? } else { ?>
				  <tr class="nav">
					<td bgcolor="#555555" align="right" colspan="2">
						<? if ($_POST['send'] == "true") echo "There was an error sending your message - "; ?>
						Contact Us&nbsp;&nbsp;&nbsp;
					</td>
				  </tr>
				  <form action="contact.php" method="post" onSubmit="return check_contact_fields(this);">
					<input name="send" value="true" type="hidden">
				  <tr bgcolor="#777777" class="nav"><td colspan="2">&nbsp;</td></tr>		  
				  <tr bgcolor="#777777" class="nav"> 
					<td width="30%" valign="top" align="right">Subject</td>
					<td width="70%">
						<? if ($_GET['emailSubject'] == "" && $_POST['emailSubject'] == "") { ?>
							<input name="emailSubject" type="text" class="form" size="40" maxlength="100">
						<? } else if ($_GET['emailSubject'] != "" || $_POST['emailSubject'] != "") { ?>
							<input READONLY name="emailSubject" type="text" class="formRO" size="40" maxlength="100" value="<? if ($_GET['emailSubject'] != "") { echo $_GET['emailSubject']; } else if ($_POST['emailSubject'] != "") { echo $_POST['emailSubject']; } ?>">
						<? } ?>
					</td>
				  </tr>
				  <tr bgcolor="#777777" class="nav"> 
					<td width="30%" valign="top" align="right">Name</td>
					<td><input name="name" type="text" class="form" size="40" maxlength="100" value="<? echo $_POST['name']; ?>"></td>
				  </tr>
				  <tr bgcolor="#777777" class="nav"> 
					<td width="30%" valign="top" align="right">Email</td>
					<td><input name="email" type="text" class="form" size="40" maxlength="100" value="<? echo $_POST['email']; ?>"></td>
				  </tr>
				  <tr bgcolor="#777777" class="nav"> 
					<td width="30%" valign="top" align="right">Detailed&nbsp;Message</td>
					<td>
						<textarea name="message" cols="40" rows="5" wrap="VIRTUAL" class="form" id="info"><? if ($_POST['message'] != "") echo $_POST['message']; else if ($_GET['specialMessage'] != "") echo $_GET['specialMessage']; ?></textarea>
					</td>
				  </tr>
				  <tr bgcolor="#777777" class="nav"> 
					<td>&nbsp;</td>
					<td><input type="submit" name="Submit" class="form" value="Send Message"></td>
				  </tr>
				  <tr bgcolor="#777777" class="nav"><td colspan="2">&nbsp;</td></tr>
			</form>		
				<? } ?>
			</table>
		</td>
	</tr>
</table>
