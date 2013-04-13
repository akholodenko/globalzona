<?
		echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
		echo "		<tr class='text'>";
		echo "			<td valign='top' class='textBig'>";
		echo "				<div style='padding-left: 15px; padding-right: 2px; text-align: justify'>";
								$layout->bubbleBoxSpacer();
								$layout->bubbleSubBoxTop(100);
								
								$venueDetails = $session->GetVenueById ($passedVenueId);
?>
								<table width='100%' cellpadding='2' cellspacing='0' border='0'>
									<tr class='text'>
										<td class='textBig'>&nbsp;&nbsp;<b>Your <? echo $venueDetails["name"]; ?> Review</b></td>
										<td class='text' align='right'><i>Rating from 1 (worst) to 5 (best)</i>&nbsp;&nbsp;</td>
									</tr>								
								</table>
							<?
								$layout->bubbleSubBoxBottom();
								$layout->bubbleBoxSpacer();
								include "../ads/ad1.php";							 							
								$layout->bubbleBoxSpacer(); 
								
								if ($_POST["submitUserReview"] == "true") include "includes/confirmationVenueReview.php";
								else include "includes/formVenueReview.php";

								$layout->bubbleBoxSpacer(); 								
								echo "</div>";
							?>						
						</td>
						<td valign="top" align='center' width='250'>
							<?	
								if ($venueDetails['imgURL'] != "") 
								{ 
									$layout->bubbleBoxSpacer(); 
									$layout->bubbleSubBoxTop(90);
									echo "<div align='center'><img class='imgBorder' src='".$venueDetails["imgURL"]."' border='0' width='200'></div>";
									$layout->bubbleSubBoxBottom();
								} 

								$layout->bubbleBoxSpacer(); 
								$layout->bubbleSubBoxTop(90);
								include "../ads/ad2.php";
								$layout->bubbleSubBoxBottom();
		echo "			</td>";
		echo "		</tr>";
		echo "	</table>";
?>