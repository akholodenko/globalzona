<table width='97%' cellpadding='0' cellspacing='3' border='0'><tr><td>
<?
	$layout = new Layout();
	$leftLink = "<a href='contact.php?emailSubject=Banner Placement'>Contact Us Today</a>";
	$layout->bubbleBoxTop("Advertise with Us",$leftLink);
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="2">
		<tr> 
			<td bgcolor="#333333" class="text" align="justify">
				<table width="100%" border="0" cellspacing="1" cellpadding="5">
					<tr class='textBig'>
						<td valign='top' colspan="2">
							GZP's Party Central offers 3 banner sizes for advertisement on the site.  
							There is a flat monthly charge for banner placement, which varies depending on the size of the banner.
							<a href="contact.php?emailSubject=Banner Placement">Contact us</a> to have your banner up today!
						</td>
					</tr>
					<tr>
						<td align='center'>
							<? AdExample(195, 195); ?>
							<!--<img src="images/banner_204x204.jpg">-->
						</td>
						<td class="text" valign="top">$150 per month</td>					
					</tr>
					<tr>
						<td align='center'>
							<? AdExample(195, 100); ?>
							<!--<img src="images/banner_204x102.jpg">-->
						</td>
						<td class="text" valign="top">$125 per month </td>					
					</tr>		
					<tr>
						<td align='center'>
							<? AdExample(195, 50); ?>
							<!--<img src="images/banner_100x102.jpg">-->
						</td>
						<td class="text" valign="top">$75 per month</td>					
					</tr>								
				</table>
			</td>
		</tr>
	</table>
<? 
	$layout->bubbleBoxSpacer();
	$layout->bubbleBoxBottom(); 
	$layout->bubbleBoxSpacer();
?>
</td></tr></table>