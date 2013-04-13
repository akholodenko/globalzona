<?
	include "../utils.php";
	
	if ($_GET['pollId'] != "")
	{
		$poll = new Poll($_GET['pollId']);
		$poll->setPollData();
		$poll->recordPollResponse($_GET['pollId'], $_GET['pollAnswerId'], $_SERVER['REMOTE_ADDR']);

		$poll->printPollResults();
	}
?>