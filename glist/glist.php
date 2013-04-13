<?
	$user_message = "";
	if($_POST['sendEmail'] == "true")
	{
		$email_message = "Name: ".$_POST['f_name']." ".$_POST['l_name']."\nEmail: ".$_POST['email']."\nPhone (optional): ".$_POST['phone'];
		mail("vip@addictionsf.com","VIP Guestlist Sign-up",$email_message);

		$user_message = "Thank you for signing up!";
	}
?>
<html>
	<head>
		<style>
			.text_body
			{
				font-family: Tahoma;
				color: #33ff99;
				font-size: 12px;
			}

			.form
			{
				font-family: Tahoma;
				color: #33ff99;
				font-size: 12px;
				background-color: #333333;
				border: 1px solid #33ff99;
				width: 150px;
			}
		</style>
		<link href="http://www.addictionsf.com/css/default.css" rel="stylesheet" type="text/css">

		<script>
			function validateVIP (theForm)
			{
				if (theForm.f_name.value == "")
				{
					alert("Please fill in your first name.");
					theForm.f_name.focus();
					return false;
				}
				if (theForm.l_name.value == "")
				{
					alert("Please fill in your last name.");
					theForm.l_name.focus();
					return false;
				}
				if (theForm.email.value == "")
				{
					alert("Please fill in your email.");
					theForm.email.focus();
					return false;
				}
				return true;
			}
		</script>
	</head>
	<body bgcolor='black'>
		<div class="text_body" style="text-align: center;">
			<img id="logo" src="http://www.addictionsf.com/images/logo_s.png">
		</div>
		<hr style="color:#33ff99;" noshade size="1">

		<div class="text_body" style="text-align: center;">
		<?
			if($user_message == "")
			{
		?>
				<h1>VIP Guestlist</h1>
				<table align="center" border="0" cellpadding="0" cellspacing="5">
				<form onSubmit="return validateVIP(this);" method="POST">
					<input type="hidden" id="sendEmail" name="sendEmail" value="true">
					<tr class="text_body">
						<td>First Name:</td>
						<td><input type="text" id="f_name" name="f_name" class="form" maxlength="50"></td>
					</tr>
					<tr class="text_body">
						<td>Last Name:</td>
						<td><input type="text" id="l_name" name="l_name" class="form" maxlength="50"></td>
					</tr>
					<tr class="text_body">
						<td>Email:</td>
						<td><input type="text" id="email" name="email" class="form" maxlength="100"></td>
					</tr>
					<tr class="text_body">
						<td>Phone:</td>
						<td><input type="text" id="phone" name="phone" class="form" maxlength="100">&nbsp;(optional)</td>
					</tr>
					<tr class="text_body">
						<td>&nbsp;</td>
						<td><input type="submit" id="submit" name="submit" class="form" maxlength="100" value="Sign-up"></td>
					</tr>
				</form>
				</table>
		<?
			}
			else
			{
				echo "<h1>".$user_message."</h1>";
			}
		?>
		</div>
	</body>
</html>
