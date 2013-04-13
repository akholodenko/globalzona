var xmlGeneralHttp;

function AjaxUtils ()
{
}

AjaxUtils.GetXmlHttpObject = function ()
{
	var xmlHttp=null;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

AjaxUtils.CurrentPostId = 0;

AjaxUtils.GetViewByPostID = function (postId)
{
	if(document.getElementById("postSubHeaderViews"))
	{
		AjaxUtils.CurrentPostId = postId;
		xmlGeneralHttp=this.GetXmlHttpObject();
		if (xmlGeneralHttp==null)
		{
		  alert ("Your browser does not support AJAX!");
		  return;
		} 

		var url="process/getViewByPostID.php?postId=" + postId;
		xmlGeneralHttp.onreadystatechange=this.updateGetViewByPostID;
		xmlGeneralHttp.open("GET",url,true);
		xmlGeneralHttp.send(null);
	}
}

AjaxUtils.updateGetViewByPostID = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		document.getElementById("postSubHeaderViews").innerHTML=xmlGeneralHttp.responseText;
	}
}

AjaxUtils.GetTotalPageCount = function (categoryId)
{
	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 

	var url="process/getTotalPageCount.php?categoryId=" + categoryId;
	xmlGeneralHttp.onreadystatechange=this.updateGetTotalPageCount;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.updateGetTotalPageCount = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		document.getElementById("totalPageNumber").innerHTML=xmlGeneralHttp.responseText;
		Data.totalPageCount = parseInt(document.getElementById("totalPageNumber").innerHTML);

		if(Data.totalPageCount < 2) Pagination.DisableNext();	//disabled next if only 1 page of data
		else if(Data.totalPageCount >= 2) Pagination.EnableNext();	//enabled next if more than 1 page of data
	}
}

AjaxUtils.RecordSpam = function (postId)
{
	if(confirm('Do you want to mark this post as SPAM?'))
	{
		AjaxUtils.CurrentPostId = postId;
		xmlGeneralHttp=this.GetXmlHttpObject();
		if (xmlGeneralHttp==null)
		{
		  alert ("Your browser does not support AJAX!");
		  return;
		} 

		var url="process/setSpam.php?postId=" + postId;
		xmlGeneralHttp.onreadystatechange=this.updateRecordSpam;
		xmlGeneralHttp.open("GET",url,true);
		xmlGeneralHttp.send(null);
	}
}

AjaxUtils.updateRecordSpam = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		document.getElementById("spamImage" + AjaxUtils.CurrentPostId).src = "images/alert15.png";
		//document.getElementById("HomePagePosts").innerHTML=xmlGetPostByCategoryIDHttp.responseText;
	}
}

var xmlGetPostByCategoryIDHttp;

