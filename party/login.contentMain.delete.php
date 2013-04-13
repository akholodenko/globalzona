<? if (dbDeleteEvent($_POST['xyz']) == true) {?>
 				<tr class="nav"><td bgcolor="red" align="right" colspan="2">Event Deleted&nbsp;&nbsp;&nbsp;</td></tr>
<? } else { ?>
 				<tr class="nav"><td bgcolor="red" align="right" colspan="2">Problem deleting event!&nbsp;&nbsp;&nbsp;</td></tr>				
<? } ?>
				