<?
	$event = Data::GetEventById($_GET['event_id']);	

	Layout::BoxTab('Edit Event');	

	echo "<div class='transparent_wrap float_right clear_both' style='width: 98%;'>";

	echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
	echo "	<form action='process/process_event_edit.php' method='POST'>";
	echo "	<input type='hidden' name='event_id' value='".$event['id']."'>";
	echo "	<tr class='text_body'>";
	echo "		<td width='60'>Title:</td>";
	echo "		<td>";
					Form::Input('title', 'title', 'form', 'width: 400px;', stripslashes(urldecode($event['title'])));
	echo "		</td>";
	echo "	</tr>";
	echo "	<tr class='text_body'>";
	echo "		<td width='60'>Date:</td>";
	echo "		<td>";
					$month_val = date("n",strtotime($event['date']));
					$day_val = date("j",strtotime($event['date']));
					$year_val = date("Y",strtotime($event['date']));
					Form::DateSelect ('form', 'width: 100px;', $month_val, $day_val, $year_val);
	echo "		</td>";
	echo "	</tr>";
	echo "	<tr class='text_body'>";
	echo "		<td width='60'>Venue:</td>";
	echo "		<td>";
					Form::VenueSelect ('form', 'width: 400px;', $event['venue_id']);
	echo "		</td>";
	echo "	</tr>";
	echo "	<tr class='text_body'>";
	echo "		<td>Flyer URL:</td>";
	echo "		<td>";
					Form::Input('flyer_url', 'flyer_url', 'form', 'width: 400px;', stripslashes(urldecode($event['flyer_url'])));
	echo "		</td>";
	echo "	</tr>";
	echo "	<tr class='text_body'>";
	echo "		<td valign='top'>Description:</td>";
	echo "		<td>";
					Form::TextArea('description', 'description', 'form', 'width: 400px; height: 200px;', str_replace("<br/>", "\n", stripslashes(urldecode($event['description']))));
	echo "		</td>";
	echo "	</tr>";
	echo "	<tr class='text_body'>";
	echo "		<td width='60'>Guestlist?:</td>";
	echo "		<td>";
					Form::HasGuestlistSelect ('form', 'width: 200px;',$event['has_guestlist']);
	echo "		</td>";
	echo "	</tr>";
	echo "	<tr class='text_body'>";
	echo "		<td>&nbsp;</td>";
	echo "		<td>";
					Form::ButtonSubmit('submitButton', 'submitButton', '', '', 'submit', '');
	echo "			&nbsp;";
	echo "			<a href='admin_event.php?event_id=".$event['id']."'>cancel</a>";
	echo "		</td>";
	echo "	</tr>";
	echo "	</form>";
	echo "</table>";

	echo "</div>";
?>