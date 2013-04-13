function Constants () {}

Constants.URL_Content_Main = "content/main";
Constants.URL_Web_Services = "web_services";

Constants.URL_Login_Validate = Constants.URL_Web_Services + "/login_validate.php";
Constants.URL_GET_EVENT_SUMMARY_DETAILS = Constants.URL_Web_Services + "/get_event_summary_details.php";
Constants.URL_GET_ADDRESS_BOOK_BY_TYPE = Constants.URL_Web_Services + "/get_address_book_by_type.php";
Constants.URL_GET_ADDRESS_BOOK_BY_ID = Constants.URL_Web_Services + "/get_address_book_by_id.php";

Constants.URL_Home_Main = Constants.URL_Content_Main + "/home_main.php";
Constants.URL_Opportunities_Main = Constants.URL_Content_Main + "/opportunities_main.php";
Constants.URL_Calendar_Main = Constants.URL_Content_Main + "/calendar_main.php";
Constants.URL_Address_Book_Main = Constants.URL_Content_Main + "/address_book_main.php";
Constants.DATA_FORMAT_JSON = "json";

Constants.EVENT_SUMMARY_DETAILS_ID = "summary_details_";
Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID = "summary_details_expanded_";
Constants.EVENT_SUMMARY_DETAILS_EXPAND_LINK_ID = "summary_details_more_expand_";
Constants.EVENT_SUMMARY_DETAILS_COLLAPSE_LINK_ID = "summary_details_more_collapse_";

Constants.EVENT_SUMMARY_DETAILS_EXPANDED_HEADER_CLASS = "summary_details_expanded_header";

Constants.NAV_MAIN_ID = "nav_main";
Constants.NAV_OPPORTUNITIES_ID = "nav_opportunities";
Constants.NAV_CALENDAR_ID = "nav_calendar";
Constants.NAV_ADDRESS_BOOK_ID = "nav_addess_book";

Constants.ADDRESS_BOOK_LIST_ID = "main_primary_address_book_list";

Constants.MAIN_PRIMARY_PREFIX_ID = "main_primary_";

function AJAX () {}

AJAX.currentPage = "";

AJAX.login = function (username, password) 
{
	$.post(	Constants.URL_Login_Validate, 
			{ "username": username, "password": password },
   			AJAX.loginCallback, 
   			Constants.DATA_FORMAT_JSON
   	);	 
}

AJAX.loginCallback = function(response) 
{
	//successful login
	if(response.status == "true")
	{
		AJAX.showLoginSuccess(response);
	}
	//failed login
	else
	{
		AJAX.showLoginError(response);
	}
}

AJAX.isLoginFadeOutComplete = false;

AJAX.showHomeContent = function ()
{
	if(!AJAX.isLoginFadeOutComplete)
	{
		//callback called twice - only needs to be once
		AJAX.isLoginFadeOutComplete = true;
		
		//load logged in home page
		$("#main").append(Elements.getMainPrimaryHome());

		$("#" + Constants.MAIN_PRIMARY_PREFIX_ID + "home").fadeIn("slow");
		
		AJAX.currentPage = "home";
	}
}

AJAX.showLoginSuccess = function (response)
{
	$("#login_form_subcontainer").fadeOut("slow", function() {
			$("#login_form_subcontainer").remove();
			
			//create/add success message
			$("#login_form_container").append(Elements.getSuccessBubble(response.message));
			
			//fade in success message
			$("#login_success_container").fadeIn("slow");
			
			//change background of login container to green (success)
			$("#login_form_container").animate({backgroundColor: "#4BB74C", height: "60px"}, 1000,
				function() {
					Utils.indexContentHeight = $("#main_primary_index").height();
					
					//fade out current content of main container and fade in logged in home page
					$("#main").children().fadeOut("slow", function () {
							$(this).remove();
							AJAX.showHomeContent();
						}
					);					
					
					//show advanced navigation (click events added in creation of element function)
					$("#header").append(Elements.getAdvancedNavigation());
					$("#advanced_nav_id").fadeIn("slow");
					/*
					$('#advanced_nav_id li').each(function(index) {
						$(this).bind('click', function() {
							alert($(this).text() + ' ' + $(this).attr('id'));
						})
					});
					*/
				}
			);
		}
	);
}

