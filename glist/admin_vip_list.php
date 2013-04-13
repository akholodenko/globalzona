<?
	session_start();
	include "classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
?>
		<html>	
			<head>
				<title>AddictionSF.com: VIP List</title>
			</head>
			<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
				<div style='width: 100%;'>
<?
					$vip = Data::GetVIP ();	
					for($x = 0; $x < count($vip); $x++)
					{
						echo urldecode($vip[$x]['first_name']);			
						echo "&nbsp;";
						echo urldecode($vip[$x]['last_name']);			
						echo "&nbsp;&nbsp;&nbsp;";
						echo urldecode($vip[$x]['email']);			
						echo "<br/>";
					}
?>
				</div>
			</body>
		</html>
<?
	}
?>

