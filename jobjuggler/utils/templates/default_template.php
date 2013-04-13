<html>
	<head>
		<script src="<?=Constants::FILE_PATH_JQUERY;?>"></script>
		<script src="<?=Constants::FILE_PATH_JQUERY_UI;?>"></script>
		<script src="<?=Constants::FILE_PATH_JQUERY_TOOLTIP;?>"></script>
		<script src="<?=Constants::FILE_PATH_JQUERY_SETUP;?>"></script>
		<script src="<?=Constants::FILE_PATH_JS_ELEMENTS;?>"></script>
		<script src="<?=Constants::FILE_PATH_JS_UTILS;?>"></script>
		<link href="<?=Constants::FILE_PATH_CSS_DEFAULT;?>" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		<div id='container'>
			<div id='header'>
				<? include($template_header); ?>
			</div>
			<div id='main'>
				<? include($template_main); ?>
			</div>
		</div>
		<div id='footer'>
			<? include($template_footer); ?>
		</div>
	</body>
</html>