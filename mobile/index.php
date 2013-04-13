<?
	include '../party/classes/database.php';
	include '../party/classes/api.php';

	include 'utils/utils.php';

	$cities = API::GetCities();
?>
<html>
	<head>
		<title>GlobalZona.com: Boot. Click. Party!</title>  
		<link href="utils/mobile.css" rel="stylesheet" type="text/css">
		<script LANGUAGE="JavaScript" SRC="utils/js/jquery-1.4.2.js"></script>
		<script LANGUAGE="JavaScript" SRC="utils/js/jquery-ui-1.8.js"></script>
		<script LANGUAGE="JavaScript" SRC="utils/js/jquery-setup.js"></script>
		<script LANGUAGE="JavaScript" SRC="utils/js/utils.js"></script>

		<meta name="viewport" content="width=device-width; height: device-height; initial-scale=1.0; maximum-scale=1.0;">
		
		<script type="application/x-javascript">
			addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);

			function hideURLbar(){
				window.scrollTo(0,1);
			}
		</script>
	</head>
	<body>
		<h1>GlobalZona.com: Boot. Click. Party!</h1>
		<div id='main'>
			<h2>please select a city:</h2>
			<ul id='city_list'>
				<?
					for($x = 0; $x < count($cities); $x++)
					{
						echo "<li>";
						echo "	<a href='#' onClick=\"return load_city_homepage(".$cities[$x]['city_id'].")\">";
						echo "		<span class='city_list_spacer'>&nbsp;</span>";
						echo "		<img class='city_list_arrow'  src='utils/img/mobile.arrow.png' />";
						echo		Utils::DisplayCityText($cities[$x], true);
						echo "		<span style='float: right; padding-right: 10px;'>(".API::GetUpcomingEventsByCityId($cities[$x]['city_id']).")</span>";
						echo "	</a>";
						echo "</li>";
					}
				?>
			</ul>
		</div>
	</body>
</html>