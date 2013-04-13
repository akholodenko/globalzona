<table width='250' cellpadding='0' cellspacing='5' border='0' align='center'>
	<form action='admin_validate.php' method='POST'>
	<input type='hidden' name='type' value='login'>
	<tr class='text_message'>
		<td>&nbsp;</td>
		<td>
			<?	echo $_GET['message']; ?>
		</td>
	</tr>
	<tr class='text_body'>
		<td width='30%' valign='middle'>
			<b>username:</b>
		</td>
		<td width='70%' valign='middle'>
			<?	Form::Input('username', 'username', 'form', '', ''); ?>
		</td>
	</tr>
	<tr class='text_body'>
		<td valign='middle'>
			<b>password:</b>
		</td>
		<td valign='middle'>
			<?	Form::Password('password', 'password', 'form', '', ''); ?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
			<?	Form::ButtonSubmit('loginButton', 'loginButton', '', '', 'log-in', '');	?>
		</td>
	</tr>
	</form>
</table>