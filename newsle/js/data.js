function Data () {}

Data.currentCategory = 0;
Data.currentPage = 0;
Data.totalPageCount = 0;

Data.GetCategorizedData = function (categoryID)
{
	document.getElementById('navCategory' + Data.currentCategory).style.fontWeight = 'normal';	//disable current category
	Data.currentCategory = categoryID;	//store new category
	document.getElementById('navCategory' + categoryID).style.fontWeight = 'bold';	//enable new category

	AjaxUtils.GetPostByCategoryID(categoryID, Data.currentPage);	//get posts for new category
	Pagination.Display();	//show prev/next navigation for post pages
}

Data.GetPostByID = function (postId)
{
	AjaxUtils.GetPostByID(postId);	//get detailed info for a post
	Pagination.Hide();	//since displaying detailed info for a post, hide prev/next navigation for post pages
}

Data.ValidateSubmitPost = function (title, url, categoryId)
{
	if(title.value == ' Title' || title.value == '')
		return this.AlertPostFormField(title,'title');

	if(url.value == ' Article Link' || url.value == '')
		return this.AlertPostFormField(url,'link');

	if(categoryId.options[categoryId.selectedIndex].value == '')
		return this.AlertPostFormField(categoryId,'category');

	AjaxUtils.SubmitPost(title.value,url.value,categoryId.options[categoryId.selectedIndex].value);
	AjaxUtils.GetPostByCategoryID(Data.currentCategory);

	return true;
}

Data.AlertPostFormField = function (field, name)
{
	alert('Please provide the ' + name + ' of the article you are trying to submit.');
	field.focus();
	return false;
}

Data.GetTotalPageCount = function (categoryId)
{
	AjaxUtils.GetTotalPageCount(categoryId);
}