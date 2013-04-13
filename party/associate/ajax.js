var xmlHttp

function getClickInfo(pYear,pMonth,pDay,AssociateId)
{ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
var url="ajax.util.php";
url=url+"?pYear="+pYear+"&pMonth="+pMonth+"&pDay="+pDay+"&associateId="+AssociateId;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function stateChanged() 
{ 
	if (xmlHttp.readyState==4)
	{ 
		document.getElementById("txtHint").innerHTML=xmlHttp.responseText;
		document.getElementById('buttonMain').value='Get Daily Report';
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