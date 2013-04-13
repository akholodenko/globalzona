function HighlightPostRow (id)
{
	if(document.getElementById('postRow' + id).style.backgroundColor == '')
	{
		document.getElementById('postRow' + id).style.backgroundColor = '#415E88';
		document.getElementById('postRow' + id).style.color = '#ffffff';
		document.getElementById('postLink' + id).style.color = '#ffffff';
		document.getElementById('postLink' + id).style.textDecoration = 'underline';
	}
	else
	{
		document.getElementById('postRow' + id).style.backgroundColor = '';
		document.getElementById('postRow' + id).style.color = '#415E88';
		document.getElementById('postLink' + id).style.color = '#415E88';
		document.getElementById('postLink' + id).style.textDecoration = 'none';
	}
}

function HighlightTopPostRow (id)
{
	if(document.getElementById('postTopRow' + id).style.backgroundColor == '')
	{
		document.getElementById('postTopRow' + id).style.backgroundColor = '#666666';
		document.getElementById('postTopRow' + id).style.color = '#ffffff';
		document.getElementById('postTopLink' + id).style.color = '#ffffff';
		document.getElementById('postTopLink' + id).style.textDecoration = 'underline';
	}
	else
	{
		document.getElementById('postTopRow' + id).style.backgroundColor = '';
		document.getElementById('postTopRow' + id).style.color = '#ffffff';
		document.getElementById('postTopLink' + id).style.color = '#ffffff';
		document.getElementById('postTopLink' + id).style.textDecoration = 'none';
	}
}

function ClearTextField (id)
{
	document.getElementById(id).value = '';
	document.getElementById(id).style.color = '#333333';
}



