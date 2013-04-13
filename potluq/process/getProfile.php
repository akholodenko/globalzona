<? 
	session_start();
	
	include "../classes/allClasses.php"; 
	
	if(Session::ValidateSession())
	{
?>
		<table width="100%" style='padding: 25px;' cellpadding="0" cellspacing='0' border="0">
			<tr>
				<td width="70%" valign='top'>
					<div id='profileBodyContent'>
						<?	Layout::DefaultModuleTop('100%', 'Personal Details');	?>
							<div class="moduleText">
								<table id='rowPotluq' width='100%' cellpadding='0' cellspacing='0' style='padding-left: 10px; padding-right: 10px;'>
								<?
									if($_GET['message'] != '')
									{
										echo "<tr class='moduleText' style='height: 25px'>";
										echo "	<td width='25%' valign='middle'>&nbsp;</td>";
										echo "	<td width='75%' valign='middle'>".Layout::Message($_GET['message'], true)."</td>";
										echo "</tr>";
									}
								?>
									<tr class='moduleText' style='height: 25px'>
										<td width='25%' valign='middle'><b>First Name</b></td>
										<td width='75%' valign='middle'>
											<?	Form::Input('f_name', 'f_name', 'formBig', 'width: 400px; padding-left: 3px;', $_SESSION['USER_f_name']); ?>
										</td>
									</tr>
									<tr class='moduleText' style='height: 25px'>
										<td width='25%' valign='middle'><b>Last Name</b></td>
										<td width='75%' valign='middle'>
											<?	Form::Input('l_name', 'l_name', 'formBig', 'width: 400px; padding-left: 3px;', $_SESSION['USER_l_name']); ?>
										</td>
									</tr>
									<tr class='moduleText' style='height: 25px'>
										<td width='25%' valign='middle'><b>Email</b></td>
										<td width='75%' valign='middle'>
											<?	Form::Input('email', 'email', 'formBig', 'width: 400px; padding-left: 3px;', $_SESSION['USER_email']); ?>
										</td>
									</tr>
									<tr class='moduleText' style='height: 25px'>
										<td width='25%' valign='middle'><b>Password</b></td>
										<td width='75%' valign='middle'>
											<?	Form::Password('password', 'password', 'formBig', 'width: 400px; padding-left: 3px;', $_SESSION['USER_password']); ?>
										</td>
									</tr>
									<tr class='moduleText' style='height: 25px'>
										<td width='25%' valign='middle'><b>Confirm Password</b></td>
										<td width='75%' valign='middle'>
											<?	Form::Password('password_confirm', 'password_confirm', 'formBig', 'width: 400px; padding-left: 3px;', $_SESSION['USER_password']); ?>
										</td>
									</tr>
									<tr>
										<td colspan='2' align='center'>
											<?	
												Form::Button('saveUpdatedProfileButton', 'saveUpdatedProfileButton', '', 'margin-right: 5px;', 'save profile', 'onClick="updateProfile('.$_SESSION['USER_id'].');"');
												Form::Button('cancelProfileButton', 'cancelProfileButton', '', '', 'cancel', 'onClick="cancelProfile();"'); 
											?>
										</td>
									</tr>
								</table>
							</div>
						<?	Layout::DefaultModuleBottom();	?>
					</div>
				</td>
				<td width="30%"  valign='top' style='padding-left: 25px;'>&nbsp;</td>
			</tr>
		</table>
<? } ?>