<? $id=$_GET['id']; ?>
<html>
<head>
<? 
if ( $id == 'usa') { echo "<title>Conflict Area: United States of America</title>"; }
else if ( $id == 'rf') { echo "<title>Conflict Area: Russian Federation</title>"; }
else if ( $id == 'me') { echo "<title>Conflict Area: Middle East</title>"; }
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? include "style.inc"; ?>
</head>

<body bgcolor="#6699CC" link="#003399" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center">
  <table width="702" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr> 
      <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr> 
            <td><? include "head_image.inc"; ?></td>
          </tr>

          <tr> 
            <td bgcolor="#000000"><? include "nav.inc"; ?>
              <table width="700" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td><img src="images/black_line.jpg" width="100" height="1"></td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td bgcolor="#CCCCCC"><table width="700" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="20%" valign="top" bgcolor="#CCCCCC"><? include "leftpost.inc"; ?></td>
                  <td width="60%" valign="top" bgcolor="#F2F2F2"><table width="100%" border="0" cellpadding="5" cellspacing="0" class="text">
                      <tr> 
                        <td valign="top" ><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                            <tr> 
                              <td bgcolor="#EBEBEB" class="textsmall"><div align="center"><strong><font color='#999999'>Conflict Area: </font>
							  	<? 
									if ( $id == 'usa') { echo "United States of America"; }
									else if ( $id == 'rf') { echo "Russian Federation"; }
									else if ( $id == 'me') { echo "Middle East"; }
								?>
							  </strong></div></td>
                            </tr>
                          </table>                        
                            
                          <div align="justify" class="textsmall">
                            <p>Information about the conflict mentioned in this 
                              section will soon appear. If you have any suggestions 
                              on specific details to provide, please contact our 
                              group with the information. Otherwise, please stay 
                              tuned for further announcements.<br>
                            </p>
                          </div></td>
                      </tr>
                      <tr> 
                        <td class="textsmall"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#EBEBEB" class="textsmall"><ul>
                                  <li><strong><a href="http://masada2000.org/" target="_blank">Read 
                                    about the history of the conflict</a></strong></li>
                                  <li><strong><a href="http://www.frontpagemag.com/Articles/ReadArticle.asp?ID=15044" target="_blank">Learn 
                                    about Eurabia</a></strong></li>
                                </ul></td>
  </tr>
</table>
</td>
                      </tr>
                    </table></td>
                  <td width="20%" valign="top" bgcolor="#CCCCCC"><? include "rightpost.inc"; ?></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <? include "footer.inc"; ?>
 </div>
</body>
</html>
