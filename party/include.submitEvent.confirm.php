		<tr class="nav"> 
            <td bgcolor="orange" colspan="2">&nbsp;&nbsp;&nbsp;<font color="#000000">Please confirm your event</font>
				<table width="100%" cellpadding="2" cellspacing="1" border="0"  bgcolor="#444444">
					<tr><td class="nav" colspan="2" align="center"><? echo stripslashes(urldecode($_POST['eventTitle'])).' on '.$_POST['pMonth'].'/'.$_POST['pDay'].'/'.$_POST['pYear'].' at '.$_POST['hour'].':'.$_POST['minute'].' '.$_POST['ampm']; ?></td></tr>
					<tr>
						<td width="30%" align="right" class="nav" valign="top">Flyer Image URL:</td>
						<td class="text"><? echo $_POST['flyer']; ?></td>						
					</tr>
					<tr>
						<td width="30%" align="right" class="nav" valign="top">Guestlist URL:</td>
						<td class="text"><? echo $_POST['guestlist']; ?></td>						
					</tr>
					<tr>
						<td width="30%" align="right" class="nav" valign="top">Detailed Message:</td>
						<td class="text"><? echo stripslashes(urldecode($_POST['message'])); ?></td>						
					</tr>
					<tr>
						<td width="30%" align="right" class="nav" valign="top">Venue Name:</td>
						<td class="text"><? echo stripslashes($_POST['venueName']); ?></td>						
					</tr>
					<tr>
						<td width="30%" align="right" class="nav" valign="top">Address:</td>
						<td class="text"><? echo $_POST['address'].', '.dbFindCity($_POST['city']).', '.dbFindState($_POST['city']); ?></td>						
					</tr>
					<tr>
						<td width="30%" align="right" class="nav" valign="top">Host Name:</td>
						<td class="text"><? echo $_POST['name']; ?></td>						
					</tr>
					<tr>
						<td width="30%" align="right" class="nav" valign="top">Host Email:</td>
						<td class="text"><? echo $_POST['email']; ?></td>						
					</tr>
					<tr>
						<td width="30%" align="right" class="nav" valign="top">Password:</td>
						<td class="text">an email with the password will be sent to the email address provided</td>						
					</tr>																																			
				</table>				
				<div align="right" class="text"><font color="#000000">Scroll down to edit or click </font><a href="<? echo $actionSubmit; ?>confirm=true&state=<? echo dbFindState($_POST['city']); ?>&<? echo getPostParams(); ?>"><font color="#000000"><b>confirm</b></font></a>&nbsp;&nbsp;&nbsp;</div>
			</td>
          </tr>