<?
	session_start();
	
	include "../classes/allClasses.php"; 
	
	if(Session::ValidateSession())
	{
		$addressBook = Data::GetUserAddressBook($_SESSION['USER_id']);
		$contactCount = count($addressBook);
?>

	<table width="100%" style='padding: 25px;' cellpadding="0" cellspacing='0' border="0">
		<tr>
			<td width="70%" valign='top'>
				<div id='addressBookBodyContent'>
					<?	Layout::DefaultModuleTop('100%', 'Contacts ('.$contactCount.')');	?>
						<div class="moduleText">
							<div id='saveNewContactMessage'></div>
								<?
									if($contactCount > 0)
									{
										for($x = 0; $x < $contactCount; $x++)
										{
											Layout::AddressBookContact($addressBook[$x]);
										}
									}
									else
									{
										Layout::AddressBookContactBlank();
									}
								?>
							
						</div>
					<?	Layout::DefaultModuleBottom();	?>
				</div>
			</td>
			<td width="30%"  valign='top' style='padding-left: 25px;'>
				<?	Layout::DefaultModuleTop('100%', 'Menu');	?>
					<div class="moduleText" style='padding-left: 25px; padding-bottom: 5px;'>
						<a href='#' class='moduleText' onClick="loadNewContact(); return false;">Add New Contact</a>
					</div>
				<?	Layout::DefaultModuleBottom();	?>
			</td>
		</tr>
	</table>
<?	} ?>