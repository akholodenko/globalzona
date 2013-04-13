<? 
	include "../utils.php";

	$submitEvent = new Event(); 
	if ($submitEvent->SubmitEvent())
	{
?>
		<span class='navTall'>
			An email has been sent to <? echo $_GET['email']; ?>, with your password.
			&nbsp;<a href="http://www.globalzona.com/party/eventDetails.php?eventId=<? echo $submitEvent->EventId; ?>">View Your Event</a>
		</span>
<?
	}
	else 
		echo "<span class='navTall'>Unfortunately, there was a problem with the submission of your event.</span>";
?>
<!--
<div style="width: 100%; text-align: left; padding: 15px">
	<br>eventTitle: <? echo stripslashes(urldecode($_GET['eventTitle'])); ?>
	<br>pMonth: <? echo $_GET['pMonth']; ?>
	<br>pDay: <? echo $_GET['pDay']; ?>
	<br>pYear: <? echo $_GET['pYear']; ?>
	<br>hour: <? echo $_GET['hour']; ?>
	<br>minute: <? echo $_GET['minute']; ?>
	<br>ampm: <? echo $_GET['ampm']; ?>
	<br>city: <? echo $_GET['city']; ?>
	<br>email: <? echo $_GET['email']; ?>
	<br>address: <? echo $_GET['address']; ?>
	<br>venueName: <? echo stripslashes(urldecode($_GET['venueName'])); ?>
	<br>venueId: <? echo $_GET['venueId']; ?>
	<br>venueManual: <? echo $_GET['venueManual']; ?>
	<br>name: <? echo $_GET['name']; ?>
	<br>flyer: <? echo $_GET['flyer']; ?>
	<br>guestlist: <? echo $_GET['guestlist']; ?>
	<br>password: <? echo $_GET['password']; ?>
	<br>message: <? echo stripslashes($_GET['message']); ?>
</div>
-->