AjaxUtils.GetPostByCategoryID = function (categoryId,page)
{
	document.getElementById('HomePagePostsLoaderImage').innerHTML = "<img src='images/ajax-loader.gif'>";	//show loading image

	xmlGetPostByCategoryIDHttp=this.GetXmlHttpObject();
	if (xmlGetPostByCategoryIDHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	
	var url="process/getPostByCategoryID.php?categoryId=" + categoryId + "&page=" + page;
	xmlGetPostByCategoryIDHttp.onreadystatechange=this.updateGetPostByCategory;
	xmlGetPostByCategoryIDHttp.open("GET",url,true);
	xmlGetPostByCategoryIDHttp.send(null);
}

AjaxUtils.updateGetPostByCategory = function() 
{ 
	if (xmlGetPostByCategoryIDHttp.readyState==4) 
	{
		document.getElementById("HomePagePosts").innerHTML=xmlGetPostByCategoryIDHttp.responseText;
		document.getElementById('HomePagePostsLoaderImage').innerHTML = "&nbsp;";	//hide loading image
	}
}

AjaxUtils.GetPostByID = function (postId)
{
	document.getElementById('HomePagePostsLoaderImage').innerHTML = "<img src='images/ajax-loader.gif'>";	//show loading image
	AjaxUtils.CurrentPostId = postId;

	xmlGeneralHttp=this.GetXmlHttpObject();
	if (xmlGeneralHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	
	var url="process/getPost.php?postId=" + postId;
	xmlGeneralHttp.onreadystatechange=this.updateGetPostByID;
	xmlGeneralHttp.open("GET",url,true);
	xmlGeneralHttp.send(null);
}

AjaxUtils.updateGetPostByID = function() 
{ 
	if (xmlGeneralHttp.readyState==4) 
	{
		document.getElementById("HomePagePosts").innerHTML=xmlGeneralHttp.responseText;
		document.getElementById('HomePagePostsLoaderImage').innerHTML = "&nbsp;";	//hide loading image
		AjaxUtils.RecordView(AjaxUtils.CurrentPostId);
		AjaxUtils.GetViewByPostID(AjaxUtils.CurrentPostId);
	}
}

var xmlGetTopPostsHttp;

AjaxUtils.GetTopPosts = function ()
{
	xmlGetTopPostsHttp=this.GetXmlHttpObject();
	if (xmlGetTopPostsHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	
	var url="process/getTopPosts.php";
	xmlGetTopPostsHttp.onreadystatechange=this.updateGetTopPost;
	xmlGetTopPostsHttp.open("GET",url,true);
	xmlGetTopPostsHttp.send(null);
}

AjaxUtils.updateGetTopPost = function() 
{ 
	if (xmlGetTopPostsHttp.readyState==4) 
	{
		document.getElementById("HomePageTopPosts").innerHTML=xmlGetTopPostsHttp.responseText;
	}
}

var xmlSubmitPostHttp;

AjaxUtils.SubmitPost = function (submitPostTitle,submitPostURL,submitPostCategory)
{
	document.getElementById('submitPostFormResponse').innerHTML = "<div style='width: 100%; height: 150px; text-align: center;'><img src='images/ajax-loader-submit.gif'></div>";	//show loading image
	document.getElementById('submitPostFormDiv').style.display = 'none';

	xmlSubmitPostHttp=this.GetXmlHttpObject();
	if (xmlSubmitPostHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	
	var url="process/setPost.php?title=" + encodeURIComponent(submitPostTitle) + "&url=" + encodeURIComponent(submitPostURL) + "&categoryId=" + submitPostCategory;
	xmlSubmitPostHttp.onreadystatechange=this.updateSubmitPost;
	xmlSubmitPostHttp.open("GET",url,true);
	xmlSubmitPostHttp.send(null);
}

AjaxUtils.updateSubmitPost = function() 
{ 
	if (xmlSubmitPostHttp.readyState==4) 
	{
		document.getElementById("submitPostFormResponse").innerHTML=xmlSubmitPostHttp.responseText;
		setTimeout('AjaxUtils.HidePostSubmitResponse()', 3000);
		document.getElementById('submitPostFormDiv').style.display = 'block';
	}
}

AjaxUtils.HidePostSubmitResponse = function () {
		document.getElementById("submitPostFormResponse").innerHTML = '&nbsp;';
}

var xmlRecordViewHttp;

AjaxUtils.RecordView = function (postId)
{
	AjaxUtils.CurrentPostId = postId;
	xmlRecordViewHttp=this.GetXmlHttpObject();
	if (xmlRecordViewHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	
	var url="process/setView.php?postId=" + postId;
	xmlRecordViewHttp.onreadystatechange=this.updateRecordView;
	xmlRecordViewHttp.open("GET",url,true);
	xmlRecordViewHttp.send(null);
}

AjaxUtils.updateRecordView = function() 
{ 
	if (xmlRecordViewHttp.readyState==4) 
	{
		AjaxUtils.GetTopPosts();	//dynamically update the top posts list without refreshing
	}
}