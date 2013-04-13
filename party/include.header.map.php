<?
if ($_SERVER['PHP_SELF'] == "/party/eventDetails.php" || $_SERVER['PHP_SELF'] == "/party/venueDetails.php" || $_SERVER['PHP_SELF'] == "/party/venueEvents.php") 
{
	if ($_GET['eventId'] != "") $eventDetails = dbFindEvent($_GET['eventId']);
	if ($_GET['venueId'] != "")	$venueDetails = dbFindVenue($_GET['venueId']); 
?>
		<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
		<script type="text/javascript">
		_uacct = "UA-1167827-1";
		urchinTracker();
		</script>
		<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAAydArRxwCW1FZkEt3NUsvuhRTYH0sI20siFhlZDnz8drPgWnhwBQkmRCCXgKoXG7jVS3-0Bqq84FTfQ" type="text/javascript"></script>
		<script type="text/javascript">
		//<![CDATA[

		var map = null;
		var geocoder = null;

		function load() {
		  if (GBrowserIsCompatible()) {
			map = new GMap2(document.getElementById("map"));
			//map.setCenter(new GLatLng(37.4419, -122.1419), 13);
			map.addControl(new GSmallMapControl());
			geocoder = new GClientGeocoder();
		  }
		}

		function showAddress(address, venueName) 
		{
			address = urldecode(address);
		  if (geocoder) {
			geocoder.getLatLng(
			  address,
			  function(point) {
				if (!point) {
				  alert(address + " not found");
				} else {
				  map.setCenter(point, 14);
				  var marker = new GMarker(point);
				  map.addOverlay(marker);
				  <? if ($_SERVER['PHP_SELF'] != "/party/venueDetails.php" && $_SERVER['PHP_SELF'] != "/party/venueEvents.php") { ?>
				  marker.openInfoWindowHtml('<font class="textBlack"><div style="font-size: 14px; letter-spacing: 1px; text-align: center;">' + decodeURI(venueName).replace(/\+/g,' ') + '</div><br>' + unescape(address) + '</font>');
				  <? } ?>
				}
			  }
			);
		  }
		}
		//]]>		
		</script>


	</head>
	<? if ($_SERVER['PHP_SELF'] == "/party/eventDetails.php") 
	   { 
			$layout = new Layout();
			if ($layout->IsVenueId($eventDetails['venueId'])) $venueAddress = $layout->GetVenueAddress($eventDetails['venueId']);
			else $venueAddress = $eventDetails['address'];

			if ($layout->IsVenueId($eventDetails['venueId'])) $venueName = $layout->GetVenueName($eventDetails['venueId']);
			else $venueName = urlencode($eventDetails['venueName']);
	?>
		<body onload="load(); showAddress('<? echo urlencode($venueAddress).', '.dbFindCity($eventDetails['cityId']).', '.dbFindState($eventDetails['cityId']); ?>','<? echo $venueName; ?>');" onunload="GUnload()" bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<? } 
	   else if ($_SERVER['PHP_SELF'] == "/party/venueDetails.php" || $_SERVER['PHP_SELF'] == "/party/venueEvents.php")
	   { 
			if ($venueDetails["countryName"] != "" && $venueDetails["countryName"] != "USA") $venueAddress = $venueDetails["city"].", ".$venueDetails["countryName"];
			else $venueAddress = $venueDetails["address"].", ".$venueDetails["city"].", ".$venueDetails["state"];
		?>
		<body onload="load();showAddress('<? echo $venueAddress; ?>','<?echo $venueDetails['name']?>');" onunload="GUnload()" bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<? } ?>
<? } else { ?>
	</head>
	<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? } ?>