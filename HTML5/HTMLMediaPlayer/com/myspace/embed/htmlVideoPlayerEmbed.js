// HTML VIDEO PLAYER EMBED DATA

function HTMLVideoPlayerEmbedData(id, src) {
	this.id = id;
	this.src = src;
}

HTMLVideoPlayerEmbedData.prototype.id;
HTMLVideoPlayerEmbedData.prototype.src;

// HTML VIDEO PLAYER EMBED

function HTMLVideoPlayerEmbed() {}

HTMLVideoPlayerEmbed.embed = function() {
	videos = arguments;
	
	var numVideos = videos.length;
	for (var i = 0; i < numVideos; i++) {
		var video = videos[i];
	
		var videoId = video.id;
		var videoSrc = video.src;
	
		var iframe = $(document.createElement("iframe"));
		iframe.width("100%");
		iframe.height("100%");
		iframe.attr("frameborder", 0);
		iframe.attr("marginwidth", 0);
		iframe.attr("marginheight", 0);
		iframe.attr("scrolling", "no");
		iframe.css("overflow", "hidden");
	
		iframe.attr("src", videoSrc);
	
		var container = $("#" + videoId);
	
		container.append(iframe);
	}
}