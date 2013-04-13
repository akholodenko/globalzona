<table width="400" border="0" cellpadding="0" cellspacing="1" bgcolor=white class='maintext'>
  <tr align="center" valign="middle" bgcolor="#000000"> 
    <? 
	calendar_day('1','1','0'); 
	calendar_day('2','2','0'); 
	calendar_day('3','3','0'); 
	calendar_day('4','4','0'); 
	calendar_day('5','5','0'); 
	calendar_day('6','6','0'); 
	calendar_day('7','7','0'); 
	?>
  </tr>
  <tr align="center" valign="middle" bgcolor="#000000">
    <? 
	calendar_day('8','8','0'); 
	calendar_day('9','9','0'); 
	calendar_day('10','10','0'); 
	calendar_day('11','11','0'); 
	calendar_day('12','12','0'); 
	calendar_day('13','13','0'); 
	calendar_day('14','14','0'); 
	?>
  </tr>
  <tr align="center" valign="middle" bgcolor="#000000">
    <? 
	calendar_day('15','15','0'); 
	calendar_day('16','16','0'); 
	calendar_day('17','17','0'); 
	calendar_day('18','18','0'); 
	calendar_day('19','19','0'); 
	calendar_day('20','20','0'); 
	calendar_day('21','21','0'); 
	?>
  </tr>
  <tr align="center" valign="middle" bgcolor="#000000">
    <? 
	calendar_day('22','22','1'); 
	calendar_day('23','23','0'); 
	calendar_day('24','24','0'); 
	calendar_day('25','25','0'); 
	calendar_day('26','26','0'); 
	calendar_day('27','27','0'); 
	calendar_day('28','28','0'); 
	?>
  </tr>
  <tr align="center" valign="middle" bgcolor="#000000">
    <? 
	calendar_day('29','29','0'); 
	calendar_day('30','30','0'); 
	calendar_day('31','31','0'); 
	?>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
<table width="400" border="0" cellpadding="0" cellspacing="0" class='maintext'>
  <tr><td>
    <?
	switch ( $date )
	{
	  case "22":
	      print "<div align='right'>April 22, 2005</div><hr size='1' color='white'>";
	      print "<b>Who:</b> Rhythmic Ethics";
	      print "<br><b>Where:</b> Suite 181 - 181 Eddy St., San Francisco, CA";
	      print "<br><b>When:</b> 9pm";
	      print "<br><b>How much:</b> Free b4 11pm with guestlist. $10 after.";
	      print "<hr size='1' color='white'>";
	      print "<div align='center'>For driving directions, please visit <a href='maps.google.com'><font class='mainlink' color='yellow'>Google Maps</font></a>.</div>";
	      break;
	}
   ?>
  </td></tr>
</table>