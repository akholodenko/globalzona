var text_blink;

function ConfirmDeleteVIP(name) 
{
	var answer = confirm("Delete " + name + " from the VIP list?")
	if (answer){
		return true;
	}
	else{
		return false;
	}
}

function ConfirmDeleteEvent() 
{
	var answer = confirm("Delete event? (guestlist will be lost)")
	if (answer){
		return true;
	}
	else{
		return false;
	}
}

function validateGuestlist (theForm)
{
	if (theForm.first_name.value == "")
	{
		alert("Please fill in your first name.");
		theForm.first_name.focus();
		return false;
	}
	if (theForm.last_name.value == "")
	{
		alert("Please fill in your last name.");
		theForm.last_name.focus();
		return false;
	}
	if (theForm.email.value == "")
	{
		alert("Please fill in your email.");
		theForm.email.focus();
		return false;
	}
	return true;
}

function loadData (url)
{
	//turn off blinking text (next event), so it doesn't clash with newly loaded one
	if(text_blink) text_blink.stop();

	$("#content_main_data").fadeOut('slow', function() {
			$("#content_main_data").load(url, null, function(){
					$("#content_main_data").fadeIn('slow');
					
					var dataHeight = $("#content_main_data").height();
					var bgHeight = $("#content_main").height();
					var bodyHeight = $("body").height();

					if(dataHeight < bgHeight)	//remove bg fade from div
						$("#content_main_data").removeClass("main_content_data");
					else	//add bg fade to div
						$("#content_main_data").addClass("main_content_data");
						
/*
					if(dataHeight > bgHeight)
					{
						$("#content_main").height(dataHeight);
					}
					else
					{
						$("#content_main").height(bodyHeight + 20);
					}
*/
					$(".lightbox").lightbox();
				}
			);
		}
	);
}

function validateVIP (theForm)
{
	if (theForm.first_name.value == "")
	{
		alert("Please fill in your first name.");
		theForm.first_name.focus();
		return false;
	}
	if (theForm.last_name.value == "")
	{
		alert("Please fill in your last name.");
		theForm.last_name.focus();
		return false;
	}
	if (theForm.email.value == "")
	{
		alert("Please fill in your email.");
		theForm.email.focus();
		return false;
	}
	return true;
}

function saveVIP (theForm)
{
	if(validateVIP(theForm))
	{
		$("#content_vip_form").fadeTo('slow', .01, function () {
				var url = "services/services_new_vip.php?first_name=" + theForm.first_name.value + "&last_name=" + theForm.last_name.value + "&email=" + theForm.email.value + "&phone=" + theForm.phone.value;
				$("#content_vip_form").addClass('text_body_black');

				$("#content_vip_form").load(url, null, function () {
						$("#content_vip_form").fadeTo('slow', 1.0);
					}
				);				
			}
		);		
	}
}

function setNavMouseOver (nav)
{
	$(nav).addClass('text_nav_over');
}

function setNavMouseOut (nav)
{
	$(nav).removeClass('text_nav_over');
}

function Blink (id, speed)
{
	this.id = id;
	this.speed = speed;
	this.state = 'visible';
	this.intervalID;
	
	this.rotate = function () {
		if(this.state == 'visible')
		{
			//alert('here');
			this.state = 'hidden';
		}
		else
			this.state = 'visible';

		this.toggle();		
	}

	this.start = function () {
		this.intervalID = setInterval ( "text_blink.rotate()", this.speed );
	}

	this.toggle = function () {
		$('#' + this.id).css({'visibility' : this.state});
	}

	this.stop = function () {
		clearInterval(this.intervalID);
	}

}

/* NEW */

function show_past_events ()
{
	$('#past_event_list').css('display', 'block');
	$('#upcoming_event_list').css('display', 'none');
}

function show_upcoming_events ()
{
	$('#upcoming_event_list').css('display', 'block');
	$('#past_event_list').css('display', 'none');
}

function click_tab_past_events()
{
	highlight_tab('tab_past_events');
	$("#tab_past_events").unbind('mouseout');
	$("#tab_past_events").unbind('mouseover');

	dim_tab('tab_upcoming_events');
	$("#tab_upcoming_events").bind('mouseover', highlight_tab_upcoming_events);
	$("#tab_upcoming_events").bind('mouseout', dim_tab_upcoming_events);

	show_past_events();
}

function click_tab_upcoming_events()
{
	highlight_tab('tab_upcoming_events');
	$("#tab_upcoming_events").unbind('mouseout');
	$("#tab_upcoming_events").unbind('mouseover');

	dim_tab('tab_past_events');
	$("#tab_past_events").bind('mouseover', highlight_tab_past_events);
	$("#tab_past_events").bind('mouseout', dim_tab_past_events);

	show_upcoming_events();
}

function highlight_tab_past_events()
{
	highlight_tab('tab_past_events');
}

function dim_tab_past_events()
{
	dim_tab('tab_past_events');
}

function highlight_tab_upcoming_events()
{
	highlight_tab('tab_upcoming_events');
}

function dim_tab_upcoming_events()
{
	dim_tab('tab_upcoming_events');
}

function highlight_tab(id)
{
	$("#" + id).css({'opacity' : 0.7, 'filter' : 'alpha(opacity=70)'});
}

function dim_tab(id)
{
	$("#" + id).css({'opacity' : 0.5, 'filter' : 'alpha(opacity=50)'});
}