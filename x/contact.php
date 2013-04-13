<? $sent=$_GET['sent']; ?>
<html>
<head>
<title>Artem Kholodenko Welcomes You!</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? include 'style.css'; ?>
</head>

<body link="#999999" vlink="#999999" alink="#999999" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="right"> 
  <? include 'header.inc'; ?>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td width="106" rowspan="2" valign="top"><img src="header_7.jpg" width="106" height="255"></td>
      <td valign="top"> <div align="center"> 
          <table width="90%" border="0" cellspacing="0" cellpadding="5">
            <tr> 
              <td valign="top">
			  	<div align="justify"> <br>
                  <? if ($sent == 1) { ?>
                  <span class="text"> 
                  <?
					$name=$_POST['name'];
					$email=$_POST['email'];
					$comments=$_POST['comments'];
					$to="artem_k@yahoo.com";
					$message="$name just filled in your comments form.\n They said:\n$comments\n\nTheir e-mail address was: $email";
					if(mail($to,"An Email From Your Personal Site",$message,"From: $email\n")) {
						print("<b>Thank you $name!</b><br><br><br>");
						echo "Your message has been sent and will be read and replied to soon.";
					} else {
						echo "There was a problem sending the mail. Please check that you filled in the form correctly.";
					}
					?>
                  </span> 
                  <? } else {?>
                  <span class="text"> To contact me reguarding any possible work, 
                  project opportunities, or any other inquiries fill out the form 
                  below or email me at:</span> 
                  <p align="center" class="nav">artem_k AT yahoo DOT com</p>
                  <p align="center"><img src="bar.jpg" width="190" height="10"></p>
				  <? } ?>
                </div>
			  </td>
            </tr>
          </table>
          <? if ($sent != 1) { ?>
          <table width="375" border="0" cellspacing="0" cellpadding="0">
            <form action="contact.php?sent=1" method="post">
              <tr> 
                <td><b><font face="Tahoma" size="2" class="nav"> &nbsp;Name:</font></b></td>
                <td> <input type="text" name="name" class="text"> </td>
              </tr>
              <tr> 
                <td><b><font face="Tahoma" size="2" class="nav">&nbsp;E-mail:</font></b></td>
                <td> <input type="text" name = "email" class="text"> </td>
              </tr>
              <tr> 
                <td valign="top"><b><font face="Tahoma" size="2" class="nav">&nbsp;Comments:</font></b></td>
                <td> <textarea name="comments" rows="10" cols="30" class="text"></textarea> 
                </td>
              </tr>
              <tr> 
                <td></td>
                <td> <input type="submit" value="Submit" name="submit" class="button"> 
                </td>
              </tr>
            </form>
          </table>
		  <? } ?>
        </div></td>
      <td width="9" valign="top"><img src="header_6.jpg" width="16" height="127"></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="bottom"><img src="dotted_line_right.jpg" width="16" height="48"></td>
    </tr>
  </table>
  <? include 'footer.inc'; ?>
  <br>
</div>
</body>
</html>
