var xmlHttp

function suggestCity (cityName)
{
	if (cityName == '')
	{
		document.getElementById("txtHint").innerHTML = 'Please enter a city name.';
		document.formCitySuggest.citySuggest.focus();
		document.getElementById("txtHint").style.display = "block";
		document.getElementById('buttonMain').value='Submit City';
	}
	else
	{
		document.getElementById("txtHint").style.display = "none";
		document.getElementById("txtHint").innerHTML = '&nbsp;';
		document.getElementById('buttonMain').value='Submitting...';
		processAjax("include.suggestCity.php?citySuggest="+cityName);
	}
}

function processAjax(url)
{ 
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	} 

	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function stateChanged() 
{ 
	if (xmlHttp.readyState==4)
	{ 
		document.getElementById("txtHint").style.display = "block";
		document.getElementById("txtHint").style.background = "green";
		document.getElementById("txtHint").innerHTML="Thank you!";
		document.getElementById("citySuggest").style.display = "none";
	}
}

function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
/*
function guestlistSignUp (fname,lname,email)
{
	document.getElementById("txtHint").style.display = "none";
	document.getElementById("txtHint").innerHTML = '&nbsp;';
	document.getElementById('buttonMain').value='Submitting...';
	processAjax("include.suggestCity.php?citySuggest="+cityName);
}
*/

function showHideBlock (idTag)
{
	if (document.getElementById(idTag + 'Span').innerHTML == '+')
	{
		document.getElementById(idTag + 'Span').innerHTML = '-'; 
		document.getElementById(idTag).style.display = 'block'; 
	}
	else if (document.getElementById(idTag + 'Span').innerHTML == '-')
	{
		document.getElementById(idTag + 'Span').innerHTML = '+'; 
		document.getElementById(idTag).style.display = 'none'; 
	}
	return false;
}