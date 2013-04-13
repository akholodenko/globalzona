<?
	$layout->bubbleSubBoxTop(100);

	echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
	echo "	<tr class='nav'>";
	echo "		<td class='lightGradient'>&nbsp;&nbsp;&nbsp;Party Information</td>";
	echo "	</tr>";								
	echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
	echo "	<tr><td align='center'>";
	echo "		<table cellpadding=2 cellspacing=0 border=0 width='98%'>";								
?>
		  <tr class="navTall"> 
			<td width="30%" valign="top" align="right">Event Title</td>
			<td width="70%"><input name="eventTitle" id="eventTitle" type="text" class="formLarge" style='width: 250px;' maxlength="30" value="<? echo $_POST['eventTitle']; ?>"></td>
		  </tr>
		  <tr class="navTall"> 
			<td width="30%" valign="top" align="right"><div id="calendar1a">Date</div></td>
			<td width="70%"><div id="calendar1b">
				<? 
					calendar_month ($_POST['pMonth'],'pMonthSubmit');
					calendar_day ($_POST['pDay'],'pDaySubmit');
					calendar_year ($_POST['pYear'],'pYearSubmit'); 
				?></div>
			</td>		
		  </tr>
		  <tr class="navTall"> 
			<td width="30%" valign="top" align="right"><div id="calendar2a">Time</div></td>
			<td width="70%"><div id="calendar2b">
				<? 
					calendar_hour ($_POST['hour']);
					calendar_minute ($_POST['minute']);
					calendar_ampm ($_POST['ampm']); 
				?></div>
			</td>
		  </tr>		  
		  <tr class="navTall"> 
			<td valign="top" align="right">Flyer&nbsp;Image&nbsp;URL</td>
			<td><input name="flyer" id="flyer" type="text" class="formLarge" id="flyer" style='width: 250px;' value="<? echo $_POST['flyer']; ?>">&nbsp;<font class='textBig'>(*.jpg, *.gif)</font></td>
		  </tr>
		  <tr class="navTall"> 
			<td valign="top" align="right">Guestlist/Tix&nbsp;URL</td>
			<td>
				<input name="guestlist" id="guestlist" type="text" class="formLarge" id="flyer" style='width: 250px;' value="<? echo urldecode($_POST['guestlist']); ?>">
				&nbsp;<a href="#" onclick="return false;" style='color: orange'  class="tooltip" title="To use an email address for guestlist sign-up<br>type in 'mailto:<i>you@domain.com</i>' (no quotes)">(1) sign-up via email</a>
			</td>
		  </tr>		  
		  <tr class="navTall"> 
			<td width="30%" valign="top" align="right">Detailed&nbsp;Message</td>
			<td>
				<textarea onKeyDown="limitText(this.form.message,this.form.countdown,1000);" onKeyUp="limitText(this.form.message,this.form.countdown,1000);" id='message' name="message" style='width: 250px;' rows="5" wrap="VIRTUAL" class="formLarge" id="info"><? echo $_POST['message']; ?></textarea>
				<br>You have <input class='form' readonly type="text" name="countdown" size="3" value="1000"> characters left.
			</td>
		  </tr>
<?
	echo "		</table>";
	echo "	</td></tr>";
	echo "</table>";
	$layout->bubbleSubBoxBottom();	
?>