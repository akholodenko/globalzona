<table width="93%" border="0" cellspacing="3" cellpadding="10">
    <tr> 
    	<td bgcolor="#333333" class="text" align="justify">
			<? dbGetFAQ(); ?>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">		
			<form action='faq.php?question=1' method='POST' onSubmit="return ValidateFAQ(this)">
				<? 	if ($_GET['question'] == 1) 
					{ 
						sendMail ('FAQ Question', $_POST['question']); ?>
						<tr><td align="center" bgcolor="#444444" class="text">Thank you for your question. It will be added to the FAQ with an answer shortly.</td></tr>
				<?	} ?>	
				<tr>
					<td align="center" bgcolor="#444444" class="spacer"><br>
						<font class="nav">Can't find the right answer? Ask us directly.</font><br>
						<input onClick="this.value='';" id="question" name="question" class="form" size="60" maxlength="500" value="Please type in your question here.">
						<br><br><input type="submit" name="Submit" class="form" value="Send Question"><br><br>
					</td>
				</tr>
			</form>
			</table>
		</td>
	</tr>
</table>