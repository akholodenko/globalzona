<table width='97%' cellpadding='0' cellspacing='3' border='0'><tr><td>
<?
	$layout = new Layout();
	$leftLink = "<a href='http://www.globalzona.com/party/contact.php?emailSubject=Submit Weekly Event&specialMessage=please provide your contact info.'>Set-up a Weekly Event</a>";
	$layout->bubbleBoxTop("Submit Your Event",$leftLink);
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="10">
		<tr><td align='center'><? include "includes/eventForm.php"; ?></td></tr>
	</table>
<? 
	$layout->bubbleBoxSpacer();
	$layout->bubbleBoxBottom(); 
	$layout->bubbleBoxSpacer();
?>
</td></tr></table>