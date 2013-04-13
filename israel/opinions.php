<? $id=$_GET['id']; ?>
<html>
<head>
<title>Opinions</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
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
                  <td><img src="images/black_line.jpg" width="700" height="1"></td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td bgcolor="#CCCCCC"><table width="700" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="20%" valign="top" bgcolor="#CCCCCC"><? include "leftpost.inc"; ?></td>
                  <td width="60%" valign="top" bgcolor="#F2F2F2"><table width="100%" border="0" cellpadding="5" cellspacing="0" class="text">
                      <tr> 
                        <td class="text"><p align="center"><strong>OPINIONS</strong></p>
                          <hr size="1" noshade>
                          <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
                                  <tr> 
                                    <td bgcolor="#E1E1E1">&nbsp;</td>
                                    <td bgcolor="#E1E1E1"><div align="right" class="textsmall"><strong>September 
                                        23, 2004</strong></div></td>
                                  </tr>
                                  <tr class="textsmall"> 
                                    <td bgcolor="#EBEBEB">Benjamin&nbsp;Kerstein</td>
                                    <td bgcolor="#EBEBEB"><div align="right"><a href="http://www.frontpagemag.com/Articles/ReadArticle.asp?ID=15170" target="_blank">&quot;My 
                                        Road to Damascus&quot;</a></div></td>
                                  </tr>
                                  <tr bgcolor="#F2F2F2"> 
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <? if ($id == "quereshi001") { 
							 	echo "<tr><td colspan=2>";
								include "opinions/why_it_matters.inc";
								echo "</td></tr>";
							 } 
							 else {
						  ?>
                                  <tr> 
                                    <td bgcolor="#E1E1E1">&nbsp;</td>
                                    <td bgcolor="#E1E1E1"><div align="right" class="textsmall"><strong>September 
                                        21, 2004</strong></div></td>
                                  </tr>
                                  <tr class="textsmall"> 
                                    <td bgcolor="#EBEBEB">Aisha&nbsp;Siddiqa&nbsp;Qureshi</td>
                                    <td bgcolor="#EBEBEB"><div align="right"><a href="opinions.php?id=quereshi001">&quot;A 
                                        Wake-Up Call for America's Jews&quot;</a></div></td>
                                  </tr>
                                  <? } ?>
                                  <tr bgcolor="#F2F2F2"> 
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td width="34%" bgcolor="#E1E1E1">&nbsp;</td>
                                    <td width="66%" bgcolor="#E1E1E1"><div align="right" class="textsmall"><strong>September 
                                        10, 2004</strong></div></td>
                                  </tr>
                                  <tr class="textsmall"> 
                                    <td width="34%" bgcolor="#EBEBEB">В. Новодворская</td>
                                    <td width="66%" bgcolor="#EBEBEB"><div align="right"><a href="http://www.cn.com.ua/N322/3authors/world/world.html" target="_blank">&quot;ОНА 
                                        НЕ УТОНЕТ&quot;</a></div></td>
                                  </tr>
                                  <tr bgcolor="#F2F2F2"> 
                                    <td width="34%">&nbsp;</td>
                                    <td width="66%" bgcolor="#F2F2F2">&nbsp;</td>
                                  </tr>
                                  <? if ($id == "harari001") { 
							 	echo "<tr><td colspan=2>";
								include "opinions/a_view_from_the_eye_of_the_storm.inc";
								echo "</td></tr>";
							 } 
							 else {
						  ?>
                                  <tr> 
                                    <td width="34%" bgcolor="#E1E1E1">&nbsp;</td>
                                    <td width="66%" bgcolor="#E1E1E1"><div align="right" class="textsmall"><strong>September 
                                        7, 2004</strong></div></td>
                                  </tr>
                                  <tr class="textsmall"> 
                                    <td width="34%" bgcolor="#EBEBEB">Haim Harari</td>
                                    <td width="66%" bgcolor="#EBEBEB"><div align="right"><a href="opinions.php?id=harari001">&quot;A 
                                        View from the Eye of the Storm&quot;</a></div></td>
                                  </tr>
                                  <? } ?>
                                </table></td>
                            </tr>
                          </table> </td>
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
<p align="center" class="navbar">&nbsp;</p>
</body>
</html>
