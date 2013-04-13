<script>
	var event = new PartyEvent();
//	event.venueDirectory = new Array ();
//	for (i=0; i <100; i++) event.venueDirectory[i] = new Array();
	//alert(event.venueDirectory[0][0]);
</script>
<?
	$submitEvent = new Event();
	$layout = new Layout();
	//$leftLink = "<a href='http://www.globalzona.com/party/contact.php?emailSubject=Submit Weekly Event&specialMessage=please provide your contact info.'>Set-up a Weekly Event</a>";
	$leftLink = "";

	$submitEvent->GetVenueDirectory();
	echo "<table width='97%' cellpadding='0' cellspacing='3' border='0'><tr><td>";
	$layout->bubbleBoxTop("Submit Your Event",$leftLink);
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="10">
		<tr><td align='center'>
<?
			$layout->bubbleSubBoxTop(100);
			echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
			echo "<form action='submitEvent.php' name='myform' method='post' onSubmit=\"return check_submitEvent(this);\">";
			$submitEvent->PrintSubmitEventFormNav();
			echo "	<tr><td colspan='5' align='center' class='nav'>";
			$submitEvent->PrintStep1();
			$submitEvent->PrintStep2();
			$submitEvent->PrintStep3();
			$submitEvent->PrintStep4();
			$submitEvent->PrintStepConfirm();
			echo "	</td></tr>";
			echo "</form>";
			echo "</table>";
			$layout->bubbleSubBoxBottom();	
?>
		</td></tr>
	</table>
	<div style='text-align: center;'>Problem with new form? <a href='contact.php?emailSubject=New+Event+Submit+Form+Problem'>Let us know</a> and use the <a href='submitEvent.php'>old one for now.</a></div>
<? 
	$layout->bubbleBoxBottom(); 
	$layout->bubbleBoxSpacer();
	echo "</td></tr></table>";
?>
<script>
	/*
	
	for (i=0; i <event.venueDirectory[2].length; i++)
	{
		if(event.venueDirectory[2][i])
			document.write(event.venueDirectory[2][i] + '<br>');
	}
	
	*/
</script>