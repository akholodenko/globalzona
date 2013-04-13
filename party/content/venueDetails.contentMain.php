<? if ($_GET['venueId'] != "") { ?>
		<table width="97%" cellpadding=0 cellspacing=3 border=0><tr><td>
		<?
			//$venueDetails populated in include.header.map.php
			if ($venueDetails["countryName"] != "" && $venueDetails["countryName"] != "USA")
				$venueAddress = $venueDetails["address"].", ".$venueDetails["city"].", ".$venueDetails["countryName"];
			else
				$venueAddress = $venueDetails["address"].", ".$venueDetails["city"].", ".$venueDetails["state"];

			$layout = new Layout();
			$leftLink = "<a href='http://www.globalzona.com/party/venueDirectory.php?cityId=".$venueDetails["cityId"]."'>View Full ".$venueDetails["city"]." Venue Directory</a>";
			$layout->bubbleBoxTop(urldecode($venueDetails['name']),$leftLink);
?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr class="text">
					<td valign="top" class="textBig">
					<? 
						echo "<div style='padding-left: 15px; padding-right: 2px; text-align: justify'>";
								$layout->bubbleBoxSpacer();
								$layout->bubbleSubBoxTop(100);
?>
								<table width='100%' cellpadding="2" cellspacing="0" border="0">

									<tr>
										<td colspan='2' style='padding-left: 22px;'><a href='webUser/mainMenu.php?venueId=<? echo $venueDetails["id"]; ?>' class='navTall' style='color: yellow; text-decoration: underline;'>Add Your Review!</a></td>
									</tr>

									<tr class='text'>
										<td width='15%' valign='top' align='right'>&nbsp;Address:</td>
										<td>
											<a target="_blank" href="http://maps.google.com/?q=<? echo $venueAddress;?>">
												<?	echo $venueDetails["address"].", ".$venueDetails["city"].", ";

													if ($venueDetails["countryName"] != "" && $venueDetails["countryName"] != "USA") echo $venueDetails["countryName"];
													else echo $venueDetails["state"]; ?>
											</a>
										</td>
									</tr>
								<? if ($venueDetails["website"] != "") { ?>
									<tr class='text'>
										<td align='right'>&nbsp;Website:</td>
										<td><a target="_blank" href="<? echo $venueDetails["website"];?>"><? echo $layout->printLimitedString($venueDetails["website"],60);?></a></td>
									</tr>
								<? } ?>
								</table>
						<?
								$layout->bubbleSubBoxBottom();
								$layout->bubbleBoxSpacer();
								include "ads/ad1.php";							 
							
								//$layout->bubbleBoxSpacer(); 
								//echo urldecode($venueDetails['text']);
								include "includes/venueAlbumEvents.php";
						echo "</div>";
						?>						
					</td>
					<td valign="top" align='center' width='250'>
						<script>
							$(document).ready(function(){
								$(".lightbox").lightbox();
							});
						</script>
						<?	
							if ($venueDetails['imgURL'] != "") 
							{ 
								$layout->bubbleBoxSpacer(); 
								$layout->bubbleSubBoxTop(90);
								echo "<div align='center'>";
								echo "	<a href='".$venueDetails["imgURL"]."' class='lightbox' title='".urldecode($venueDetails['name'])."'>";
								echo "		<img class='imgBorder' src='".$venueDetails["imgURL"]."' border='0' width='200'>";
								echo "	</a>";
								echo "</div>";
								$layout->bubbleSubBoxBottom();
							} 
							/*
							$layout->bubbleBoxSpacer(); 
							$layout->bubbleSubBoxTop(90);

							include "ads/ad2.php";

							$layout->bubbleSubBoxBottom();
							*/
							$layout->bubbleBoxSpacer(); 
							$layout->bubbleSubBoxTop(90);
						?>
							<table width='100%' cellpadding="2" cellspacing="0" border="0">									
								<tr>
									<td colspan=2 align='center'><div id="map" style="width: 196; height: 250px"></div></td>
								</tr>
								<tr class='text'>
									<form action="http://maps.google.com/maps" method="get">
									<td colspan=2 align='center'>
										<div class='spacer'>&nbsp;</div>
										<input onClick="document.getElementById('fromAddress').value='';" id="fromAddress" type="text" size=30 name="saddr" id="saddr" value="&nbsp;Click here to enter start address"  class='form'/>
										<div class='spacer'>&nbsp;</div>
										<input type="submit" value="Get Driving Directions" class='form' />
										<input type="hidden" name="daddr" value="<? echo $venueAddress; ?>" />
										<input type="hidden" name="hl" value="en" />
										<div class='spacer'>&nbsp;</div>
									</td>
									</form>
								</tr>
							</table>
						<?	$layout->bubbleSubBoxBottom();	?>						
					</td>	
				</tr>
			</table>
<?
			$layout->bubbleBoxSpacer(); 
			$layout->bubbleBoxBottom(); 
			$layout->bubbleBoxSpacer();
?>
		</td></tr></table>
<?	} ?>