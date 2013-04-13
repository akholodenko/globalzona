<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Email</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?
	if ($_POST['email'] == "true")
	{
		if (mail($_POST['to'],$_POST['subject'],$_POST['message'],'From: info@globalzona.com'))
			echo "Send successfully to ".$_POST['to'];
		else echo "failed";
	}
?>
<form method="post">
	<table>
		<input type="hidden" name="email" value="true">
		<tr><td>email:</td><td><input type="text" name="to" value="<? echo $_POST['to']; ?>"></td></tr>
		<tr><td>subject:</td><td><input type="text" name="subject" value="<? echo $_POST['subject']; ?>"></td></tr>
		<tr><td>message:</td><td><textarea name="message"><? echo $_POST['message']; ?></textarea></td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" name="submit" value="Submit"></td></tr>		
	</table>	
</form>
</body>
</html>
