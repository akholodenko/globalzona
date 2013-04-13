<div id="tcontent3" class="tabcontent">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr class="text">
			<? $featuredhostInfo = dbFindFeatured('host'); ?>		
			<td valign="top" align="justify">
				<table width="100%" bgcolor="gray" cellpadding="0" cellspacing="0" border="0"><tr class="nav"><td>&nbsp;&nbsp;&nbsp;<? echo $featuredhostInfo["name"];?></td></tr></table>
				<? echo $featuredhostInfo["text"];?> 
				<p><br><? dbFindPrintBriefHostInfo($featuredhostInfo["prevHostId"]);?>
				<br><a href="contact.php?emailSubject=Featured Host Request">Want to be a featured host?</a></p>				
			</td>
			<td valign="top">&nbsp;&nbsp;</td>
			<td width="200" valign="top" align="center">
				<table bgcolor="gray" cellpadding="1" cellspacing="0" border="0"><tr><td><? displayFlyer ($featuredhostInfo["imgURL"]); ?></td></tr></table>
				<a target="_blank" href="<? echo $featuredhostInfo["website"];?>"><? echo $featuredhostInfo["website"];?></a></p>		
			</td>						
		</tr>						
	</table>	
</div>