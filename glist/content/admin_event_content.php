<?
	Layout::AdminPageMessage(stripslashes(urldecode($_GET['message'])));
	
	if($_GET['event_id'] != "")
	{
		$event = Data::GetEventById($_GET['event_id']);	
		$event_guestlist_count = Data::GetGuestlistByEventIdCount($_GET['event_id']);
		$event_guestlist_count = $event_guestlist_count['count_guestlist'];

		echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
		echo "	<tr class='text_body'>";
		echo "		<td colspan='2'>";
		echo "			<span style='font-weight: bold'>Event Information</span>";
		echo "			<span style='margin-left: 15px;'>|</span>";
		echo "			<span style='margin-left: 15px;'><a href='admin_event_edit.php?event_id=".$event['id']."'>edit</a></span>";
		echo "			<span style='margin-left: 15px;'><a href='process/process_event_delete.php?event_id=".$event['id']."' onClick=\"return ConfirmDeleteEvent()\">delete</a></span>";
		echo "			<span style='margin-left: 15px;'>|</span>";
		echo "			<span style='margin-left: 15px;'><a target='_blank' href='admin_event_guestlist.php?event_id=".$event['id']."'>guestlist (".$event_guestlist_count.")</a></span>";
		echo "			<span style='margin-left: 15px;'><a target='_blank' href='admin_event_sign_up.php?event_id=".$event['id']."'>sign-up</a></span>";
//		echo "			<span style='margin-left: 15px;'><a target='_blank' href='admin_event_sign_up.php?html_content=true&noform=true&event_id=".$event['id']."'>html</a></span>";
		echo "			<span style='margin-left: 15px;'><a target='_blank' href='admin_event_html.php?event_id=".$event['id']."'>html</a></span>";
		echo "		</td>";
		echo "	</tr>";
		echo "	<tr>";
		echo "		<td colspan='2'><hr style='color: #9dca3a;' noshade size='1'></td>";
		echo "	</tr>";
		echo "</table>";
		
		Layout::EventDetails ($event, false);
	}
?>