<?
	include ("classes/ui.class.php");
	include ("classes/database.class.php");
	include ("classes/data.class.php");
?>
<html>
	<head>
		<title>LemonLog</title>  
		<link href="css/all.css" rel="stylesheet" type="text/css">
		<script LANGUAGE="JavaScript" SRC="../mobile/utils/js/jquery-1.4.2.js"></script>
		<script LANGUAGE="JavaScript" SRC="js/utils.js"></script>
		<script LANGUAGE="JavaScript" SRC="js/jquery.setup.js"></script>
		

<!--
		<script LANGUAGE="JavaScript" SRC="utils/js/jquery-ui-1.8.js"></script>		
-->
		<meta name="viewport" content="width=device-width; height: device-height; initial-scale=1.0; maximum-scale=1.0;">
		
		<script type="application/x-javascript">
			addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);

			function hideURLbar(){
				window.scrollTo(0,1);
			}
		</script>
	</head>
	<body>
		<div id='loader'>
			<img src='images/spinner3.gif' />
		</div>
		<div id='container'>
			<div id='logo_container'>
				<img src='images/logo.png' />
			</div>
			<div id='main'>
				<? 
					$in_page = true;
					include ("content/form.php"); 
				?>
			</div>
		</div>
	</body>
</html>