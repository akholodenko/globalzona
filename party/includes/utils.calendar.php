<?
function calendarNav ($currentWeek)
{
	$layout = new Layout();
	$layout->bubbleSubBoxTop(100);
	echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
	echo "<tr class='textBig'>";
	echo "<td align='left'>&nbsp;&nbsp;&nbsp;";
	if ($currentWeek != -1) echo "<a href='calendar.php?showWeek=".($currentWeek-7)."&cityId=".$_GET['cityId']."'><<&nbsp;prev&nbsp;week</a>&nbsp;&nbsp;&nbsp;";
	echo "</td><td align='right'>";
	echo "<a href='calendar.php?showWeek=".($currentWeek+7)."&cityId=".$_GET['cityId']."'>next&nbsp;week&nbsp;>></a>&nbsp;&nbsp;&nbsp;";
	echo "</td></tr>";
	echo "</table>";
	$layout->bubbleSubBoxBottom();
}

function getCalendarNav ($currentWeek)
{
	$calNav = "";
	if ($currentWeek != -1) $calNav = $calNav."<a href='calendar.php?showWeek=".($currentWeek-7)."&cityId=".$_GET['cityId']."'><<&nbsp;Prev&nbsp;Week</a>&nbsp;&nbsp;&nbsp;";
	$calNav = $calNav."<a href='calendar.php?showWeek=".($currentWeek+7)."&cityId=".$_GET['cityId']."'>Next&nbsp;week&nbsp;>></a>&nbsp;&nbsp;&nbsp;";

	return $calNav;
}

function calendarDay ($currentDate)
{
	//echo "<tr class='textBig'>";
	//echo "<td align='justify' colspan='3'>&nbsp;&nbsp;&nbsp;<b>";
	//echo "</b></td>";
	//echo "<td align='right'><b>";
	echo "<div align='right' class='navTall' style='margin-right: 15px;'>".date('l, M. j, Y', $currentDate)."</div>";
	//echo "</b>&nbsp;&nbsp;&nbsp;</td></tr>";
}

function calendarWeekDayNavigation ($currentDate, $divName, $start)
{
	echo "<td width='14%' align='center' class='text' valign='bottom'>";

	$layout = new Layout();
	$content = "<a href='#' onClick=\"showCalendarDayByWeek(".$divName.");return false;\">".date('l', $currentDate)."</a>";
	if ($divName == $start)
	{
		echo "<div id='calendarDayTabOn".$divName."'>";
				$layout->bubbleTab($content,85);
		echo "</div>";
		echo "<div id='calendarDayTabOff".$divName."' style='display: none'>";
			echo $content;
		echo "</div>";
	}
	else 
	{
		echo "<div id='calendarDayTabOn".$divName."' style='display: none'>";
				$layout->bubbleTab($content,80);
		echo "</div>";
		echo "<div id='calendarDayTabOff".$divName."'>";
			echo $content;
		echo "</div>";
	}
	echo "</td>";
}
?>