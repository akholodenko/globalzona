<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $html->charset(); ?>
		<title>
			<?php echo $title_for_layout?>
		</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		
		<!-- Include external files and scripts here (See HTML helper for more info.) -->
		<?
			echo $html->css('gz_admin.css');
			echo $scripts_for_layout;
		?>		
	</head>
	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0>
		<!-- If you'd like some sort of menu to show up on all of your views, include it here -->
		<? include 'menu.ctp'; ?>
		
		<? echo $session->flash(); ?>

		<!-- Here's where I want my views to be displayed -->
		<?php echo $content_for_layout ?> 
		
		<!-- Add a footer to each displayed page -->
		<div id="footer">...</div>
	</body>
</html>