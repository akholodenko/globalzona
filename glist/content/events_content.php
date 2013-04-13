<?
	include "../classes/allClasses.php";

	if ($_GET['pastevents'] == "true") $isPastEvents = true;
	else $isPastEvents = false;

	$upcomingText = "<span style='font-size: 11px;'>Upcoming Events</span>";
	$upcomingLink = "<a href='#' onClick=\"loadData('content/events_content.php'); return false;\">".$upcomingText."</a>";

	$pastText = "<span style='font-size: 11px;'>Past Events</span>";
	$pastLink = "<a href='#' onClick=\"loadData('content/events_content.php?pastevents=true'); return false;\">".$pastText."</a>";

	echo "<div style='border-bottom: 1px dashed #50671d; padding-bottom: 10px; margin: 0px 10px 10px 10px;'>";

			if ($isPastEvents) echo $upcomingLink." | ".$pastText;
			else echo $upcomingText." | ".$pastLink;

	echo "</div>";

	if($isPastEvents)
	{
		$events = Data::GetEvents("past");

		//display all events in next event style
		if(count($events) > 0)
		{
			for($x = 0; $x < count($events); $x++)
			{
				Layout::EventTop($events[$x], 150, false);
			}
		}
		else
		{
			echo "<div style='height: 30px;'>There are no past events.</div>";
		}
	}
	else
	{
		$events = Data::GetEvents("future");

		//display all events in next event style
		if(count($events) > 0)
		{
			Layout::EventTop($events[0], 300, true, true); //next event

			for($x = 1; $x < count($events); $x++)
			{
				Layout::EventTop($events[$x], 300);
			}
		}
		else
		{
			echo "<div style='height: 30px;'>There are no upcoming events.</div>";
		}
	}
?>