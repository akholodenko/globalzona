<style>
#cityInfoBreakDown ul
{
	list-style: none;
	padding: 0;
	margin: 0;
	line-height: 16px;

	font-family: Tahoma;
	font-size: 12px;
	font-weight: bold;

	color: #cccccc;
}
</style>

<?
	include "../utils.php";

	if ($_GET['cityId'] != "")
	{
		$layout = new Layout();
		echo "<div id='cityInfoBreakDown'>";
		echo "	<ul>";
		echo "		<li>Events: ".$layout->getCityEventCount($_GET['cityId'])."</li>";
		echo "		<li>Venues: ".$layout->getCityVenueCount($_GET['cityId'])."</li>";
		echo "		<li>Albums: ".$layout->getCityAlbumCount($_GET['cityId'])."</li>";
		echo "	</ul>";
		echo "</div>";
	}
?>