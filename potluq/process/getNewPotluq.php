<?
	session_start();
	
	include "../classes/allClasses.php"; 
	
	if(Session::ValidateSession())
	{
		$addressBook = Data::GetUserAddressBook($_SESSION['USER_id']);
		$contactCount = count($addressBook);

		Layout::DefaultModuleTop('100%', 'Create New Potluq');	
?>
		<div class="moduleText"'>
			<table width='100%' cellpadding='0' cellspacing='0' border='0' style='padding-left: 10px; padding-right: 10px; padding-bottom: 5px;'>
				<tr class='moduleText'>
					<td width='25%' valign='middle'>
						<b>Title</b>
					</td>
					<td width='75%' valign='middle'>
						<?	Form::Input('title', 'title', 'formBig', 'width: 475px;', ''); ?>
					</td>
				</tr>
				<tr class='moduleText'>
					<td width='25%' valign='middle'>
						<b>Date</b>
					</td>
					<td width='75%' valign='middle'>
						<?
							Form::DateSelect ('formBigNarrow');
						?>
					</td>
				</tr>
				<tr class='moduleText'>
					<td width='25%' valign='middle'>
						<b>Location Name</b>
					</td>
					<td width='75%' valign='middle'>
						<?	Form::Input('location_name', 'location_name', 'formBig', 'width: 475px;', ''); ?>
					</td>
				</tr>
				<tr class='moduleText'>
					<td width='25%' valign='middle'>
						<b>Address</b>
					</td>
					<td width='75%' valign='middle'>
						<?	Form::Input('address', 'address', 'formBig', 'width: 475px;', ''); ?>
					</td>
				</tr>
			</table>
		</div>
		<div style='width: 100%; background-color: #fe8300; height: 1px; font-size: 2px; line-height: 1px;'>&nbsp;</div>
		<div class="moduleText">
			<table width='100%' cellpadding='0' cellspacing='0' style='padding: 10px 10px 5px 10px;'>
				<tr class='moduleText'>
					<td width='25%' valign='top'>
						<div>
							<b>Description</b>
						</div>
					</td>
					<td width='75%' valign='top'>
						<textarea onKeyDown="limitText(document.getElementById('description'),document.getElementById('countdown'),1000);" onKeyUp="limitText(document.getElementById('description'),document.getElementById('countdown'),1000);" id='description' name="description" style='width: 475px; height: 150px' rows="5" wrap="VIRTUAL" class="formBig"></textarea>
						<br>You have <input class='formBigNarrow' readonly type="text" id="countdown" name="countdown" size="3" value="1000"> characters left.
					</td>
				</tr>			
			</table>
		</div>
		<div style='width: 100%; background-color: #fe8300; height: 1px; font-size: 2px; line-height: 1px;'>&nbsp;</div>
		<div class="moduleText">
			<table width='100%' cellpadding='0' cellspacing='0' style='padding: 10px 10px 5px 10px;'>
				<tr class='moduleText'>
					<td width='25%' valign='top'>
						<div>
							<b>Guestlist</b>
						</div>
					</td>
					<td width='75%' valign='top'>
						<div id='potluqGuestlist'>
							<?
								$sel1 = null;
								for($x = 0; $x < $contactCount; $x++)
								{
									$sel1[] = array(name => $addressBook[$x][1]." ".$addressBook[$x][2], id => $addressBook[$x][0]);
								}

								sort($sel1);
								Layout::GuestlistForm($sel1, null);
							?>						
						</div>
					</td>
				</tr>			
			</table>
		</div>
		<div style='width: 100%; background-color: #fe8300; height: 1px; font-size: 2px; line-height: 1px;'>&nbsp;</div>
		<div class="moduleText">
			<table width='100%' cellpadding='0' cellspacing='0' style='padding: 10px 10px 5px 10px;'>
				<tr class='moduleText'>
					<td width='25%' valign='top'>
						<div>
							<b>Food 'n Drink</b>
						</div>
					</td>
					<td width='75%' valign='top'>
						<div id='potluqFoodDrinkList'>
							<div id='itemWrap0'>
								<?	Form::Input('item0', 'item0', 'formBig', 'width: 475px;', ''); ?>
							</div>
						</div>
						<div>
							<?	
								Form::Button('addItemMore', 'addItemMore', '', '', 'add more', 'onClick="addNewItem(\'itemWrap0\');"'); 
							?>
						</div>
					</td>
				</tr>			
			</table>
		</div>
		<div style='width: 100%; background-color: #fe8300; height: 1px; font-size: 2px; line-height: 1px;'>&nbsp;</div>
		<div style='text-align: center; padding-top: 10px;'>
			<?	Form::Button('saveButton', 'saveButton', '', '', 'save potluq', 'onClick="saveNewPotluq();"'); ?>
		</div>
<?	
		Layout::DefaultModuleBottom();	
	}
?>