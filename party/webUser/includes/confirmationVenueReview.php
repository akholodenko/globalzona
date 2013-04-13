<?
if ($session->ProcessNewVenueReview($_POST['venueId'],$_SESSION['userId'],$_POST["reviewRating"],$_POST["reviewText"]))
{
	echo "<div style='margin-left: 12px;'><b>Thank you for your valuable opinion!</b> Your review has been submitted.<br>To edit/view your previous submissions, please visit the <a href='mainMenu.php'>Main Menu</a>.</div>";
	echo "<hr noshade size='1' color='#cccccc'>";
	$layout->bubbleBoxSpacer();
	echo "<div style='margin-left: 12px;'>";								
	$layout->showRating($_POST["reviewRating"],"");
	echo "</div>";
	echo "<div style='margin-left: 12px; text-align: justify;'>".$_POST["reviewText"]."</div>";
}
else
{
	$currentMessage = $session->getMessage();
	if($currentMessage != "") 	echo "<div style='margin-left: 12px;'><b>".$currentMessage."</b><br>To edit/view your previous submissions, please visit the <a href='mainMenu.php'>Main Menu</a>.</div>";
	else echo "<div style='margin-left: 12px;'><b>Sorry, but there was a problem submitting your review.</b><br>Please click back and trying again.</div>";
}
?>