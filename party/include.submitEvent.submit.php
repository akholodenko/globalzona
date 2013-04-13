<? 
	$insertEventResult = insertNewEvent(); 
	if ($insertEventResult == false) { ?>
          <tr class="nav"><td bgcolor="red" align="right" colspan="2">Event Submittion Failed: Possibly Invalid Characters&nbsp;&nbsp;&nbsp;</td></tr>		
<? 	} else { ?>
          <tr class="nav"><td bgcolor="green" align="right" colspan="2">Event Confirmed&nbsp;&nbsp;&nbsp;</td></tr>		
<? 	} ?>