var pix_ex = 15;
var pix_cityinfo;

	function show_form_ext(id)
	{
		if (document.getElementById(id + '_span').innerHTML == '+')
		{
			document.getElementById(id + '_span').innerHTML = '-'; 
			show_form(id, 'open');
		}
		else if (document.getElementById(id + '_span').innerHTML == '-')
		{
			document.getElementById(id + '_span').innerHTML = '+'; 
			show_form(id, 'close');
		}
	}

	function show_form(id, val){
		if (val == "open"){
			document.getElementById(id+'_tr').style.display = "";
			setTimeout("expand_div('"+id+"')", 10);
		}
		else {
			setTimeout("collapse_div('"+id+"')", 10);
		}
	}
	
	function expand_div(id){
		var sh = document.getElementById(id+'_div').scrollHeight;
		var h = document.getElementById(id+'_div').clientHeight;
		
		pix_cityinfo = h;
		if (h < sh) {
			h = h + pix_ex;
			document.getElementById(id+'_div').style.height = h+"px";
			setTimeout("expand_div('"+id+"')", 10);
		}
	}
	
	function collapse_div(id){
		var h = document.getElementById(id+'_div').clientHeight;
		
		if (h > 0) {
			h = h - pix_ex;
			document.getElementById(id+'_div').style.height = h+"px";
			setTimeout("collapse_div('"+id+"')", 10);
		}
		else {
			document.getElementById(id+'_tr').style.display = "none";
		}
	}

	function expandForCityInfo (id)
	{
		var h = document.getElementById(id+'_div').clientHeight;
		h = pix_cityinfo + 18;
		document.getElementById(id+'_div').style.height = h+"px";

	}

	function collapseForCityInfo (id)
	{
		var h = document.getElementById(id+'_div').clientHeight;
		h = pix_cityinfo;
		document.getElementById(id+'_div').style.height = h+"px";

	}

function showReviewDetails (id)
{
	if (document.getElementById('venueDetailsStatus' + id).value == 0)
	{
		document.getElementById('venueBubble' + id).style.display='block'; 
		document.getElementById('venue' + id).style.display='block'; 
		document.getElementById('venueDetailsStatus' + id).value = 1;
		document.getElementById('viewHideReviewLink' + id).innerHTML = 'hide review';
	}
	else if (document.getElementById('venueDetailsStatus' + id).value == 1)
	{
		document.getElementById('venueBubble' + id).style.display='none'; 
		document.getElementById('venue' + id).style.display='none'; 
		document.getElementById('venueDetailsStatus' + id).value = 0;
		document.getElementById('viewHideReviewLink' + id).innerHTML = 'view review';
		cancelEditReviewDetails(id);
	}

	return false;
}

function editReviewDetails (id)
{
	document.getElementById('venueReviewLinks' + id).style.display = 'none';
	document.getElementById('venueBackUpText' + id).innerHTML = document.getElementById('venueReviewText' + id).innerHTML;
	document.getElementById('venueReviewText' + id).innerHTML = '<form onSubmit="if(isTextInLimit(this.newReviewText' + id + ', 1000)) { return updateReview (' + id + ', this.newReviewText' + id + '.value) } else { return false } ;"><textarea name="newReviewText' + id + '" id="newReviewText' + id + '" class="form" style="width: 100%; height: 150px;">' + document.getElementById('venueReviewText' + id).innerHTML + '</textarea><div style="text-align: right;"><input class="form" type="submit" value="update review">&nbsp;<input class="form" type="button" value="cancel" onClick="return cancelEditReviewDetails(' + id + ');"></div></form>';
	return false;
}

function cancelEditReviewDetails(id)
{
	document.getElementById('venueReviewLinks' + id).style.display = 'block';
	document.getElementById('venueReviewUpdateResult' + id).style.visibility = 'hidden';

	if (document.getElementById('venueBackUpText' + id).innerHTML != '&nbsp;')
		document.getElementById('venueReviewText' + id).innerHTML = document.getElementById('venueBackUpText' + id).innerHTML;
}

var xmlReviewHttp; 
var currentReviewId;

