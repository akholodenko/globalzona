function PartyEvent ()
{	
	this.cityId = '';
	this.cityName = '';
	this.eventTitle = '';
	this.month = '';
	this.day = '';
	this.year = '';
	this.hour = '';
	this.minute = '';
	this.ampm = '';
	this.weekly = '';
	this.dayOfWeek = -1;
	this.isDayOfWeekSet = false;
	this.flyer = '';
	this.guestlist = '';
	this.message = '';
	this.venueId = '';
	this.venueName = '';
	this.venueAddress = '';
	this.venueManual = '';
	this.hostName = '';
	this.hostEmail = '';
	this.hostPassword = '';
	this.venueDirectory = new Array();
	for (i=0; i <200; i++) this.venueDirectory[i] = new Array();
}

function EventFormTabHighlight (theDiv)
{
	document.getElementById(theDiv).className='lightGradient';
}

function EventFormTabDim (theDiv)
{
	document.getElementById(theDiv).className='lightGradientDim';
}

function EventFormCityNameHighlight (theLink)
{
	document.getElementById(theLink).style.textDecoration='underline'; 
	document.getElementById(theLink).style.color='#C229CF'
}

function EventFormCityNameDim (theLink)
{
	document.getElementById(theLink).style.textDecoration='none';
	document.getElementById(theLink).style.color='#ffffff';
}

function Step1 ()
{
	StoreEventInformation('','');
//	document.getElementById('EventFormEventCity').style.display = 'block';	//show STEP 1
	$('#EventFormEventCity').slideDown('normal');
	document.getElementById('eventCityTDSubmitNav').className='lightGradient';

	document.getElementById('EventFormPartyInfo').style.display = 'none';	//hide STEP 2
	document.getElementById('partyInfoTDSubmitNav').className='lightGradientDim';
}

function Step2 (cityId, cityName)
{
	StoreEventInformation(cityId, cityName);

	document.getElementById('EventFormConfirmInfo').style.display = 'none';	//hide STEP Confirm (case of edit)
	document.getElementById('confirmInfoTDSubmitNav').className='lightGradientDim';

	document.getElementById('EventFormVenueInfo').style.display = 'none';	//hide STEP 3 (case of back)
	document.getElementById('venueInfoTDSubmitNav').className='lightGradientDim';

	document.getElementById('EventFormEventCity').style.display = 'none';	//hide STEP 1
	document.getElementById('eventCityTDSubmitNav').className='lightGradientDim';

//	document.getElementById('EventFormPartyInfo').style.display = 'block';	//show STEP 2
	$('#EventFormPartyInfo').slideDown('normal');
	document.getElementById('partyInfoTDSubmitNav').className='lightGradient';
	
	//alert(event.cityId + event.cityName);
}

function Step3 ()
{
	if(ValidateEventPartyInfo(document.myform))
	{
		StoreEventInformation('','');

		document.getElementById('EventFormPartyInfo').style.display = 'none';	//hide STEP 2
		document.getElementById('partyInfoTDSubmitNav').className='lightGradientDim';

//		document.getElementById('EventFormVenueInfo').style.display = 'block';	//show STEP 3
		$('#EventFormVenueInfo').slideDown('normal');
		document.getElementById('venueInfoTDSubmitNav').className='lightGradient';

		if (event.venueDirectory[event.cityId].length > 0) 
		{
			GetEventFormVenueList(event.cityId);
			document.getElementById('EventFormManualVenueCheck').disabled = false;
			//document.getElementById('eventVenueId').style.display = 'block';
			$('#eventVenueId').slideDown('normal');
			document.getElementById('NoCityVenues').style.display = 'none';
		}
		else 
		{
			document.getElementById('eventVenueId').style.display = 'none';
//			document.getElementById('NoCityVenues').style.display = 'block';
			$('#NoCityVenues').slideDown('normal');
			document.getElementById('EventFormManualVenueCheck').checked = true;
			document.getElementById('EventFormManualVenueCheck').disabled = true;
			ShowManualVenueForm();
		}
		SetSelectedVenue();
		document.getElementById('Step3EventFormCityName').innerHTML = event.cityName;
	}
}

