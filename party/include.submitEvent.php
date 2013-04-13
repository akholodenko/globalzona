        <table width="100%" border="0" cellspacing="0" cellpadding="1">
	<? 
		if ($_POST['add'] == 'true')
		{
			$actionSubmit = "submitEvent.php?";
			if (eventSubmitValidated()) include "include.submitEvent.confirm.php";
		}
        else if ($_GET['confirm'] == 'true') { 
			include "include.submitEvent.submit.php"; 
			if ($insertEventResult != false) {	?>
				<tr class="text"><td bgcolor="#777777" align="center" colspan="2">
					An email has been sent to <? echo $_GET['email']; ?>, with your password.<br>
					<a href="http://www.globalzona.com/party/eventDetails.php?eventId=<? echo $insertEventResult; ?>">http://www.globalzona.com/party/eventDetails.php?eventId=<? echo $insertEventResult; ?></a>
				</td></tr>	
		<?	}
		} else { ?> 
			<tr>
				<td bgcolor="#555555" class="text">&nbsp;&nbsp;&nbsp;<a href="http://www.globalzona.com/party/contact.php?emailSubject=Submit Weekly Event&specialMessage=please provide your contact info.">set-up up a weekly event</a></td>
				<td bgcolor="#555555" align="right" class="nav">Submit Your Event&nbsp;&nbsp;&nbsp;</td>
			</tr> 
	<? 	} 
		
		if ($_GET['confirm'] != 'true')
		{
			$hiddenFields = "";
			$actionValue = "submitEvent.php";
			include "include.submitEvent.form.php";
			//include "test.submitEvent.php";
		}
		
	?>  		  
        </table>