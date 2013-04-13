<?
	include "../classes/database.php";

	function SendForgotPassword($email)
	{
		$query = "SELECT password FROM webUser where email='".$email."'";
		//echo $query;

		$db = new Database($query);
		$result = $db->ExecuteQuery($query);

		if ($result != -1)
		{
			$num = mysql_numrows($result);
			$results = mysql_fetch_array($result);	
			
			if ($num != 1) echo "Your email doesn't match our records. Please contact us for a detailed inquiry.";
			else
			{
				$message = "Your password is: ".$results['password'];
				$headers = "From: info@globalzona.com";
				mail($email, 'GlobalZona.com Password Request', $message, $headers);

				echo "<div style='padding-left: 10px; padding-right: 10px;'>An email has been sent to <b>".$email."</b> with your password.</div>";
			}
		}
	}

	SendForgotPassword($_GET['email']);
?>