function Step4 ()
{
	if(ValidateEventVenueInfo(document.myform))
	{
		StoreEventInformation('','');

		document.getElementById('EventFormVenueInfo').style.display = 'none';	//hide STEP 3
		document.getElementById('venueInfoTDSubmitNav').className='lightGradientDim';

//		document.getElementById('EventFormHostInfo').style.display = 'block';	//show STEP 4
		$('#EventFormHostInfo').slideDown('normal');
		document.getElementById('hostInfoTDSubmitNav').className='lightGradient';
	}
}

function StepConfirm ()
{
	if(ValidateEventHostInfo(document.myform))
	{
		StoreEventInformation('','');

		document.getElementById('EventFormHostInfo').style.display = 'none';	//hide STEP 4
		document.getElementById('hostInfoTDSubmitNav').className='lightGradientDim';

//		document.getElementById('EventFormConfirmInfo').style.display = 'block';	//show STEP Confirm
		$('#EventFormConfirmInfo').slideDown('normal');
		document.getElementById('confirmInfoTDSubmitNav').className='lightGradient';

		SetConfirmInformation();
		if (isEmpty(event.guestlist)) document.getElementById('GuestlistConfirmTR').style.display = 'none';	//hide Guestlist if blank
		else document.getElementById('GuestlistConfirmTR').style.display = '';	//show Guestlist
	}
}

function StepComplete ()
{

	document.getElementById('EventFormConfirmInfo').innerHTML = '<table width="97%" border="0" cellspacing="0" cellpadding="2" align="center"><div align="center" width="100%" class="navTall"><br><br><br><br><br>Submitting Event Information<br><img src="http://www.globalzona.com/party/images/ajax-loader3.gif"><br><br><br><br><br><br></div></table>';
	document.getElementById('confirmInfoTDSubmitNav').className='lightGradientDim';

	SubmitEvent();
	document.getElementById('SubmitEventFormNavTR').style.display = 'none';
	document.getElementById('SubmittedTR').style.display = '';
	document.getElementById('eventSubmittedTDSubmitNav').className='lightGradient';
}

function StoreEventInformation (cityId, cityName)
{
	if (cityId != '' && cityName != '')
	{
		event.cityId = cityId;												//City Id
		event.cityName = cityName;											//City Name
	}

	event.eventTitle = document.getElementById('eventTitle').value;			//Event Title
	event.month = document.getElementById('pMonthSubmit').value;			//Event Month
	event.day = document.getElementById('pDaySubmit').value;				//Event Day
	event.year = document.getElementById('pYearSubmit').value;				//Event Year
	event.hour = document.getElementById('hour').value;						//Event Hour
	event.minute = document.getElementById('minute').value;					//Event Minute
	event.ampm = document.getElementById('ampm').value;						//Event AMPM

	if(document.getElementById('EventFormWeeklyEventCheck').checked) event.weekly = true;	//Set Event As Weekly
	else event.weekly = false;
	
	event.flyer = document.getElementById('flyer').value;					//Event Flyer
	event.guestlist = document.getElementById('guestlist').value;			//Event Guestlist
	event.message = document.getElementById('message').value;				//Event Message

	if (document.getElementById('eventVenueId')) event.venueId = document.getElementById('eventVenueId').value;			//Venue Id
	else event.venueId = '';
	event.venueName = document.getElementById('venueName').value;			//Venue Name
	event.venueAddress = document.getElementById('address').value;			//Venue Address
	if(document.getElementById('EventFormManualVenueCheck').checked) event.venueManual = true;
	else event.venueManual = false;

	event.hostName = document.getElementById('name').value;
	event.hostEmail = document.getElementById('email').value;
	event.hostPassword = document.getElementById('password').value;
}

