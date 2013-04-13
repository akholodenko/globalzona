<?php
function calendar_day($title, $address, $event)
{
          print ("<td ");

	  if($event == '1') {
		echo "bgcolor='green'";
	  }
	  else if ($event == '0') {
 		echo "bgcolor='black'";
	  }

	  print ("class='navlink'><div align='center' id='");
		  echo $address;
		  print ("' onMouseOver=\"MM_changeProp('");
		  echo $address;
		  print ("','','style.backgroundColor','#333333','DIV')\" onMouseOut=\"MM_changeProp('");
		  echo $address;
		  print("','','style.backgroundColor','");

	  if($event == '1') {
		echo "green";
	  }
	  else if ($event == '0') {
 		echo "black";
	  }

	  print ("','DIV')\"><a href='events.php?date=");
	  echo $address;
	  print("' STYLE='TEXT-DECORATION: NONE'><font color='white'>");
	  echo $title;
	  print ("</font></a></div></td>");
}

function nav_link($title, $address)
{
          echo "<tr>";
          print ("<td bgcolor='#CBE0FA' width='16%' class='navlink'><div align='center' id='");
		  echo $address;
		  print ("' onMouseOver=\"MM_changeProp('");
		  echo $address;
		  print ("','','style.backgroundColor','#FFCC00','DIV')\" onMouseOut=\"MM_changeProp('");
		  echo $address;
		  print("','','style.backgroundColor','CBE0FA','DIV')\"><a href='");
  		  echo $address;
		  print(".php' STYLE='TEXT-DECORATION: NONE'><font color='#000000'>");
		  echo $title;
		  print ("</font></a></div></td>");
          echo "</tr>";
}

function nav_group($title, $mark)
{
	print ("<table width='169' border='0' cellspacing='1' cellpadding='0'><tr><td bgcolor='#333333' class='navheader'>");
	echo $title;
	print ("</td></tr>");
	
	if ($mark == '1') {
	    nav_link('A.P. US History','ap_us');
		nav_link('A.P. Chemistry','ap_chem');
	}
	else if ($mark == '2') {
		nav_link('Web Development','web_dev');
		nav_link('Computer Consulting','consulting');
	}
	else if ($mark == '3') {
		nav_link('Web Form','web_form');
		nav_link('Email','email');
		nav_link('Advertisement','ads');
		nav_link('Front Page','index');
	}
	else if ($mark == '4') {
		nav_link('Upcoming Events','events');
		nav_link('Photo Gallery','photos');
	}
	print ("</table>");
	
}

function notes_link($chapter, $from_page, $to_page)
{
	echo "<tr><td width='94' valign='middle' height='2'><a href='homework/apus/Chapter%20";
	echo $chapter;
	echo "-pgs%20";
	echo $from_page;
	echo "-";
	echo $to_page;
	echo ".doc'><div align='center' class='mainlink'>Download</div></a></td><td height='2' valign='top' bgcolor='#000000' class='maintext'>&nbsp;Chapter ";
	echo $chapter;
	echo ": pgs. ";
	echo $from_page;
	echo " - ";
	echo $to_page;
	echo "</td></tr>";
}

function notes_chapter_header($chapter, $title)
{
	echo "<tr><td width='94' valign='middle' height='2' bgcolor='#666666'><div align='center'>";
	echo "<font class='maintext'><b>Chapter ";
	echo $chapter;
	echo "</b></font>";
	echo "</div><a name='";
	echo $chapter;
	echo "'></a></td><td valign='middle' height='2' bgcolor='#333333'><div align='right'><font color='#FFFFFF' class='maintext'><b>";
	echo $title;
	echo "</b></font></font></a></td></tr>";
}
?> 