AJAX.showLoginError = function (response)
{
	$(".login_form_wrapper_default").animate({height: "170px"}, 500, 
		function () {			
			//create/add error message
			$("#login_form_container").append(Elements.getErrorBubble(response.message));
			
			//fade in error message
			$("#login_error_container").fadeIn("normal");
			
			//hide error message after 3 seconds
			Utils.timerHolder = setTimeout('AJAX.hideLoginError()', 3000);
		}
	);				
}

AJAX.hideLoginError = function ()
{
	$("#login_error_container").fadeOut("slow", function () {
			$("#login_error_container").remove();
			$(".login_form_wrapper_default").animate({height: "90px"}, 500);
		}
	);
}

jQuery.fn.exists = function(){return jQuery(this).length>0;}

AJAX.showAddressBookItemDetails = function (abId)
{
	if(!$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + abId).exists())
	{
		var abDetailsDiv = $(document.createElement("div"));
		
		abDetailsDiv.attr("id", Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + abId);
		abDetailsDiv.addClass("summary_details");
		abDetailsDiv.addClass("summary_details_expandable");		
		abDetailsDiv.css({
			display:'none', 
			marginLeft:'30px', 
			color:'#555555', 
			backgroundColor:'#dddddd', 
			borderLeft: '1px dashed #777777',
			borderRight: '1px dashed #777777',
			height: 'auto'
		});
	
	
		$("#" + Constants.EVENT_SUMMARY_DETAILS_ID + abId).after(abDetailsDiv);
		
		//make ajax call
		$.post(	Constants.URL_GET_ADDRESS_BOOK_BY_ID, 
				{ "addressBookId": abId },
   				AJAX.showAddressBookItemDetailsCallback, 
   				Constants.DATA_FORMAT_JSON
	   	);
	}
}

AJAX.showAddressBookItemDetailsCallback = function (response) 
{
	//add details content
	if(response.typeId == 2)	//company
		$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + response.id).html(Elements.getAddressBookCompanyDetailsLayout(response));
	else
		$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + response.id).html(Elements.getAddressBookPersonDetailsLayout(response));
	
	//display details content
	$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + response.id).slideDown("slow", function () {
			//swap expand for collapse link
			$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPAND_LINK_ID + response.id).css({display:"none"});
			$("#" + Constants.EVENT_SUMMARY_DETAILS_COLLAPSE_LINK_ID + response.id).css({display:"block"});
		}
	);
}

AJAX.showEventSummaryDetails = function (eventId) 
{
	//hide all displayed details
	/*$(".summary_details_expandable").slideUp("slow", function () {
			$(".summary_details_more_expand").css({display:"block"});
			$(".summary_details_more_collapse").css({display:"none"});
		}
	);
	*/
	if(!$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + eventId).exists())
	{
		var summaryDetailsDiv = $(document.createElement("div"));

		summaryDetailsDiv.attr("id", Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + eventId);
		summaryDetailsDiv.addClass("summary_details");
		summaryDetailsDiv.addClass("summary_details_expandable");		
		summaryDetailsDiv.css({
			display:'none', 
			marginLeft:'30px', 
			color:'#555555', 
			backgroundColor:'#dddddd', 
			borderLeft: '1px dashed #777777',
			borderRight: '1px dashed #777777',
			height: 'auto'
		});
	
	
		$("#" + Constants.EVENT_SUMMARY_DETAILS_ID + eventId).after(summaryDetailsDiv);
	
		//get detail info from web service
		$.post(	Constants.URL_GET_EVENT_SUMMARY_DETAILS, 
				{ "eventId": eventId },
   				AJAX.showEventSummaryDetailsCallback, 
   				Constants.DATA_FORMAT_JSON
	   	);
   	}
	
}

