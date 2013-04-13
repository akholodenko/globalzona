				<tr class="nav"><td bgcolor="#555555" align="right" colspan="2">Confirm Your Ownership&nbsp;&nbsp;&nbsp;</td></tr>
				<tr class="nav" bgcolor="#777777"><td colspan="2" valign="top" align="right">&nbsp;</td></tr>				 
				<? if ($_POST['login'] == "true") { ?>			
				<tr bgcolor="#dddddd" class="nav">
					<td colspan="2" align="center"><font color="black">The email and/or password did not match our records.</font></td>
				</tr>	
				<? } ?>
				<tr bgcolor="#777777" class="text">
					<td colspan="2" align="center">An event may only be edited or deleted by the individual who created the post.</td>
				</tr>	
			<form action="login.php?eventId=<? echo $_GET['eventId']; ?>&edit=<? echo $_GET['edit']; ?>&delete=<? echo $_GET['delete']; ?>" method="post">
				<input type="hidden" name="login" value="true">
				<? include "include.eventHiddenFields.php"; ?>
				<tr class="nav" bgcolor="#777777">
					<td width="30%" valign="top" align="right">Email</td>
            		<td width="70%"><input name="emailLog" type="text" class="form" size="30" maxlength="100" value="<? echo $_POST['emailLog']; ?>"></td>
				</tr>				 
				<tr class="nav" bgcolor="#777777">
					<td width="30%" valign="top" align="right">Password</td>
            		<td width="70%"><input name="passwordLog" type="password" class="form" size="30" maxlength="100" value="<? echo $_POST['passwordLog']; ?>"></td>
				</tr>
				<tr class="nav" bgcolor="#777777">
					<td>&nbsp;</td>
					<td valign="top"><input type="submit" name="Submit" class="form" value="Confirm Identity"></td>
				</tr>
			 </form>