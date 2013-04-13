<? 
	include 'utils.php' ;

	if ($_POST['email2'] != "")
		recordGuestList($_POST['firstname'],$_POST['lastname'],$_POST['email2'],$_GET['eventId']);	//record guestlist entry

	if($_GET['sidebar'] == "true")
	{
		header('Location: http://www.globalzona.com/party/index.php?guestlist=true');
?>
<!--
		<html>
			<head><META http-equiv="refresh" content="0;URL=http://www.globalzona.com/party/index.php?guestlist=true"></head>
		</html>
-->
<?
	}
	else
	{
		/*
		$pos = strpos(urldecode($_GET['guestListURL']), '@');
		$pos2 = strpos(urldecode($_GET['guestListURL']), '%40');

		echo $pos." ".$pos2." ".urldecode($_GET['guestListURL']);
		if ($pos != false || $pos2 != false) { // note: three equal signs
			$redirectURL =  "http://www.globalzona.com/party/eventDetails.php?guestListEmail=".$_GET['guestListURL']."&guestList=email&eventId=".$_GET['eventId'];
			//$redirectURL = "mailto:JABEntertainment2007%40yahoo.com";
		}
		else 
		*/
		if ($_GET['guestListURL'] != "") 
		{
			$redirectURL =  urldecode($_GET['guestListURL']);

			if (strrpos($redirectURL,"www.") === 0 && strrpos($redirectURL,"http://") === false)
				$redirectURL =  "http://".$redirectURL;
		}
		else $redirectURL =  "http://www.globalzona.com/party/eventDetails.php?guestList=false&eventId=".$_GET['eventId'];

		header('Location: '.$redirectURL);
?>
<!--
		<html>
			<head><META http-equiv="refresh" content="0;URL=<? echo urldecode($redirectURL); ?>"></head>
		</html>
-->
<?	}	?>