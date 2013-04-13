<?
	include "../../classes/database.php";

	function UpdateVenueReview($venueReviewId, $venueReviewText)
	{
		$query = "UPDATE venueReview set review='".$venueReviewText."' where id=".$venueReviewId;
		//echo $query;

		$db = new Database($query);
		$result = $db->ExecuteQuery($query);

		return true;
	}

	UpdateVenueReview($_GET['reviewId'],urlencode($_GET['reviewText']));
?>
<font color=yellow>updated review</font>