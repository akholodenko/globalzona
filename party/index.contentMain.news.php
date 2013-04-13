				  <!-- Start Of Moreover.com News Javascript Code -->
				  
					<style type='text/css'>
					
					.morehl {
						font-family: Verdana, geneva, arial, sans-serif !important;
						font-size: 11px !important;
						color: #eeeeee !important;
						font-weight: bold !important;
						font-style: normal !important;
						text-decoration: none !important;
					}	
					
					A:link.morehl, A:vlink.morehl, A:alink.morehl {
						color: #eeeeee !important;
					}
					
					.moresrc {
						font-family: Verdana, geneva, arial, sans-serif !important;
						font-size: 9px !important;
						color: #cccccc !important;
						font-weight: normal !important;
						font-style: normal !important;
						text-decoration: none !important;
					}
					
					A:link.moresrc, A:vlink.moresrc, A:alink.moresrc {
						color: #cccccc !important;
					}
					
					.moreti {
						font-family: Verdana, geneva, arial, sans-serif;
						font-size: 9px;
						color: #cccccc;
						font-weight: normal;
						font-style: normal;
						text-decoration: none;
					}
					
					.morehlt {
						font-family: Verdana, geneva, arial, sans-serif;
						font-size: 11px;
						color: #eeeeee !important;
						font-weight: bold;
						font-style: normal;
						text-decoration: none;
					}	
					</style>
				  
				  <SCRIPT LANGUAGE="Javascript">
				  <!--
				  // the array global_article is used to allow multiple categories
				  var global_article = new Array();
				  var global_article_counter = 0;
				  var article = null;
				  var early_exit = true;
				  var moreover_text = 0;
				  
				  function load_wizard()
					{
					
					var newwin = window.open("","clone","resizable,scrollbars");
					document.forms.moreover_clone.submit();
					return false;
					}
				  // -->
				  
				  </SCRIPT>
				  <SCRIPT LANGUAGE="Javascript" SRC="http://p.moreover.com/cgi-local/page?c=reuters%20entertainment%20news&o=js&n=5">
				  </SCRIPT>
				  <SCRIPT LANGUAGE="Javascript">
				  <!--
				  // load global_article array with articles from category
				  if (article != null && (article.length > 0))
					{
					early_exit = false;
					for (var article_counter = 0; article_counter < article.length; article_counter++)
					  {
					  global_article[global_article_counter] = article[article_counter];
					  global_article[global_article_counter].url += "&w=2357093";
					  
					  global_article[global_article_counter].url += "' TARGET='_blank";
					  global_article[global_article_counter].document_url += "' TARGET='_blank";
					  global_article_counter++;
					  }
					}
				  // -->
				  </SCRIPT>
				  <SCRIPT LANGUAGE="Javascript">
				  <!--
				  if (global_article.length == 0)
					  {
					  early_exit = true;
					  }
				  // -->
				  </SCRIPT>
				  <table cellpadding=0 cellspacing=0 border=0 width='400' style='table-layout: fixed'><tr bgcolor='#333333'><td>
				  <SCRIPT LANGUAGE="Javascript" SRC="http://w.moreover.com/wizard/conf/reuters/wizard_image.js"></SCRIPT>
				  
				  <SCRIPT LANGUAGE="Javascript">
				  <!--
				  if (!early_exit)
				  {
				  var wizard_brand			= "reuters";
				  var webfeed_heading 			= "";
				  var width 				= "400";
				  var numberofarticles 			=  global_article.length;
				  var cluster_border 			= "";
				  var time_display 			= "No";
				  var cell_spacing 			= "";
				  var cell_padding 			= "1";
				  var time 					=  new Array(global_article.length);
				 
				  
				  // Start loop for articles
				  for (var counter=0; counter < numberofarticles; counter++)
					{
					
					if ((counter == (global_article.length - 1)) && moreover_text == 1) 
					  {  
					  time_display = "No";
					  }
					
					// Print out the headline 
					document.write("<a href='"+global_article[counter].url+"' class='morehl'>");
					document.write(global_article[counter].headline_text+"...</a><br>");
					
					
					  // Print out the source
						if ((counter != (global_article.length - 1)) || moreover_text != 1)
						{
						
						document.write("<A HREF='"+global_article[counter].document_url+"' + class='moresrc'>");
						document.write(global_article[counter].source+"</A><span class='moreti'>&nbsp;</span>");
						
						}
					
					
					
					// Print out reg/sub/prem if appropriate
					if (global_article[counter].access_status == "sub" || global_article[counter].access_status == "reg" || global_article[counter].access_status == "prem")
					  {
					  document.write("<A HREF='"+global_article[counter].access_registration+"' class='moresrc'>");
					  document.write(global_article[counter].access_status+"</A><span class='moreti'>&nbsp;</span>");
					  }
					
					  
					// Print out the harvest time
					if (time_display == "Yes" && global_article[counter].harvest_time != "")
					  {
					  // Make a new date object
					  time[counter] = new Date(global_article[counter].harvest_time);
					  time[counter].setHours(time[counter].getHours() - (time[counter].getTimezoneOffset() / 60 ));
					  document.write("<span class='moreti'> "+time[counter].toString()+"<br>&nbsp;<br></span>");
					  } 
					else
					  {
					  document.write("<span class='moreti'><br>&nbsp;<br></span>");
					  }

					} // End of article loop
				  

				  // Start of clone button code //
				  // NOTE: DO NOT REMOVE any of the code in this section //
				  document.write("<FORM METHOD='POST' ACTION='http://w.moreover.com/cgi-local/wizard_welcome.pl' target='clone' name='moreover_clone'>");
				  document.write("<INPUT TYPE='hidden' NAME='parent_code' VALUE='2357093'>");
				  document.write("<INPUT TYPE='hidden' NAME='clone_system' VALUE='c'>");
				  document.write("<INPUT TYPE='hidden' NAME='system' VALUE='c'>");
				  document.write("<INPUT TYPE='hidden' NAME='source_time_bold' VALUE='false'><INPUT TYPE='hidden' NAME='cluster_width' VALUE='400'>")
				  document.write("<INPUT TYPE='hidden' NAME='headline_bgcolor' VALUE='333333'><INPUT TYPE='hidden' NAME='headline_italic' VALUE='false'>")
				  document.write("<INPUT TYPE='hidden' NAME='headline_font' VALUE='Verdana, geneva, arial, sans-serif'><INPUT TYPE='hidden' NAME='wizard_brand' VALUE='reuters'>")
				  document.write("<INPUT TYPE='hidden' NAME='number_of_headlines' VALUE='5'><INPUT TYPE='hidden' NAME='time_display' VALUE='No'>")
				  document.write("<INPUT TYPE='hidden' NAME='source_time_italic' VALUE='false'><INPUT TYPE='hidden' NAME='cluster_cellspacing' VALUE='0'>")
				  document.write("<INPUT TYPE='hidden' NAME='search_keywords' VALUE=''><INPUT TYPE='hidden' NAME='headline_underline' VALUE='false'>")
				  document.write("<INPUT TYPE='hidden' NAME='headline_fgcolor' VALUE='eeeeee'><INPUT TYPE='hidden' NAME='source_time_font_size' VALUE='9'>")
				  document.write("<INPUT TYPE='hidden' NAME='cluster_border' VALUE='0'><INPUT TYPE='hidden' NAME='cluster_cellpadding' VALUE='1'>")
				  document.write("<INPUT TYPE='hidden' NAME='source_time_fgcolor' VALUE='cccccc'><INPUT TYPE='hidden' NAME='heading_font_size' VALUE=''>")
				  document.write("<INPUT TYPE='hidden' NAME='cluster_name' VALUE='c=reuters%20entertainment%20news&o=js'><INPUT TYPE='hidden' NAME='source_time_font' VALUE='Verdana, geneva, arial, sans-serif'>")
				  document.write("<INPUT TYPE='hidden' NAME='cluster_layout' VALUE='<BR>'><INPUT TYPE='hidden' NAME='webfeed_heading' VALUE=''>")
				  document.write("<INPUT TYPE='hidden' NAME='source_time_underline' VALUE='false'><INPUT TYPE='hidden' NAME='headline_font_size' VALUE='11'>")
				  document.write("<INPUT TYPE='hidden' NAME='heading_display' VALUE='Yes'><INPUT TYPE='hidden' NAME='source_rank' VALUE=''>")
				  document.write("<INPUT TYPE='hidden' NAME='headline_bold' VALUE='true'>")

				  document.write("</FORM>");
				  // End of clone button code //

				  // ************************************************************************************
				  // This code is subject to the copyright and warranty restrictions detailed at 
				  // http://www.moreover.com/wizard_copyright.html
				  // Copyright 2004 Moreover Technologies. All rights reserved.
				  // *************************************************************************************
				  } 
				  // -->
				  </SCRIPT>
				<SCRIPT LANGUAGE="Javascript" SRC="http://w.moreover.com/wizard/conf/reuters/wizard_text.js"></SCRIPT>
				  </td></tr></table>
				  <!-- End Of Moreover.com News Javascript Code -->
