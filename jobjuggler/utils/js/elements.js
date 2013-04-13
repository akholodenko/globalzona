function Elements () {}

Elements.getAdvancedNavigation = function ()
{
	var nav = $(document.createElement("ul"));
	nav.attr("id","advanced_nav_id");
	nav.addClass("advanced_nav");
	
	var nav_items = "";
	nav_items += "<li id='" + Constants.NAV_MAIN_ID + "'>Main</li>";
	nav_items += "<li id='" + Constants.NAV_OPPORTUNITIES_ID + "'>Opportunities</li>";
	nav_items += "<li id='" + Constants.NAV_CALENDAR_ID + "'>Calendar</li>";
	nav_items += "<li id='" + Constants.NAV_ADDRESS_BOOK_ID + "'>Address&nbsp;Book</li>";
	
	nav.html(nav_items);
	
	nav.css({display:"none"});
	
	//loop through each LI and add a click event
	nav.find('li').bind('click',function () {		
		AJAX.showPage($(this).attr('id'));
	});
	
	return nav;
}

Elements.getMainPrimaryHome = function ()
{
	var main = $(document.createElement("div"));
	main.attr("id", Constants.MAIN_PRIMARY_PREFIX_ID + "home");
	main.addClass("main_primary_container");
	main.css({display:"none"});
	
	main.load(Constants.URL_Home_Main);
	
	return main;
}

Elements.getMainPrimaryOpportunities = function ()
{
	var main = $(document.createElement("div"));
	main.attr("id", Constants.MAIN_PRIMARY_PREFIX_ID + "opportunities");
	main.css({display:"none"});
	
	main.load(Constants.URL_Opportunities_Main);
	
	return main;
}

Elements.getMainPrimaryCalendar = function ()
{
	var main = $(document.createElement("div"));
	main.attr("id", Constants.MAIN_PRIMARY_PREFIX_ID + "calendar");
	main.css({display:"none"});
	
	main.load(Constants.URL_Calendar_Main);
	
	return main;
}

Elements.getMainPrimaryAddressBook = function ()
{
	var main = $(document.createElement("div"));
	main.attr("id", Constants.MAIN_PRIMARY_PREFIX_ID + "address_book");
	main.addClass("main_primary_container");
	main.css({display:"none"});
	
	main.load(Constants.URL_Address_Book_Main);
	
	return main;
}

Elements.getSuccessBubble = function (text)
{
	var successBubble =  $(document.createElement("div"));
	successBubble.addClass("successBubble");
	successBubble.attr("id","login_success_container");
	successBubble.css({height:"62px", textAlign:"center", display:"none"});
	
	var successBubbleTextContainer = $(document.createElement("div"));
	successBubbleTextContainer.text(text);
	successBubbleTextContainer.width('95%');
	successBubbleTextContainer.css({position:"relative", top:"10px", left:"10px"});
	
	successBubble.append(successBubbleTextContainer);
	
	return successBubble;
}

Elements.getErrorBubble = function (text)
{
	var errorBubble =	$(document.createElement("div"));
	errorBubble.addClass("errorBubble");
	errorBubble.attr("id","login_error_container");
	errorBubble.css({height:"62px", textAlign:"center", display:"none"});
	
	var errorBubbleTextContainer = $(document.createElement("div"));
	errorBubbleTextContainer.text(text);
	errorBubbleTextContainer.width('95%');
	errorBubbleTextContainer.css({position:"relative", top:"10px", left:"8px"});
	
	errorBubble.append(errorBubbleTextContainer);
	
	return errorBubble;
}

Elements.getSummaryDetailsLayout = function (data)
{
	var detailsLayout = "<div style=''>";
	detailsLayout += "<div class='" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_HEADER_CLASS + "'>Description</div>";
	detailsLayout += "<div>" + data.position.title + " - " + data.position.description + "</div>";
	detailsLayout += "<div style='height: 10px;'></div>";
	detailsLayout += "</div>";
	
	detailsLayout += "<div style='width: 50%; float: left'>";
	detailsLayout += "<div class='" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_HEADER_CLASS + "'>Address</div>";
	detailsLayout += "<div>" + data.company.address.street + "</div>";
	detailsLayout += "<div>" + data.company.address.city + ", " + data.company.address.state + " " + data.company.address.zip + "</div>";
	detailsLayout += "</div>";
	
	detailsLayout += "<div style='width: 50%; float: left'>";
	detailsLayout += "<div class='" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_HEADER_CLASS + "'>Contact</div>";
	detailsLayout += "<div>" + data.company.contact.name + "</div>";
	detailsLayout += "<div>" + data.company.contact.phone + "</div>";	
	detailsLayout += "<div>" + data.company.contact.email + "</div>";
	detailsLayout += "</div>";
	
	detailsLayout += "<div style='clear: both;'></div>";
		
	return detailsLayout;
}

