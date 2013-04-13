<html>
	<head>
		<title>AddictionSF.com</title>
		<link href="http://www.addictionsf.com/css/default.css" rel="stylesheet" type="text/css">
		<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/utils.js"></script>
		<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery-1.3.1.js"></script>
		<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery-ui-1.6rc6.js"></script>
		<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery.corner.js"></script>
		<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery.lightbox.js"></script>
		<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery.setup.js"></script>
		<link href="http://www.addictionsf.com/css/lightbox.css" rel="stylesheet" type="text/css">		
	</head>
	<body bgcolor="black" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<noscript>
			<? include "content/js_turned_off_content.php"; ?>
		</noscript>
		<div id='navigation' style="display: none; width: 100%; height: 28px; background-color: black; text-align: center; margin-top: 35px;">
			<?	Layout::Navigation(); ?>
		</div>
		<div style="text-align: left; margin: -55px 0px 0px 20px;">
			<img style='display: none;' id="logo" src="http://www.addictionsf.com/images/logo_s.png" width='350'>
		</div>
		<div id='content_all' class='text_body' style='height: 100%; width: 900px; margin: 20px auto 0px auto;'>
			<div style='float: right'>
				<div id='content_side' class='side_content' style='display: none;' >
					<div class='text_header_black' style="margin-top: 7px;">
						AddictionSF VIP
					</div>
					<div id='content_vip_form'>
						<?	Layout::VIPForm("100", "width: 120px;","text_body_black", false, '#22231e', 'onSubmit="return false;"', 'onClick="saveVIP(document.getElementById(\'vip_form\')); return false;"');	?>
					</div>				
				</div>
				<!--
				<div id='side_affiliate' style='width: 250px; margin-top: 20px; display: none;'>
					<a href='http://www.globalzona.com' target='blank'>
						<img src='http://www.addictionsf.com/images/affiliates/gz_banner_100x100.jpg' style='border: 1px solid #9dca3a; padding: 5px;'>
					</a>
				</div>
				-->
			</div>
			<div style='float: right; clear: both; margin-top: 20px;'>
				<div id='news_side' class='news_content' style='display: none;'>
					<?	Layout::NewsSpecials();	?>
				</div>
			</div>
			<div id='content_main' class='main_content' style='display: none; padding: 10px 0px 10px 0px; margin-bottom: 0px; height: 100%'>
				<div id='content_main_data' class='main_content_data'>
					<? include $mainFileName; ?>
				</div>
			</div>
		</div>	
		<?
			Layout::Copyright();
		?>
	</body>
</html>