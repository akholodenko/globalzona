<? include "include.header.php"; ?>
<!--
  <tr>
	<td colspan="3">
		<div class='LoginLink'><div class="nav" align="right">&nbsp;&nbsp;<a href='http://www.globalzona.com/party/webUser/login.php'>Login</a>&nbsp;&nbsp;</div></div>
		<img src="http://www.globalzona.com/party/layout/index_01.jpg" width="960" height="20">
	</td>
  </tr>
-->
  <!--<tr><td colspan="3"><? //include "include.nav.php"; ?></td></tr>-->
  <!--
  <tr>
	<td colspan="3" class='textSmallWhite' align='right'>
		<? 
			$today = getdate(); 
			echo $today['weekday'].", ".$today['month']."&nbsp;".$today['mday'].", ".$today['year'];
		?>
		&nbsp;&nbsp;
	</td>
  </tr>
  -->
  <tr>
	<td colspan="3">
		<!--
		<div class='NewsUpdateHeader'><div class="text" align="right">&nbsp;&nbsp;<b><font color=yellow>Update:</font></b><? //NewsUpdate(); ?>&nbsp;&nbsp;</div></div>
		-->
		<div class='Navlayer'><div class="text">
			<? include "include.nav.php"; ?>
			<div style='margin-left: 475px; margin-top: 140px;'>
				<div class='nav' style='text-align: left; padding-left: 25px;'>It's better to have partial memories of an awesome night...</div>
				<div class='nav' style='text-align: left; padding-left: 230px;'>...than complete memories of a boring one!</div>
			</div>
		</div></div>
		<img src="http://www.globalzona.com/party/layout/index_02.jpg" width="960" height="217">
	</td>
  </tr>
  <tr>
	<td colspan="3" class="spacer" align='right'>&nbsp;&nbsp;&nbsp&nbsp;</td>
  </tr>
  <tr><td colspan="3"><img src="http://www.globalzona.com/party/layout/index_03.jpg" width="960" height="6"></td></tr>
  <tr> 
    <td colspan=2 align="center" width="77%" valign="top" background="http://www.globalzona.com/party/layout/bg_mid_g.jpg">
		<div class='spacer'>&nbsp;</div>
		<? include $filenameMain; ?>
	</td>
	<td width='23%' class='text' valign='top' background="http://www.globalzona.com/party/layout/bg_mid_g.jpg">
		<div class='spacer'>&nbsp;</div>
		<? include "include.adNav.php"; ?>
	</td>
  </tr>
  <tr><td colspan="3"><img src="http://www.globalzona.com/party/layout/index_04.jpg" width="960" height="6"></td></tr>
<? include "include.footer.php"; ?>