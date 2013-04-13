<table width="97%" cellpadding=0 cellspacing=3 border=0><tr><td>
<?
	$tempCityName = dbFindCity($_GET['cityId']);
	$layout = new Layout();

	$leftLink = "<a href='http://www.globalzona.com/party/calendar.php?cityId=".$_GET['cityId']."'>View Full Calendar</a>";
	$layout->bubbleBoxTop($tempCityName." Events",$leftLink);
	$layout->cityViewCalendar($_GET['cityId']); 
	$layout->bubbleBoxBottom(); 

	$layout->bubbleBoxSpacer();

	$leftLink = "<a href='http://www.globalzona.com/party/venueDirectory.php?cityId=".$_GET['cityId']."'>View Full Venue Directory</a>";
	$layout->bubbleBoxTop($tempCityName." Clubs and Bars",$leftLink);
	$layout->cityViewVenues($_GET['cityId']); 
	$layout->bubbleBoxBottom(); 

	$layout->bubbleBoxSpacer();	

	$leftLink = "<a href='http://www.globalzona.com/party/photo.php?cityId=".$_GET['cityId']."'>Full Album Collection</a>";
	$layout->bubbleBoxTop($tempCityName." Photo Albums",$leftLink);
	$layout->cityViewPhotos($_GET['cityId']);
	$layout->bubbleBoxBottom(); 

	$layout->bubbleBoxSpacer();
?>
</td></tr></table>