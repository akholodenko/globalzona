<?
echo "<tr><td colspan='2'>";
	echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'><tr>";
	for ($x = $loopStart + 1; $x <= $loopStart+7; $x++)	
		calendarWeekDayNavigation(time() + ($x * 24 * 60 * 60),$x, $loopStart + 1);	//24 hours, 60 minutes, 60 seconds = 1 day
	echo "</tr></table>";

	for ($x = $loopStart + 1; $x <= $loopStart+7; $x++)	
	{
		echo "<div id='calendarDay".$x."'";
		if ($x != ($loopStart + 1)) echo " style='display: none' ";
		echo ">";

		$layout->bubbleSubBoxTop(100);
		calendarDay(time() + ($x * 24 * 60 * 60));	//24 hours, 60 minutes, 60 seconds = 1 day
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td>";						
			$currentTime = time() + ($x * 24 * 60 * 60);
			$startDay = date("Y",$currentTime).'-'.date("m",$currentTime).'-'.date("d",$currentTime).' 00:00:00';
			$endDay = date("Y",$currentTime).'-'.date("m",$currentTime).'-'.date("d",$currentTime).' 23:59:59';	

			dbGetEvent ($startDay,$endDay, $_GET['cityId'],"Special");
			dbGetWeeklyEvent ($startDay, $_GET['cityId']);
		echo "</td></tr></table>";
		$layout->bubbleSubBoxBottom();	
		echo "</div>";
	}
	//$layout->bubbleBoxSpacer();
	//calendarNav ($loopStart);
echo "</td></tr>";
?>