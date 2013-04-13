//Default Video Menu Class

function VideoMenu (mediaId) {
	this.mediaId = mediaId;

	//create video menu content
	this.relatedVideosContent = new RelatedVideosContent(this.mediaId);	
}

VideoMenu.prototype.mediaId = undefined;
VideoMenu.prototype.width = undefined;
VideoMenu.prototype.height = undefined;
VideoMenu.prototype.isShowing = false;
VideoMenu.prototype.menuOverlay = undefined;
VideoMenu.prototype.menuContainer = undefined;

VideoMenu.prototype.leftNavButton = undefined;
VideoMenu.prototype.rightNavButton = undefined;
VideoMenu.prototype.relatedVideosContent = undefined;

VideoMenu.prototype.resize = function (videoPlayer, width, height) {
	this.hideMenu();
	
	this.width = width;
	this.height = height;
	
	if(this.menuOverlay)
	{
		this.menuOverlay.width(this.width);
		this.menuOverlay.height(this.height);
	}
	
	if(this.menuContainer)
	{
		this.menuContainer.width(this.width);
		this.menuContainer.height(this.height);
	}
	
	this.relatedVideosContent.updateSizePosition(this.width, this.height);	
	
	this.defineMenuOverlayContainer(videoPlayer.videoContainer);
}

VideoMenu.prototype.defineMenuOverlayContainer = function (videoContainer) {
	this.width = videoContainer.width();
	this.height = videoContainer.height();
	
	this.menuOverlay = $(document.createElement("div"));
	this.menuOverlay.addClass(VideoPlayer.MENU_CLASS);
	this.menuOverlay.width(videoContainer.width());
	this.menuOverlay.height(videoContainer.height());	
	this.menuOverlay.css({
		"-moz-opacity":".60",
		"filter":"alpha(opacity=60)",
		"opacity":".60",
		"background-color":"#000000",
		"position":"absolute"
	});
	
	this.menuContainer = $(document.createElement("div"));
	this.menuContainer.addClass(VideoPlayer.MENU_CLASS);
	this.menuContainer.width(videoContainer.width());
	this.menuContainer.height(videoContainer.height());	
	this.menuContainer.css({
		"position":"absolute",
		"color":"#FFFFFF"
	});
	
	this.relatedVideosContent.updateSizePosition(this.width, this.height);
	this.setMenuContent();
}

VideoMenu.prototype.toggleMenu = function(event) {
	if(!this.isShowing)
		this.showMenu(event.data.context.getVideoPlayer());		
	else
		this.hideMenu();
}

VideoMenu.prototype.showMenu = function (videoPlayer) {
	if(!this.menuOverlay || !this.menuContainer)	//if menu container hasn't been defined yet
		this.defineMenuOverlayContainer(videoPlayer.videoContainer);

	//videoPlayer.videoContainer.prepend(this.menuContainer);	
	//videoPlayer.videoContainer.prepend(this.menuOverlay);
	this.menuContainer.insertAfter(videoPlayer.imageStill.img);
	this.menuOverlay.insertAfter(videoPlayer.imageStill.img);
	
	this.isShowing = true;
} 

VideoMenu.prototype.hideMenu = function () {
	$('.' + VideoPlayer.MENU_CLASS).detach();
	this.isShowing = false;
}

VideoMenu.prototype.setMenuContent = function () {	
	var table = $(document.createElement("table"));	//create table for menu content

	var trContent = $(document.createElement("tr"));
	var tdLeftNavButton = $(document.createElement("td"));
	var tdContent = $(document.createElement("td"));
	var tdRightNavButton = $(document.createElement("td"));
	
	//set table styling
	table.attr("cellpadding", 0);
	table.attr("cellspacing", 0);
	table.attr("border", 0);
	table.attr("width", "100%");
	table.attr("height", "100%");
	
	tdLeftNavButton.attr("width","15%");
	tdLeftNavButton.attr("align","right");
	tdLeftNavButton.attr("valign","middle");
	
	tdContent.attr("width","70%");
	tdContent.attr("align","center");
	tdContent.attr("valign","middle");	
	tdContent.css("padding","0px 5px 0px 5px");
    tdContent.css("position","relative");
	tdContent.css("overflow","hidden");	//alows scrolling content to hide	
	
	tdRightNavButton.attr("width", "15%");
	tdRightNavButton.attr("valign","middle");
	
	trContent.append(tdLeftNavButton);
	trContent.append(tdContent);
	trContent.append(tdRightNavButton);
		
	table.append(trContent);	//add row to table		
	this.menuContainer.append(table);	//add table to container
	
	//create related menu navigation buttons
	this.leftNavButton = new NavigationButton(Constants.NAVIGATION_BUTTON_TYPE_LEFT, this.width);
	this.rightNavButton = new NavigationButton(Constants.NAVIGATION_BUTTON_TYPE_RIGHT, this.width);
	
	tdLeftNavButton.append(this.leftNavButton.element);
	tdContent.append(this.relatedVideosContent.element);
    tdContent.append(this.relatedVideosContent.element2);
	tdRightNavButton.append(this.rightNavButton.element);
	
	//overwrite the CLICK for RIGHT (Next) button
	this.rightNavButton.element.bind("click", {context: this}, this.relatedVideosContent.nextGalleryPage);
	
	//overwrite the CLICK for LEFT (Previous) button
	this.leftNavButton.element.bind("click", {context: this}, this.relatedVideosContent.previousGalleryPage);
	
	//disable the PREVIOUS button since 1st page is default
	this.leftNavButton.disable(); 
	
	//TODO: DISPLAY THUMBNAILS OF VIDEOS
	this.relatedVideosContent.createGallery();
}

