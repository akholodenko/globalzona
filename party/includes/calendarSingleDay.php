<?
	$month = $_POST['pMonth'];
	$day = $_POST['pDay'];
	$year = $_POST['pYear'];

	if ($month == "" && $day == "" && $year == "")
	{
		$month = $_GET['pMonth'];
		$day = $_GET['pDay'];
		$year = $_GET['pYear'];
	}

	$startDay = $year.'-'.$month.'-'.$day.' 00:00:00';
	$endDay = $year.'-'.$month.'-'.$day.' 23:59:59';	

	echo "<tr><td>";
		$layout->bubbleSubBoxTop(100);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td>";
			echo "<tr class='navTall'>";
			echo "<td align='right' colspan=4><b>".date('l, M. j, Y', strtotime($startDay)) ."</b>&nbsp;&nbsp;&nbsp;</td></tr>";
			dbGetEvent ($startDay,$endDay, $_GET['cityId'], "Special");							
			dbGetWeeklyEvent ($startDay, $_GET['cityId']);
		echo "</td></tr></table>";
		$layout->bubbleSubBoxBottom();
		$layout->bubbleBoxSpacer();
	echo "</td></tr>";
?>