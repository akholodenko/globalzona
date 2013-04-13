<?
	echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";								
?>
		  <tr class="navTall"> 
			<td width="30%" valign="top" align="right">Event Title</td>
			<td width="70%"><input name="eventTitle" id="eventTitle" type="text" class="formLarge" style='width: 250px;' maxlength="40" value="<? echo $_POST['eventTitle']; ?>"></td>
		  </tr>
		  <tr class="navTall"> 
			<td width="30%" valign="top" align="right"><div id="calendar1a">Date</div></td>
			<td width="70%">
				<div id="calendar1b">
				<? 
					calendar_month ($_POST['pMonth'],'pMonthSubmit');
					calendar_day ($_POST['pDay'],'pDaySubmit');
					calendar_year ($_POST['pYear'],'pYearSubmit'); 
				?>
					<span style='padding-left: 20px;'>Weekly&nbsp;Event?</span>
					<input onClick='ShowWeeklyEventForm()' type='checkbox' id='EventFormWeeklyEventCheck'>
				</div>
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
				<div class='spacer' id='EventFormWeeklyEventFormSpacer' style="display: none;">&nbsp;</div>
				<div class='form' id="EventFormWeeklyEventForm" style="display: none;">
					<table class='text' border='0' cellpadding='2' cellspacing='1' width='100%'>
						<tr bgcolor='#333333'>
							<td width='14%' align='center' style='cursor: pointer;' id='DayOfWeek0' onClick="SetDayofWeek(0);" onMouseOver="HighlightDayofWeek(0);" onMouseOut="DimDayofWeek(0);">Sun</td>
							<td width='14%' align='center' style='cursor: pointer;' id='DayOfWeek1' onClick="SetDayofWeek(1);" onMouseOver="HighlightDayofWeek(1);" onMouseOut="DimDayofWeek(1);">Mon</td>
							<td width='14%' align='center' style='cursor: pointer;' id='DayOfWeek2' onClick="SetDayofWeek(2);" onMouseOver="HighlightDayofWeek(2);" onMouseOut="DimDayofWeek(2);">Tue</td>
							<td width='14%' align='center' style='cursor: pointer;' id='DayOfWeek3' onClick="SetDayofWeek(3);" onMouseOver="HighlightDayofWeek(3);" onMouseOut="DimDayofWeek(3);">Wed</td>
							<td width='14%' align='center' style='cursor: pointer;' id='DayOfWeek4' onClick="SetDayofWeek(4);" onMouseOver="HighlightDayofWeek(4);" onMouseOut="DimDayofWeek(4);">Thu</td>
							<td width='14%' align='center' style='cursor: pointer;' id='DayOfWeek5' onClick="SetDayofWeek(5);" onMouseOver="HighlightDayofWeek(5);" onMouseOut="DimDayofWeek(5);">Fri</td>
							<td width='14%' align='center' style='cursor: pointer;' id='DayOfWeek6' onClick="SetDayofWeek(6);" onMouseOver="HighlightDayofWeek(6);" onMouseOut="DimDayofWeek(6);">Sat</td>
						</tr>
						<!--
						<tr bgcolor='#444444'>
							<? for ($i = 0; $i < 7; $i++) echo "<td align='center'><input name='weeklyEvent' id='weeklyEvent' type='radio' value='".$i."'></td>"; ?>							
						</tr>
						-->
					</table>
				</div>
			</td>
		  </tr>		 
		  <tr class="navTall"> 
			<td valign="top" align="right">Flyer&nbsp;Image&nbsp;URL</td>
			<td><input name="flyer" id="flyer" type="text" class="formLarge" style='width: 250px;' value="<? echo $_POST['flyer']; ?>">&nbsp;<font class='textBig'>(*.jpg, *.gif)</font></td>
		  </tr>
		  <tr class="navTall"> 
			<td valign="top" align="right">Guestlist/Tix&nbsp;URL</td>
			<td>
				<input name="guestlist" id="guestlist" type="text" class="formLarge" style='width: 250px;' value="<? echo urldecode($_POST['guestlist']); ?>">
				&nbsp;<a href="#" onclick="return false;" style='color: orange'  class="tooltip" title="To use an email address for guestlist sign-up<br>type in 'mailto:<i>you@domain.com</i>' (no quotes)">(1) sign-up via email</a>
			</td>
		  </tr>		  
		  <tr class="navTall"> 
			<td width="30%" valign="top" align="right">Detailed&nbsp;Message</td>
			<td>
				<textarea onKeyDown="limitText(this.form.message,this.form.countdown,2500);" onKeyUp="limitText(this.form.message,this.form.countdown,2500);" id='message' name="message" style='width: 250px;' rows="5" wrap="VIRTUAL" class="formLarge" id="info"><? echo $_POST['message']; ?></textarea>
				<br>You have <input class='form' readonly type="text" name="countdown" size="3" value="2500"> characters left.
			</td>
		  </tr>
<?
	echo "</table>";
?>
<script>
	ShowWeeklyEventForm();
</script>