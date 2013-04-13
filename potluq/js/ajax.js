var xmlGeneralHttp;
var xmlGeneralHttp2;

function AjaxUtils ()
{
}

AjaxUtils.GetXmlHttpObject = function ()
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

AjaxUtils.GetMain = function ()
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getMain.php";
	xmlGeneralHttp.onreadystatechange=this.updateMasterContent;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.GetAddressBook = function ()
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getAddressBook.php";
	xmlGeneralHttp.onreadystatechange=this.updateMasterContent;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.GetProfile = function (message)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getProfile.php?message=" + message;
	xmlGeneralHttp.onreadystatechange=this.updateMasterContent;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.GetPotluq = function (potluq_id)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getPotluq.php?potluq_id=" + potluq_id;
	xmlGeneralHttp.onreadystatechange=this.updateMainBodyContent;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.GetNewPotluq = function ()
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getNewPotluq.php";
	xmlGeneralHttp.onreadystatechange=this.updateMainBodyContent;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.GetPastPotluqs = function (id)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getPastPotluqs.php?id=" + id;
	xmlGeneralHttp.onreadystatechange=this.updateMainBodyContent;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.GetPotluqGuestlist = function (potluq_id)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getPotluqEditGuestlist.php?potluq_id=" + potluq_id;
	xmlGeneralHttp.onreadystatechange=this.updateGetPotluqGuestlist;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.GetNewContact = function ()
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getNewContact.php";
	xmlGeneralHttp.onreadystatechange=this.updateAddressBookBodyContent;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.GetPotluqEditItem = function (potluq_id)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getPotluqEditItem.php?potluq_id=" + potluq_id;
	xmlGeneralHttp.onreadystatechange=this.updateGetPotluqEditItem;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.SaveNewContact = function (f_name, l_name, email)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/saveNewContact.php?f_name=" + f_name + "&l_name=" + l_name + "&email=" + email;
	xmlGeneralHttp.onreadystatechange=this.updateBlank;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.UpdateContact = function (contact_id, f_name, l_name, email)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/updateContact.php?contact_id=" + contact_id + "&f_name=" + f_name + "&l_name=" + l_name + "&email=" + email;
	xmlGeneralHttp.onreadystatechange=this.updateBlank;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

var current_contact_id = 0;
AjaxUtils.GetContact = function (contact_id)
{
	current_contact_id = contact_id;

	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getContact.php?contact_id=" + contact_id;
	xmlGeneralHttp.onreadystatechange=this.updateGetEditContact;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.GetEditContact = function (contact_id)
{
	current_contact_id = contact_id;

	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getEditContact.php?contact_id=" + contact_id;
	xmlGeneralHttp.onreadystatechange=this.updateGetEditContact;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.DeleteContact = function (id)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/deleteContact.php?id=" + id;
	xmlGeneralHttp.onreadystatechange=this.updateBlank;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.SaveNewPotluqDetails = function (title, month, day, year, location_name, address, description, guestlist, items)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/saveNewPotluq.php?title=" + title + "&month=" + month + "&day=" + day + "&year=" + year + "&location_name=" + location_name + "&address=" + address + "&description=" + description + "&guestlist=" + guestlist + "&items=" + items;
	xmlGeneralHttp.onreadystatechange=this.updateSaveNewPotluqBasics;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.UpdateProfile = function (f_name, l_name, email, password)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/updateProfile.php?f_name=" + f_name + "&l_name=" + l_name + "&email=" + email + "&password=" + password;
	xmlGeneralHttp.onreadystatechange=this.updateBlank;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.UpdateWelcomeMessage = function ()
{
	xmlGeneralHttp2=this.GetXmlHttpObject();
	if (xmlGeneralHttp2==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getWelcomeMessage.php";
	xmlGeneralHttp2.onreadystatechange=this.updateUpdateWelcomeMessage;
	xmlGeneralHttp2.open("GET",url,true);
	xmlGeneralHttp2.send(null);
}

AjaxUtils.updateUpdateWelcomeMessage = function() 
{ 
	if (xmlGeneralHttp2.readyState==4) 
	{
		document.getElementById("welcomeMessage").innerHTML=xmlGeneralHttp2.responseText;
	}
}

AjaxUtils.updateSaveNewPotluqBasics = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		currentPotluqID=xmlGeneralHttp.responseText;
		alert(currentPotluqID);
	}
}

AjaxUtils.updateGetEditContact = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		document.getElementById("rowPotluq" + current_contact_id).innerHTML=xmlGeneralHttp.responseText;
	}
}

AjaxUtils.updateBlank = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		//document.getElementById("saveNewContactMessage").innerHTML=xmlGeneralHttp.responseText;
	}
}

AjaxUtils.updateMasterContent = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		document.getElementById("masterContent").innerHTML=xmlGeneralHttp.responseText;
	}
}

AjaxUtils.updateMainBodyContent = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		document.getElementById("mainBodyContent").innerHTML=xmlGeneralHttp.responseText;
	}
}

AjaxUtils.updateAddressBookBodyContent = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		document.getElementById("addressBookBodyContent").innerHTML=xmlGeneralHttp.responseText;
	}
}

AjaxUtils.updateGetPotluqGuestlist = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		document.getElementById("potluqGuestlist").innerHTML=xmlGeneralHttp.responseText;
	}
}

AjaxUtils.updateGetPotluqEditItem = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		document.getElementById("potluqItem").innerHTML=xmlGeneralHttp.responseText;
	}
}