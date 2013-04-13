<?
	session_start();

	include "../classes/allClasses.php";

	if(Session::ValidateSession())
	{
		$address_book_remaining = Data::GetUserRemainingAddressBook ($_SESSION['USER_id'], $_GET['potluq_id']);
		$potluq_guestlist = Data::GetPotluqGuestlistById($_GET['potluq_id']);

		$sel1 = array();
		for($x = 0; $x < count($address_book_remaining); $x++)
		{
			$sel1[] = array(name => $address_book_remaining[$x]['f_name']." ".$address_book_remaining[$x]['l_name'], id => $address_book_remaining[$x]['id']);
		}

		sort($sel1);

		$sel2 = array();
		for($x = 0; $x < count($potluq_guestlist); $x++)
		{
			$sel2[] = array(name => $potluq_guestlist[$x]['f_name']." ".$potluq_guestlist[$x]['l_name'], id => $potluq_guestlist[$x]['address_book_id']);
		}

		sort($sel2);
		Layout::GuestlistForm($sel1, $sel2);
?>	
	<div style='width: 100%; text-align: center;'>
		<?	Form::Button('saveUpdatedGuestlistButton', 'saveUpdatedGuestlistButton', '', '', 'save', 'onClick="loadPotluqEditedGuestlist('.$_GET['potluq_id'].');"'); ?>
	</div>
<?	}	?>