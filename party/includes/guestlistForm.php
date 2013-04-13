<table width='100%' cellpadding='1' cellspacing='0' border='0' align='center'>
	<form onSubmit='return check_submitGuestList(this);' action='process.GuestList.php?eventId=<? echo $_GET['eventId']; ?>&guestListURL=<? echo $eventDetails['guestListURL']; ?>' method='POST'>
		<tr class='nav'><td colspan='2' align='center' class='lightGradient'>Get on the guestlist</td></tr>
		<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>
		<tr class='text'><td width='15%'>&nbsp;</td><td><input onClick="if(document.getElementById('firstname').value=='First Name') document.getElementById('firstname').value='';" type='text' id='firstname' name='firstname' class='form' size='20' maxlength='50' value='First Name'></td></tr>
		<tr class='text'><td width='15%'>&nbsp;</td><td><input onClick="if(document.getElementById('lastname').value=='Last Name') document.getElementById('lastname').value='';" type='text' id='lastname' name='lastname' class='form' size='20' maxlength='50' value='Last Name'></td></tr>
		<tr class='text'><td width='15%'>&nbsp;</td><td><input onClick="if(document.getElementById('email2').value=='Email') document.getElementById('email2').value='';" type='text' id='email2' name='email2' class='form' size='20' maxlength='50' value='Email'></td></tr>
		<tr class='text'><td width='15%'>&nbsp;</td><td><input type='submit' name='submit' value='register' class='form'></td></tr>					
	</form>
</table>