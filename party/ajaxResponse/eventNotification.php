<?
	include "../utils.php";
	
	if ($_GET['eventId'] != "" && $_GET['toEmail'] != "" && $_GET['fromName'] != "" && $_GET['fromEmail'] != "")
	{
		$email = new Email();
		$email->to = $_GET['toEmail'];
		$email->fromName = $_GET['fromName'];
		$email->from = $_GET['fromEmail'];
		$email->subject = "Great Event Coming Up!";
		$email->GenerateEventNotificationEmailBody($_GET['eventId']);
		//echo $email->body;

		if($email->SendMail(true))
			echo  "<div align='center' style='padding: 10px;'>A message has been sent to your friend at ".$_GET['toEmail'].".</div>";
		else
			echo  "<div align='center' style='padding: 10px;'>There was a problem sending your message.<br>Please try again.</div>";

		recordGuestList($_GET['fromName'], "Tell A Friend (from)", $_GET['fromEmail'], $_GET['eventId']);
		recordGuestList("(from) ".$_GET['fromName'], "Tell A Friend (to)", $_GET['toEmail'], $_GET['eventId']);
	}
	else
	{
		echo  "<div align='center' style='padding: 10px;'>The information you provided was incomplete. Please try again.</div>";
	}
?>