$(document).ready(function(){
	$('#message_modal_window').dialog({ autoOpen: autoModalPopUp, modal: true, width: 700, height: 500, minWidth: 700, minHeight: 500 });
	
	if(autoModalPopUp)
	{
		set_message_window(autoModalSubject, autoModalBody, true);
		$('#message_modal_window').dialog('option', 'width', '300');
		$('#message_modal_window').dialog('option', 'height', '200');
		$('#message_modal_window').dialog('option', 'position', 'center');
		$('#message_modal_window').dialog('option', 'resizable', false);
	}
	else
	{
		$('#message_modal_window').dialog('option', 'width', '700');
		$('#message_modal_window').dialog('option', 'height', '500');
	}



/*
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
*/
});			