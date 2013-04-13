function passwordOnClick (field, placeHolder)
{

	if(field.value == '' || field.value == placeHolder)
	{
		field.type = 'password';
		field.value = '';
	}
}