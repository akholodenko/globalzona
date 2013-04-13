<?
	$layout = new Layout();
	$layout->contentBoxTop("Registration Confirmation");
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
			<input type="hidden" name="register" value="true">
			<tr class="nav">
				<td bgcolor="#dddddd">&nbsp;&nbsp;&nbsp;<font color="#000000">Thank you for registering!</font></td>
			</tr>		
			<tr><td class="spacer">&nbsp;</td></tr>
			<tr class="text" bgcolor="#777777">
				<td>
					&nbsp;&nbsp;An email has been sent to <b><? echo $_POST["email"]?></b> with confirmation information.
					<br>&nbsp;&nbsp;You can now access your account after confirming, by <a href='login.php'>logging in</a>.
				</td>
			</tr>			
	</table>
<?	$layout->contentBoxBottom(); ?>