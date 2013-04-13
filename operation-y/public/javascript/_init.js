$(document).bind('pageinit')
{
	$('.tile').live('tap', function(e) { 
		$(this).find('.body').css({'background-color':'#CCCCCC'});
		
		var category_id = $(this).data('category_id');
		
		document.location = "/" + Constants.controller_events + "/get/" + category_id; 
	});
}	