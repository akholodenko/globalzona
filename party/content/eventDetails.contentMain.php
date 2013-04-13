<? 
	if ($_GET['eventId'] != "")
	{
		//eventDetails DECLARED IN INCLUDE.HEADER.PHP
		$eventAddress = $eventDetails['address'].', '.dbFindCity($eventDetails['cityId']).', '.dbFindState($eventDetails['cityId']);		
		echo "<table width='97%' cellpadding=0 cellspacing=3 border=0><tr><td>";
			$layout = new Layout();
			$leftLink = "<a href='http://www.globalzona.com/party/calendar.php?cityId=".$eventDetails["cityId"]."'>View ".dbFindCity($eventDetails['cityId'])."'s Full Calendar</a>";
			$layout->bubbleBoxTop(urldecode($eventDetails['eventTitle']),$leftLink);
			$layout->bubbleBoxSpacer(); 

		echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
		echo "		<tr class='text'>";
		echo "			<td valign='top' class='textBig'>";
					echo "	<div style='padding-left: 15px; padding-right: 2px; text-align: justify'>";
								$layout->bubbleSubBoxTop(100);
?>
								<table width="100%" cellpadding="2" cellspacing="0" border="0">
									<tr>
										<td colspan='4' valign='top' style='padding-left: 36px;'>
											<script>
												function fbs_click() 
												{
													u = "http://www.globalzona.com/party/eventDetails.php?eventId=<?=$eventDetails['id']?>";
													t = "<?=$eventDetails['eventTitle']?>";
													window.open('http://www.facebook.com/share.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=800,height=436');
													return false;
												}
											</script>
											<style> 
												html .fb_share_button 
												{ 
													display: -moz-inline-block; 
													display:inline-block; 
													padding:1px 20px 0 5px; 
													height:15px; 
													border:1px solid #d8dfea; 
													background:url(http://static.ak.fbcdn.net/images/share/facebook_share_icon.gif?8:26981) no-repeat top right; 
												} 
												
												html .fb_share_button:hover 
												{ 
													color:#fff; 
													border-color:#295582; 
													background:#3b5998 url(http://static.ak.fbcdn.net/images/share/facebook_share_icon.gif?8:26981) no-repeat top right; 
													text-decoration:none; 
												} 
											</style> 
											<a href="http://www.facebook.com/share.php?u=http://www.globalzona.com/party/eventDetails.php?eventId=<?=$eventDetails['id']?>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;">
												Share on Facebook
											</a>
										</td>
									</tr>
									<tr>
										<td colspan='4' style='padding-left: 36px;'>
											<a onClick='showNotifyAboutEventDiv(); return false;' href='#' class='navTall' style='color: yellow; text-decoration: underline;'>Tell a friend about this event!</a>
										<?
											echo "<div id='notifyAboutEventDiv' style='padding: 5px; margin-left: -13px; display: none;'>";
											echo "	<input type='hidden' id='notifyAboutEventHiddenParam' value='closed'>";
												$layout->bubbleSub2BoxTop(95);
												$layout->notifyOfEvent($eventDetails['id']);
												$layout->bubbleSub2BoxBottom();
											echo "</div>";
										?>
										</td>										
									</tr>										
									<tr class="text"> 
									<? if ($_GET['weeklyDay'] == "") { ?>
										<td align="right" width='15%'>Date:</td>
										<td width='45%'><? echo date("l, F j, Y", strtotime($eventDetails['date'])); ?></td>		
									<? } else { ?>
										<td align="right" width="15%">Day:</td>
										<td width='45%'><? echo $_GET['weeklyDay']." (weekly)"; ?></td>
									<? } ?>
										<td width='20%' align="right">Time:</td>
										<td width='20%'><? echo date("g:i a", strtotime($eventDetails['date'])); ?></td>		
									</tr>						
									<tr class="text"> 
										<td align="right" valign="top">Venue:</td>
										<td colspan='3'><? $layout->printVenueName($eventDetails['venueName'],$eventDetails['venueId'],true); ?></td>		
									</tr>
									<tr class="text"> 
										<td align="right" valign="top">Address:</td>
										<td colspan='2'><a target="_blank" href="http://maps.google.com/?q=<? $layout->printVenueAddress($eventDetails); ?>"><? $layout->printVenueAddress($eventDetails); ?></a></td>		
										<td valign="top"><a href="#eventMap">View Map</a></td>
									</tr>	
								</table>
						<?
								$layout->bubbleSubBoxBottom();
								$layout->bubbleBoxSpacer();
								include "ads/ad1.php";	
								include "includes/eventDescriptionMapEdit.php";						
					echo "	</div>";
					$layout->bubbleBoxSpacer(); 								
				echo "	</td>";
				echo "	<td valign='top' align='center' width='250'>";
				?>
						<script>
							$(document).ready(function(){
								$(".lightbox").lightbox();
							});
						</script>
				<?
							$layout->bubbleSubBoxTop(90);
							echo "<div align='center'>";							
							if ($eventDetails['flyerURL'] != "") 
							{
								echo "	<a href='".$eventDetails['flyerURL']."' class='lightbox' title='".$eventDetails['eventTitle']."'>";
								echo "		<img class='imgBorder ' src='".$eventDetails['flyerURL']."' border='0' width='200'>";
								echo "	</a>";
							}
							else echo "	<img class='imgBorder' src='http://www.globalzona.com/party/images/no_flyer.jpg' border='0' width='200'>";
							echo "</div>";
							$layout->bubbleSubBoxBottom();
							$layout->bubbleBoxSpacer(); 
/*
							if ($eventDetails['guestListURL'] != "")
							{
								$layout->bubbleSubBoxTop(90);
								include "includes/guestlistForm.php";
								$layout->bubbleSubBoxBottom();
								$layout->bubbleBoxSpacer(); 
							}

							$layout->bubbleSubBoxTop(90);
							echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
							echo "		<tr class='textBig'>";
							echo "			<td align='center'>Creator Options:</td>";
							echo "			<td align='right'><a href='login.php?edit=true&eventId=".$_GET['eventId']."'>edit</a>&nbsp;|&nbsp;<a href='login.php?delete=true&eventId=".$_GET['eventId']."'>delete</a>&nbsp;&nbsp;&nbsp;</td>";
							echo "		</tr>";
							echo "	</table>";
							$layout->bubbleSubBoxBottom();
							$layout->bubbleBoxSpacer(); 
*/
							$layout->bubbleSubBoxTop(90);
							include "ads/ad3.php";
							$layout->bubbleSubBoxBottom();
							$layout->bubbleBoxSpacer(); 				
		echo "			</td>";
		echo "		</tr>";					
		echo "	</table>";
			$layout->bubbleBoxBottom(); 
			$layout->bubbleBoxSpacer();
		echo "</td></tr></table>";
	} 
?>