Elements.getAddresBookPerson = function (item)
{
	var row = "";
	row += "<div id='" + Constants.EVENT_SUMMARY_DETAILS_ID + item.id + "' class='summary_details'>";
	row += "<div class='ab_name'>" + item.name + "</div>";
	row += "<div class='ab_phone'>" + item.phone + "</div>";
	row += "<div class='ab_email'>" + item.email + "</div>";
	
	row += "<div class='summary_details_more'>";
	row += "<a id='summary_details_more_expand_" + item.id + "' href='#' class='summary_details_more_expand' onclick=\"AJAX.showAddressBookItemDetails(" + item.id + "); return false;\">expand</a>";
	row += "<a id='summary_details_more_collapse_" + item.id + "' href='#' class='summary_details_more_collapse' onclick=\"AJAX.hideEventSummaryDetails(" + item.id + "); return false;\">collapse</a>";
	row += "</div>";
	
	row += "</div>";
	
	return row;
	
}

Elements.getAddresBookCompany = function (item)
{
	var row = "";
	row += "<div id='" + Constants.EVENT_SUMMARY_DETAILS_ID + item.id + "' class='summary_details'>";
	
	row += "<div class='ab_name'>" + item.company + "</div>";
	row += "<div class='ab_address'>" + item.address_street + ", " + item.city + ", " + item.state + " " + item.zip + "</div>";

	row += "<div class='summary_details_more'>";
	row += "<a id='summary_details_more_expand_" + item.id + "' href='#' class='summary_details_more_expand' onclick=\"AJAX.showAddressBookItemDetails(" + item.id + "); return false;\">expand</a>";
	row += "<a id='summary_details_more_collapse_" + item.id + "' href='#' class='summary_details_more_collapse' onclick=\"AJAX.hideEventSummaryDetails(" + item.id + "); return false;\">collapse</a>";
	row += "</div>";
	
	row += "</div>";
	
	return row;
	
}

Elements.getAddressBookCompanyDetailsLayout = function (data)
{
	var detailsLayout = "";

	detailsLayout += "<div style='width: 50%; float: left'>";
	detailsLayout += "<div class='" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_HEADER_CLASS + "'>Contact</div>";
	detailsLayout += "<div>" + data.contact.name + "</div>";
	detailsLayout += "<div>" + data.contact.phone + "</div>";
	detailsLayout += "<div>" + data.contact.email + "</div>";
	detailsLayout += "<div style='height: 10px;'></div>";
	detailsLayout += "</div>";
	
	if(data.event.calendarId != '')
	{
		detailsLayout += "<div style='width: 50%; float: left'>";
		detailsLayout += "<div class='" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_HEADER_CLASS + "'>Scheduled&nbsp;Meeting</div>";
		detailsLayout += "<div>" + data.event.type + "</div>";
		detailsLayout += "<div>" + data.event.date.dayOfWeek + ", " + data.event.date.month + "." + data.event.date.day + "." + data.event.date.year + "</div>";	
		detailsLayout += "<div>" + data.event.date.time + "</div>";
		detailsLayout += "</div>";
	}
	detailsLayout += "<div style='clear: both;'></div>";
		
	return detailsLayout;
}

Elements.getAddressBookPersonDetailsLayout = function (data)
{
	var detailsLayout = "";

	detailsLayout += "<div style='width: 50%; float: left'>";
	detailsLayout += "<div class='" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_HEADER_CLASS + "'>Company</div>";
	detailsLayout += "<div>" + data.company + "</div>";
	
	if(data.address.addressStreet != "")
	{
		detailsLayout += "<div>" + data.address.addressStreet + "</div>";
		detailsLayout += "<div>" + data.address.city + ", " + data.address.state + " " + data.address.zip + "</div>";
	}
	
	detailsLayout += "<div style='height: 10px;'></div>";
	detailsLayout += "</div>";
	
	if(data.event.calendarId != '')
	{
		detailsLayout += "<div style='width: 50%; float: left'>";
		detailsLayout += "<div class='" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_HEADER_CLASS + "'>Scheduled&nbsp;Meeting</div>";
		detailsLayout += "<div>" + data.event.type + "</div>";
		detailsLayout += "<div>" + data.event.date.dayOfWeek + ", " + data.event.date.month + "." + data.event.date.day + "." + data.event.date.year + "</div>";	
		detailsLayout += "<div>" + data.event.date.time + "</div>";
		detailsLayout += "</div>";
	}
	detailsLayout += "<div style='clear: both;'></div>";
		
	return detailsLayout;
}