function SetConfirmInformation ()
{
	document.getElementById("eventTitleX").innerHTML = event.eventTitle;
	document.getElementById("eventDate").innerHTML = event.month +'/'+ event.day +'/'+ event.year + ' at ' + event.hour + ':' + event.minute + ' ' + event.ampm;

	if (event.isDayOfWeekSet)
	{
		document.getElementById('eventWeekly').style.display = 'block';
		document.getElementById('eventWeekly').innerHTML = 'Every week on ' + GetDayNameByIndex(event.dayOfWeek);
	}
	if (event.flyer != '') document.getElementById("flyerX").innerHTML='<img class="imgBorder" src="' + event.flyer + '" style="width: 200px; height:auto;">';
	else document.getElementById("flyerX").innerHTML='<img class="imgBorder" src="http://www.globalzona.com/party/images/no_flyer.jpg" style="width: 200px; height:auto;">';
	
	document.getElementById("guestlistX").innerHTML='<a href="' + event.guestlist + '" target="_blank">' + event.guestlist.substring(0,40) + '...</a>';
	document.getElementById("messageX").innerHTML = event.message.replace(/\n/g,'<br>');
	if (event.venueManual) 
	{
		document.getElementById("venueNameX").innerHTML = event.venueName;
		document.getElementById("addressX").innerHTML=event.venueAddress + ', ' + event.cityName;
	}
	else GetVenueInfo(event.venueId,1);
	document.getElementById("nameX").innerHTML = event.hostName;
	document.getElementById("emailX").innerHTML= event.hostEmail + ' (password will be emailed here)';
}

var xmlGetEventFormVenueHttp;

function GetEventFormVenueList (cityId)
{
	document.getElementById('eventVenueId').size = 20;
	document.getElementById('eventVenueId').length = 1;

	if(cityId)
	{		
		var x = 0;
		for (i = 0; i < event.venueDirectory[cityId].length; i++)
		{
			if(event.venueDirectory[cityId][i])
			{
				document.getElementById('eventVenueId').options[x] = new Option(unescape(event.venueDirectory[cityId][i]),i);
				x++;
			}
		}
		sortOptions(document.getElementById('eventVenueId'));
		/*
		xmlGetEventFormVenueHttp=GetXmlHttpReviewObject();
		if (xmlGetEventFormVenueHttp==null)
		{
		  alert ("Your browser does not support AJAX!");
		  return;
		} 
		
		var url="ajaxResponse/eventFormVenueList.php";
		url=url+"?cityId="+cityId;
		url=url+"&sid="+Math.random();
		xmlGetEventFormVenueHttp.onreadystatechange=updateEventFormVenueListResponse;
		xmlGetEventFormVenueHttp.open("GET",url,true);
		xmlGetEventFormVenueHttp.send(null);
		*/
		return true;
	}
	return false;
}

function updateEventFormVenueListResponse() 
{ 
	if (xmlGetEventFormVenueHttp.readyState==4) document.getElementById("EventFormVenueList").innerHTML=xmlGetEventFormVenueHttp.responseText;
}

function ShowManualVenueForm ()
{
	if(document.getElementById('EventFormManualVenueCheck').checked)
	{
		document.getElementById('EventFormManualVenueForm').style.display = 'block';
		document.getElementById('SelectedEventVenueInfo').style.display = 'none';
	}
	else
		document.getElementById('EventFormManualVenueForm').style.display = 'none';

}

function ShowWeeklyEventForm ()
{
	if(document.getElementById('EventFormWeeklyEventCheck').checked)
	{
		document.getElementById('EventFormWeeklyEventForm').style.display = 'block';
		document.getElementById('EventFormWeeklyEventFormSpacer').style.display = 'block';
	}
	else
	{
		event.isDayOfWeekSet = false;
		event.dayOfWeek = -1;
		for(x = 0; x < 7; x++) document.getElementById('DayOfWeek' + x).style.backgroundColor = "#333333";

		document.getElementById('EventFormWeeklyEventForm').style.display = 'none';
		document.getElementById('EventFormWeeklyEventFormSpacer').style.display = 'none';
	}
}

