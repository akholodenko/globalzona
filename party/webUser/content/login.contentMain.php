<?
	if($_GET['confirmationCode'] != "")
	{
		include "classes/database.php";
		include "classes/session.php";

		$newUserInfo['id'] = $_GET['userId'];
		$newUserInfo['email'] = $_GET['email'];
		$newUserInfo['confirmationCode'] = $_GET['confirmationCode'];

		$session = new Session();
		if($session->ConfirmNewUser($newUserInfo))
			$confirmMessage = "Your account has been activated! Please log-in.";
		else
			$confirmMessage = "Unfortunately, we were unable to activate your account.";
	}


	echo "<table width='97%' cellpadding='0' cellspacing='3' border='0'><tr><td>";
	$layout = new Layout();
	$leftLink = "";
	$layout->bubbleBoxTop("Login or Register",$leftLink);
	echo "<div align='center'>".$confirmMessage."</div>";
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td align='center' valign='top'>
		<?	
			$layout->bubbleBoxSpacer();
			$layout->bubbleSubBoxTop(90);
			$layout->loginForm();
			$layout->bubbleSubBoxBottom();
		?>		
			</td>
			<td align='center' valign='top'>
		<?	
			$layout->bubbleBoxSpacer();
			$layout->bubbleSubBoxTop(90);
			$layout->registrationForm(); 
			$layout->bubbleSubBoxBottom();
		?>		
			</td>
		</tr>
	</table>
<? 
	$layout->bubbleBoxSpacer();
	$layout->bubbleBoxBottom(); 
	$layout->bubbleBoxSpacer();
	echo "</td></tr></table>";
?>