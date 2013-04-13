 				<tr class="nav"><td bgcolor="#555555" align="right" colspan="2">Identify Confirmed&nbsp;&nbsp;&nbsp;</td></tr>
				<? 
					if ($_GET['eventId'] != "")
					{
						if ($_GET['delete'] == "true") //user wants to delete event
						{
							$eventInfo = dbFindEvent($_GET['eventId']); ?>
							<tr class='text'>
								<td bgcolor='#777777' colspan='2' align='center'><br>Are you sure you want to delete <b><? echo urldecode($eventInfo['eventTitle']); ?></b>?
									<table width="100%" cellpadding="0" cellspacing='3' border="0">
										<tr><td align="right">
											<form action="login.php?eventId=<? echo $_GET['eventId']; ?>" method="post">
												<input type="hidden" name="xyz" value="<? echo $_GET['eventId']; ?>">
												<input type="hidden" name="emailLog" value="<? echo $_POST['emailLog']; ?>">
												<input type="hidden" name="passwordLog" value="<? echo $_POST['passwordLog']; ?>">
												<input type="hidden" name="login" value="true">
												<input class='form' type='submit' value='yes'>
											</form>
										</td><td>
											<form action="login.php" method="post">
												<input type="hidden" name="xyz" value="-1">								
												<input class='form' type='submit' value='no'>
											</form>
										</td></tr>		
									</table>						
								</td>
							</tr>	
						<? deleteCurrentEvent ($_GET['eventId']);
						}
						else if ($_GET['edit'] == "true")	//user wants to edit event
						{
							if ($_POST['add'] == 'true')
							{
								$actionSubmit = "login.php?eventId=".$_GET['eventId']."&";
								if (eventSubmitValidated ()) include "include.submitEvent.confirm.php";
							}
							$actionConfirm = "login.php?edit=true&eventId=".$_GET['eventId'];	//set action value for the submit event form
							$hiddenFields = "<input name='emailLog' value='".$_POST['emailLog']."' type='hidden'>";
							$hiddenFields = $hiddenFields."<input name='passwordLog' value='".$_POST['passwordLog']."' type='hidden'>";
							$hiddenFields = $hiddenFields."<input name='login' value='true' type='hidden'>";					
							include "include.submitEvent.form.php"; 
						}
					}
					else echo "<tr class='text'><td bgcolor='#777777' colspan='2' align='center'>No event was selected to be edited.</td></tr>";
				?>				