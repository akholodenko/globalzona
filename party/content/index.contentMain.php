<table width="97%" cellpadding=0 cellspacing=3 border=0><tr><td>
<!--CITY LIST-->
<?
	$layout = new Layout();
	$layout->cityListBubble(3);
	$layout->bubbleBoxSpacer(); 
?>
<!--
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
		<td valign='top'>
		<?
			$leftLink = "<a href='submitEvent.php'>Add Your Event</a>";
			$layout->bubbleBoxTop("Recently Posted Events",$leftLink);
			$layout->dbGetRecentEvents(10);
			$layout->bubbleBoxBottom();
		?>
		</td>
	</tr></table>
-->
</td></tr></table>