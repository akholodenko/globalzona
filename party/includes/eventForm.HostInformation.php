<?
	$layout->bubbleBoxSpacer();
	$layout->bubbleSubBoxTop(100);

	echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
	echo "	<tr class='nav'>";
	echo "		<td class='lightGradient'>&nbsp;&nbsp;&nbsp;Host Information</td>";
	echo "	</tr>";								
	echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
	echo "	<tr><td align='center'>";
	echo "		<table cellpadding=2 cellspacing=0 border=0 width='98%'>";								
?>
	  <tr class="navTall"> 
		<td width="30%" valign="top" align="right">Name</td>
		<td width="70%">
			<input name="name" id="name" type="text" class="formLarge" style='width: 250px;' value="<? echo $_POST['name']; ?>">
			&nbsp;<a href="#" onclick="return false;" style='color: orange'  class="tooltip" title="This information will not be shown to<br>visitors; used for post editing only.">(2) purpose for info.</a>
		</td>
	  </tr>		  
	  <tr class="navTall"> 
		<td valign="top" align="right">Email</td>
		<td><input name="email" id="email" type="text" class="formLarge" id="email" style='width: 250px;' value="<? echo $_POST['email']; ?>"></td>
	  </tr>
	  <tr class="navTall"> 
		<td valign="top" align="right">Password</td>
		<td><input name="password" id="password" type="password" class="formLarge" id="email" maxlength='50' style='width: 250px;' value="<? echo $_POST['password']; ?>"></td>
	  </tr>		  
<?
	echo "		</table>";
	echo "	</td></tr>";
	echo "</table>";
	$layout->bubbleSubBoxBottom();	
?>