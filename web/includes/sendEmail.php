	<?
	$response = null;
	if ($_GET['send'] == "true" && $_POST['fromEmail'] != "" && $_POST['details'] != "")
	{
		$subject = "GZP: " . $_POST['subject'];
		$name="Smash Entertainment Guestlist";
		$email=$_POST['fromEmail'];
		$to="artemk@gmail.com";
		$message = $_POST['details'] ;
		if(mail($to,$subject,$message,"From: $email\n")) $response = true;
		else $response = false;
	}
	else $message = "Not all fields were filled in";
	
	if ($response == true && $_GET['send'] == "true") echo "<font color=green>Email Sent.</font>";
	else if ($response == false && $_GET['send'] == "true") echo "<font color=red>Failed to send.</font>";
	
	?>