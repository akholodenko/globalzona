<?
	$layout->bubbleBoxSpacer();
	$layout->bubbleSubBoxTop(100);

	echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
	echo "	<tr class='nav'>";
	echo "		<td class='lightGradient'>&nbsp;&nbsp;&nbsp;Venue Information</td>";
	echo "	</tr>";								
	echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
	echo "	<tr><td align='center'>";
	echo "		<table cellpadding=2 cellspacing=0 border=0 width='98%'>";								
?>
		  <tr class="navTall"> 
			<td width="30%" valign="top" align="right">Venue Name</td>
			<td width="70%"><input name="venueName" id='venueName' type="text" class="formLarge" style='width: 250px;' maxlength="30" value="<? echo $_POST['venueName']; ?>"></td>
		  </tr>		  
		  <tr class="navTall"> 
			<td width="30%" valign="top" align="right">Address</td>
			<td width="70%"><input name="address" id='address' type="text" class="formLarge" style='width: 250px;' maxlength="100" value="<? echo $_POST['address']; ?>"></td>
		  </tr>		  		  
		  <tr class="navTall">
			<td width="30%" valign="top" align="right"><div id="calendar3a">City</div></td>
			<td><div id="calendar3b"><? dbGetCity('dropDown', $_POST['city']); ?></div></td>
		  </tr>	  
<?
	echo "		</table>";
	echo "	</td></tr>";
	echo "</table>";
	$layout->bubbleSubBoxBottom();	
?>