<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSession())
	{
?>
		edit food 'n drink
		<div style='width: 100%; text-align: center;'>
			<?	Form::Button('saveUpdatedItemButton', 'saveUpdatedItemButton', '', '', 'save', 'onClick="loadPotluqEditedGuestlist('.$_GET['potluq_id'].');"'); ?>
		</div>
<?	}	?>