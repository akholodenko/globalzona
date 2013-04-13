function checkVenueReview (theForm)
{
	var status = true;
	status = radio_button_checker(theForm.reviewRating);
	if (status && theForm.reviewText.value == '')
	{
		alert('Please enter your review.');
		theForm.reviewText.focus();
		status = false;
	}

	return status;
}

function radio_button_checker(radioButton)
{
	var radio_choice = false;

	for (counter = 0; counter < radioButton.length; counter++)
		if (radioButton[counter].checked) radio_choice = true; 

	if (!radio_choice)
	{
		alert("Please select a rating."); 		
		return (false);
	}
	return (true);
}

function prof_check (theForm)
{
	if(theForm.subject.value.indexOf('test') != -1)
	{
		theForm.subject.focus();	
		alert('There\'s Profanity in the Subject!');
		return false;
	}
	
	if(theForm.message.value.indexOf('test') != -1)
	{
		theForm.message.focus();	
		alert('There\'s Profanity in the message body!');
		return false;
	}
}