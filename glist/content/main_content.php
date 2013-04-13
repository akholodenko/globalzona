<div class='login_box_wrap'>
	<div class='box_top text_tab transparent'>
		log-in
	</div>
	<div class='login_box'>
		<?	Form::LoginForm();	?>
	</div>
</div>

<?
/*
	if($_GET['remote'] == 'true')
	{
		include "../classes/allClasses.php";
	}

	//welcome message
	Layout::WelcomeMessage();

	$events = Data::GetEvents("future", false);

	//display next event
	if(count($events) > 0)
	{
		Layout::EventTop($events[0], 300, true, true);
	}
	else
	{
		echo "<div style='height: 30px;'>There are no upcoming events.</div>";
	}

	//display other upcoming events
	if(count($events) > 1)
	{
		echo "<div style='height: 30px;'>&nbsp;</div>";
		Layout::EventsMiniList($events);
	}

	//Layout::Copyright();
*/
?>