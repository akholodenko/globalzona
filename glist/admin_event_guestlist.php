<?
	session_start();
	include "classes/allClasses.php";

	if($_GET['event_id'] != "")
	{
?>
		<html>	
			<head>
				<title>AddictionSF.com: Guestlist</title>
			</head>
			<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
				<div style='width: 100%;'>
<?
						$event = Data::GetEventById($_GET['event_id']);	
						echo "Guestlist for <b>".stripslashes(urldecode($event['title']))."</b>";
						echo "<hr noshade size='1'/>";

						$event_guestlist = Data::GetGuestlistByEventId($_GET['event_id']);	

						for($x = 0; $x < count($event_guestlist); $x++)
						{
							echo urldecode($event_guestlist[$x]['first_name'])." ".urldecode($event_guestlist[$x]['last_name'])."&nbsp;&nbsp;&nbsp;&nbsp;".$event_guestlist[$x]['email']."<br>";
						}
?>
				</div>
			</body>
		</html>
<?
	}
?>

