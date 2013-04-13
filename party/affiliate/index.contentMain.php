<table width="93%" border="0" cellspacing="3" cellpadding="10">
    <tr> 
    	<td bgcolor="#333333" class="text" align="justify">
			<table width="100%" border="0" cellspacing="0" cellpadding="1">
				  <tr class="nav">
					<td bgcolor="#555555" align="right" colspan="2">
						Affiliate Statistics&nbsp;&nbsp;&nbsp;
					</td>
				  </tr>
				  <tr bgcolor="#777777" class="nav"><td colspan="2">&nbsp;</td></tr>		  
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
					<td><textarea name="message" cols="40" rows="5" wrap="VIRTUAL" class="form" id="info"><? echo $_POST['message']; ?></textarea></td>
				  </tr>
				  <tr bgcolor="#777777" class="nav"> 
					<td>&nbsp;</td>
					<td><input type="submit" name="Submit" class="form" value="Submit Event"></td>
				  </tr>
				  <tr bgcolor="#777777" class="nav"><td colspan="2">&nbsp;</td></tr>
			</table>
		</td>
	</tr>
</table>