//Related Videos thumb strip
function RelatedVideosContent (mediaId) {
    var contentWidth = 440;
    var positionTop = 190;
    var positionLeft = 100;
    
	this.element = $(document.createElement("div"));	//container will display related videos thumbnails
    this.element.width(contentWidth);
    this.element.css("position","absolute");
    
    this.element2 = $(document.createElement("div"));
    
    //opacity setting is needed for glitch in safari/mac sliding
    this.element2.css({'position':'absolute', 
        "-moz-opacity":"0.99", "filter":"alpha(opacity=99)", "opacity":".99",
        "display":"none"
    });
    this.element2.width(contentWidth);

	//safari/mac needs custome params set for proper sliding and display
	if(VideoPlayer.isMacSafari())
	{
        positionLeft = 110;
        positionTop = 200;
	}	
    
    this.element.css("left", positionLeft + "px");
    this.element.css("top", positionTop + "px");
        
    this.element2.css("left", positionLeft + "px");
    this.element2.css("top", positionTop + "px");

	this.videos = [];
	this.currentPageIndex = 0;
	
	this.getRelatedVideos(mediaId);	//retrieve JSON-P feed for related videos
}

RelatedVideosContent.prototype.videos = undefined;
RelatedVideosContent.prototype.element = undefined;
RelatedVideosContent.prototype.element2 = undefined;
RelatedVideosContent.prototype.currentPageIndex = undefined;
RelatedVideosContent.prototype.pageSize = 4;	//by default show 4 vidoe thumbs per page

RelatedVideosContent.prototype.updateSizePosition = function (width, height) {
	var contentWidth = width * .65;
	var positionTop = height / 2 - 30;
	var positionLeft = width * .18;
		
	this.element.width(contentWidth);
	this.element2.width(contentWidth);
	
    this.element.css("top", positionTop + "px");
    this.element2.css("top", positionTop + "px");
    
    this.element.css("left", positionLeft + "px");
    this.element2.css("left", positionLeft + "px");
    
    this.pageSize = Math.round(contentWidth / 120);
}

RelatedVideosContent.prototype.getRelatedVideos = function (mediaId) {
	var callback = function(obj) {
		return function(data){ 
			//obj.parseRelatedVideos(data);
			obj.parseRelatedVideosJSON(data); 
		}
	}

	//$.get("http://lads-stage.myspace.com/MediaPlayer/HTML5/sample/sampleRelatedVideos.xml", callback(this), "xml");
	//$.get("sampleRelatedVideos.xml", callback(this), "xml");
	//PROD:  http://mediaservices.myspace.com/services/media/video.asmx/MySpaceTvRelated?
	//TODO: http://mediaservices.myspace.com/services/RelatedVideos.ashx?videoid=18001&token=default&type=2&format=json&callback=?
	$.getJSON("http://mediaservices.myspace.com/services/RelatedVideos.ashx?videoid=" + mediaId + "&format=json&callback=?", callback(this));
}

RelatedVideosContent.prototype.parseRelatedVideosJSON = function(data){
	var curObj = this;
	
	$.each(data.Videos,function(i,item) {				
		var videoInfo = new RelatedVideoInfo();
		
		videoInfo.mediaID = item.MediaID;
		videoInfo.title = StringUtils.ReplaceEncodedChars(item.Title);
		videoInfo.vanityURL = item.VanityUrl;
		videoInfo.thumbNailURL = item.Thumbnail;
		videoInfo.TotalSeconds = item.TotalSeconds;
		
		curObj.videos.push(videoInfo);

	});
}

