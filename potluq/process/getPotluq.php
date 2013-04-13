<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSession())
	{
		$potluq = Data::GetPotluqById($_GET['potluq_id']);

		$potluq_guestlist = Data::GetPotluqGuestlistById($_GET['potluq_id']);
		$potluq_guestlist_confirmed_count = Data::GetPotluqGuestlistConfirmedCountById($_GET['potluq_id']);
		$potluq_guestlist_confirmed_count = $potluq_guestlist_confirmed_count[0];
		$potluq_guestlist_awaiting_count = Data::GetPotluqGuestlistAwaitingCountById($_GET['potluq_id']);
		$potluq_guestlist_awaiting_count = $potluq_guestlist_awaiting_count[0];

		$potluq_items = Data::GetPotluqItemsById($_GET['potluq_id']);		
		$potluq_items_remaining_count = Data::GetPotluqItemsRemainingCountById($_GET['potluq_id']);
		$potluq_items_remaining_count = $potluq_items_remaining_count[0];
		$potluq_items_assigned_count = Data::GetPotluqItemsAssignedCountById($_GET['potluq_id']);
		$potluq_items_assigned_count = $potluq_items_assigned_count[0];

		Layout::DefaultModuleTop('100%', stripslashes(urldecode($potluq['title'])));	
?>
		<div class="moduleText">
			<?	Layout::PotluqBasics($potluq);	?>
		</div>
		<div style='width: 100%; background-color: #fe8300; height: 1px; font-size: 2px; line-height: 1px;'>&nbsp;</div>
		<div class="moduleText">
			<?	Layout::PotluqGuestlist($potluq_guestlist, $potluq_guestlist_confirmed_count, $potluq_guestlist_awaiting_count);	?>
		</div>
		<div style='width: 100%; background-color: #fe8300; height: 1px; font-size: 2px; line-height: 1px;'>&nbsp;</div>
		<div class="moduleText">
			<?	Layout::PotluqItems($potluq_items, $potluq_items_assigned_count, $potluq_items_remaining_count);	?>
		</div>
<?		
		Layout::DefaultModuleBottom();	
	}
?>