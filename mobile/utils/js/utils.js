function load_into_main (url, callback)
{
	if(callback == null)
		$('#main').load(url);
	else
		$('#main').load(url, null, callback);

	return false;
}

function load_city_homepage (city_id)
{
	return load_into_main("content.php?page=cityHomepage&city_id=" + city_id);
}