RelatedVideosContent.prototype.parseRelatedVideos = function(xml){
	var curObj = this;

	$(xml).find("Video").each(function(){
		var videoInfo = new RelatedVideoInfo();
		
		videoInfo.mediaID = $(this).attr("MediaID");
		videoInfo.title = StringUtils.CleanString($(this).find("Title").text());
		videoInfo.vanityURL = StringUtils.CleanString($(this).find("VanityUrl").text());
		videoInfo.thumbNailURL = $(this).attr("Thumbnail");
		videoInfo.TotalSeconds = $(this).attr("TotalSeconds");
		
		curObj.videos.push(videoInfo);
	}); 
}

RelatedVideosContent.prototype.createGallery = function () {	
	this.currentPageIndex = 0;	//by default display 1st page	
	this.createGalleryPage(this.currentPageIndex, this.element);
}

RelatedVideosContent.prototype.createGalleryPage = function (pageIndex, thumbContainer) {
	//remove thumnails of currently displayed page
	$(thumbContainer).find("span").each(function(){
		$(this).remove();
	});
	
	var startIndex = pageIndex * this.pageSize;
	var endIndex = ((startIndex + this.pageSize) > this.videos.length) ? this.videos.length - 1 : startIndex + (this.pageSize - 1);
	
	for(var x = startIndex; x <= endIndex; x++)
	{
		//new thumbs gets video info and reference to container for all thumbs	(used to append mouseEnter text)
		thumbContainer.append(new VideoThumb(this.videos[x], thumbContainer).element);
	}
}

RelatedVideosContent.prototype.nextGalleryPage = function (event) {
	var obj = event.data.context.relatedVideosContent;
	var rightNavButton = event.data.context.rightNavButton;
	var leftNavButton = event.data.context.leftNavButton;
	var lastPageIndex = obj.videos.length / obj.pageSize - 1;
	
	if(obj.currentPageIndex >= lastPageIndex)
	{
		rightNavButton.element.css({"background-color":"#AAAAAA"});
	}
	else
	{		
		obj.currentPageIndex++;	//increase current page index
        
        rightNavButton.element.unbind("click");	//remove NAV BUTTON click during sliding
        
		//slide out current content
		$(obj.element).hide('slide',{direction: 'left'}, 600, function () { 
			obj.createGalleryPage(obj.currentPageIndex, obj.element);
			
			//add NAV BUTTON click after sliding is done
            rightNavButton.element.bind("click", {context: event.data.context}, obj.nextGalleryPage);
            
			//$(this).show('slide',{direction: 'right'}, 600); 
		});
        
        obj.createGalleryPage(obj.currentPageIndex, obj.element2); //create content to slide in
        
        //slide in new content (in parallel)
        $(obj.element2).show('slide',{direction: 'right'}, 600, function () {
            obj.element.css('display','block'); //overlay main content over sliding content
            obj.element2.css('display','none'); //hide the slide-in content layer            
        });
                
        if(!leftNavButton.isEnabled)
        	leftNavButton.enable();	//enable PREVIOUS button
         
        //if last page, disable NEXT button
		if(obj.currentPageIndex >= lastPageIndex)
			rightNavButton.disable();
	}
}

RelatedVideosContent.prototype.previousGalleryPage = function (event) {
	var obj = event.data.context.relatedVideosContent;
	var leftNavButton = event.data.context.leftNavButton;
	var rightNavButton = event.data.context.rightNavButton;
	
	if(obj.currentPageIndex <= 0)
	{
		leftNavButton.element.css({"background-color":"#AAAAAA"});
	}
	else
	{
		obj.currentPageIndex--;	//decrease current page index
		
		leftNavButton.element.unbind("click");	//remove NAV BUTTON click during sliding

		//slide current content and slide in new content
		$(obj.element).hide('slide',{direction: 'right'}, 600, function () { 
			obj.createGalleryPage(obj.currentPageIndex, obj.element);
			
			//add NAV BUTTON click after sliding is done
            leftNavButton.element.bind("click", {context: event.data.context}, obj.previousGalleryPage);
            
			//$(this).show('slide',{direction: 'left'}, 600); 
		});	
        
        obj.createGalleryPage(obj.currentPageIndex, obj.element2); //create content to slide in
        
        $(obj.element2).show('slide',{direction: 'left'}, 600, function () {
            obj.element.css('display','block');
            obj.element2.css('display','none');
            
            
        });
        
        if(!rightNavButton.isEnabled)
        	rightNavButton.enable();	//enable NEXT button
        	
        //if first page, disable PREVIOUS button
        if(obj.currentPageIndex <= 0)	
        	leftNavButton.disable();        
	}
}


