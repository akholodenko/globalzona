function validateString (obj, message)
{
	if(obj.value == '')
	{
		alert(message);
		obj.focus();

		return false;
	}
	else
		return true;
}

function validateSelectSingle (obj, message)
{
	if(obj.selectedIndex == 0)
	{
		alert(message);
		obj.focus();

		return false;
	}
	else
		return true;
}

function validateSelectMultiple (obj, minCountSelect, message)
{
	if(obj.length < minCountSelect)
	{
		alert(message);
		obj.focus();

		return false;
	}
	else
		return true;
}

function validateArray (obj, minCountSelect, message)
{
	if(obj.length < minCountSelect)
	{
		alert(message);
		return false;
	}
	else
		return true;
}

function validatePasswordConfirm (password, password_confirm, message)
{
	if(password.value != password_confirm.value)
	{
		alert(message);
		password_confirm.value = '';
		password_confirm.focus();

		return false;
	}
	else
		return true;
}

function validateSignup (theForm)
{
	if(	validateString(theForm.f_name, 'Please enter your first name.') &&
		validateString(theForm.l_name, 'Please enter your last name.') &&
		validateString(theForm.email, 'Please enter your email.') &&
		validateString(theForm.password, 'Please enter a password.')
	)
	{
		return true;
	}
	else
		return false;
}