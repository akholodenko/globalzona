<?
	$SEO_TITLE_PREFIX = "";
	$SEO_TITLE_BODY = "Nightlife Events, Venues, Photo Albums";
	$SEO_TITLE_SUFFIX = "";

	if(IsValidId($_GET['cityId']))
	{
		$SEO_TITLE_PREFIX = dbFindCity($_GET['cityId']);
	}
	else if(IsValidId($_GET['venueId']))
	{
		$SEO_venueDetails = dbFindVenue($_GET['venueId']);

		$SEO_TITLE_PREFIX = urldecode($SEO_venueDetails['name']);
		$SEO_TITLE_BODY = "in ".$SEO_venueDetails['city'];
		$SEO_TITLE_SUFFIX = "- Description, Photo Albums, Events";
	}
	else if(IsValidId($_GET['eventId']))
	{
		$SEO_eventDetails = dbFindEvent($_GET['eventId']);

		$SEO_TITLE_PREFIX = urldecode($SEO_eventDetails['eventTitle']);

		if(IsValidId($SEO_eventDetails['venueId']))
			$SEO_TITLE_BODY = "at ".urldecode(dbGetVenueName($SEO_eventDetails['venueId']))." in ".dbFindCity($SEO_eventDetails['cityId']);
		else
			$SEO_TITLE_BODY = "at ".urldecode($SEO_eventDetails['venueName'])." in ".dbFindCity($SEO_eventDetails['cityId']);
	
		$SEO_TITLE_SUFFIX = "- Detailed Information";
	}
	else if(IsValidId($_GET['photoAlbumId']))
	{
		$SEO_albumDetails = dbFindAlbum($_GET['photoAlbumId']);

		$SEO_TITLE_PREFIX = urldecode($SEO_albumDetails['eventTitle']);
		$SEO_TITLE_BODY = "at ".urldecode($SEO_albumDetails['venueName'])." in ".$SEO_albumDetails['city'];
		$SEO_TITLE_SUFFIX = "- Photo Album";
	}
?>
