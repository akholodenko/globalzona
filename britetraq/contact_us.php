<html>
<head>
<title>BriteTraq</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center"> 
  <table width="700" border="0" cellspacing="0" cellpadding="0">
    <tr> 
    	<td colspan="3">
	  		<? include "includes/header.inc"; ?>
		</td>
    </tr>
    <tr> 
      	<td width="62" rowspan="3">
	  		<? include "includes/left_generic.inc"; ?>
		</td>
      	<td height="6" colspan="2" valign="top">
			<img src="images/layout_black_line.jpg" width="638" height="6">
		</td>
    </tr>
    <tr> 
      	<td width="468" rowspan="2" valign="top">
	  		<!-- <? include "includes/nav_leisure.inc"; ?> -->
			<?	$id=$_GET['id']; 
				
				if($id == '1') {
					$name=$_POST['name'];
					$email=$_POST['email'];
					$comments=$_POST['comments'];
					$to="artemk@gmail.com";
					$message="$name just filled in your comments form.\n They said:\n$comments\n\nTheir e-mail address was: $email";
					if(mail($to,"Customer Service for Global Zona",$message,"From: $email\n")) {
						print("<b>Thank you $name!</b><br><br><br>");
						echo "The information you submited has been sent to our Customer Services and will be processed shortly.";
					} else {
						echo "There was a problem sending the mail. Please check that you filled in the form correctly.";
					}
					?> <br>	<?
				}
				else {
			?>

				<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor='images/sample_light_green.jpg'>
				  <tr> 
					<td colspan="2" bgcolor="#000000"> 
					  <div align="center"><font color="#FFFFFF" class='infotitle'><b>Contact Us</b></font></div>
					</td>
				  </tr>
				  <tr> 
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <form action="contact_us.php?id=1" method="post">
					<tr> 
					  <td><b><font face="Tahoma" size="2" class="text"> &nbsp;Name:</font></b></td>
					  <td> 
						<input type="text" name="name" class="form">
					  </td>
					</tr>
					<tr> 
					  <td><b><font face="Tahoma" size="2" class="text">&nbsp;E-mail:</font></b></td>
					  <td> 
						<input type="text" name = "email" class="form">
					  </td>
					</tr>
					<tr> 
					  <td valign="top"><b><font face="Tahoma" size="2" class="text">&nbsp;Comments:</font></b></td>
					  <td> 
						<textarea name="comments" rows="10" cols="30" class="form"></textarea>
					  </td>
					</tr>
					<tr> 
					  <td></td>
					  <td> 
						<input type="submit" value="Submit" name="submit" class="button">
					  </td>
					</tr>
					<tr>
					  <td></td>
					  <td>&nbsp;</td>
					</tr>
				  </form>
				</table>
			<? } ?>
		</td>
      <? include "includes/right_contact_us.inc"; ?>
    </tr>
  </table>
</div>
<? include "includes/link_map.inc"; ?>
</body>
</html>
