<?
	echo "<table width='97%' cellpadding='0' cellspacing='3' border='0'><tr><td>";
	$layout = new Layout();
	
	$loopStart = -1;
	if (check_int($_GET['showWeek']) == 1) $loopStart = $_GET['showWeek'];	//check which week to display when navigating the calendar

	$leftLink = "<a href='submitEvent.php'>Add Event</a>";
	if ($_GET['showDay'] != 1) $leftLink = $leftLink." | ".getCalendarNav ($loopStart);

	$title = "Calendar";
	if ($_GET['cityId'] != "") $title = dbFindCity($_GET['cityId'])." ".$title;

	$layout->bubbleBoxTop($title,$leftLink);
	echo "<table width='100%' border='0' cellspacing='0' cellpadding='15'>";
			if ($_GET['showDay'] == 1)	//single day
				include "includes/calendarSingleDay.php";
			else	//entire week
				include "includes/calendarWeek.php";				
	echo "</table>";

	//TEXT LINK ADS
	echo "<div style='padding-left: 20px;'>";
			include "include.textlinkads.calendar.php";
	echo "</div>";

	$layout->bubbleBoxBottom(); 
	$layout->bubbleBoxSpacer();
	echo "</td></tr></table>";
?>