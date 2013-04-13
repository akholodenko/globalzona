<table width="100%" cellpadding="25" cellspacing='0' border="0">
	<tr>
		<form action='validate.php' method='POST' onSubmit="return validateSignup(this);">
			<input type='hidden' name='type' value='signup'>
			<td width="45%" align="center">
				<?	Layout::DefaultModuleTop('300px', 'Sign-up');	?>
					<div class="moduleText">
						<input type='text' name='f_name' id='firstName' class='formBig' value='<? echo FORM_PLACEHOLDER_FIRST_NAME; ?>'><br>
						<input type='text' name='l_name' id='lastName' class='formBig' value='<? echo FORM_PLACEHOLDER_LAST_NAME; ?>'><br>
						<input type='text' name='email' id='email' class='formBig' value='<? echo FORM_PLACEHOLDER_EMAIL; ?>'><br>
						<input type='text' name='password' id='password' class='formBig' onClick="passwordOnClick(this,'<? echo FORM_PLACEHOLDER_PASSWORD; ?>');" value='<? echo FORM_PLACEHOLDER_PASSWORD; ?>'><br>
						<input type='submit' name='submitSignUp' id='submitSignUp' class='formBigButton' value='Submit'>
					</div>
				<?	Layout::DefaultModuleBottom();	?>
			</td>
		</form>
		<td width="10%" align='center' class='moduleHeaderText'>OR</td>
		<form action='validate.php' method='POST'>
			<input type='hidden' name='type' value='login'>
			<td width="45%"  align="center" valign='top'>
				<?	Layout::DefaultModuleTop('300px', 'Log-in');	?>
					<div class="moduleText">
						<input type='text' name='email' id='email' class='formBig' value=''><br>
						<input type='password' name='password' id='password' class='formBig' value=''><br>
						<input type='submit' name='submitLogIn' id='submitLogIn' class='formBigButton' value='Submit'>
					</div>
				<?	Layout::DefaultModuleBottom();	?>
			</td>
		</form>
	</tr>
</table>