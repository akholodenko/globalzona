<? include "classes/config.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
	<TITLE>Potluq</TITLE>
	<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/potluq/js/utils.js"></script>
	<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/potluq/js/ajax.js"></script>
	<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/potluq/js/validate.js"></script>

	<link href="http://www.globalzona.com/potluq/css/modules.css" rel="stylesheet" type="text/css">
	<link href="http://www.globalzona.com/potluq/css/main.css" rel="stylesheet" type="text/css">
 </HEAD>

 <BODY  bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<table style="width: 80%;" align="center" cellpadding='0' cellspacing='0' border='0'>
			<tr>
				<td valign='top' class='welcomeText' style='padding-left: 75px;'>
					<div id='welcomeMessage'>
						Welcome, <? echo $_SESSION['USER_f_name'].' '.$_SESSION['USER_l_name'] ?> (<a href='validate.php?type=logout'>log out</a>)
					</div>
				</td>
				<td align="right" rowspan='2'>
					<img src="images/potluq_logo.jpg">
				</td>
			</tr>
			<tr>
				<td valign='bottom' style='padding-left: 50px;'><? include $mainNavigation;	?></td>
			</tr>
			<tr>
				<td colspan='2'>
					<div>
					  <b class="bodyOrange">
					  <b class="bodyOrange1"><b></b></b>
					  <b class="bodyOrange2"><b></b></b>
					  <b class="bodyOrange3"></b>
					  <b class="bodyOrange4"></b>
					  <b class="bodyOrange5"></b></b>

					  <div id='masterContent' class="bodyOrangefg">
						<? include $mainFileName; ?>
					  </div>

					  <b class="bodyOrange">
					  <b class="bodyOrange5"></b>
					  <b class="bodyOrange4"></b>
					  <b class="bodyOrange3"></b>
					  <b class="bodyOrange2"><b></b></b>
					  <b class="bodyOrange1"><b></b></b></b>
					</div>
				</td>
			</tr>
		</table>
	</BODY>
</HTML>