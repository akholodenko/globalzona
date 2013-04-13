$(document).ready(function(){

	//layers have been hidden with hardcoded CSS 
	//(IE doesn't process jQuery fast enough for seemless performance)
			
	//slide nav -> fade logo -> slide side content -> slide main content -> fade side affiliates
	$('#navigation').slideDown(700, function (){
			$('#logo').fadeIn('slow', function () {
					$('#content_side').slideDown(700, function () {
							$('#content_main').slideDown(700, function () {
									$('#news_side').slideDown(700);
								}
							);
						}
					);
				}
			);
		}
	);

	//give divs corners
	$('#content_main').corner('top');
	$('#content_side').corner();
	$('#news_side').corner();

	//set up image displaying
	$(".lightbox").lightbox();

	//make sure the main content bg is long enough
	//$("#content_main").height($("body").height() + 20);		
	//$('#copyright').insteadAfter('#content_main_data');
});			