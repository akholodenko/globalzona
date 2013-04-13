<?
	Layout::AdminPageMessage(stripslashes(urldecode($_GET['message'])));

	$count_events = Data::GetEventsCount("future");
	$count_events = $count_events['count_events'];

	$count_past_events = Data::GetEventsCount("past");
	$count_past_events = $count_past_events['count_events'];

	echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
	echo "	<tr>";
	echo "		<td valign='top'>";
					echo "<div id='tab_past_events' class='box_top_large text_tab transparent_off'>";
					echo "	Past&nbsp;Events&nbsp;(".$count_past_events.")";
					echo "</div>";
					echo "<div id='tab_upcoming_events' class='box_top_large text_tab transparent'>";
					echo "	Upcoming&nbsp;Events&nbsp;(".$count_events.")";
					echo "</div>";
					Layout::EventList(Data::GetEvents("future"), 'upcoming_event_list');
					Layout::EventList(Data::GetEvents("past"), 'past_event_list');
	echo "		</td>";
	echo "		<td width='25'>&nbsp;</td>";
	echo "		<td width='485' valign='top' style='padding-right: 5px;'>";
					Layout::BoxTab('Add Event');
	echo "			<div class='transparent_wrap float_right clear_both'>";						
						Form::AddEventForm();
	echo "			</div>";
	echo "</td></tr></table>";
?>