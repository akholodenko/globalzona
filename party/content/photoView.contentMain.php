<?
	if($_GET['photoAlbumId'] != "")
	{
		$photoAlbumInfo = dbFindAlbum($_GET['photoAlbumId']);

		echo "<table width='97%' cellpadding='0' cellspacing='3' border='0'><tr><td>";
		$layout = new Layout();
		
		$leftLink = "<a href='photo.php?cityId=".$photoAlbumInfo['cityId']."'>Back to ".$photoAlbumInfo['city']." Albums</a>&nbsp;|&nbsp;";
		$leftLink = $leftLink."<a href='contact.php?emailSubject=Please Add My Photo Album&specialMessage=paste link to your album here'>Send Us Your Album Link</a>";
		$title = urldecode($photoAlbumInfo['eventTitle'])." Photo Album";

		$layout->bubbleBoxTop($title,$leftLink);

		echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
		echo "	<tr class='nav' bgcolor='#333333'>";
		echo "		<td width='65%' valign='top' align='center'>";
		echo "			<div style='padding-left: 15px; padding-right: 2px; text-align: justify'>";
							$layout->bubbleBoxSpacer();
							$layout->bubbleSubBoxTop(100);
							echo "<table width='100%' cellpadding='2' cellspacing='0' border='0'>";
							echo "	<tr class='text'>";
							echo "		<td align='right' width='15%'>Date:</td>";
							echo "		<td>";
							echo			date("F j, Y", strtotime($photoAlbumInfo['eventDate']));
							echo "		</td>";
							echo "	</tr>";
							echo "	<tr class='text'>";
							echo "		<td align='right' width='15%'>Location:</td>";
							echo "		<td>".$photoAlbumInfo['city'].", ".$photoAlbumInfo['state']."</td>";
							echo "	</tr>";
							echo "	<tr class='text'>";
							echo "		<td align='right' width='15%'>Venue:</td>";
							echo "		<td><a href='venueDetails.php?venueId=".$photoAlbumInfo['venueId']."' class='textSubLink'>";
							echo "		<u>".urldecode($photoAlbumInfo['venueName'])."</u></b></a></td>";
							echo "	</tr>";
							echo "</table>";
							$layout->bubbleSubBoxBottom();
							$layout->bubbleBoxSpacer(); 
							include "ads/ad1.php";
		echo "			</div>";
		echo "		</td>";
		echo "		<td width='35%' valign='top' align='center'>"; 
						$layout->bubbleBoxSpacer();
						$layout->bubbleSubBoxTop(90);
						include "ads/ad3.php";
						$layout->bubbleSubBoxBottom();
		echo "		</td>";
		echo "	</tr>";
		echo "</table>";


		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='padding: 15px;'>";
		echo "	<tr>";
		echo "		<td class='text'>";
		echo "			&nbsp;<a target='_blank' href='".$photoAlbumInfo['albumUrl']."'>Remove Frame</a>";
		echo "		</td>";
		echo "	</tr>";
		echo "	<tr>";
		echo "		<td align='center'>";			
		echo "			<iframe width='678' height='700' scrolling='auto' src='".$photoAlbumInfo['albumUrl']."' style='border: 1px #333333 solid'></iframe>";
		echo "		</td>";
		echo "	</tr>";
		echo "</table>";

		$layout->bubbleBoxBottom(); 
		$layout->bubbleBoxSpacer();
		echo "</td></tr></table>";
	}
?>