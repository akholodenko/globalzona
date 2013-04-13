<?
	include "classes/allClasses.php";

	if($_GET['event_id'] != "")
	{
?>
		<html>	
			<head>
				<title>AddictionSF.com</title>
				<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/utils.js"></script>
				<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery-1.3.1.js"></script>
				<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery-ui-1.6rc6.js"></script>
				<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery.corner.js"></script>
				<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery.lightbox.js"></script>

				<link href="http://www.addictionsf.com/css/admin.css" rel="stylesheet" type="text/css">
				<link href="http://www.addictionsf.com/css/lightbox.css" rel="stylesheet" type="text/css">

				<script>

					$(document).ready(function(){
						$(".lightbox").lightbox();			
					});			

				</script>
			</head>
			<body bgcolor="black" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
				<div style='text-align: center;'>
						<center>
<?
						echo "<div>";
						echo "	<img src='http://www.addictionsf.com/images/logo_red.png'>";
						echo "</div>";
						if($_GET['added'] == "true")
						{
							echo "<div class='text_body' style='line-height: 45px; font-weight: bold; font-size: 20px; color: orange;'>";
							echo "	Thank you for signing up!";
							echo "</div>";
						}

						$event = Data::GetEventById($_GET['event_id'], false);	

						if($_GET['html_content'] == "true")
						{
							Layout::EventDetailsSimple ($event);

						}
						else
						{
							Layout::EventDetails ($event);
							if($_GET['noform'] != "true" && $event['has_guestlist'] == 1)
							{
								Layout::GuestlistForm($event['id']);
							}
						}												
?>
						</center>
				</div>
			</body>
		</html>
<?
	}
?>