function updateReview (id, text)
{
	//alert(text);
	//text = escape(text);
	//alert(text);

	currentReviewId = id;
	document.getElementById("venueReviewUpdateResult" + currentReviewId).style.visibility = 'visible';
	document.getElementById('venueReviewLinks' + id).style.display = 'block';
	document.getElementById('venueReviewText' + id).innerHTML = text;
	document.getElementById('venueBackUpText' + id).innerHTML = text;

	xmlReviewHttp=GetXmlHttpReviewObject();
	if (xmlReviewHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	
	var url="ajaxResponse/updateVenueReview.php";
	url=url+"?reviewId="+id+"&reviewText="+escape(text);
	url=url+"&sid="+Math.random();
	xmlReviewHttp.onreadystatechange=updateReviewResponse;
	xmlReviewHttp.open("GET",url,true);
	xmlReviewHttp.send(null);

	return false;
}

function updateReviewResponse() 
{ 
	if (xmlReviewHttp.readyState==1)
	{ 
			document.getElementById("venueReviewUpdateResult" + currentReviewId).innerHTML = '<img src="http://www.globalzona.com/party/images/waitBoxReview.gif">&nbsp;&nbsp;<font color="yellow">updating</font>';
	}

	if (xmlReviewHttp.readyState==4)
	{ 
		document.getElementById("venueReviewUpdateResult" + currentReviewId).style.visibility = 'visible';
		document.getElementById("venueReviewUpdateResult" + currentReviewId).innerHTML=xmlReviewHttp.responseText;
	}
}

function GetXmlHttpReviewObject()
{
var xmlReviewHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlReviewHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlReviewHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlReviewHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlReviewHttp;
}

function showForgotPassword ()
{
	document.getElementById("forgotPasswordLink").style.display = 'none';
	document.getElementById("forgotPasswordForm").style.display = 'block';
	document.getElementById("emailForPassword").value = document.getElementById("emailLogin").value;
}

function hideForgotPassword ()
{
	document.getElementById("forgotPasswordLink").style.display = 'block';
	document.getElementById("forgotPasswordForm").style.display = 'none';
}

function isTextInLimit(field, limit)
{
	if (field.value.length > limit)
	{
		alert('Your text must be under ' + limit + ' characters.\nYou currently have ' + field.value.length + '.');
		field.focus();
		return false;
	}
	return true;
}

function isFieldEmpty(field, fieldName, showMessage)
{
	if (field.value == '')
	{
		if (showMessage) alert(fieldName + ' field is empty.');
		field.focus();
		return false;
	}
	return true;
}

var xmlForgotPasswordHttp;

function sendForgotPassword ()
{
	if(check_string (document.getElementById('emailForPassword'), 'Please enter a valid email.'))
	{
		xmlForgotPasswordHttp=GetXmlHttpReviewObject();
		if (xmlForgotPasswordHttp==null)
		{
		  alert ("Your browser does not support AJAX!");
		  return;
		} 
		
		var url="ajaxResponse/sendForgotPassword.php";
		url=url+"?email="+document.getElementById('emailForPassword').value;
		url=url+"&sid="+Math.random();
		xmlForgotPasswordHttp.onreadystatechange=updateForgotPasswordResponse;
		xmlForgotPasswordHttp.open("GET",url,true);
		xmlForgotPasswordHttp.send(null);

		return true;
	}
	return false;
}

function updateForgotPasswordResponse() 
{ 
	if (xmlForgotPasswordHttp.readyState==1) document.getElementById("forgotPasswordBubbleContent").innerHTML = '<img src="http://www.globalzona.com/party/images/waitBoxReview.gif">&nbsp;&nbsp;<font style="color: yellow; font-weight: bold;">Sending Email</font>';
	else if (xmlForgotPasswordHttp.readyState==4) document.getElementById("forgotPasswordBubbleContent").innerHTML=xmlForgotPasswordHttp.responseText;
}

function showWebUserModule (type)
{
	if (type == 'review')
	{
		document.getElementById('mainMenu.Reviews').style.display = 'block';
		document.getElementById('mainMenu.Reviews.Link').style.color = 'yellow';

		document.getElementById('mainMenu.Events').style.display = 'none';
		document.getElementById('mainMenu.Events.Link').style.color = '#dddddd';
		document.getElementById('mainMenu.AddEvent').style.display = 'none';
		document.getElementById('mainMenu.AddEvent.Link').style.color = '#dddddd';
	}
	else if (type == 'event')
	{
		document.getElementById('mainMenu.Events').style.display = 'block';
		document.getElementById('mainMenu.Events.Link').style.color = 'yellow';

		document.getElementById('mainMenu.Reviews').style.display = 'none';
		document.getElementById('mainMenu.Reviews.Link').style.color = '#dddddd';
		document.getElementById('mainMenu.AddEvent').style.display = 'none';
		document.getElementById('mainMenu.AddEvent.Link').style.color = '#dddddd';
	}
	else if (type == 'addEvent')
	{
		document.getElementById('mainMenu.AddEvent').style.display = 'block';
		document.getElementById('mainMenu.AddEvent.Link').style.color = 'yellow';

		document.getElementById('mainMenu.Reviews').style.display = 'none';
		document.getElementById('mainMenu.Reviews.Link').style.color = '#dddddd';
		document.getElementById('mainMenu.Events').style.display = 'none';
		document.getElementById('mainMenu.Events.Link').style.color = '#dddddd';
	}
}

function showCitySuggestDiv ()
{
	$('#citySuggestDiv').slideToggle("normal");
	/*
	if (document.getElementById('citySuggestHiddenParam').value == 'closed')
	{
		$('#citySuggestDiv').slideDown("slow");
		//document.getElementById('citySuggestDiv').style.display = 'block';
		document.getElementById('citySuggestHiddenParam').value = 'opened';
	}
	else if (document.getElementById('citySuggestHiddenParam').value == 'opened')
	{
		document.getElementById('citySuggestDiv').style.display = 'none';
		document.getElementById('citySuggestHiddenParam').value = 'closed';
	}
	*/
}

function showCityListDiv ()
{
	if (document.getElementById('cityListHiddenParam').value == 'closed')
	{
		document.getElementById('ViewAllCities').style.display = 'block';
		document.getElementById('cityListHiddenParam').value = 'opened';
	}
	else if (document.getElementById('cityListHiddenParam').value == 'opened')
	{
		document.getElementById('ViewAllCities').style.display = 'none';
		document.getElementById('cityListHiddenParam').value = 'closed';
	}
}

function showNotifyAboutEventDiv ()
{
	$('#notifyAboutEventDiv').slideToggle("normal");
	/*
	if (document.getElementById('notifyAboutEventHiddenParam').value == 'closed')
	{
		document.getElementById('notifyAboutEventDiv').style.display = 'block';
		document.getElementById('notifyAboutEventHiddenParam').value = 'opened';
	}
	else if (document.getElementById('notifyAboutEventHiddenParam').value == 'opened')
	{
		document.getElementById('notifyAboutEventDiv').style.display = 'none';
		document.getElementById('notifyAboutEventHiddenParam').value = 'closed';
	}
	*/
}

var xmlRecordPollVoteHttp;

function recordPollVote (pollId, pollAnswerId)
{
	if(pollAnswerId)
	{
		xmlRecordPollVoteHttp=GetXmlHttpReviewObject();
		if (xmlRecordPollVoteHttp==null)
		{
		  alert ("Your browser does not support AJAX!");
		  return;
		} 
		
		var url="ajaxResponse/recordPollVote.php";
		url=url+"?pollId="+pollId+"&pollAnswerId="+pollAnswerId;
		url=url+"&sid="+Math.random();
		xmlRecordPollVoteHttp.onreadystatechange=updateRecordPollVoteResponse;
		xmlRecordPollVoteHttp.open("GET",url,true);
		xmlRecordPollVoteHttp.send(null);

		return true;
	}
	return false;
}

function GetSelectedItem() 
{

	chosen = "";
	len = document.poll.pollAnswerId.length;

	for (i = 0; i < len; i++) 
	{
		if (document.poll.pollAnswerId[i].checked) 
		{
			chosen = document.poll.pollAnswerId[i].value;
		}
	}

	if (chosen == "") 
	{
		alert("Please pick your choice.");
		return false;
	}
	//else 
	//	alert(chosen + document.poll.pollId.value);

	return chosen;
}

function updateRecordPollVoteResponse() 
{ 
	if (xmlRecordPollVoteHttp.readyState==1) document.getElementById("pollDiv").innerHTML = '<div style="padding: 7px;"><img src="http://www.globalzona.com/party/images/ajax-loader2.gif">&nbsp;&nbsp;&nbsp;&nbsp;<font style="color: yellow; font-weight: bold;">Casting Vote...</font></div>';
	else if (xmlRecordPollVoteHttp.readyState==4) document.getElementById("pollDiv").innerHTML=xmlRecordPollVoteHttp.responseText;
}

function SortList(mylist) 
{
	var lb = mylist;
	arrTexts = new Array();

	for(i=0; i<lb.length; i++)  
	{
		arrTexts[i] = lb.options[i].text;
	}

	arrTexts.sort();

	for(i=0; i<lb.length; i++)  
	{
		lb.options[i].text = arrTexts[i];
		lb.options[i].value = arrTexts[i];
	}
}

function compareOptionText(a,b) {
  /*
   * return >0 if a>b
   *         0 if a=b
   *        <0 if a<b
   */
  // textual comparison
  return a.text!=b.text ? a.text<b.text ? -1 : 1 : 0;
  // numerical comparison
//  return a.text - b.text;

}

function sortOptions(list) {
  var items = list.options.length;
  // create array and make copies of options in list
  var tmpArray = new Array(items);
  for ( i=0; i<items; i++ )
    tmpArray[i] = new
Option(list.options[i].text,list.options[i].value);
  // sort options using given function
  tmpArray.sort(compareOptionText);
  // make copies of sorted options back to list
  for ( i=0; i<items; i++ )
    list.options[i] = new Option(tmpArray[i].text,tmpArray[i].value);

}

function showPhotoAlbumPage (page,pageCount)
{
	//alert('Page ' + page + " out of " + pageCount);
	for (i = 1; i <= pageCount; i++) document.getElementById('Page' + i).style.display = 'none';
	document.getElementById('Page' + page).style.display = 'block';
	document.getElementById('PageNumber').innerHTML = page;
}

function showVenuePage (page)
{
	for(i = 0; i <= 26; i++)
	{
		if(document.getElementById('Page' + i))
			document.getElementById('Page' + i).style.display = 'none';
	}
	document.getElementById('Page' + page).style.display = 'block';
}

function showCalendarDayByWeek (page)
{
	for(i = -1; i <= 365; i++)
	{
		if(document.getElementById('calendarDay' + i))
		{
			document.getElementById('calendarDay' + i).style.display = 'none';
			document.getElementById('calendarDayTabOn' + i).style.display = 'none';
			document.getElementById('calendarDayTabOff' + i).style.display = 'block';
		}
	}

	$("#calendarDay" + page).fadeIn("slow");
	$("#calendarDayTabOn" + page).fadeIn("slow");
//	document.getElementById('calendarDay' + page).style.display = 'block';
//	document.getElementById('calendarDayTabOn' + page).style.display = 'block';
	document.getElementById('calendarDayTabOff' + page).style.display = 'none';
}

function showVenueAlbums ()
{
	document.getElementById('venueAlbumsTabOn').style.display = 'block';
	document.getElementById('venueAlbumsTabOff').style.display = 'none';

	document.getElementById('venueEventsTabOn').style.display = 'none';
	document.getElementById('venueEventsTabOff').style.display = 'block';

	document.getElementById('venueDescriptionTabOn').style.display = 'none';
	document.getElementById('venueDescriptionTabOff').style.display = 'block';

	document.getElementById('venueAlbumsTab').style.display = 'block';
	document.getElementById('venueEventsTab').style.display = 'none';
	document.getElementById('venueDescriptionTab').style.display = 'none';
	/*
	if (trigger == 1)
	{
		document.getElementById('venueAlbumsTabOn').style.display = 'block';
		document.getElementById('venueAlbumsTabOff').style.display = 'none';

		document.getElementById('venueEventsTabOn').style.display = 'none';
		document.getElementById('venueEventsTabOff').style.display = 'block';

		document.getElementById('venueAlbumsTab').style.display = 'block';
		document.getElementById('venueEventsTab').style.display = 'none';
	}
	else if (trigger == 0)
	{
		document.getElementById('venueAlbumsTabOn').style.display = 'none';
		document.getElementById('venueAlbumsTabOff').style.display = 'block';

		document.getElementById('venueEventsTabOn').style.display = 'block';
		document.getElementById('venueEventsTabOff').style.display = 'none';

		document.getElementById('venueAlbumsTab').style.display = 'none';
		document.getElementById('venueEventsTab').style.display = 'block';
	}
	*/
}

function showVenueEvents ()
{
	document.getElementById('venueEventsTabOn').style.display = 'block';
	document.getElementById('venueEventsTabOff').style.display = 'none';

	document.getElementById('venueAlbumsTabOn').style.display = 'none';
	document.getElementById('venueAlbumsTabOff').style.display = 'block';

	document.getElementById('venueDescriptionTabOn').style.display = 'none';
	document.getElementById('venueDescriptionTabOff').style.display = 'block';

	document.getElementById('venueEventsTab').style.display = 'block';
	document.getElementById('venueAlbumsTab').style.display = 'none';
	document.getElementById('venueDescriptionTab').style.display = 'none';
}

function showDescription ()
{
	document.getElementById('venueDescriptionTabOn').style.display = 'block';
	document.getElementById('venueDescriptionTabOff').style.display = 'none';

	document.getElementById('venueAlbumsTabOn').style.display = 'none';
	document.getElementById('venueAlbumsTabOff').style.display = 'block';

	document.getElementById('venueEventsTabOn').style.display = 'none';
	document.getElementById('venueEventsTabOff').style.display = 'block';

	document.getElementById('venueDescriptionTab').style.display = 'block';
	document.getElementById('venueAlbumsTab').style.display = 'none';
	document.getElementById('venueEventsTab').style.display = 'none';
}
/*
function showEventDescription ()
{
	document.getElementById('eventDescriptionTabOn').style.display = 'block';
	document.getElementById('eventDescriptionTabOff').style.display = 'none';

	document.getElementById('eventMapTabOn').style.display = 'none';
	document.getElementById('eventMapTabOff').style.display = 'block';

	document.getElementById('eventOptionsTabOn').style.display = 'none';
	document.getElementById('eventOptionsTabOff').style.display = 'block';

	document.getElementById('eventGuestlistTabOn').style.display = 'none';
	document.getElementById('eventGuestlistTabOff').style.display = 'block';

	document.getElementById('eventDescriptionTab').style.display = 'block';
	document.getElementById('eventMapTab').style.display = 'none';
	document.getElementById('eventOptionsTab').style.display = 'none';
	document.getElementById('eventGuestlistTab').style.display = 'none';
}
*/
function showEventMap ()
{
//	document.getElementById('eventDescriptionTabOn').style.display = 'none';
//	document.getElementById('eventDescriptionTabOff').style.display = 'block';

	document.getElementById('eventMapTabOn').style.display = 'block';
	document.getElementById('eventMapTabOff').style.display = 'none';

	document.getElementById('eventOptionsTabOn').style.display = 'none';
	document.getElementById('eventOptionsTabOff').style.display = 'block';

	document.getElementById('eventGuestlistTabOn').style.display = 'none';
	document.getElementById('eventGuestlistTabOff').style.display = 'block';

//	document.getElementById('eventDescriptionTab').style.display = 'none';
	document.getElementById('eventOptionsTab').style.display = 'none';
	document.getElementById('eventGuestlistTab').style.display = 'none';
	document.getElementById('eventMapTab').style.display = 'block';
}

function showEventOptions ()
{
	document.getElementById('eventOptionsTabOn').style.display = 'block';
	document.getElementById('eventOptionsTabOff').style.display = 'none';
	
//	document.getElementById('eventDescriptionTabOn').style.display = 'none';
//	document.getElementById('eventDescriptionTabOff').style.display = 'block';

	document.getElementById('eventMapTabOn').style.display = 'none';
	document.getElementById('eventMapTabOff').style.display = 'block';

	document.getElementById('eventGuestlistTabOn').style.display = 'none';
	document.getElementById('eventGuestlistTabOff').style.display = 'block';

	document.getElementById('eventOptionsTab').style.display = 'block';
//	document.getElementById('eventDescriptionTab').style.display = 'none';
	document.getElementById('eventMapTab').style.display = 'none';
	document.getElementById('eventGuestlistTab').style.display = 'none';
}

function showEventGuestList ()
{
	document.getElementById('eventGuestlistTabOn').style.display = 'block';
	document.getElementById('eventGuestlistTabOff').style.display = 'none';

	document.getElementById('eventOptionsTabOn').style.display = 'none';
	document.getElementById('eventOptionsTabOff').style.display = 'block';
	
//	document.getElementById('eventDescriptionTabOn').style.display = 'none';
//	document.getElementById('eventDescriptionTabOff').style.display = 'block';

	document.getElementById('eventMapTabOn').style.display = 'none';
	document.getElementById('eventMapTabOff').style.display = 'block';

	document.getElementById('eventGuestlistTab').style.display = 'block';
	document.getElementById('eventOptionsTab').style.display = 'none';
//	document.getElementById('eventDescriptionTab').style.display = 'none';
	document.getElementById('eventMapTab').style.display = 'none';
}

var xmlNotifyOfEventHttp;

function SentNotifyOfEvent (eventId)
{
	if(check_string (document.getElementById('fromName'), 'Please enter your name.') && check_string (document.getElementById('fromEmail'), 'Please enter your email.') && check_string (document.getElementById('toEmail'), 'Please your friend\'s email.'))
	{
		xmlNotifyOfEventHttp=GetXmlHttpReviewObject();
		if (xmlNotifyOfEventHttp==null)
		{
		  alert ("Your browser does not support AJAX!");
		  return;
		} 
		
		var url="ajaxResponse/eventNotification.php";
		url=url+"?eventId="+eventId;
		url=url+"&toEmail="+document.getElementById('toEmail').value;
		url=url+"&fromEmail="+document.getElementById('fromEmail').value;
		url=url+"&fromName="+document.getElementById('fromName').value;
		url=url+"&sid="+Math.random();
		xmlNotifyOfEventHttp.onreadystatechange=updateNotifyOfEventResponse;
		xmlNotifyOfEventHttp.open("GET",url,true);
		xmlNotifyOfEventHttp.send(null);

		return true;
	}
	return false;
}

function updateNotifyOfEventResponse() 
{ 
	if (xmlNotifyOfEventHttp.readyState==1) document.getElementById("responseFromNotifyOfEvent").innerHTML = '<div align="center"><img src="http://www.globalzona.com/party/images/waitBoxReview.gif">&nbsp;&nbsp;<font style="color: yellow; font-weight: bold;">Sending Email</font></div>';
	else if (xmlNotifyOfEventHttp.readyState==4) 
	{
		document.getElementById("responseFromNotifyOfEvent").innerHTML=xmlNotifyOfEventHttp.responseText;
		document.getElementById('toEmail').value = '';
		document.getElementById('fromEmail').value = '';
		document.getElementById('fromName').value = '';
	}
}

function ValidateFAQ (theForm)
{
	if(theForm.question.value.length <= 0)
	{
		alert("Please type in your question.");
		theForm.question.focus();
		return false;
	}
	return true;
}

function urldecode( str ) {
// http://kevin.vanzonneveld.net
// +   original by: Philip Peterson
// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
// +      input by: AJ
// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
// +   improved by: Brett Zamir
// %          note: info on what encoding functions to use from: http://xkr.us/articles/javascript/encode-compare/
// *     example 1: urldecode('Kevin+van+Zonneveld%21');
// *     returns 1: 'Kevin van Zonneveld!'
// *     example 2: urldecode('http%3A%2F%2Fkevin.vanzonneveld.net%2F');
// *     returns 2: 'http://kevin.vanzonneveld.net/'
// *     example 3: urldecode('http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a');
// *     returns 3: 'http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a'

var histogram = {};
var ret = str.toString();

var replacer = function(search, replace, str) {
	var tmp_arr = [];
	tmp_arr = str.split(search);
	return tmp_arr.join(replace);
};

// The histogram is identical to the one in urlencode.
histogram["'"]   = '%27';
histogram['(']   = '%28';
histogram[')']   = '%29';
histogram['*']   = '%2A';
histogram['~']   = '%7E';
histogram['!']   = '%21';
histogram['%20'] = '+';

for (replace in histogram) {
	search = histogram[replace]; // Switch order when decoding
	ret = replacer(search, replace, ret) // Custom replace. No regexing   
}

// End with decodeURIComponent, which most resembles PHP's encoding functions
ret = decodeURIComponent(ret);

return ret;
}