<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<? $album=$_GET['album']; ?>
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
      <td rowspan="2" valign="top"> <div align="center"> 
          <table width="90%" border="0" cellspacing="0" cellpadding="5">
            <tr> 
              <td valign="top"><div align="center" class="nav"> 
                  <p><br>
                  </p>
                </div>
				<? if ($album == '') {?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr> 
                    <td width="50%" bgcolor="#F4F4F4"><div align="center"><span class="nav"><a href="photos.php?album=2005fleetweek">Fleet Week</a></span></div></td>
                    <td width="50%" bgcolor="#F4F4F4"><div align="center" class="text">October, 2005</div></td>
                  </tr>
				  <tr> 
                    <td width="50%"><div align="center"><span class="nav"><a href="photos.php?album=2005car">2005 Mercedes C230</a></span></div></td>
                    <td width="50%"><div align="center" class="text">September, 2005</div></td>
                  </tr>				  
				  <tr> 
                    <td width="50%" bgcolor="#F4F4F4"><div align="center"><span class="nav"><a href="photos.php?album=misssac2005">Miss Sacramento 2005</a></span></div></td>
                    <td width="50%" bgcolor="#F4F4F4"><div align="center" class="text">February, 2005</div></td>
                  </tr>
				  <tr> 
                    <td width="50%"><div align="center"><span class="nav"><a href="photos.php?album=vegas2004">Lav 
                        Vegas, Nevada</a></span></div></td>
                    <td width="50%"><div align="center" class="text">August 3 
                        - 7, 2004</div></td>
                  </tr>
                  <tr> 
                    <td bgcolor="#F4F4F4"><div align="center" class="nav"><a href="photos.php?album=various">Various 
                        Photos</a></div></td>
                    <td bgcolor="#F4F4F4"><div align="center" class="text">---</div></td>
                  </tr>
                  <tr> 
                    <td ><div align="center" class="nav"><a href="photos.php?album=family">Family</a></div></td>
                    <td ><div align="center" class="text">August 2, 2004</div></td>
                  </tr>
                  <tr bgcolor="#F4F4F4"> 
                    <td ><div align="center" class="nav"><a href="http://pinon.zakuska.com/photos.php" target="_blank">Off-Site                 Photos</a></div></td>
                    <td ><div align="center" class="text">---</div></td>
                  </tr>
                </table>
				<? } elseif ($album == 'various') { include 'photos_various.inc'; }
					 elseif ($album == 'vegas2004') { include 'photos_2004_lasvegas.inc'; }
					 elseif ($album == 'family') { include 'photos_family.inc'; }
					 elseif ($album == 'misssac2005') { include 'photos_misssac.inc'; }
					 elseif ($album == '2005car') { include 'photos_benz.inc'; }
					 elseif ($album == '2005fleetweek') { include 'photos_fleetweek.inc'; }
				?>
                <p align="center" class="text"><img src="bar.jpg" width="190" height="10"></p>
				<? if ($album != '') {?>
				<div align="center" class="nav"><a href="photos.php">Return to Album Menu</a></div></td>
				<? } ?>
            </tr>
          </table>
        </div></td>
      <td width="9" valign="top"><img src="header_6.jpg" width="16" height="127"></td>
    </tr>
    <tr> 
      <td valign="bottom"><img src="dotted_line_right.jpg" width="16" height="48"></td>
    </tr>
  </table>
  <? include 'footer.inc'; ?>
  <br>
</div>
</body>
</html>
