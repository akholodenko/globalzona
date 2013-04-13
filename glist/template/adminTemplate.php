<html>	
	<head>
		<title>GlobalZona.com Guestlist Service</title>
		
		<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/glist/js/utils.js"></script>
		<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery-1.3.1.js"></script>
		<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery-ui-1.6rc6.js"></script>
		<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery.corner.js"></script>
		<script language="javascript" type="text/JavaScript" SRC="http://www.addictionsf.com/js/jquery.lightbox.js"></script>

<!--		<link href="http://www.addictionsf.com/css/admin.css" rel="stylesheet" type="text/css">-->
		<link href="http://www.globalzona.com/glist/css/glist.css" rel="stylesheet" type="text/css">
		<link href="http://www.addictionsf.com/css/lightbox.css" rel="stylesheet" type="text/css">

		<script>

			$(document).ready(function(){
				$(".lightbox").lightbox();	

				$("#tab_past_events").bind('mouseover', highlight_tab_past_events);
				$("#tab_past_events").bind('mouseout', dim_tab_past_events);

				$('#tab_past_events').bind('click', click_tab_past_events);
				$('#tab_upcoming_events').bind('click', click_tab_upcoming_events);

				$('#past_event_list').css('display', 'none');
			});			

			
		</script>
	</head>
	<body bgcolor="black" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<div style='margin-bottom: 25px;'>
			<?	
				if($mainNavigation != "")
				{
					include $mainNavigation;	
				}
			?>
		</div>
		<div style="width: 100%; padding-top: 10px;">
			<?	
				if($mainFileName != "")
				{
					include $mainFileName;	
				}
			?>
		</div>
	</body>
</html>