AJAX.showEventSummaryDetailsCallback = function (response) 
{
	//add details content
	$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + response.eventId).html(Elements.getSummaryDetailsLayout(response));
	
	//display details content
	$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + response.eventId).slideDown("slow", function () {
			//swap expand for collapse link
			$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPAND_LINK_ID + response.eventId).css({display:"none"});
			$("#" + Constants.EVENT_SUMMARY_DETAILS_COLLAPSE_LINK_ID + response.eventId).css({display:"block"});
		}
	);
}

AJAX.hideEventSummaryDetails = function (eventId) 
{
	//hide expanded details
	$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + eventId).slideUp("slow", function () {
			//after hiding, remove from DOM
			$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPANDED_ID + eventId).remove();
			
			//swap collaps for expand link
			$("#" + Constants.EVENT_SUMMARY_DETAILS_EXPAND_LINK_ID + eventId).css({display:"block"});
			$("#" + Constants.EVENT_SUMMARY_DETAILS_COLLAPSE_LINK_ID + eventId).css({display:"none"});
		}
	);
}

AJAX.showPage = function (pageId)
{
	//hide current page
	$("#" + Constants.MAIN_PRIMARY_PREFIX_ID + AJAX.currentPage).fadeOut("slow", function () {
			//remove current page from DOM
			$(this).remove();
			
			var contentContainer = null;
			var contentContainerId = null;
			
			//show new page
			switch(pageId)
			{
				case Constants.NAV_MAIN_ID:
					contentContainer = Elements.getMainPrimaryHome();
					contentContainerId = "home";
					break;
					
				case Constants.NAV_OPPORTUNITIES_ID:
					contentContainer = Elements.getMainPrimaryOpportunities();
					contentContainerId = "opportunities";
					break;
					
				case Constants.NAV_CALENDAR_ID:
					contentContainer = Elements.getMainPrimaryCalendar();
					contentContainerId = "calendar";
					break;
				
				case Constants.NAV_ADDRESS_BOOK_ID:
					contentContainer = Elements.getMainPrimaryAddressBook();
					contentContainerId = "address_book";
					break;
					
			}//close switch
			
			//load content
			$("#main").append(contentContainer);
			$("#" + Constants.MAIN_PRIMARY_PREFIX_ID + contentContainerId).fadeIn("slow");			
			AJAX.currentPage = contentContainerId;
			
		}//close callback
	);		
}

AJAX.showAddressBookByType = function (obj)
{
	$.post(	Constants.URL_GET_ADDRESS_BOOK_BY_TYPE, 
			{ "addressBookTypeId": $(obj).val() },
			AJAX.showAddressBookByTypeCallback, 
			Constants.DATA_FORMAT_JSON
   	);
}

AJAX.showAddressBookByTypeCallback = function (response) 
{
	$("#" + Constants.ADDRESS_BOOK_LIST_ID).fadeOut("slow", function() {
			$(this).children().remove();
			
			//message about no contacts of selected type
			if(response.count == 0)
				$("#" + Constants.ADDRESS_BOOK_LIST_ID).append("<div class='summary_details'>no contacts in this category</div>");
			//add retrieved contacts
			else
			{
				$.each(response.contacts,function(i,item) {				
					if(response.addressBookTypeId == 2)
					{
						$("#" + Constants.ADDRESS_BOOK_LIST_ID).append(Elements.getAddresBookCompany(item));
					}
					else
					{
						$("#" + Constants.ADDRESS_BOOK_LIST_ID).append(Elements.getAddresBookPerson(item));
					}
			
				});
			}
			
			$(this).fadeIn("slow");
		}
	)
}

function Utils () {}

Utils.timerHolder = null;
Utils.indexContentHeight = null;