function showConfirmLayer ()
{
	document.getElementById('calendar1a').style.display = 'none'; 
	document.getElementById('calendar1b').style.display = 'none'; 
	document.getElementById('calendar2a').style.display = 'none'; 
	document.getElementById('calendar2b').style.display = 'none'; 
	document.getElementById('calendar3a').style.display = 'none'; 
	document.getElementById('calendar3b').style.display = 'none'; 
	document.getElementById('confirmFormBG').style.display = 'block'; 
	document.getElementById('confirmFormText').style.display = 'block'; 

	document.getElementById("eventTitleX").innerHTML='<font color="#333333">' + document.getElementById('eventTitle').value + '</font>';
	document.getElementById("eventDate").innerHTML='<font color="#333333">' + document.getElementById('pMonthSubmit').value+'/'+document.getElementById('pDaySubmit').value+'/'+document.getElementById('pYearSubmit').value + ' at ' + document.getElementById('hour').value+':'+document.getElementById('minute').value+' '+document.getElementById('ampm').value + '</font>';
	document.getElementById("flyerX").innerHTML='<img src="' + document.getElementById('flyer').value + '" style="width: 200px; height:auto;">';
	document.getElementById("guestlistX").innerHTML='<a href="' + document.getElementById('guestlist').value + '" target="_blank"><font color="#333333">' + document.getElementById('guestlist').value.substring(0,40) + '...</font></a>';
	document.getElementById("messageX").innerHTML='<font color="#333333">' + document.getElementById('message').value + '</font>';
	document.getElementById("venueNameX").innerHTML='<font color="#333333">' + document.getElementById('venueName').value + '</font>';
	document.getElementById("addressX").innerHTML='<font color="#333333">' + document.getElementById('address').value + ', ' + document.myform.city.options[document.myform.city.selectedIndex].text + '</font>';
	document.getElementById("nameX").innerHTML='<font color="#333333">' + document.getElementById('name').value + '</font>';
	document.getElementById("emailX").innerHTML='<font color="#333333">' + document.getElementById('email').value + ' (password will be emailed here)</font>';
	
	return false;
}

function hideConfirmLayer ()
{
	document.getElementById('calendar1a').style.display = 'block'; 
	document.getElementById('calendar1b').style.display = 'block'; 
	document.getElementById('calendar2a').style.display = 'block'; 
	document.getElementById('calendar2b').style.display = 'block'; 
	document.getElementById('calendar3a').style.display = 'block'; 
	document.getElementById('calendar3b').style.display = 'block'; 
	document.getElementById('confirmFormBG').style.display = 'none'; 
	//document.getElementById('confirmFormText').style.display = 'none'; 
	return false;
}

function submitCofirmLayer ()
{
	document.getElementById('submitFormBG').style.display = 'block'; 
	document.getElementById('submitFormText').style.display = 'block'; 
	document.myform.action = actionString();
	document.myform.submit();
}

function actionString ()
{
	var actionUrl;
	var eventTitle = document.getElementById('eventTitle').value;
	var venueName = document.getElementById('venueName').value;

	eventTitle = encodeURIComponent(eventTitle);
	venueName = escape(venueName);
	
	actionUrl = 'submitEvent.php?';
	actionUrl = actionUrl + 'eventTitle='+escape(document.getElementById('eventTitle').value);
	actionUrl = actionUrl + '&pMonth='+document.getElementById('pMonthSubmit').value;
	actionUrl = actionUrl + '&pDay='+document.getElementById('pDaySubmit').value;
	actionUrl = actionUrl + '&pYear='+document.getElementById('pYearSubmit').value;
	actionUrl = actionUrl + '&hour='+document.getElementById('hour').value;
	actionUrl = actionUrl + '&minute='+document.getElementById('minute').value;
	actionUrl = actionUrl + '&ampm='+document.getElementById('ampm').value;
	actionUrl = actionUrl + '&state=';
	actionUrl = actionUrl + '&city='+document.getElementById('citySubmit').value;
	actionUrl = actionUrl + '&email='+document.getElementById('email').value;
	actionUrl = actionUrl + '&address='+document.getElementById('address').value;
	actionUrl = actionUrl + '&venueName='+escape(document.getElementById('venueName').value);
	actionUrl = actionUrl + '&name='+document.getElementById('name').value;
	actionUrl = actionUrl + '&flyer='+document.getElementById('flyer').value;
	actionUrl = actionUrl + '&guestlist='+escape(document.getElementById('guestlist').value);
	actionUrl = actionUrl + '&password='+document.getElementById('password').value;
	actionUrl = actionUrl + '&message='+escape(document.getElementById('message').value);
	actionUrl = actionUrl + '&confirm=true';

	return actionUrl;
}

function limitText(limitField, limitCount, limitNum) 
{
	if (limitField.value.length > limitNum) 
	{
		limitField.value = limitField.value.substring(0, limitNum);
	} 
	else 
	{
		limitCount.value = limitNum - limitField.value.length;
	}
}