function VideoThumb (videoInfo, thumbsContainer) {
	this.videoInfo = videoInfo;
	this.element = $(document.createElement("span"));	//single thumbnail container
	this.element.addClass(VideoPlayer.THUMB_CLASS);
	this.element.width("80");
	this.element.height("60");
	this.element.css({"padding":"0px 5px 0px 5px"});
	
	this.img = $(document.createElement("img"));
	this.img.attr("src", this.videoInfo.thumbNailURL);
	this.img.attr("width","80");
	this.img.attr("height","60");
	this.img.css({"border":"1px solid " + VideoThumb.BORDER_COLOR,"cursor":"pointer"});	//prepares space for mouseEnter border
	
	this.element.append(this.img);
	
	this.element.bind("mouseenter", {context: this, thumbsContainer: thumbsContainer}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
	this.element.bind("click", {context: this}, this.onClick);
	
	this.createVideoInfoLabel();	//set up DIV for displaying mouseEnter video title and duration
}

VideoThumb.BORDER_COLOR = "#666666";
VideoThumb.BORDER_OVER_COLOR = "#2f83d9";
VideoThumb.prototype.element = undefined;
VideoThumb.prototype.img = undefined;
VideoThumb.prototype.videoInfo = undefined;
VideoThumb.prototype.videoInfoLabel = undefined;

VideoThumb.prototype.createVideoInfoLabel = function () {
	this.videoInfoLabel = $(document.createElement("div"));
	this.videoInfoLabel.addClass(VideoPlayer.THUMB_LABEL_CLASS);
	this.videoInfoLabel.css({
		"font-family" : Constants.DEFAULT_FONT_FAMILY,
		"font-size" : Constants.DEFAULT_FONT_SIZE,
		"font-weight" : "bold",
		"color" : "white",
		"float" : "left",
		"position" : "relative",
		"margin-top" : "-20px",
		"top" : "55px",
		"left" : "41px"
	});
	
	if(VideoPlayer.isMacSafari())
		this.videoInfoLabel.css({"top":"65px","left":"50px"});

	this.videoInfoLabel.text(this.videoInfo.title + ' (' + TimeUtils.secondsToDigitalDisplay(this.videoInfo.TotalSeconds) + ')');
}

VideoThumb.prototype.onMouseEnter = function(event) {
	var obj = event.data.context;
	obj.img.css("border", "1px solid " + VideoThumb.BORDER_OVER_COLOR);

	$(obj.videoInfoLabel).insertAfter($(event.data.thumbsContainer));
}

VideoThumb.prototype.onMouseLeave = function(event) {
	event.data.context.img.css("border", "1px solid " + VideoThumb.BORDER_COLOR);	
	$('.' + VideoPlayer.THUMB_LABEL_CLASS).remove();
}

VideoThumb.prototype.onClick = function(event) {
	window.open(Constants.VIDEO_PAGE_URL + event.data.context.videoInfo.mediaID);
	//window.location = Constants.VIDEO_PAGE_URL + event.data.context.videoInfo.mediaID;
}

//VideoInfo Object stores data for a single related video
function RelatedVideoInfo () {}

RelatedVideoInfo.prototype.mediaID = undefined;
RelatedVideoInfo.prototype.title = undefined;
RelatedVideoInfo.prototype.vanityURL = undefined;
RelatedVideoInfo.prototype.thumbNailURL = undefined;
RelatedVideoInfo.prototype.TotalSeconds = undefined;

//Related Videos LEFT/RIGHT navigation button
function NavigationButton (type, containerWidth) {
	this.type = type;	
	this.containerWidth = containerWidth;
	
	this.draw();	
	
	this.element.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
	this.element.bind("click", {context: this}, this.onClick);
}

NavigationButton.prototype.element = undefined;
NavigationButton.prototype.type = undefined;	//LEFT or RIGHT
NavigationButton.prototype.isEnabled = true;
NavigationButton.prototype.containerWidth = undefined;
NavigationButton.BG_COLOR = "#2f83d9";
NavigationButton.BG_COLOR_OVER = "#FFFFFF";

NavigationButton.prototype.draw = function () {		
	var fontSize = "35px";
	var width = "50px";
	var height = "100px";
	var textTop = "24px";
	var textSide = "11px";
		
	if(this.containerWidth * .15 < 60)
	{
		width = "25px";
		height = "50px";
		fontSize = "14px";
		textTop = "16px";
		textSide = "7px";
	}
	
	this.element = $(document.createElement("div"));
	this.element.width(width);
	this.element.height(height);
	this.element.css({
		"background-color":NavigationButton.BG_COLOR,
		"cursor":"pointer",
		"font-family":"Tahoma",
		"font-size":fontSize,
		"font-weight":"bold",
		"color":"white"	
	});
	
	var textSpan = $(document.createElement("span"));
	textSpan.css({"position":"relative", "top":textTop});	
	
	if(this.type == Constants.NAVIGATION_BUTTON_TYPE_LEFT)
	{
		textSpan.text("<");
		textSpan.css({"right":textSide});
	}
	else if(this.type == Constants.NAVIGATION_BUTTON_TYPE_RIGHT)
	{
		textSpan.text(">");
		textSpan.css({"left":textSide});
	}
	
	this.element.append(textSpan);
}

NavigationButton.prototype.enable = function() {
	this.element.css({
		"background-color":NavigationButton.BG_COLOR,
		"color":NavigationButton.BG_COLOR_OVER,
		"cursor":"pointer"		
	});
	
	this.element.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
	
	this.isEnabled = true;
}

NavigationButton.prototype.disable = function() {
	this.element.css({"background-color":"#AAAAAA", "color":"#FFFFFF", "cursor":"default"});
	
	this.element.unbind("mouseenter");
	this.element.unbind("mouseleave");
	
	this.isEnabled = false;
}

NavigationButton.prototype.onMouseEnter = function(event) {
	event.data.context.element.css("background-color", NavigationButton.BG_COLOR_OVER);
	event.data.context.element.css("color", NavigationButton.BG_COLOR);
}

NavigationButton.prototype.onMouseLeave = function(event) {
	event.data.context.element.css("background-color",NavigationButton.BG_COLOR);
	event.data.context.element.css("color",NavigationButton.BG_COLOR_OVER);
}

NavigationButton.prototype.onClick = function(event) {}	//custom overwrite in VideoMenu.setMenuContent()

/* IVP LAYOUT

VideoMenu.prototype.playButton = undefined;
VideoMenu.prototype.shareButton = undefined;
VideoMenu.prototype.commentsButton = undefined;
VideoMenu.prototype.moreVideosButton = undefined;

VideoMenu.prototype.setMenuContent = function () {
	//this.menuContainer.text("CONTENT HERE");
	
	//create table for menu content
	var table = $(document.createElement("table"));
	
	//create row for play, share, comments, more videos buttons
	var trButtons = $(document.createElement("tr"));
	
	//create blank left cell
	var tdBlankLeft = $(document.createElement("td"));
	
	//create cell for play
	var tdPlayButton = $(document.createElement("td"));
	
	//create cell for share
	var tdShareButton = $(document.createElement("td"));
	
	//create cell for comments
	var tdCommentsButton = $(document.createElement("td"));
	
	//create cell for more videos
	var tdMoreVideosButton = $(document.createElement("td"));
	
	//create blank right cell
	var tdBlankRight = $(document.createElement("td"));
	
	//create row for related videos and navigation
	var trContent = $(document.createElement("tr"));
	
	//create cell for left navigation
	var tdLeftNavButton = $(document.createElement("td"));
	
	//create cell for related videos (colspan = 4, to merge columns from above row)
	var tdRelatedVideos = $(document.createElement("td"));
	
	//create cell for right navigation
	var tdRightNavButton = $(document.createElement("td"));
	
	//set table styling
	table.attr("cellpadding", 0);
	table.attr("cellspacing", 0);
	table.attr("border", 0);
	table.attr("width", "100%");
	table.attr("height", "100%");
	
	//set buttons row  and cells styling
	trButtons.attr("height", "30%");
	tdBlankLeft.attr("width", "10%");
	tdPlayButton.attr("width", "20%");
	tdShareButton.attr("width", "20%");
	tdCommentsButton.attr("width", "20%");
	tdMoreVideosButton.attr("width", "20%");
	tdBlankRight.attr("width", "10%");
		
	//set content row and cells styling
	trContent.attr("height", "70%");
	tdLeftNavButton.attr("width","10%");
	tdRelatedVideos.attr("colspan", 4);
	tdRelatedVideos.attr("width", "80%");
	tdRightNavButton.attr("width","10%");
	
	//put together all table elements
	trButtons.append(tdBlankLeft);
	trButtons.append(tdPlayButton);
	trButtons.append(tdShareButton);
	trButtons.append(tdCommentsButton);
	trButtons.append(tdMoreVideosButton);
	trButtons.append(tdBlankRight);
	
	trContent.append(tdLeftNavButton);
	trContent.append(tdRelatedVideos);
	trContent.append(tdRightNavButton);
	
	table.append(trButtons);
	table.append(trContent);	
	
	//add table to menu content container
	this.menuContainer.append(table);
}
*/