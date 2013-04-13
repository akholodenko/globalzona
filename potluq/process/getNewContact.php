<?
	include "../classes/allClasses.php";

	Layout::DefaultModuleTop('100%', 'Add New Contact');	?>
	<div class="moduleText"'>
		<table width='100%' cellpadding='0' cellspacing='0' border='0' style='padding-left: 10px; padding-right: 10px; padding-bottom: 5px;'>
			<tr class='moduleText'>
				<td width='25%' valign='middle'>
					<b>First Name</b>
				</td>
				<td width='75%' valign='middle'>
					<?	Form::Input('f_name', 'f_name', 'formBig', 'width: 400px;', ''); ?>
				</td>
			</tr>
			<tr class='moduleText'>
				<td width='25%' valign='middle'>
					<b>Last Name</b>
				</td>
				<td width='75%' valign='middle'>
					<?	Form::Input('l_name', 'l_name', 'formBig', 'width: 400px;', ''); ?>
				</td>
			</tr>
			<tr class='moduleText'>
				<td width='25%' valign='middle'>
					<b>Email</b>
				</td>
				<td width='75%' valign='middle'>
					<?	Form::Input('email', 'email', 'formBig', 'width: 400px;', ''); ?>
				</td>
			</tr>
		</table>
	</div>
	<div style='text-align: center;'>
		<?	
			Form::Button('saveButton', 'saveButton', '', 'margin-right: 5px;', 'save contact', 'onClick="saveNewContact();"');		
			Form::Button('cancelButton', 'cancelButton', '', '', 'cancel', 'onClick="cancelContact();"'); 
		?>
	</div>
<?	Layout::DefaultModuleBottom();	?>