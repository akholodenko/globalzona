function check_contact_fields (theForm)	//checks that fields entered for new venue are not empty of white spaces
{
	if (!check_string (theForm.emailSubject, 'Please fill out the subject field.')) return false;
	if (!check_string (theForm.name, 'Please fill out the name field.')) return false;
	if (!check_string (theForm.email, 'Please fill out the email field.')) return false;
	if (!check_string (theForm.message, 'Please write a detailed message.')) return false;
}

function check_citySuggest (theForm)	//checks that a city sgugestion was entered
{
	if (!check_string (theForm.citySuggest, 'Please enter a city name.')) return false;
}

function check_submitGuestList (theForm)	//checks guestlist submittion
{
	if (!check_string(theForm.firstname, 'Please enter your first name.')) return false;
	else if (!check_string(theForm.lastname, 'Please enter your last name.')) return false;
	else if (!check_string(theForm.email2, 'Please enter a valid email.')) return false;

	if (document.getElementById('firstname').value=='First Name') 
	{
		alert('Please enter your first name.');
		return false;
	}
	else if (document.getElementById('lastname').value=='Last Name')
	{
		alert('Please enter your last name.');
		return false;
	}
	else if (document.getElementById('email2').value=='Email')
	{
		alert('Please enter a valid email.');
		return false;
	}
	return true;
}

function check_submitEvent (theForm)	//checks event submittion
{
	if (!check_string (theForm.eventTitle, 'Please enter an event title.')) return false;
	if (!check_string (theForm.message, 'Please enter a detailed message.')) return false;
	if (!check_string (theForm.venueName, 'Please enter a venue name.')) return false;
	if (!check_string (theForm.address, 'Please enter an address.')) return false;
	if (!check_string (theForm.name, 'Please enter a name.')) return false;
	if (!check_string (theForm.email, 'Please enter an email.')) return false;
	if (!check_string (theForm.password, 'Please enter a password.')) return false;

	return showConfirmLayer();
}

function check_string (theField, theMessage)	//checks a field for blank values
{
	if(isWhitespace(theField.value))	//checks for white spaces and empty values
	{
		theField.focus();	//brings cursor to the field
		alert(theMessage);	//displays message about missing information
		return false;
	}
	else return true;
}

function isWhitespace (s)	//checks if field value is empty of is only white spaces
{   
	var whitespace = " \t\n\r";
	var i;
    if (isEmpty(s)) return true;	//checks if field value is empty
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if (whitespace.indexOf(c) == -1) return false;
    }
    return true;
}

function isEmpty(s)	//checks if field value is empty
{   return ((s == null) || (s.length == 0))
}

function check_dropdown (theField, theMessage)
{
	if	(theField.selectedIndex == -1) 
	{
		theField.focus();	//brings cursor to the field
		alert(theMessage);	//displays message about missing information
		return false;
	}
	return true
}