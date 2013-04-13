<? 
   $sent = '0';
   $sent=$_GET['sent']; 
   $name=$_GET['name']; 
   $email=$_GET['email'];
   $message=$_GET['message'];
?>
<? include "functions.inc"; ?>
<html>
<head>
<title>globalzona.com :-: main</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? include "style.inc"; ?>
</head>

<body bgcolor="#336699" background="images/layout/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center"> 
<? include "header.inc"; ?>
  <table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr> 
      <td width="169" valign="top" background="images/layout/bg.jpg"> 
        <? include "nav_bar.inc"; ?>
      </td>
      <td width="431" valign="top"><div align="center"> 
          <table width="400" border="0" cellspacing="8" cellpadding="0">
            <tr> 
			<tr> 
			  <td class='navlink'><font color=white>Please send us your feedback & comments!</font></td>
			</tr><tr>
              <td valign="top" class="maintext"><br>
				<table width='100%'>
				<?
					if ($sent == '1') {
				?>
					<tr><td>
				<?
					$to="artem_k@yahoo.com";
					$message="$name just filled in your comments form.\n They said:\n$comments\n\nTheir e-mail address was: $email";
					if(mail($to,"From newly redesigned Global Zona",$message,"From: $email\n")) {
						print("<b>Thank you $name!</b><br><br><br>");
						echo "<font class='maintext'>The information you submited has been sent and will be processed shortly.</font>";
					} else {
						echo "<font class='maintext'>There was a problem sending the mail. Please check that you filled in the form correctly.</font>";
					}
				?>					
					</td></tr>
				<?
					} else {	
				?>
					<form action='web_form.php' method='get'>
					<input type='hidden' name='sent' value='1'>
					<tr>
						<td class='maintext' align='right'>Name:</td>
						<td align='left'><input type='text' name='name' class='form' size='25'></td>
					</tr>
					<tr>					
						<td class='maintext' align='right'>Email:</td>
						<td align='left'><input type='text' name='email' class='form' size='25'></td>
					</tr>
					<tr>					
						<td class='maintext' align='right' valign='top'>Message:</td>
						<td align='left'><textarea name='message' class='form' rows="10" cols="22"></textarea></td>
					</tr>
					<tr>					
						<td>&nbsp</td>
						<td align='left' valign='top' colspan='2'><input type='submit' class='form'></td>
					</tr>
					</form>
				<? } ?>
				</table>
			  </td>
            </tr>
          </table>
        </div>
        </td>
    </tr>
  </table>
<? include "footer.inc"; ?>
</div>
</body>
</html>
