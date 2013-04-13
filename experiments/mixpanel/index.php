<html>
	<head>
		<!-- Mixpanel --><script type="text/javascript">var mpq=[];mpq.push(["init","fc08aa327a82c1cafd64a125e96be047"]);(function(){var a=document.createElement("script");a.type="text/javascript";a.async=true;a.src=(document.location.protocol==="https:"?"https:":"http:")+"//api.mixpanel.com/site_media/js/api/mixpanel.js";var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)})();</script><!-- End Mixpanel -->
		<script>
			function link_click_test (event_name, value, position, text)
			{
				mpq.push(["track", event_name, {"link_id": value, "position": position, "text": text}]);
			}
		</script>
	</head>
	<body>
		<a href='#' onclick="link_click_test('link_one','100', 5, '100 with pos 5'); return false;">Link One - 100, pos. 5</a> | 
		<a href='#' onclick="link_click_test('link_one','100', 3, 'Pos Three'); return false;">Link One - 100</a> | 
		<a href='#' onclick="link_click_test('link_one','101', 1, 'Pos One'); return false;">Link One - 101</a> |
		<a href='#' onclick="link_click_test('link_one','102', 2, 'Pos Two'); return false;">Link One - 102</a> |		 
		<a href='#' onclick="link_click_test('link_one','103', 4, 'Some Text'); return false;">Link One - 103</a> |		 		
		<p/>
		<a href='#' onclick="link_click_test('link_two','200'); return false;">Link Two</a>
		<br/>
		<a href='#' onclick="link_click_test('link_three','300'); return false;">Link Three</a>	
	</body>
</html>
