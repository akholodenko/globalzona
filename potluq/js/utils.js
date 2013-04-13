var currentTabOnId = 'main';

function loadContent (id)
{
	switch(id)
	{
		case 'main':
			loadMain(id);
			break;    
		case 'addressBook':
			loadAddressBook(id);
			break;
		case 'profile':
			loadProfile(id, '');
			break;
		default:
			loadMain(id);
	}
}

function loadMain (id)
{
	selectNavigationTab(id);
	AjaxUtils.GetMain();
}

function loadAddressBook (id)
{
	selectNavigationTab(id);
	AjaxUtils.GetAddressBook();
}

function loadProfile (id, message)
{
	selectNavigationTab(id);
	AjaxUtils.GetProfile(message);
}

function selectNavigationTab (id)
{
	tabOff(currentTabOnId);
	currentTabOnId = id;
	tabOn(id);
}

function tabOn (id)
{
	document.getElementById(id).style.display = 'block';
	document.getElementById(id + 'Off').style.display = 'none';
}

function tabOff (id)
{
	document.getElementById(id + 'Off').style.display = 'block';
	document.getElementById(id).style.display = 'none';
}

function loadPotluq (id)
{
	AjaxUtils.GetPotluq(id);
}

function loadPotluqEditGuestlist (id)
{
	hideElement('guestlistEditLink');
	AjaxUtils.GetPotluqGuestlist(id);
}

function loadPotluqEditedGuestlist (potluq_id)
{
	//save updates to guestlist

	loadPotluq (potluq_id);
}

function loadNewPotluq ()
{
	AjaxUtils.GetNewPotluq();
}

function loadPastPotluqs (id)
{
	AjaxUtils.GetPastPotluqs(id);
}

function hideElement (id)
{
	document.getElementById(id).style.display = 'none';
}

function saveNewPotluq ()
{
	//get potluq information
	var title = document.getElementById('title');
	var month = document.getElementById('month');
	var day = document.getElementById('day');
	var year = document.getElementById('year');
	var location_name = document.getElementById('location_name');
	var address = document.getElementById('address');
	var description = document.getElementById('description');
	var guestlistForm = document.getElementById('sel2');
	var guestlist = [];
	var items = [];

	for(x = 0; x < guestlistForm.options.length; x++)
	{
		guestlist.push(guestlistForm.options[x].value);
	}

	for(x = 0; x <= currentItemMaxId; x++)
	{
		item = document.getElementById('item' + x).value;

		if(item != '')
		{
			items.push(item);
		}
	}

	if(	validateString(title, 'Please enter a title.') &&
		validateSelectSingle(month, 'Please select a month') &&
		validateSelectSingle(day, 'Please select a day') &&
		validateSelectSingle(year, 'Please select a year') &&
		validateString(location_name, 'Please enter a name for the location.') &&
		validateString(description, 'Please enter a description.') &&
		validateString(address, 'Please enter an address.') &&
		validateSelectMultiple (guestlistForm, 1, 'Please select at least 1 guest from your address book.') &&
		validateArray (items, 1, 'Please enter at least 1 item for food or drink.')
	)
	{
		//save potluq basics
		saveNewPotluqDetails (title.value, month.value, day.value, year.value, location_name.value, address.value, description.value, guestlist, items);

		//load list of current potluqs
		loadMain('main');
	}
}

function saveNewPotluqDetails (title, month, day, year, location_name, address, description, guestlist, items)
{
	title = encodeURIComponent(title);
	location_name = encodeURIComponent(location_name);
	address = encodeURIComponent(address);
	description = encodeURIComponent(description.replace(/\n/g,'<br>'));

	AjaxUtils.SaveNewPotluqDetails (title, month, day, year, location_name, address, description, guestlist, items);
}

var currentItemMaxId = 0;
function addNewItem (id)
{
	//incremeant max. of items
	currentItemMaxId++;
	
	//append new div to wrap item
	var div = document.createElement('div');
	document.getElementById(id).appendChild(div);
	div.id = 'itemWrap' + currentItemMaxId;
	

	var inputField = document.createElement('input');
	inputField.id = 'item' + currentItemMaxId;
	inputField.className = 'formBig';
	inputField.style.width = '475px';
	
	div.appendChild(inputField);
	inputField.focus();	//focus cursor on newly added field
}

function loadEditContact (contact_id)
{
	AjaxUtils.GetEditContact(contact_id);
}

function deleteContact (id, f_name, l_name)
{
	var response = window.confirm("Delete " + f_name + " " + l_name + " from your Address Book?")

	if (response)
	{
		AjaxUtils.DeleteContact(id);
		loadAddressBook('addressBook');
	}
}

