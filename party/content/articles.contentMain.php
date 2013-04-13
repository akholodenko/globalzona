<? 
		echo "<table width='97%' cellpadding=0 cellspacing=3 border=0><tr><td>";
			$layout = new Layout();
			$leftLink = "";
			$layout->bubbleBoxTop("Collection of Advice and Reviews for a Great NightLife Experience",$leftLink);
			$layout->bubbleBoxSpacer(); 

		echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
		echo "		<tr class='text'>";
		echo "			<td valign='top' class='textBig'>";
					echo "	<div style='padding-left: 15px; padding-right: 2px; text-align: justify'>";
								$layout->bubbleSubBoxTop(100);
								$articles = new Article();
								$articles->SetAllArticles("DESC");
								$articles->PrintArticleInfo(false);
								$layout->bubbleSubBoxBottom();
								$layout->bubbleBoxSpacer();					
					echo "	</div>";						
				echo "	</td>";
				echo "	<td valign='top' align='center' width='250'>";
								$layout->bubbleSubBoxTop(90);
								include "ads/ad10.php";
								include "ads/ad11.php";
								$layout->bubbleSubBoxBottom();
								$layout->bubbleBoxSpacer(); 
							?>					
						</td>	
					</tr>					
				</table>
<?
			$layout->bubbleBoxBottom(); 
			$layout->bubbleBoxSpacer();
		echo "</td></tr></table>";
?>