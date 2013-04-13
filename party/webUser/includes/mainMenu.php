<?
		echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
		echo "		<tr class='text'>";
		echo "			<td valign='top' class='textBig'>";
		echo "				<div style='padding-left: 15px; padding-right: 2px; text-align: justify'>";
		echo "					<div id='mainMenu.Reviews'>";
									include "mainMenu.Reviews.php";
		echo "					</div>";
		echo "					<div id='mainMenu.Events' style='display: none;'>";
									include "mainMenu.Events.php";									
		echo "					</div>";
		echo "					<div id='mainMenu.AddEvent' style='display: none;'>";
									include "mainMenu.AddEvent.php";									
		echo "					</div>";
		echo "				</div>";
?>						
						</td>
						<td valign="top" align='center' width='250'>
							<?
							/*
								$layout->bubbleBoxSpacer(); 
								$layout->bubbleSubBoxTop(90);
								echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
								echo "	<tr class='nav'>";
								echo "		<td colspan='2' class='lightGradient'>&nbsp;&nbsp;&nbsp;Upcoming Events</td>";
								echo "	</tr>";								
								echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
								echo "</table>";
								$layout->bubbleSubBoxBottom();
							*/

								$layout->bubbleBoxSpacer(); 
								$layout->bubbleSubBoxTop(90);
								include "../ads/ad2.php";
								$layout->bubbleSubBoxBottom();

								$layout->bubbleBoxSpacer(); 
								$layout->bubbleSubBoxTop(90);
								echo "<div class='textBig' style='padding-left: 15px; padding-right: 15px; text-align: right; vertical-align: middle;'>";
								echo "approved&nbsp;&nbsp;<img src='http://www.globalzona.com/party/images/check-yes.jpg' width='20' height='20'>";
								echo "<br>pending approval&nbsp;&nbsp;<img src='http://www.globalzona.com/party/images/check-pending.jpg' width='20' height='20'>";
								echo "</div>";
								$layout->bubbleSubBoxBottom();
		echo "			</td>";
		echo "		</tr>";
		echo "	</table>";
?>