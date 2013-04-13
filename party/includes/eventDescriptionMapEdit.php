<?
	//TABS

	echo "	<table cellpadding='0' cellspacing='0' width='100%' border='0'><tr>";
	echo "		<td width='10%' align='center' valign='bottom'>&nbsp;</td>";
	echo "		<td width='40%' align='center' valign='bottom'>";
	echo "			<div id='eventMapTabOn'>";
						$layout->bubbleTab("<a class='navTall' style='color: #bbbbbb;' href='#' onClick=\"showEventMap(); return false;\">Detailed&nbsp;Information</a>", 90);
	echo "			</div>";
	echo "			<div id='eventMapTabOff' style='display: none'>";
						$layout->bubbleTab2("<a class='textBig' href='#' onClick=\"showEventMap(); return false;\">Detailed&nbsp;Information</a>", 90);
	echo "			</div>";
	echo "		</td>";
	echo "		<td width='22%' align='center' valign='bottom'>";
	echo "			<div id='eventGuestlistTabOn' style='display: none'>";
						$layout->bubbleTab("<a class='navTall' style='color: #bbbbbb;' href='#' onClick=\"showEventGuestList(); return false;\">Guestlist</a>", 90);
	echo "			</div>";
	echo "			<div id='eventGuestlistTabOff'>";
						$layout->bubbleTab2("<a class='textBig' href='#' onClick=\"showEventGuestList(); return false;\">Guestlist</a>", 90);
	echo "			</div>";
	echo "		</td>";
	echo "		<td width='18%' align='center' valign='bottom'>";
	echo "			<div id='eventOptionsTabOn' style='display: none'>";
						$layout->bubbleTab("<a class='navTall' style='color: #bbbbbb;' href='#' onClick=\"showEventOptions(); return false;\">Options</a>", 90);
	echo "			</div>";
	echo "			<div id='eventOptionsTabOff'>";
						$layout->bubbleTab2("<a class='textBig' href='#' onClick=\"showEventOptions(); return false;\">Options</a>", 90);
	echo "			</div>";
	echo "		</td>";
	echo "		<td width='10%'>&nbsp;</td>";
	echo "	</tr></table>";

	//TAB CONTENT
				$layout->bubbleSubBoxTop(100);
	echo "		<div id='eventMapTab'>";
	echo "			<div class='textBig' style='padding-left: 15px; padding-right: 15px; padding-bottom: 10px; text-align: justify'>".urldecode($eventDetails['message'])."</div>";
					include "includes/eventMap.php";
	echo "		</div>";
	echo "		<div id='eventGuestlistTab' style='display: none'>";
	echo "			<div class='textBig' style='padding-left: 15px; padding-right: 15px; text-align: justify; height: 350px;'>";
						if ($eventDetails['guestListURL'] != "") 
							echo "<a target='_blank' href='".urldecode($eventDetails['guestListURL'])."'>".$layout->printLimitedString(urldecode($layout->GetFullURL($eventDetails['guestListURL'])),60)."</a>";
						else 
							echo "Unfortunately, there is no guestlist information available for this event.";
	echo "			</div>";
	echo "		</div>";
	echo "		<div id='eventOptionsTab' style='display: none'>";
			echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0' style='padding-left: 15px; padding-right: 15px;'>";
			echo "		<tr class='textBig'>";
			echo "			<td>Creator Options:</td>";
			echo "			<td align='right'><a href='login.php?edit=true&eventId=".$_GET['eventId']."'>edit</a>&nbsp;|&nbsp;<a href='login.php?delete=true&eventId=".$_GET['eventId']."'>delete</a></td>";
			echo "		</tr>";
			echo "	</table>";
	echo "		</div>";
				$layout->bubbleSubBoxBottom();
?>