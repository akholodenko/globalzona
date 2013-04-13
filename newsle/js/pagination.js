function Pagination () {}

Pagination.Display = function ()
{
	if(document.getElementById('HomePagePagination'))
		document.getElementById('HomePagePagination').style.display = 'block';
}

Pagination.Hide = function ()
{
	if(document.getElementById('HomePagePagination'))
		document.getElementById('HomePagePagination').style.display = 'none';
}

Pagination.DisablePrevious = function ()
{
	document.getElementById('prevPage').style.display = 'none';	
}

Pagination.DisableNext = function ()
{
	document.getElementById('nextPage').style.display = 'none';	
}

Pagination.EnablePrevious = function ()
{
	document.getElementById('prevPage').style.display = 'block';	
}

Pagination.EnableNext = function ()
{
	document.getElementById('nextPage').style.display = 'block';	
}

Pagination.NextPage = function ()
{
	Data.currentPage++;

	Pagination.DisplayCurrentPageNumber();
	Data.GetCategorizedData(Data.currentCategory);

	if(Data.currentPage > 0) Pagination.EnablePrevious();

	if(Data.currentPage + 1 == Data.totalPageCount) Pagination.DisableNext();	//page counts are on the INDEX system, while total count is not
}

Pagination.PreviousPage = function ()
{
	if(Data.currentPage > 0) Data.currentPage--;

	Data.GetCategorizedData(Data.currentCategory);
	Pagination.DisplayCurrentPageNumber();

	if(Data.currentPage == 0) Pagination.DisablePrevious();

	if(Data.currentPage < Data.totalPageCount) Pagination.EnableNext();
}

Pagination.FirstPage = function (categoryID)
{
	Data.currentPage = 0;
	Pagination.DisplayCurrentPageNumber();
	Data.GetCategorizedData(categoryID);

	Pagination.DisplayTotalPageNumber(categoryID);
	Pagination.DisablePrevious();
}

Pagination.DisplayCurrentPageNumber = function ()
{
	if(document.getElementById('currentPageNumber'))
		document.getElementById('currentPageNumber').innerHTML = Data.currentPage + 1;
}

Pagination.DisplayTotalPageNumber = function (categoryID)
{
	Data.GetTotalPageCount(categoryID);
}