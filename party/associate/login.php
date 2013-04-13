<? 
	include '../utils.php'; 	 
?>
<html>
<title>Associate Administrative Area</title>
<head>
	<link href="http://www.globalzona.com/party/style.css" rel="stylesheet" type="text/css">
	<script language="javascript" type="text/JavaScript" SRC="ajax.js"></SCRIPT>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<table align='center' bgcolor='black' width='700' border=0 cellpadding=0 cellspacing=1>
		<tr><td colspan='2' class='nav' align='center'>GZP's Party Central Associate Statistics</td></tr>
		<tr bgcolor='#dddddd'>
			<td align='center' width='35%'%>
				<table align='center' width='100%' border=0 cellpadding=2 cellspacing=0>
					<tr bgcolor='#666666'>
						<td class='text' align='right'>
							<? 
								dbGetAssociateAdmin($_POST['associateId'],'','');
							?>
						</td>
					</tr>
					<tr bgcolor='#333333'>
						<td align='center' class='nav'>Search Daily Statistics</td>
					</tr>
					<tr bgcolor='#444444'>
						<form name="calendar" onSubmit="document.getElementById('buttonMain').value='Retrieving Data...';getClickInfo(this.pYear.value,this.pMonth.value,this.pDay.value,this.associateId.value); return false;">
							<input type="hidden" name="showDay" value="true">
							<input type="hidden" name="associateId" value="<? echo $_POST['associateId']; ?>">
							<input type="hidden" name="password" value="<? echo $_POST['password']; ?>">
							<td align='center' class='nav'>
								<div class='spacer'>&nbsp;</div>
								<? 
									calendar_month(''); 
									calendar_day('');
									calendar_year('');
								?>
								<br>
								<div class='spacer'>&nbsp;</div>
								<input id='buttonMain' type="submit" name="Submit" class="form" value="Get Daily Report">
								<div class='spacer'>&nbsp;</div>
							</td>
						</form>
					</tr>
					<tr bgcolor='#666666'><td class='spacer' align='right'>&nbsp;</td></tr>
				</table>
			</td>
			<td valign='top'>
				<div class='spacer'>&nbsp;</div>
				<table align='center' width='95%' border=0 cellpadding=1 cellspacing=1>
					<tr class='text' bgcolor='#bbbbbb'>
						<td valign='top' align='center'>
							<font color=black>

								GZP's Party Central Associate Statistics provides you with information about daily clicks produced 
								from your listing in the 'Top Associates' section of GZP's Party Central website.
								<p>
								To view the total number of clicks for a certain day, please use the calendar to the left.
							</font>
						</td>
					</tr>
				</table>
				<div id="txtHint">&nbsp;</div>
			</td>
		</tr>
	</table>
</body>
</html>