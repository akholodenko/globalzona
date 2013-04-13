<style>
	.title
	{
		font-family: Tahoma;
		font-size: 15px;
		font-weight: bold;
		line-height: 25px;
	}

	.text
	{
		font-family: Tahoma;
		font-size: 14px;
		font-weight: normal;
		line-height: 18px;
	}
</style>
<?
	include "classes/allClasses.php";

	if($_GET['event_id'] != "")
	{
		$event = Data::GetEventById($_GET['event_id'], false);	
		Layout::EventDetailsSimple ($event);
	}
?>

