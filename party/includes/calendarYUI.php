<!--START CAL YUI-->
<script> 
    YAHOO.namespace("example.calendar"); 
 
    YAHOO.example.calendar.init = function() { 
        <? if ($month != "" && $day!= "" && $year != "") { ?>
			cal1 = new YAHOO.widget.Calendar("cal1","cal1Container",{ pagedate:"<? echo $month."/".$year; ?>", selected:"<? echo $month."/".$day."/".$year; ?>" }); 
		<? } else { ?>
			cal1 = new YAHOO.widget.Calendar("cal1","cal1Container"); 
		<? } ?>

		//YAHOO.example.calendar.cal1 = new YAHOO.widget.Calendar("cal1","cal1Container",{ pagedate:"10/2007", selected:"10/5/2007-10/27/2007,10/30/2007" }); 
		cal1.selectEvent.subscribe(showMyDate, cal1, true); 
		//YAHOO.util.Event.addListener(YAHOO.example.calendar.cal1, "click",alert(YAHOO.example.calendar.cal1.getSelectedDates()));
        cal1.render();
	}  
    YAHOO.util.Event.onDOMReady(YAHOO.example.calendar.init); 


	function showMyDate ()
	{
		var DateInfo = new Array();
		DateInfo = cal1.getSelectedDates()[0];
		//alert((DateInfo.getMonth()+1) + '/' + DateInfo.getDate() + '/' + DateInfo.getFullYear());
		document.calform.action = 'calendar.php?cityId=<? echo $_GET['cityId']; ?>&showDay=1&pMonth=' + (DateInfo.getMonth()+1) + '&pDay=' + DateInfo.getDate() + '&pYear=' + DateInfo.getFullYear();
		document.calform.submit();
	}

</script>
<?
	$title = "miniCal";
	if ($_GET['cityId'] != "") $title = $title.": ".dbFindCity($_GET['cityId']);
	$leftLink = "";

	$layout = new Layout();
	$layout->bubbleBoxTop($title,$leftLink);
?>
	<div class="yui-skin-sam" style='padding-left: 14px;'><div id="cal1Container"></div></div>
	<div style="clear:both" ></div>
	<form name="calform" method="POST"></form>
<?
	$layout->bubbleBoxBottom(); 
	$layout->bubbleBoxSpacer();
?>
<!--END CAL YUI-->