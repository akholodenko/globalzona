<?
	$layout->bubbleBoxSpacer();
	$layout->bubbleSubBoxTop(100);

//	$userVenueReviews = $session->GetUserVenueReviews($_SESSION['userId']);
	echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
	echo "	<tr class='nav'>";
	echo "		<td class='lightGradient'>&nbsp;&nbsp;&nbsp;Your Events</td>";
	echo "	</tr>";								
	echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
	echo "	<tr><td align='center'>";
	echo "		<table cellpadding=2 cellspacing=0 border=0 width='98%'>";								
	/*
	if (count($userVenueReviews) > 0)
	{
		for($i=0; $i < count($userVenueReviews); $i++)
		{
			echo "<input type='hidden' id='venueDetailsStatus".$userVenueReviews[$i]['reviewId']."' name='venueDetailsStatus".$userVenueReviews[$i]['venueId']."' value='0'>";
			echo "<tr>";
			echo "	<td align='center'>";
						$layout->showStatus($userVenueReviews[$i]['approved']);
			echo "	</td>";
			echo "	<td class='textBig' width='40%'>";
			//echo "		<a href='#' onClick=\"return showReviewDetails(".$userVenueReviews[$i]['reviewId'].");\">".$userVenueReviews[$i]['venueName']." Review</a>";
			echo 		$userVenueReviews[$i]['venueName'];
			echo "	</td>";
			echo "	<td class='textBig' width='25%'>";
			//echo		$userVenueReviews[$i]['cityName'];
			echo "		<a href='#' onClick=\"return showReviewDetails(".$userVenueReviews[$i]['reviewId'].");\"><span id='viewHideReviewLink".$userVenueReviews[$i]['reviewId']."'>view review</span></a>";
			echo "	</td>";
			echo "	<td align='right' width='25%'>";
						$layout->showRating($userVenueReviews[$i]['rating'],"dark");
			echo "	</td>";
			echo "</tr>";
			echo "<tr>";
			echo "	<td class='textBig' colspan='4' style='text-align: justify;'>";
			echo "		<div id='venueBubble".$userVenueReviews[$i]['reviewId']."' style='display: none;'>";
							$layout->bubbleSub2BoxTop(100);
			echo "			<div id='venue".$userVenueReviews[$i]['reviewId']."' style='margin-left: 10px; margin-right: 10px; display: none;'>";
			echo "				<div id='venueReviewLinks".$userVenueReviews[$i]['reviewId']."' style='text-align: right;'>";
			echo "					<span style='float: left' id='venueReviewUpdateResult".$userVenueReviews[$i]['reviewId']."'>&nbsp;</span>";
			echo "					<a href='#' onClick=\"return editReviewDetails(".$userVenueReviews[$i]['reviewId'].");\">edit</a> | ";
			echo "					<a href='../venueDetails.php?venueId=".$userVenueReviews[$i]['venueId']."'>view venue profile</a>";
			echo "				</div>";
			echo "				<div id='venueReviewText".$userVenueReviews[$i]['reviewId']."' style='text-align: justify;'>".urldecode($userVenueReviews[$i]['review'])."</div>";
			echo "			</div>";
			echo "			<div id='venueBackUp".$userVenueReviews[$i]['reviewId']."' style='display: none;' >&nbsp;</div>";
			echo "			<div id='venueBackUpLinks".$userVenueReviews[$i]['reviewId']."' style='display: none;' >&nbsp;</div>";
			echo "			<div id='venueBackUpText".$userVenueReviews[$i]['reviewId']."' style='display: none;' >&nbsp;</div>";
			echo "			<div id='newVenueText".$userVenueReviews[$i]['reviewId']."' style='display: none;' >&nbsp;</div>";
							$layout->bubbleSub2BoxBottom();
			echo "		</div>";
			echo "	</td>";
			echo "</tr>";
		}
	}
	else */
	echo "<tr><td class='textBig'>You have not posted any events. (feature under construction)</td></tr>";

	echo "		</table>";
	echo "	</td></tr>";
	echo "</table>";
	$layout->bubbleSubBoxBottom();	
?>