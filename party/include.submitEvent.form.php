<form action="<? echo $actionConfirm; ?>" method="post">
		<input name="add" value="true" type="hidden">
		<? echo $hiddenFields; ?>		
          <tr class="nav"><td bgcolor="#dddddd" colspan="2">&nbsp;&nbsp;&nbsp;<font color="#000000">Party Information</font></td></tr>		
          <tr bgcolor="#777777" class="nav"><td colspan="2">&nbsp;</td></tr>		  
          <tr bgcolor="#777777" class="nav"> 
            <td width="30%" valign="top" align="right">Event Title</td>
            <td width="70%"><input name="eventTitle" type="text" class="form" size="31" maxlength="30" value="<? echo stripslashes(urldecode($_POST['eventTitle'])); ?>"></td>
          </tr>
          <tr bgcolor="#777777" class="nav"> 
            <td width="30%" valign="top" align="right">Date</td>
            <td width="70%">
				<? 
					calendar_month ($_POST['pMonth'],'pMonthSubmit');
					calendar_day ($_POST['pDay'],'pDaySubmit');
					calendar_year ($_POST['pYear'],'pYearSubmit'); 
				?>
			</td>
          </tr>
          <tr bgcolor="#777777" class="nav"> 
            <td width="30%" valign="top" align="right">Time</td>
            <td width="70%">
				<? 
					calendar_hour ($_POST['hour']);
					calendar_minute ($_POST['minute']);
					calendar_ampm ($_POST['ampm']); 
				?>
			</td>
          </tr>		  
          <tr bgcolor="#777777" class="nav"> 
            <td valign="top" align="right">Flyer&nbsp;Image&nbsp;URL</td>
            <td><input name="flyer" type="text" class="form" id="flyer" size="40" value="<? echo $_POST['flyer']; ?>">&nbsp;<font class='text'>(*.jpg, *.gif)</font></td>
          </tr>
          <tr bgcolor="#777777" class="nav"> 
            <td valign="top" align="right">Guestlist/Buy&nbsp;Tix&nbsp;URL</td>
            <td><input name="guestlist" type="text" class="form" id="flyer" size="40" value="<? echo urldecode($_POST['guestlist']); ?>">&nbsp;<a href="#guestlistInfo" class="tooltip" title="To use an email address for guestlist sign-up, type in 'mailto:[email here]'">(1) sign-up via email</a></td>
          </tr>		  
          <tr bgcolor="#777777" class="nav"> 
            <td width="30%" valign="top" align="right">Detailed&nbsp;Message</td>
            <td><textarea name="message" cols="40" rows="5" wrap="VIRTUAL" class="form" id="info"><? echo stripslashes(urldecode($_POST['message'])); ?></textarea></td>
          </tr>
          <tr bgcolor="#777777" class="nav"><td colspan="2">&nbsp;</td></tr>
          <tr class="nav"><td bgcolor="#dddddd" colspan="2">&nbsp;&nbsp;&nbsp;<font color="#000000">Venue Information</font></td></tr>				  
          <tr bgcolor="#777777" class="nav"><td colspan="2">&nbsp;</td></tr>		  		  		  		  
          <tr bgcolor="#777777" class="nav"> 
            <td width="30%" valign="top" align="right">Venue Name</td>
            <td width="70%"><input name="venueName" type="text" class="form" size="33" maxlength="30" value="<? echo stripslashes(urldecode($_POST['venueName'])); ?>"></td>
          </tr>		  
          <tr bgcolor="#777777" class="nav"> 
            <td width="30%" valign="top" align="right">Address</td>
            <td width="70%"><input name="address" type="text" class="form" size="40" maxlength="100" value="<? echo $_POST['address']; ?>"></td>
          </tr>		  		  
          <tr bgcolor="#777777" class="nav">
            <td width="30%" valign="top" align="right">City</td>
            <td><? dbGetCity('dropDown', $_POST['city']); ?></td>
          </tr>
	<? if ($_GET['edit'] == "true") { ?>
			<input name="email" type="hidden" value="<? echo $_POST['emailLog']; ?>">
			<input name="name" type="hidden" value="<? echo $_POST['name']; ?>">
			<input name="password" type="hidden" value="<? echo $_POST['passwordLog']; ?>">						
	<? } else { ?>
          <tr bgcolor="#777777" class="nav"><td colspan="2">&nbsp;</td></tr>
          <tr class="nav"><td bgcolor="#dddddd" colspan="2">&nbsp;&nbsp;&nbsp;<font color="#000000">Host Information</font></td></tr>				  
          <tr bgcolor="#777777" class="nav"><td colspan="2">&nbsp;</td></tr>		  
          <tr bgcolor="#777777" class="nav"> 
            <td width="30%" valign="top" align="right">Name</td>
            <td width="70%"><input name="name" type="text" class="form" size="40" value="<? echo $_POST['name']; ?>">&nbsp;<a href="#guestlistInfo">(2) purpose for info.</a></td>
          </tr>		  
          <tr bgcolor="#777777" class="nav"> 
            <td width="30%" valign="top" align="right">Email</td>
            <td><input name="email" type="text" class="form" id="email" size="40" value="<? echo $_POST['email']; ?>"></td>
          </tr>
          <tr bgcolor="#777777" class="nav"> 
            <td width="30%" valign="top" align="right">Password</td>
            <td><input name="password" type="password" class="form" id="email" size="40" value="<? echo $_POST['password']; ?>"></td>
          </tr>		  
	<? } ?>
          <tr bgcolor="#777777" class="nav"><td colspan="2"><hr size="1" color="#dddddd" noshade></td></tr>
          <tr bgcolor="#777777" class="nav"> 
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" class="form" value="Submit Event"></td>
          </tr>
	</form>		  
          <tr bgcolor="#777777" class="nav">
		  	<td colspan="2">
		  		<a name="guestlistInfo">&nbsp;&nbsp;&nbsp;(1) To use an email address for guestlist sign-up, type in "mailto:[email here]".</a>
		  		<br><a name="hostDiscInfo">&nbsp;&nbsp;&nbsp;(2) This information will not be shown to visitors; used for post editing only.</a>				
			</td>
		  </tr>
          <tr bgcolor="#777777" class="nav"><td colspan="2">&nbsp;</td></tr>