<?
	include "../classes/allClasses.php";

	echo "<hr style='color: #22231e; margin-left: 4px; margin-right: 4px;' noshade size='1'>";

	if($_GET['first_name'] != "" && $_GET['last_name'] != "" && $_GET['email'] != "")
	{
		Data::SetNewVIP(urlencode(stripslashes($_GET['first_name'])), urlencode(stripslashes($_GET['last_name'])), $_GET['email'], urlencode(stripslashes($_GET['phone'])));
		echo "You were added to the AddictionSF VIP.";
	}
	else
	{
		echo "There was a problem adding you to the AddictionSF VIP.";
	}
?>