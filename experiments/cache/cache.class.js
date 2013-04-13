/**	Cache Class contains the functionality for caching client-side	*/
Cache = function () {}

/**	Cached items are stored in the bin	*/
Cache.bin = new Array();

/**	Stores value in bin with key as index	*/
Cache.store = function (key, value)
{
	Cache.bin[key] = value;
}

/** Stores value pulled via AJAX call from URL in bin with key as index	*/
Cache.storeFromURL = function (key, url)
{
	var value;
	
	$.get(url, function(response){
		Cache.store(key, response);
	});
}

/**	Fetches value from bin based on key as index	*/
Cache.fetch = function (key)
{
	return Cache.bin[key];
}

/**	Clears all items stored in bin	*/
Cache.clear = function ()
{
	Cache.bin = new Array();
}