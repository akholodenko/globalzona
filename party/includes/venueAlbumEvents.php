<?
	//$layout->bubbleBoxSpacer(); 
	echo "	<table cellpadding='0' cellspacing='0' width='90%' border='0'><tr>";
	echo "		<td width='10%' align='center' valign='bottom'>&nbsp;</td>";
	echo "		<td width='27%' align='center' valign='bottom'>";
	echo "			<div id='venueDescriptionTabOn'>";
						$layout->bubbleTab("<a class='navTall' style='color: #bbbbbb;' href='#' onClick=\"showDescription(); return false;\">Description</a>", 90);
	echo "			</div>";
	echo "			<div id='venueDescriptionTabOff' style='display: none'>";
						$layout->bubbleTab2("<a class='textBig' href='#' onClick=\"showDescription(); return false;\">Description</a>", 90);
	echo "			</div>";
//	echo "			<div id='venueDescriptionTabOff' style='display: none' class='textBig'><a href='#' onClick=\"showDescription(); return false;\">Description</a></div>";
	echo "		</td>";
	echo "		<td width='30%' align='center' valign='bottom'>";
	echo "			<div id='venueAlbumsTabOn' style='display: none'>";
						$layout->bubbleTab("<a class='navTall' style='color: #bbbbbb;' href='#' onClick=\"showVenueAlbums(); return false;\">Photo Albums</a>", 90);
	echo "			</div>";
	echo "			<div id='venueAlbumsTabOff' >";
						$layout->bubbleTab2("<a class='textBig' href='#' onClick=\"showVenueAlbums(); return false;\">Photo Albums</a>", 90);
	echo "			</div>";
//	echo "			<div id='venueAlbumsTabOff' class='textBig'><a href='#' onClick=\"showVenueAlbums(); return false;\">Photo Albums</a></div>";
	echo "		</td>";
	echo "		<td width='23%' align='center' valign='bottom'>";
	echo "			<div id='venueEventsTabOn' style='display: none'>";
						$layout->bubbleTab("<a class='navTall' style='color: #bbbbbb;' href='#' onClick=\"showVenueEvents(); return false;\">Events</a>", 90);
	echo "			</div>";
	echo "			<div id='venueEventsTabOff'>";
						$layout->bubbleTab2("<a class='textBig' href='#' onClick=\"showVenueEvents(); return false;\">Events</a>", 90);
	echo "			</div>";
//	echo "			<div id='venueEventsTabOff' class='textBig'><a href='#' onClick=\"showVenueEvents(); return false;\">Events</a></div>";
	echo "		</td>";
	echo "		<td width='10%'>&nbsp;</td>";
	echo "	</tr></table>";
				$layout->bubbleSubBoxTop(100);
	echo "		<div id='venueDescriptionTab'>";
	echo "			<div class='textBig' style='text-align: justify; padding-left: 15px; padding-right: 15px;'>".urldecode($venueDetails['text'])."</div>";
	echo "		</div>";
	echo "		<div id='venueAlbumsTab' style='display: none'>";
					dbGetAlbumByVenue($venueDetails["id"]);
	echo "		</div>";
	echo "		<div id='venueEventsTab' style='display: none'>";
					$event = new Event();
					$event->GetEventByVenue($_GET['venueId']);
	echo "		</div>";
				$layout->bubbleSubBoxBottom();
?>	