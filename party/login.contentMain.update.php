					<tr class='nav'><td bgcolor='green' align='right' colspan='2'>Event '<? echo $_GET['eventTitle']; ?>' has been updated.&nbsp;&nbsp;&nbsp;</td></tr>							
					<? updateCurrentEvent(); ?>
					<tr class='text'>
						<td bgcolor='#777777' align='center' colspan='2'>
							Event URL: 
								<a href="http://www.globalzona.com/party/eventDetails.php?eventId=<? echo $_GET['eventId']; ?>">
									http://www.globalzona.com/party/eventDetails.php?eventId=<? echo $_GET['eventId']; ?>
								</a>
							&nbsp;&nbsp;&nbsp;
						</td>
					</tr>		