function loadNewContact ()
{
	AjaxUtils.GetNewContact();
}

function updateContact (contact_id)
{	
	var f_name = document.getElementById('f_name' + contact_id).value;
	var l_name = document.getElementById('l_name' + contact_id).value;
	var email = document.getElementById('email' + contact_id).value;

	if(f_name != '' && l_name != '' && email != '')
	{
		//update contact
		AjaxUtils.UpdateContact(contact_id, f_name, l_name, email);

		//display updated address book
		//loadAddressBook('addressBook');
		getContact(contact_id);
	}
	else
	{
		alert('Please fill out the first name, last name, and valid email.');
	}
}

function saveNewContact ()
{	
	if(	document.getElementById('f_name').value != '' && 
		document.getElementById('l_name').value != '' && 
		document.getElementById('email').value != '')
	{
		//save contact
		AjaxUtils.SaveNewContact(document.getElementById('f_name').value, document.getElementById('l_name').value, document.getElementById('email').value);

		//display updated address book
		loadAddressBook('addressBook');
	}
	else
	{
		alert('Please fill out the first name, last name, and valid email.');
	}
}

function getContact (contact_id)
{
	AjaxUtils.GetContact(contact_id);
}

function cancelContact ()
{
	loadAddressBook('addressBook');
}

function loadPotluqEditItem (potluq_id)
{
	hideElement('itemEditLink');
	AjaxUtils.GetPotluqEditItem(potluq_id);
}

function loadPotluqEditedItem (id)
{
	//save updates to item list

	loadPotluq (id);
}

function updateProfile (user_id)
{
	var f_name = document.getElementById('f_name');
	var l_name = document.getElementById('l_name');
	var email = document.getElementById('email');
	var password = document.getElementById('password');
	var password_confirm = document.getElementById('password_confirm');

	if(	validateString(f_name, 'Please enter your first name.') &&
		validateString(l_name, 'Please enter your last name.') &&
		validateString(email, 'Please enter your email.') &&
		validateString(password, 'Please enter a password.') &&
		validatePasswordConfirm(password, password_confirm, 'Password confirmation does not match the password. Please confirm your password.')
	)
	{
		AjaxUtils.UpdateProfile(f_name.value, l_name.value, email.value, password.value);
		AjaxUtils.UpdateWelcomeMessage();
		loadProfile('profile', 'your profile information has been updated');
	}
}

function cancelProfile ()
{
	loadMain('main');
}

//GUESTLIST JS Manipulation

var NS4 = (navigator.appName == "Netscape" && parseInt(navigator.appVersion) < 5);

function addOption(theSel, theText, theValue)
{
  var newOpt = new Option(theText, theValue);
  var selLength = theSel.length;
  theSel.options[selLength] = newOpt;
}

function deleteOption(theSel, theIndex)
{ 
  var selLength = theSel.length;
  if(selLength>0)
  {
    theSel.options[theIndex] = null;
  }
}

function moveOptions(theSelFrom, theSelTo)
{
  
  var selLength = theSelFrom.length;
  var selectedText = new Array();
  var selectedValues = new Array();
  var selectedCount = 0;
  
  var i;
  
  // Find the selected Options in reverse order
  // and delete them from the 'from' Select.
  for(i=selLength-1; i>=0; i--)
  {
    if(theSelFrom.options[i].selected)
    {
      selectedText[selectedCount] = theSelFrom.options[i].text;
      selectedValues[selectedCount] = theSelFrom.options[i].value;
      deleteOption(theSelFrom, i);
      selectedCount++;
    }
  }
  
  // Add the selected text/values in reverse order.
  // This will add the Options to the 'to' Select
  // in the same order as they were in the 'from' Select.
  for(i=selectedCount-1; i>=0; i--)
  {
    addOption(theSelTo, selectedText[i], selectedValues[i]);
  }
  
  if(NS4) history.go(0);

  sortOptions(theSelTo);
}

//SORT SELECT
function compareOptionText(a,b) 
{
	return a.text!=b.text ? a.text<b.text ? -1 : 1 : 0;
}

       

function sortOptions(list) 
{
	var items = list.options.length;

	// create array and make copies of options in list
	var tmpArray = new Array(items);

	for ( i=0; i<items; i++ )
		tmpArray[i] = new Option(list.options[i].text,list.options[i].value);

	// sort options using given function
	tmpArray.sort(compareOptionText);

	// make copies of sorted options back to list
	for ( i=0; i<items; i++ )
		list.options[i] = new Option(tmpArray[i].text,tmpArray[i].value);
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