function ValidateEventPartyInfo (theForm)	//checks event submittion
{
	if (!check_string (theForm.eventTitle, 'Please enter an event title.')) return false;
	if (!check_string (theForm.message, 'Please enter a detailed message.')) return false;
	if(document.getElementById('EventFormWeeklyEventCheck').checked && !event.isDayOfWeekSet) 
	{
		alert('Please select a day of the week.');
		return false;
	}
	return true;
}

function ValidateEventVenueInfo (theForm)	//checks event submittion
{	
	if(document.getElementById('EventFormManualVenueCheck').checked)
	{
		if (!check_string (theForm.venueName, 'Please enter a venue name.')) return false;
		if (!check_string (theForm.address, 'Please enter an address.')) return false;
	}
	else
	{
		return check_dropdown (document.getElementById('eventVenueId'), 'Please select a venue.');
	}
	
	return true;
}

function ValidateEventHostInfo (theForm)	//checks event submittion
{
	if (!check_string (theForm.name, 'Please enter a name.')) return false;
	if (!check_string (theForm.email, 'Please enter an email.')) return false;
	if (!check_string (theForm.password, 'Please enter a password.')) return false;

	return true;
}

var xmlSubmitEventHttp;

function SubmitEvent()
{
	xmlSubmitEventHttp=GetXmlHttpReviewObject();
	if (xmlSubmitEventHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	
	var url="ajaxResponse/submitEvent.php?" + postEventString();
	//alert(url);
	xmlSubmitEventHttp.onreadystatechange=updateSubmitEventResponse;
	xmlSubmitEventHttp.open("GET",url,true);
	xmlSubmitEventHttp.send(null);
}

function updateSubmitEventResponse() 
{ 
	if (xmlSubmitEventHttp.readyState==4) document.getElementById("EventFormConfirmInfo").innerHTML=xmlSubmitEventHttp.responseText;
}

function postEventString ()
{
	var actionUrl = '';
	
	//actionUrl = 'ajaxResponse/submitEvent.php?';
	actionUrl = actionUrl + 'eventTitle=' + escape(event.eventTitle);
	actionUrl = actionUrl + '&pMonth=' + event.month;
	actionUrl = actionUrl + '&pDay=' + event.day;
	actionUrl = actionUrl + '&pYear=' + event.year;
	actionUrl = actionUrl + '&hour=' + event.hour;
	actionUrl = actionUrl + '&minute=' + event.minute;
	actionUrl = actionUrl + '&ampm=' + event.ampm;
	if(event.weekly) actionUrl = actionUrl + '&dayOfWeek=' + event.dayOfWeek;	
	actionUrl = actionUrl + '&state=';
	actionUrl = actionUrl + '&city=' + event.cityId;
	actionUrl = actionUrl + '&email=' + event.hostEmail;
	actionUrl = actionUrl + '&address=' + event.venueAddress;
	actionUrl = actionUrl + '&venueName=' + escape(event.venueName);
	if(!event.venueManual) actionUrl = actionUrl + '&venueId=' + event.venueId;
	actionUrl = actionUrl + '&venueManual=' + event.venueManual;
	actionUrl = actionUrl + '&name=' + event.hostName;
	actionUrl = actionUrl + '&flyer=' + event.flyer;
	actionUrl = actionUrl + '&guestlist=' + escape(event.guestlist);
	actionUrl = actionUrl + '&password=' + event.hostPassword;
	actionUrl = actionUrl + '&message=' + escape(event.message.replace(/\n/g,'<br>'));
	actionUrl = actionUrl + '&confirm=true';

	return actionUrl;
}

var xmlGetVenueInfoHttp;
var GetVenueInfoTrigger;

function GetVenueInfo(venueId,trigger)
{
	GetVenueInfoTrigger = trigger;

	xmlGetVenueInfoHttp=GetXmlHttpReviewObject();
	if (xmlGetVenueInfoHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	
	var url="ajaxResponse/findVenueInfo.php?venueId=" + venueId;
	xmlGetVenueInfoHttp.onreadystatechange=updateGetVenueInfoResponse;
	xmlGetVenueInfoHttp.open("GET",url,true);
	xmlGetVenueInfoHttp.send(null);
}

function updateGetVenueInfoResponse() 
{ 
	if (xmlGetVenueInfoHttp.readyState == 4 && GetVenueInfoTrigger == 1) //update info on confirmation page
	{
		document.getElementById("venueNameX").innerHTML = unescape(xmlGetVenueInfoHttp.responseText);
		document.getElementById("addressX").innerHTML = document.getElementById("dbVenueAddress").value;
	}
	else if (xmlGetVenueInfoHttp.readyState == 4 && GetVenueInfoTrigger == 2) //update info and image on Step 3
	{
		if(!document.getElementById('EventFormManualVenueCheck').checked) 
		{
			$('#SelectedEventVenueInfo').fadeOut('normal', function () {
					document.getElementById("SelectedEventVenueName").innerHTML = unescape(xmlGetVenueInfoHttp.responseText);
					document.getElementById("SelectedEventVenueImg").innerHTML = '<img src="' + unescape(document.getElementById("dbVenueImg").value) + '" width="220" border"0" class="imgBorder">';
					document.getElementById("SelectedEventVenueAddress").innerHTML = document.getElementById("dbVenueStreetAddress").value + '<br>' + document.getElementById("dbVenueCityName").value;
				}
			);
//			document.getElementById("SelectedEventVenueInfo").style.display = 'block';
			$('#SelectedEventVenueInfo').fadeIn('normal');
		}
	}
}

function SetSelectedVenue ()	//set selected venue when looking through form
{
	for (x = 0; x < document.getElementById('eventVenueId').length;  x++)
	{
		if (document.getElementById('eventVenueId').options[x].value == event.venueId)
		{
			document.getElementById('eventVenueId').options[x].selected = true;
			break;
		}
	}
}

function SetDayofWeek (day)
{
	event.dayOfWeek = day;
	event.isDayOfWeekSet = true;
	document.getElementById('DayOfWeek' + day).style.backgroundColor = "#C229CF";

	for(x = 0; x < 7; x++)
	{
		if(event.dayOfWeek != x)
		{
			document.getElementById('DayOfWeek' + x).style.backgroundColor = "#333333";
			document.getElementById('DayOfWeek' + day).style.color = "#FFFFFF";
			document.getElementById('DayOfWeek' + day).className = '';
		}
	}
}

function HighlightDayofWeek (day)
{
	if(event.dayOfWeek != day)
	{
		document.getElementById('DayOfWeek' + day).className = 'lightGradient';
		document.getElementById('DayOfWeek' + day).style.backgroundColor = "#999999";
		document.getElementById('DayOfWeek' + day).style.color = "#000000";
	}
}

function DimDayofWeek (day)
{
	if(event.dayOfWeek != day)
	{
		document.getElementById('DayOfWeek' + day).style.backgroundColor = "#333333";
		document.getElementById('DayOfWeek' + day).style.color = "#FFFFFF";
		document.getElementById('DayOfWeek' + day).className = '';
	}
}

function GetDayNameByIndex (index)
{
	if (index == 0) return 'Sunday';
	else if (index == 1) return 'Monday';
	else if (index == 2) return 'Tuesday';
	else if (index == 3) return 'Wednesday';
	else if (index == 4) return 'Thursday';
	else if (index == 5) return 'Friday';
	else if (index == 6) return 'Saturday';

}