<?
	echo "<table width='97%' cellpadding='0' cellspacing='3' border='0'><tr><td>";
	$layout = new Layout();
	
	$leftLink = "<span id='PageNumberBody' class='textBig'>Page&nbsp;<span id='PageNumber'>1</span></span>";
	$title = "Photo Albums Gallery";
	if(check_int($_GET['cityId']) == 1 && $_GET['cityId'] > 0) $title = dbFindCity($_GET['cityId'])." ".$title;

	$layout->bubbleBoxTop($title,$leftLink);
?>
		<table width="100%" cellpadding="15" cellspacing="0" border="0">					
			<tr bgcolor="#333333" class="text"> 
				<td align="center">
					<?	
						if (check_int($_GET['cityId']) == 1 && $_GET['cityId'] > 0) dbGetAlbumByCity($_GET['cityId']); 
						else 
						{
							echo "<script>document.getElementById('PageNumberBody').style.display = 'none';</script>";
							dbGetCity("album", "");
						}
					?>		
				</td>		
			</tr>	
		</table>
<?
	$layout->bubbleBoxBottom(); 
	echo "</td></tr></table>";
?>