///////////////////
// CONFIGURATION //
///////////////////

// Constants - global constants

function Constants() {}

Constants.FILE_SEPARATOR = "/"; // file separator

//Constants.ASSETS_DIR_PATH = "../assets"; // assets directory path
Constants.ASSETS_DIR_PATH = HTML5_VIDEO_PLAYER_ASSET_PATH; // assets directory path 

Constants.VIDEO_PAGE_URL = "http://vids.myspace.com/index.cfm?fuseaction=vids.individual&videoid=";
Constants.BEACON_URL = "http://b.myspace.com/~myspace/beacon/b.ashx?";

Constants.DEFAULT_FONT_FAMILY = "arial, sans-serif";
Constants.DEFAULT_FONT_SIZE = "11px";
Constants.DEFAULT_FONT_COLOR = "#666666";
Constants.NAVIGATION_BUTTON_TYPE_LEFT = "LEFT";
Constants.NAVIGATION_BUTTON_TYPE_RIGHT = "RIGHT";

//Analytics: IDs Events
function AnalyticsEventType () {}

AnalyticsEventType.DSID_PLAYER_LOADED = "500";
AnalyticsEventType.DSID_PLAYER_GENERIC = "501";

AnalyticsEventType.PLAYER_LOADED = "101";
AnalyticsEventType.PLAY_DURATION = "102";
AnalyticsEventType.PLAY_REQUEST_ON_NEW_MEDIA_START = "103";
AnalyticsEventType.PLAY_PREROLL = "106";
AnalyticsEventType.PLAY_POSTROLL = "107";
AnalyticsEventType.PLAY_INTERRUPT_BY_PAUSE = "110";
AnalyticsEventType.PLAY_COMPLETED = "120";
AnalyticsEventType.PLAYER_SEEK_FORWARD = "127";
AnalyticsEventType.PLAYER_SEEK_BACKWARD = "128";
AnalyticsEventType.PLAY = "132";
AnalyticsEventType.ENTER_FULL_SCREEN_MODE = "605";
AnalyticsEventType.EXIT_FULL_SCREEN_MODE = "606";
AnalyticsEventType.IVP_PLAYER_MENU_PANE_OPEN_BUTTON_CLICKED = "607";
AnalyticsEventType.IVP_PLAYER_MENU_PANE_CLOSE_BUTTON_CLICKED = "608";
AnalyticsEventType.IVP_REPLAY_BUTTON_CLICK = "616";
AnalyticsEventType.TWENTY_FIVE_PLAY_COMPLETE = "617";
AnalyticsEventType.FIFTY_PLAY_COMPLETE = "618";
AnalyticsEventType.SEVENTY_FIVE_PLAY_COMPLETE = "619";

// Localization - localized strings

function Localization() {}

Localization.prototype.PLAY = "Play";
Localization.prototype.PAUSE = "Pause";
Localization.prototype.MENU = "Menu";

// Config - configuration variables

function Config() {
	this.mediaId = undefined;
	
	//Event Info
	this.plrid = "300";	//player id
	this.pver = "1.0";	//player version
	this.pskin = "7000";	//player skin
	this.seq = 1;	//sequence number
	this.plid = 0;	//playlist id
	this.ssprod = true;
}

Config.prototype.mpguid = undefined;	//media player guid
Config.prototype.pid = undefined;	//Persistent End User ID 
Config.prototype.uid = undefined;	//user id
Config.prototype.pc = undefined;	//culture id
Config.prototype.refpg = undefined;	//embed url
Config.prototype.plrid = undefined;	//player id
Config.prototype.pver = undefined;	//player version
Config.prototype.pskin = undefined;	//player skin
Config.prototype.srchid = undefined;	//search id
Config.prototype.cip = undefined;	//client ip
Config.prototype.sip = undefined;	//server ip
Config.prototype.prid = undefined;	//profile id
Config.prototype.prtype = undefined;	//profile type
Config.prototype.ili = undefined;	//is logged in
Config.prototype.plid = undefined;	//playlist id
Config.prototype.pf = undefined;	//page context
Config.prototype.useid = undefined;	//content usage type id
Config.prototype.seq = undefined;	//sequence number
Config.prototype.ssprod = undefined;	//production or not
	
Config.prototype.mediaId = undefined;
Config.ASSETS_PATH = Constants.ASSETS_DIR_PATH + Constants.FILE_SEPARATOR + "videoAssets.png"; // assets

// Debug

function Debug() {}

Debug.out = function(value) {
	window.console.log(value);
}

Debug.log = function() {
	var args = [].splice.call(arguments, 0);
	window.console.log(args.join(" "));
}

//////////
// MAIN //
//////////

// Video Player Data - template object for passing to Video constructor on initialization

function VideoPlayerData() {}

VideoPlayerData.prototype.sources = {};
VideoPlayerData.prototype.poster = false;
VideoPlayerData.prototype.autoplay = false;
VideoPlayerData.prototype.mediaId = undefined;
VideoPlayerData.prototype.imageStillSrc = undefined;
VideoPlayerData.prototype.mpguid = undefined;	//media player guid
VideoPlayerData.prototype.pid = undefined;	//Persistent End User ID 
VideoPlayerData.prototype.uid = undefined;	//user id
VideoPlayerData.prototype.pc = undefined;	//culture id
VideoPlayerData.prototype.refpg = undefined;	//embed url
VideoPlayerData.prototype.srchid = undefined;	//search id
VideoPlayerData.prototype.cip = undefined;	//client ip
VideoPlayerData.prototype.sip = undefined;	//server ip
VideoPlayerData.prototype.prid = undefined;	//profile id
VideoPlayerData.prototype.prtype = undefined;	//profile type
VideoPlayerData.prototype.ili = undefined;	//is logged in
VideoPlayerData.prototype.pf = undefined;	//page context
VideoPlayerData.prototype.useid = undefined;	//content usage type id

// Video Player - main class to instantiate video player

function VideoPlayer(containerId, data) {
	this.setConfig(data);
	
	var container = $("#" + containerId);
	
	var width = $(window).width() + "px";
	var height = $(window).height() + "px";
	
	// root html element
	
	this.root = $(document.createElement("div"));
	this.root.css("backgroundColor", VideoPlayer.BACKGROUND_COLOR);
	this.root.css("overflowY", "hidden");
	
	this.root.addClass(VideoPlayer.ROOT_CLASS);
	this.root.data("videoPlayer", this);
	
	// video container html element
	
	this.videoContainer = $(document.createElement("div"));
	
	// video html element
	
	this.video = new Video();
	this.video.setSources(data.sources);
	this.video.setPoster(data.poster);
	this.video.setAutoplay(data.autoplay);
	
	// image still
	this.imageStill = new ImageStill(data.imageStillSrc, 0, 0);	
	
	// controls container html element
	
	this.controlsContainer = $(document.createElement("div"));
	
	// controls html element
	
	this.controls = new Controls();
	
	// define display tree
	
	this.videoContainer.append(this.video.element);
	this.controlsContainer.append(this.controls.element);
	this.videoContainer.prepend(this.imageStill.img);
	
	this.root.append(this.videoContainer);
	this.root.append(this.controlsContainer);

	container.append(this.root);	
	
	// size	
	this.resize(width, height);
	
	// attach	
	this.controls.attach();	
	
	//create video menu (default is related videos)
	this.controls.menuButton.videoMenu = new VideoMenu(this.config.mediaId);	
	
	//set default player volume level
	this.video.element.get(0).volume = VideoPlayer.DEFAULT_VOLUME;
	
	//send analytics
	AnalyticsUtils.buildAndSend(AnalyticsEventType.PLAYER_LOADED, "", this.config);
	
	this.video.element.bind("timeupdate", {context: this}, this.onTimeUpdate);
	
	// resize upon window resize
	$(window).bind("resize", {context: this}, function(event) { 
		var self = event.data.context;
		
		self.resize($(window).width() + "px", $(window).height() + "px");
	});
}

VideoPlayer.ROOT_CLASS = "videoPlayerRoot"; // root css class
VideoPlayer.MENU_CLASS = "videoPlayerMenuRoot";	//video menu root css class 
VideoPlayer.THUMB_CLASS = "videoPlayerRelatedThumb";
VideoPlayer.THUMB_LABEL_CLASS = "videoPlayerRelatedThumbLabel";
VideoPlayer.BACKGROUND_COLOR = "#000000"; // video player background color
VideoPlayer.DEFAULT_VOLUME = .50;
 
VideoPlayer.isMacSafari = function () {
	if(navigator.userAgent.indexOf("Safari") != -1 && navigator.userAgent.indexOf("Mac OS") != -1)
		return true;
	else
		return false;
}

// traverse display tree to find containing video player
VideoPlayer.findVideoPlayer = function(element) {
	var parent = $(element).parent();

	while (parent.length) {
		if (parent.hasClass(VideoPlayer.ROOT_CLASS)) {
			return parent.data().videoPlayer;
		}
		
		parent = parent.parent();
	}
	
	return null;
}

VideoPlayer.prototype.config = new Config(); // video player configuration
VideoPlayer.prototype.localization = new Localization(); // video player localized strings

VideoPlayer.prototype.root = undefined; // root html element
VideoPlayer.prototype.videoContainer = undefined; // video container html element
VideoPlayer.prototype.video = undefined; // video playback html element
VideoPlayer.prototype.controlsContainer = undefined; // controls container html element
VideoPlayer.prototype.controls = undefined; // controls html element
VideoPlayer.prototype.imageStill = undefined;
VideoPlayer.prototype.playInitStarted = false;
VideoPlayer.prototype.playEnded = false;
VideoPlayer.prototype.Beacon25Sent = false;	//flag for 25% analytic beacon
VideoPlayer.prototype.Beacon50Sent = false;	//flag for 50% analytic beacon
VideoPlayer.prototype.Beacon75Sent = false;	//flag for 75% analytic beacon

VideoPlayer.prototype.onTimeUpdate = function(event) {
	var videoPlayer = event.data.context;
	
	if(!videoPlayer.video.element.get(0).paused)
	{
		var currentPercentCompletion = (videoPlayer.video.element.get(0).currentTime/videoPlayer.video.element.get(0).duration) * 100;
		
		//send 25% analytic beacon
		if(currentPercentCompletion >= 25 && currentPercentCompletion < 26 && !videoPlayer.Beacon25Sent)
		{
			AnalyticsUtils.buildAndSend(AnalyticsEventType.TWENTY_FIVE_PLAY_COMPLETE, "", videoPlayer.config);
			videoPlayer.Beacon25Sent = true;
		}
		
		//send 50% analytic beacon
		if(currentPercentCompletion >= 50 && currentPercentCompletion < 51 && !videoPlayer.Beacon50Sent)
		{
			AnalyticsUtils.buildAndSend(AnalyticsEventType.FIFTY_PLAY_COMPLETE, "", videoPlayer.config);
			videoPlayer.Beacon50Sent = true;
		}
		
		//send 75% analytic beacon
		if(currentPercentCompletion >= 75 && currentPercentCompletion < 76 && !videoPlayer.Beacon75Sent)
		{
			AnalyticsUtils.buildAndSend(AnalyticsEventType.SEVENTY_FIVE_PLAY_COMPLETE, "", videoPlayer.config);
			videoPlayer.Beacon75Sent = true;
		}
	}
}
 
VideoPlayer.prototype.setConfig = function(data) {
	this.config.mediaId = data.mediaId;	//set MEDIA ID
	
	this.config.mpguid = data.mpguid;	//media player guid
	this.config.pid = data.pid;	//Persistent End User ID 
	this.config.uid = data.uid;	//user id
	this.config.pc = data.pc;	//culture id
	this.config.refpg = data.refpg;	//embed url
	this.config.srchid = data.srchid;	//search id
	this.config.cip = data.cip;	//client ip
	this.config.sip = data.sip;	//server ip
	this.config.prid = data.prid;	//profile id
	this.config.prtype = data.prtype;	//profile type
	this.config.ili = data.ili;	//is logged in
	this.config.pf = data.pf;	//page context
	
	//content usage type id (auto play = 1, manual play = 2)
	if(data.autoplay)
		this.config.useid = 1;	
	else
		this.config.useid = 2;	
}

VideoPlayer.prototype.resize = function(width, height) {
	this.root.width(width);
	this.root.height(height);
	
	var computedWidth = this.root.width();
	var computedHeight = this.root.height();
	
	this.videoContainer.width(computedWidth + "px");
	this.videoContainer.height((computedHeight - this.controls.element.height()) + "px");
	
	this.imageStill.img.width(this.videoContainer.width() + "px");
	this.imageStill.img.height(this.videoContainer.height()+ "px");
	
	this.controlsContainer.width(computedWidth + "px");
	
	//update menu size
	if(this.controls.menuButton.videoMenu)
	{
		this.controls.menuButton.videoMenu.resize(this, this.videoContainer.width(), this.videoContainer.height());
	}
} 

//ImageStill

function ImageStill (imageStillSrc, width, height) {		
	this.img = $(document.createElement("img"));
	this.img.attr("src", imageStillSrc);
	this.img.width(width);
	this.img.height(height);
	this.img.css("position","absolute");
	
	this.img.bind("click", {context: this}, this.onClick);
}

ImageStill.prototype.element = undefined;
ImageStill.prototype.img = undefined;

ImageStill.prototype.showImageStill = function() {
	this.img.css("display","block");
}

ImageStill.prototype.hideImageStill = function() {
	this.img.css("display","none");
}

ImageStill.prototype.onClick = function(event) {
	var videoPlayer = event.data.context.getVideoPlayer();
	videoPlayer.video.element.get(0).play();
}

ImageStill.prototype.getVideoPlayer = function() {
	return VideoPlayer.findVideoPlayer(this.img);
}
///////////
// MEDIA //
///////////

// Video - video playback

function Video() {
	this.element = $(document.createElement("video"));
	this.element.width("100%");
	this.element.height("100%");
}

Video.prototype.element = undefined; // video html element

// set video sources ({"type": "source", "type": "source"})
Video.prototype.setSources = function(sources) {
	this.element.children("source").remove();
	
	for (var type in sources) {
		var source = sources[type];
		
		var sourceElement = $(document.createElement("source"));
		sourceElement.attr("type", type);
		sourceElement.attr("src", source);
		
		this.element.append(sourceElement);
	}
}

// get video sources ({"type": "source", "type": "source"})
Video.prototype.getSources = function() {
	var sources = {};
	
	this.element.children("source").each(
		function (index, sourceElement) {
			sourceElement = $(sourceElement);
			
			var type = sourceElement.attr("type");
			var source = sourceElement.attr("src");
			
			sources[type] = source;
		}
	);
	
	return sources;
}

// set video autoplay
Video.prototype.setAutoplay = function(autoplay) {
	this.element.attr("autoplay", Boolean(autoplay));
}

// get video autoplay
Video.prototype.getAutoplay = function() {
	return Boolean(this.element.attr("autoplay"));
}

// set video poster
Video.prototype.setPoster = function(poster) {
	this.element.attr("poster", String(poster));
}

// get video poster
Video.prototype.getPoster = function() {
	return String(this.element.attr("poster"));
}

////////
// UI //
////////

// Controls - controls for video player 

function Controls() {
	this.element = $(document.createElement("table"));
	this.element.width("100%");
	this.element.height(Controls.HEIGHT);
	this.element.attr("cellpadding", 0);
	this.element.attr("cellspacing", 0);
	this.element.attr("border", 0);	
	this.element.css("backgroundImage", "url(" + Controls.BACKGROUND_IMAGE + ")");
	this.element.css("backgroundColor", Controls.BACKGROUND_COLOR);
	this.element.css("backgroundRepeat", "repeat-x");
	this.element.css("backgroundPosition", "bottom");
	
	this.playToggle = new PlayToggle();
	this.videoScrubber = new VideoScrubber();
	this.timeDisplay = new TimeDisplay();
	this.volumeControl = new VolumeControl();
	this.fullscreenButton = new FullscreenButton();
	this.menuButton = new MenuButton();
	
	var tr = $(document.createElement("tr"));
	
	var tdPlayToggle = $(document.createElement("td"));
	tdPlayToggle.width("0%");
	tdPlayToggle.css("padding", Controls.PLAY_TOGGLE_PADDING);
	
	var tdVideoScrubber = $(document.createElement("td"));
	tdVideoScrubber.width("100%");
	tdVideoScrubber.css("padding", Controls.VIDEO_SCRUBBER_PADDING);
	
	var tdTimeDisplay = $(document.createElement("td"));
	tdTimeDisplay.width("0%");
	tdTimeDisplay.css("padding", Controls.TIME_DISPLAY_PADDING);
	
	var tdVolumeControl = $(document.createElement("td"));
	tdVolumeControl.width("0%");
	tdVolumeControl.css("padding", Controls.VOLUME_TOGGLE_PADDING);
	
	var tdFullscreenButton = $(document.createElement("td"));
	tdFullscreenButton.width("0%");
	tdFullscreenButton.css("padding", Controls.FULLSCREEN_BUTTON_PADDING);
	
	var tdMenuButton = $(document.createElement("td"));
	tdMenuButton.width("0%");
	tdMenuButton.css("padding", Controls.MENU_BUTTON_PADDING);
	
	tdPlayToggle.append(this.playToggle.element);
	tdVideoScrubber.append(this.videoScrubber.element);
	tdTimeDisplay.append(this.timeDisplay.element);
	tdVolumeControl.append(this.volumeControl.element);
	//tdFullscreenButton.append(this.fullscreenButton.element);
	tdMenuButton.append(this.menuButton.element);

	tr.append(tdPlayToggle);
	tr.append(tdVideoScrubber);
	tr.append(tdTimeDisplay);
	tr.append(tdVolumeControl);
	tr.append(tdFullscreenButton);
	tr.append(tdMenuButton);

	this.element.append(tr);	
}

Controls.HEIGHT = "40px";
Controls.BACKGROUND_IMAGE = Constants.ASSETS_DIR_PATH + Constants.FILE_SEPARATOR + "videoControlsBackground.gif";
Controls.BACKGROUND_COLOR = "#f5f5f5";
Controls.MENU_BUTTON_IMAGE = Constants.ASSETS_DIR_PATH + Constants.FILE_SEPARATOR + "menuButtonBackground.gif";

Controls.LEFT_CONTAINER_WIDTH = "48px";
Controls.RIGHT_CONTAINER_WIDTH = "200px";

Controls.PLAY_TOGGLE_PADDING = "5px 5px 5px 5px";

Controls.VIDEO_SCRUBBER_PADDING = "0px 0px 0px 0px";
Controls.TIME_DISPLAY_PADDING = "5px 5px 5px 5px";

Controls.VOLUME_CONTROL_PADDING = "5px 0px 5px 5px";
Controls.FULLSCREEN_BUTTON_PADDING = "5px 0px 5px 0px";
Controls.MENU_BUTTON_PADDING = "5px 5px 5px 0px";

Controls.prototype.element = undefined; // controls html element

Controls.prototype.playToggle = undefined; // play toggle control

Controls.prototype.videoScrubber = undefined; // video scrubber element
Controls.prototype.timeDisplay = undefined; // time display element

Controls.prototype.volumeControl = undefined; // volume toggle control
Controls.prototype.fullscreenButton = undefined; // fullscreen button control
Controls.prototype.menuButton = undefined; //menu button control

Controls.prototype.attach = function() {
	this.playToggle.attach();
	this.videoScrubber.attach();
	this.timeDisplay.attach();
	this.volumeControl.attach();
	this.menuButton.attach();
}

Controls.prototype.getVideoPlayer = function() {
	return VideoPlayer.findVideoPlayer(this.element);
}

// Play Button 

function PlayButton() {	
	this.element = $(document.createElement("a"));
	this.slice = new ImageSlice(this.element, PlayButton.UP_ASSET_DATA);
	
	this.element.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
}

PlayButton.UP_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 0, 0, 38, 29);
PlayButton.OVER_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 38, 0, 38, 29);

PlayButton.prototype.element = undefined;
PlayButton.prototype.slice = undefined;

PlayButton.prototype.onMouseEnter = function(event) {
	event.data.context.slice.set(PlayButton.OVER_ASSET_DATA);
}

PlayButton.prototype.onMouseLeave = function(event) {
	event.data.context.slice.set(PlayButton.UP_ASSET_DATA);
}

// Pause Button 

function PauseButton() {	
	this.element = $(document.createElement("a"));
	this.slice = new ImageSlice(this.element, PauseButton.UP_ASSET_DATA);
	
	this.element.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
}

PauseButton.UP_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 0, 29, 38, 29);
PauseButton.OVER_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 38, 29, 38, 29);

PauseButton.prototype.element = undefined;
PauseButton.prototype.slice = undefined;

PauseButton.prototype.onMouseEnter = function(event) {
	event.data.context.slice.set(PauseButton.OVER_ASSET_DATA);
}

PauseButton.prototype.onMouseLeave = function(event) {
	event.data.context.slice.set(PauseButton.UP_ASSET_DATA);
}

// Play Toggle

function PlayToggle() {
	this.element = $(document.createElement("span"));
	this.element.width("0px");
	this.element.height("0px");
	this.element.css("outline", "none");
	
	this.playButton = new PlayButton();
	this.pauseButton = new PauseButton();
	
	//attach/remove to load asset
	this.element.append(this.pauseButton.element);
	this.pauseButton.element.detach();
	
	this.element.append(this.playButton.element);
	
	this.playButton.element.attr("href", "#");
	this.playButton.element.bind("click", {context: this}, this.onPlayButtonClick);
	this.pauseButton.element.attr("href", "#");
	this.pauseButton.element.bind("click", {context: this}, this.onPauseButtonClick);
}

PlayToggle.prototype.element = undefined;

PlayToggle.prototype.playButton = undefined;
PlayToggle.prototype.pauseButton = undefined;

PlayToggle.prototype.getVideoPlayer = function() {
	return VideoPlayer.findVideoPlayer(this.element);
}

PlayToggle.prototype.attach = function() {
	var videoPlayer = this.getVideoPlayer();
	
	videoPlayer.video.element.bind("play", {context: this, vp: videoPlayer}, this.onVideoPlay);
	videoPlayer.video.element.bind("pause", {context: this, vp: videoPlayer}, this.onVideoPause);
	videoPlayer.video.element.bind("ended", {context: this, vp: videoPlayer}, this.onVideoEnded);
	videoPlayer.video.element.bind("playing", {context: this, vp: videoPlayer}, this.onVideoPlaying);
}

PlayToggle.prototype.onPlayButtonClick = function(event) {
	var videoPlayer = event.data.context.getVideoPlayer();
	
	videoPlayer.video.element.get(0).play();
	
	return false;
} 

PlayToggle.prototype.onPauseButtonClick = function(event) {
	var videoPlayer = event.data.context.getVideoPlayer();
	
	videoPlayer.video.element.get(0).pause();
	
	return false;
}

PlayToggle.prototype.onVideoPlay = function(event) {
	var self = event.data.context;
	
	self.playButton.element.detach();
	self.element.append(self.pauseButton.element);
	
	//hide image still when video starts playing
	var videoPlayer = event.data.vp;
	videoPlayer.imageStill.hideImageStill();
	
	//send analytics
	AnalyticsUtils.buildAndSend(AnalyticsEventType.PLAY, "", videoPlayer.config);
}

PlayToggle.prototype.onVideoPause = function(event) {
	var self = event.data.context;
	
	self.pauseButton.element.detach();
	self.element.append(self.playButton.element);
	
	var videoPlayer = event.data.vp;
	var currentTime = Math.round(videoPlayer.video.element.get(0).currentTime * 1000);	//currentTime is in seconds; needs to be in milliseconds
	
	//send analytics
	AnalyticsUtils.buildAndSend(AnalyticsEventType.PLAY_INTERRUPT_BY_PAUSE, currentTime, videoPlayer.config);
}

PlayToggle.prototype.onVideoEnded = function(event) {
	var self = event.data.context;
	
	self.pauseButton.element.detach();
	self.element.append(self.playButton.element);
				
	//send analytics
	var videoPlayer = event.data.vp;
	var currentTime = Math.round(videoPlayer.video.element.get(0).currentTime*100)/100;
	AnalyticsUtils.buildAndSend(AnalyticsEventType.PLAY_COMPLETED, currentTime, videoPlayer.config);
	
	videoPlayer.playEnded = true;
	
	//reset analytics beacons
	videoPlayer.Beacon25Sent = false;
	videoPlayer.Beacon50Sent = false;
	videoPlayer.Beacon75Sent = false;
}

PlayToggle.prototype.onVideoPlaying = function(event) {
	var self = event.data.context;
	
	self.playButton.element.detach();
	self.element.append(self.pauseButton.element);

	//send analytics
	var videoPlayer = event.data.vp;
	
	if(!videoPlayer.playInitStarted)
	{
		AnalyticsUtils.buildAndSend(AnalyticsEventType.PLAY_REQUEST_ON_NEW_MEDIA_START, "", videoPlayer.config);
		videoPlayer.playInitStarted = true;
	}
	
	if(videoPlayer.playEnded)
	{
		AnalyticsUtils.buildAndSend(AnalyticsEventType.IVP_REPLAY_BUTTON_CLICK, "", videoPlayer.config);
		videoPlayer.playEnded = false;
	}
}

// Video Scrubber

function VideoScrubber() {
	this.element = $(document.createElement("div"));
	this.element.width("100%");
	this.element.height("30px");
	this.element.css("overflowY", "hidden");
	
	// duration bar
	
	this.duration = $(document.createElement("div"));
	this.duration.width("100%");
	this.duration.css({
		position: "relative",
		top: VideoScrubber.DURATION_Y,
		overflowX: "hidden",
		cursor: "pointer"
	});
	
	var durationLeft = (new ImageSlice($(document.createElement("span")), VideoScrubber.DURATION_LEFT_ASSET_DATA)).element;
	var durationCenter = $(document.createElement("div"));
	durationCenter.width("100%");
	durationCenter.height(VideoScrubber.DURATION_HEIGHT);
	durationCenter.css({
		backgroundImage: "url(" + VideoScrubber.DURATION_CENTER_BACKGROUND_IMAGE + ")",
		backgroundRepeat: "repeat-x" 
	});
	var durationRight = (new ImageSlice($(document.createElement("span")), VideoScrubber.DURATION_RIGHT_ASSET_DATA)).element;
	
	var durationLayout = $(document.createElement("table"));
	durationLayout.attr("cellpadding", 0);
	durationLayout.attr("cellspacing", 0);
	durationLayout.width("100%");
	
	var durationRow = $(document.createElement("tr"));
	
	var durationLeftColumn = $(document.createElement("td"));
	durationLeftColumn.width("0%");
	var durationCenterColumn = $(document.createElement("td"));
	durationCenterColumn.width("100%");
	var durationRightColumn = $(document.createElement("td"));
	durationRightColumn.width("0%"); 
	
	durationLeftColumn.append(durationLeft);
	durationCenterColumn.append(durationCenter);
	durationRightColumn.append(durationRight);
	
	durationRow.append(durationLeftColumn);
	durationRow.append(durationCenterColumn);
	durationRow.append(durationRightColumn);
	
	durationLayout.append(durationRow);
	
	this.duration.append(durationLayout);
	
	// played bar
	
	this.played = $(document.createElement("div"));
	this.played.width("0%");
	this.played.css({
		position: "relative",
		top: VideoScrubber.PLAYED_Y,
		overflowX: "hidden",
		cursor: "pointer"
	});
	
	var playedLeft = (new ImageSlice($(document.createElement("span")), VideoScrubber.PLAYED_LEFT_ASSET_DATA)).element;
	var playedCenter = $(document.createElement("div"));
	playedCenter.width("100%");
	playedCenter.height(VideoScrubber.PLAYED_HEIGHT);
	playedCenter.css({
		backgroundImage: "url(" + VideoScrubber.PLAYED_CENTER_BACKGROUND_IMAGE + ")",
		backgroundRepeat: "repeat-x" 
	});
	var playedRight = (new ImageSlice($(document.createElement("span")), VideoScrubber.PLAYED_RIGHT_ASSET_DATA)).element;
	
	var playedLayout = $(document.createElement("table"));
	playedLayout.attr("cellpadding", 0);
	playedLayout.attr("cellspacing", 0);
	playedLayout.width("100%");
	
	var playedRow = $(document.createElement("tr"));
	
	var playedLeftColumn = $(document.createElement("td"));
	playedLeftColumn.width("0%");
	var playedCenterColumn = $(document.createElement("td"));
	playedCenterColumn.width("100%");
	var playedRightColumn = $(document.createElement("td"));
	playedRightColumn.width("0%"); 
	
	playedLeftColumn.append(playedLeft);
	playedCenterColumn.append(playedCenter);
	playedRightColumn.append(playedRight);
	
	playedRow.append(playedLeftColumn);
	playedRow.append(playedCenterColumn);
	playedRow.append(playedRightColumn);
	
	playedLayout.append(playedRow);
	
	this.played.append(playedLayout);
	
	// handle
	
	this.handle = (new ImageSlice($(document.createElement("span")), VideoScrubber.HANDLE_ASSET_DATA)).element;
	this.handle.css({
		position: "relative",
		top: VideoScrubber.HANDLE_Y,
		left: "0%",
		cursor: "pointer"
	});
	this.handle.hide();
	
	var handleWidth = VideoScrubber.HANDLE_ASSET_DATA.width;
	var halfHandleWidth = handleWidth / 2;
	
	var barsContainer = $(document.createElement("div"));
	barsContainer.css({
		paddingLeft: halfHandleWidth + "px",
		paddingRight: halfHandleWidth + "px"
	});
	
	var handleContainer = $(document.createElement("div"));
	handleContainer.css({
		paddingRight: handleWidth + "px"
	});
	
	barsContainer.append(this.duration);
	barsContainer.append(this.played);
	
	handleContainer.append(this.handle);
	
	this.element.append(barsContainer);
	this.element.append(handleContainer);
	
	this.element.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
	
	this.duration.bind("mousedown", {context: this}, this.onBarMouseDown);
	this.played.bind("mousedown", {context: this}, this.onBarMouseDown);
	
	this.handle.bind("mousedown", {context: this}, this.onHandleMouseDown);
}

VideoScrubber.DURATION_Y = "12px";
VideoScrubber.DURATION_HEIGHT = "6px";
VideoScrubber.DURATION_CENTER_BACKGROUND_IMAGE = Constants.ASSETS_DIR_PATH + Constants.FILE_SEPARATOR + "videoDurationCenter.gif";
VideoScrubber.DURATION_LEFT_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 83, 14, 4, 6);
VideoScrubber.DURATION_RIGHT_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 90, 14, 4, 6);

VideoScrubber.PLAYED_Y = "6px";
VideoScrubber.PLAYED_HEIGHT = "6px";
VideoScrubber.PLAYED_CENTER_BACKGROUND_IMAGE = Constants.ASSETS_DIR_PATH + Constants.FILE_SEPARATOR + "videoPlayedCenter.gif";
VideoScrubber.PLAYED_LEFT_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 83, 3, 4, 6);
VideoScrubber.PLAYED_RIGHT_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 90, 3, 4, 6);

VideoScrubber.HANDLE_Y = "-5px";
VideoScrubber.HANDLE_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 79, 23, 21, 17);
VideoScrubber.HANDLE_FADE_DURATION = 500; // milliseconds

VideoScrubber.prototype.element = undefined;
VideoScrubber.prototype.bar = undefined;
VideoScrubber.prototype.duration = undefined;
VideoScrubber.prototype.played = undefined;
VideoScrubber.prototype.handle = undefined;
VideoScrubber.prototype.seekStart = -1;
VideoScrubber.prototype.seekEnd = -1;
VideoScrubber.prototype.barMouseDownEventType = -1;

VideoScrubber.prototype.percentagePlayed = -1;

VideoScrubber.prototype.update = function() {
	var videoPlayer = this.getVideoPlayer();
	
	var currentTime = videoPlayer.video.element.get(0).currentTime;
	var duration = videoPlayer.video.element.get(0).duration;
	
	if (duration) {
		var newPercentagePlayed = parseInt((currentTime / duration) * 100);

		if (newPercentagePlayed != this.percentagePlayed) {
			this.percentagePlayed = newPercentagePlayed;
			
			this.played.width(this.percentagePlayed + "%");
			this.handle.css("left", this.percentagePlayed + "%");
		}
	} else {
		if (this.percentagePlayed != 0) {
			this.percentagePlayed = 0;
			
			this.played.width(this.percentagePlayed + "%");
			this.handle.css("left", this.percentagePlayed + "%");
		}
	}
}

VideoScrubber.prototype.getVideoPlayer = function() {
	return VideoPlayer.findVideoPlayer(this.element);
}	

VideoScrubber.prototype.attach = function() {
	this.update();
	
	var videoPlayer = this.getVideoPlayer();
	
	videoPlayer.video.element.bind("loadedmetadata", {context: this}, this.onLoadedMetadata);
	videoPlayer.video.element.bind("loadeddata", {context: this}, this.onLoadedData);
	videoPlayer.video.element.bind("timeupdate", {context: this}, this.onTimeUpdate);	
}

VideoScrubber.prototype.onLoadedMetadata = function(event) {
	event.data.context.update();
}

VideoScrubber.prototype.onLoadedData = function(event) {
	event.data.context.update();
}

VideoScrubber.prototype.onTimeUpdate = function(event) {
	event.data.context.update();	
}

VideoScrubber.prototype.onMouseEnter = function(event) {
	event.data.context.handle.fadeIn(VideoScrubber.HANDLE_FADE_DURATION);
}

VideoScrubber.prototype.onMouseLeave = function(event) {
	event.data.context.handle.fadeOut(VideoScrubber.HANDLE_FADE_DURATION);
}

VideoScrubber.prototype.onHandleMouseDown = function(event) {
	var self = event.data.context;
	var videoPlayer = self.getVideoPlayer();
	
	$(window.document).bind("mousemove", {context: self}, self.onDocumentMouseMove);
	$(window.document).bind("mouseup", {context: self, vp: videoPlayer}, self.onDocumentMouseUp);
}

VideoScrubber.prototype.onBarMouseDown = function(event) {
	var self = event.data.context;
	var videoPlayer = self.getVideoPlayer();
	
	var durationX = self.duration.offset().left;
	var durationWidth = self.duration.width();
	
	var ratio = MathUtils.constrain((event.pageX - durationX) / durationWidth, 0, 1);
	var percentage = ratio * 100;
	
	this.percentagePlayed = -1;
	
	//store start of seek point
	if(self.seekStart == -1)
		self.seekStart = (videoPlayer.video.element.get(0).currentTime / videoPlayer.video.element.get(0).duration) * 100;
	
	videoPlayer.video.element.get(0).currentTime = ratio * videoPlayer.video.element.get(0).duration;
	
	//store end of seek point
	self.seekEnd = percentage;
	
	//store analytics eventType to send in onDocumentMouseUp
	self.barMouseDownEventType = (self.seekStart <= self.seekEnd) ? AnalyticsEventType.PLAYER_SEEK_FORWARD : AnalyticsEventType.PLAYER_SEEK_BACKWARD;
	self.seekStart = -1;
	self.seekEnd = -1;
	
	self.played.width(percentage + "%");
	self.handle.css("left", percentage + "%");
	
	$(window.document).bind("mousemove", {context: self}, self.onDocumentMouseMove);
	$(window.document).bind("mouseup", {context: self, vp: videoPlayer}, self.onDocumentMouseUp);
}

VideoScrubber.prototype.onDocumentMouseMove = function(event) {
	var self = event.data.context;
	var videoPlayer = self.getVideoPlayer();
	
	var durationX = self.duration.offset().left;
	var durationWidth = self.duration.width();
	
	var ratio = MathUtils.constrain((event.pageX - durationX) / durationWidth, 0, 1);
	var percentage = ratio * 100;
	
	this.percentagePlayed = -1;
	
	//store start of seek point
	if(self.seekStart == -1)
		self.seekStart = videoPlayer.video.element.get(0).currentTime;
		
	videoPlayer.video.element.get(0).currentTime = ratio * videoPlayer.video.element.get(0).duration;
	
	//store end of seek point
	self.seekEnd = videoPlayer.video.element.get(0).currentTime;
	
	self.played.width(percentage + "%");
	self.handle.css("left", percentage + "%");	
}

VideoScrubber.prototype.onDocumentMouseUp = function(event) {
	var self = event.data.context;
	
	$(window.document).unbind("mousemove", self.onDocumentMouseMove);
	$(window.document).unbind("mouseup", self.onDocumentMouseUp);
	
	//send analytics
	var videoPlayer = event.data.vp;
	if(self.seekStart != -1 && self.seekEnd != -1)
	{
		//analytics for dragging handle
		var eventType = (self.seekStart <= self.seekEnd) ? AnalyticsEventType.PLAYER_SEEK_FORWARD : AnalyticsEventType.PLAYER_SEEK_BACKWARD;
		AnalyticsUtils.buildAndSend(eventType, "", videoPlayer.config);
	}
	else if(self.barMouseDownEventType != -1)
	{
		//analytics for clicking media bar
		AnalyticsUtils.buildAndSend(self.barMouseDownEventType, "", videoPlayer.config);
	}
	
	//reset seek info
	self.seekStart = -1;
	self.seekEnd = -1;
	self.barMouseDownEventType = -1;
}

// Time Display

function TimeDisplay() {
	this.element = $(document.createElement("span"));
	this.element.css({
		"fontFamily": TimeDisplay.FONT_FAMILY,
		"color": TimeDisplay.FONT_COLOR,
		"fontSize": TimeDisplay.FONT_SIZE
	});
}

TimeDisplay.FONT_FAMILY = Constants.DEFAULT_FONT_FAMILY;
TimeDisplay.FONT_COLOR = Constants.DEFAULT_FONT_COLOR;
TimeDisplay.FONT_SIZE = Constants.DEFAULT_FONT_SIZE;

TimeDisplay.prototype.element = undefined;

TimeDisplay.prototype.timePlayed = -1;
TimeDisplay.prototype.timeDuration = -1;

TimeDisplay.prototype.update = function() {
	var videoPlayer = this.getVideoPlayer();
	
	var currentTime = videoPlayer.video.element.get(0).currentTime;
	var duration = videoPlayer.video.element.get(0).duration;
	
	var newTimePlayed = parseInt(currentTime);
	var newTimeDuration = parseInt(duration);
	
	if (newTimePlayed != this.timePlayed || newTimeDuration != this.timeDuration) {
		this.timePlayed = newTimePlayed;
		this.timeDuration = newTimeDuration;
		var text = TimeUtils.secondsToDigitalDisplay(this.timePlayed) + 
		"/" +
		TimeUtils.secondsToDigitalDisplay(parseInt(this.timeDuration));
	
		this.element.text(text);
	}
}

TimeDisplay.prototype.getVideoPlayer = function() {
	return VideoPlayer.findVideoPlayer(this.element);
}	

TimeDisplay.prototype.attach = function() {
	this.update();
	
	var videoPlayer = this.getVideoPlayer();
	
	videoPlayer.video.element.bind("loadedmetadata", {context: this}, this.onLoadedMetadata);
	videoPlayer.video.element.bind("loadeddata", {context: this}, this.onLoadedData);
	videoPlayer.video.element.bind("timeupdate", {context: this}, this.onTimeUpdate);	
}

TimeDisplay.prototype.onLoadedMetadata = function(event) {
	event.data.context.update();
}

TimeDisplay.prototype.onLoadedData = function(event) {
	event.data.context.update();
}

TimeDisplay.prototype.onTimeUpdate = function(event) {
	event.data.context.update();	
}

// Mute Button 

function MuteButton() {	
	this.element = $(document.createElement("a"));
	this.slice = new ImageSlice(this.element, MuteButton.UP_ASSET_DATA);
	
	this.element.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
}

MuteButton.UP_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 2, 60, 36, 24);
MuteButton.OVER_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 42, 60, 36, 24);

MuteButton.prototype.element = undefined;
MuteButton.prototype.slice = undefined;

MuteButton.prototype.onMouseEnter = function(event) {
	event.data.context.slice.set(MuteButton.OVER_ASSET_DATA);
}

MuteButton.prototype.onMouseLeave = function(event) {
	event.data.context.slice.set(MuteButton.UP_ASSET_DATA);
}

// Low Volume Button 

function LowVolumeButton() {	
	this.element = $(document.createElement("a"));
	this.slice = new ImageSlice(this.element, LowVolumeButton.UP_ASSET_DATA);
	
	this.element.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
}

LowVolumeButton.UP_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 2, 86, 36, 24);
LowVolumeButton.OVER_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 42, 86, 36, 24);

LowVolumeButton.prototype.element = undefined;
LowVolumeButton.prototype.slice = undefined;

LowVolumeButton.prototype.onMouseEnter = function(event) {
	event.data.context.slice.set(LowVolumeButton.OVER_ASSET_DATA);
}

LowVolumeButton.prototype.onMouseLeave = function(event) {
	event.data.context.slice.set(LowVolumeButton.UP_ASSET_DATA);
}

// Volume Toggle

function VolumeToggle() {
	this.element = $(document.createElement("span"));
	this.element.width("0px");
	this.element.height("0px");
	this.element.css("outline", "none");
	
	this.lowVolumeButton = new LowVolumeButton();
	this.muteButton = new MuteButton();
	
	this.element.append(this.muteButton.element);
	this.muteButton.element.detach();
	
	this.element.append(this.lowVolumeButton.element);
	
	this.lowVolumeButton.element.attr("href", "#");
	this.lowVolumeButton.element.bind("click", {context: this}, this.onLowVolumeButtonClick);
	this.muteButton.element.attr("href", "#");
	this.muteButton.element.bind("click", {context: this}, this.onMuteButtonClick);
}

VolumeToggle.prototype.element = undefined;

VolumeToggle.prototype.lowVolumeButton = undefined;
VolumeToggle.prototype.muteButton = undefined;

VolumeToggle.prototype.getVideoPlayer = function() {
	return VideoPlayer.findVideoPlayer(this.element);
}

VolumeToggle.prototype.attach = function() {
	var videoPlayer = this.getVideoPlayer();
	
	videoPlayer.video.element.bind("volumechange", {context: this}, this.onVideoVolumeChange);
}

VolumeToggle.prototype.onLowVolumeButtonClick = function(event) {
	var videoPlayer = event.data.context.getVideoPlayer();
	
	videoPlayer.video.element.get(0).muted = true;
	
	//set visual volume slider to 0 value (bottom)
	videoPlayer.controls.volumeControl.volumeSlider.muteProgressBar();
	
	return false;
} 

VolumeToggle.prototype.onMuteButtonClick = function(event) {
	var videoPlayer = event.data.context.getVideoPlayer();	
	videoPlayer.video.element.get(0).muted = false;
	
	//before visually resetting the vol slider, check if pre-mute state was vol = 0	
	if(!videoPlayer.controls.volumeControl.volumeSlider.isMutedBySlider)
		videoPlayer.controls.volumeControl.volumeSlider.unmuteProgressBar();	//reset visual volume slider
	
	return false;
}

VolumeToggle.prototype.onVideoVolumeChange = function(event) {
	var self = event.data.context;
	var videoPlayer = self.getVideoPlayer();
	
	if (videoPlayer.video.element.get(0).muted) {
		self.lowVolumeButton.element.detach();
		self.element.append(self.muteButton.element);
	} else {
		self.muteButton.element.detach();
		self.element.append(self.lowVolumeButton.element);
	}
}

// Volume Slider

function VolumeSlider() {
	this.element = $(document.createElement("div"));
	this.element.width(VolumeSlider.WIDTH);
	//this.element.css("overflowY", "hidden");
	this.element.attr('id','volSlider');
	
	var topBackgroundSlice = new ImageSlice($(document.createElement("span")), VolumeSlider.TOP_BACKGROUND_ASSET_DATA);
	
	var layout = $(document.createElement("table"));
	layout.width(VolumeSlider.WIDTH);
	layout.attr("cellpadding", 0);
	layout.attr("cellspacing", 0);
	layout.attr("border", 0);
	
	var trTop = $(document.createElement("tr"));
	var trCenter = $(document.createElement("tr"));
	
	var tdTop = $(document.createElement("td"));
	
	var tdCenter = $(document.createElement("td"));
	tdCenter.css("backgroundImage", "url(" + VolumeSlider.CENTER_BACKGROUND_IMAGE + ")");
	tdCenter.css("backgroundRepeat", "repeat-y");
	tdCenter.css("backgroundPosition", "top");
	tdCenter.height("93px");
	tdCenter.attr('valign','top');

	tdTop.append(topBackgroundSlice.element);
	
	trTop.append(tdTop);
	trCenter.append(tdCenter);
	
	layout.append(trTop);
	layout.append(trCenter);
	
	this.element.append(layout);
	
	//create volume slider
	this.slider = $(document.createElement("div"));
	this.progressBar = $(document.createElement("div"));
	this.handle = $(document.createElement("a"));
	
	tdCenter.append(this.slider);
	this.slider.append(this.progressBar);
	this.slider.append(this.handle);
	
	this.setSliderCSS();
	this.setProgressBarCSS();	
	this.setHandleCSS();
		
	this.slider.bind("mousedown", {context: this}, this.onMouseDown);	
	this.progressBar.bind("mousedown", {context: this}, this.onMouseDown);
	this.slider.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.slider.bind("mouseleave", {context: this}, this.onMouseLeave);	
	
	//set to default start-up volume
	this.setSliderPositionToVolume(VideoPlayer.DEFAULT_VOLUME);
}

VolumeSlider.prototype.setSliderPositionToVolume = function (volume) {
	var scrubberHeight = VolumeSlider.SLIDER_HEIGHT;
	var newHeight = volume * scrubberHeight;
	var newTop = scrubberHeight - newHeight;
		
	//update bar and handle position
	this.progressBar.css({'top': newTop + 'px'});
	this.progressBar.height(newHeight);
	this.handle.css({'top': (parseInt(newTop) - 7.5) + 'px'});
}

VolumeSlider.prototype.updateProgressBarPosition = function (event) {	
	var self = event.data.context;

	var maxVolumeY = self.slider.offset().top;
	var minVolumeY = self.slider.offset().top + self.slider.height();
	
	//progress bar only changes within range of slider
	if(maxVolumeY < event.pageY && minVolumeY > event.pageY)
	{
		self.isMutedBySlider = false;
		this.unmuteProgressBar();
		
		var barChange = event.pageY - self.progressBar.offset().top;
		var fullDistance = self.slider.height();
		
		var currentTop = self.progressBar.css('top').substr(0, self.progressBar.css('top').length - 2);
		var newTop = parseInt(currentTop) + parseInt(barChange);		
		var newHeight = self.progressBar.height() - parseInt(barChange);
		
		//update bar position
		self.progressBar.css({'top': newTop + 'px'});
		self.progressBar.height(newHeight);		
	
		var newVolume = Math.round((newHeight/fullDistance)*100)/100;
		self.setVolume(newVolume);
	}
	//mouse above max volume slider: set to max
	else if(maxVolumeY > event.pageY)
	{
		self.isMutedBySlider = false;
		this.unmuteProgressBar();
		
		self.progressBar.css({'top': 0 + 'px'});
		self.progressBar.height(self.slider.height());
		self.setVolume(1);
	}
	//mouse below min volume slider: set to min
	else if(minVolumeY < event.pageY)
	{
		self.isMutedBySlider = true;
		self.muteProgressBar();
		self.setVolume(0);
	}
}

VolumeSlider.prototype.updateHandlePosition = function (event) {
	var self = event.data.context;
		
	var maxHandleY = self.slider.offset().top;
	var minHandleY = self.slider.offset().top + self.slider.height();
	
	//handle slides only within progress bar
	if(maxHandleY < event.pageY && minHandleY > event.pageY)
	{		
		var currentTop = self.handle.css('top').substr(0, self.handle.css('top').length - 2);
		var newTop = parseInt(currentTop) + parseInt(event.pageY - self.handle.offset().top) - 7.5;
		this.handleResetTop = newTop;	//store reset position to come back from MUTING
		self.handle.css({'top': newTop + 'px'});
	}
}	

VolumeSlider.prototype.muteProgressBar = function () {
	this.handleResetTop = this.handle.css('top').substr(0, this.handle.css('top').length - 2);
	this.handle.css({'top': (VolumeSlider.SLIDER_HEIGHT - 7.5) + 'px'});
	
	this.progressBar.css('display','none');
	this.isMuted = true;
}

VolumeSlider.prototype.unmuteProgressBar = function () {
	this.handle.css({'top': this.handleResetTop + 'px'});
	
	this.progressBar.css('display','block');
	this.isMuted = false;
}

VolumeSlider.prototype.setSliderCSS = function () {
	this.slider.addClass('ui-slider');
	this.slider.width(2);
	this.slider.height(VolumeSlider.SLIDER_HEIGHT);
	this.slider.css({
		'position':'relative',
		'background-color':'#FFFFFF', 'border':'1px solid #FFFFFF',
		'-moz-border-radius':'4px 4px 4px 4px', '-webkit-border-radius':'4px', 'border-radius':'4px',
		'background-position':'0 0',
		'top':'5px', 'left':'14px', 'cursor':'pointer', 'z-index':'1'
	});
}

VolumeSlider.prototype.setHandleCSS = function () {
	this.handle.addClass('ui-slider-handle');
	this.handle.height(15);
	this.handle.width(10);
	this.handle.css({
		'left':'-5px', 'top':'-3px', 'margin-bottom':'-6px', 'bottom':'0', 
		'cursor':'pointer', 'display':'none',
		'-moz-border-radius':'4px', '-webkit-border-radius':'4px', 'border-radius':'4px',
		'position':'absolute', 'z-index':'2', 'margin-left':'0',
		'background':'none repeat scroll 0 0 #DADADA',
		'border':'1px solid #999999'
	});
}

VolumeSlider.prototype.setProgressBarCSS = function () {	
	this.progressBar.addClass('ui-slider-range');
	this.progressBar.width(2);
	this.progressBar.height(VolumeSlider.SLIDER_HEIGHT);
	this.progressBar.css({
		'position':'absolute',
		'background-color':'#2f83d9',
		'border':'1px solid #2f83d9',
		'-moz-border-radius':'4px 4px 4px 4px', '-webkit-border-radius':'4px', 'border-radius':'4px',
		'top':'0px', 'left':'-1px',
		'cursor':'pointer',
		'background-position':'0 0',
		'display':'block',
		'z-index':'1'
	});
}

VolumeSlider.prototype.setVolume = function (volume) {
	var videoPlayer = this.getVideoPlayer();
	videoPlayer.video.element.get(0).volume = volume;
}

VolumeSlider.prototype.onMouseEnter = function (event) {
	self = event.data.context;
	$(self.handle).fadeIn(VolumeSlider.HANDLE_FADE_SPEED);
}

VolumeSlider.prototype.onMouseLeave = function (event) {
	self = event.data.context;
	$(self.handle).fadeOut(VolumeSlider.HANDLE_FADE_SPEED);
}

VolumeSlider.prototype.onMouseDown = function (event) {
	self = event.data.context;
	
	self.updateHandlePosition(event);
	self.updateProgressBarPosition(event);
	
	//remove mouse leave functionality so handle doesn't disappear
	self.slider.unbind('mouseleave');
	
	$(window.document).bind("mousemove", {context: self}, self.onDocumentMouseMove);
	$(window.document).bind("mouseup", {context: self}, self.onDocumentMouseUp);		
	
	//prevent volume slider from hiding after clicking down on the volume handle
	var videoPlayer = self.getVideoPlayer();
	videoPlayer.controls.volumeControl.element.unbind("mouseleave");	
}

VolumeSlider.prototype.onDocumentMouseMove = function (event) {
	self = event.data.context;
	self.updateHandlePosition(event);
	self.updateProgressBarPosition(event);
}

VolumeSlider.prototype.onDocumentMouseUp = function (event) {
	self = event.data.context;
	
	$(window.document).unbind("mousemove", self.onDocumentMouseMove);
	$(window.document).unbind("mouseup", self.onDocumentMouseUp);
	
	var volumeControl = self.getVideoPlayer().controls.volumeControl;
	
	//add back the event listeners for mouse leaving the volume scrubber and entire volume container
	$(self.slider).bind('mouseleave', {context: self}, self.onMouseLeave);
	volumeControl.element.bind("mouseleave", {context: volumeControl}, volumeControl.onMouseLeave);
	
	//keep showing the handle/container only if mouse up was done inside slider/handle
	if(!VolumeSlider.isMouseUpWithinVolumeSlider(event.target))
	{
		$(self.handle).fadeOut(VolumeSlider.HANDLE_FADE_SPEED);		
		volumeControl.hideVolumeSlider();
	}
}

VolumeSlider.isMouseUpWithinVolumeSlider = function (target) {
	if($(target).hasClass('ui-slider-handle') 
		|| $(target).hasClass('ui-slider') 
		|| $(target).hasClass('ui-slider-range')
	)
		return true;
		
	return false;
}

VolumeSlider.prototype.getVideoPlayer = function() {
	return VideoPlayer.findVideoPlayer(this.element);
}

VolumeSlider.WIDTH = "33px";
VolumeSlider.MAX_HEIGHT_SCALAR = 100;
VolumeSlider.HANDLE_FADE_SPEED = 500;
VolumeSlider.SLIDER_HEIGHT = 75;

VolumeSlider.CENTER_BACKGROUND_IMAGE = Constants.ASSETS_DIR_PATH + Constants.FILE_SEPARATOR + "volumeSliderBackgroundCenter.png";
VolumeSlider.TOP_BACKGROUND_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 79, 41, 33, 7);

VolumeSlider.prototype.element = undefined;
VolumeSlider.prototype.jSlider = undefined;
VolumeSlider.prototype.handle = undefined;
VolumeSlider.prototype.progressBar = undefined;
VolumeSlider.prototype.slider = undefined;
VolumeSlider.prototype.isMuted = false;
VolumeSlider.prototype.isMutedBySlider = false;
VolumeSlider.prototype.handleResetTop = undefined;

// Volume Control

function VolumeControl() {
	this.element = $(document.createElement("div"));
	this.element.height(VolumeControl.HEIGHT);
	
	this.volumeToggle = new VolumeToggle();
	
	this.volumeSlider = new VolumeSlider();
	this.volumeSlider.element.css("left", VolumeControl.VOLUME_SLIDER_LEFT);
	this.volumeSlider.element.hide();

	this.element.append(this.volumeToggle.element);
	this.element.append(this.volumeSlider.element);
	
	this.element.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
}

VolumeControl.HEIGHT_SCALAR = 24;
VolumeControl.HEIGHT = VolumeControl.HEIGHT_SCALAR + "px";
VolumeControl.VOLUME_SLIDER_LEFT = "3px";

VolumeControl.VOLUME_SLIDER_INTERVAL = 30;
VolumeControl.VOLUME_SLIDER_INCREMENT = .15;

VolumeControl.VOLUME_SLIDER_UP = true;
VolumeControl.VOLUME_SLIDER_DOWN = false;

VolumeControl.prototype.element = undefined;
VolumeControl.prototype.volumeToggle = undefined;
VolumeControl.prototype.volumeSlider = undefined;
VolumeControl.prototype.isVolumeSliderShowing = false; 

VolumeControl.prototype.getVolumeSliderPosition = function() {
	var top = parseFloat(this.volumeSlider.element.css("top"));
	top = isNaN(top) ? 0 : top;
	
	var position = MathUtils.constrain((-top + 1 - VolumeControl.HEIGHT_SCALAR) / VolumeSlider.MAX_HEIGHT_SCALAR, 0, 1);
	
	return position;
}

VolumeControl.prototype.attach = function() {
	this.volumeToggle.attach();
}

VolumeControl.prototype.showVolumeSlider = function() {
	if(!this.isVolumeSliderShowing)
	{
		this.isVolumeSliderShowing = true;
		this.volumeSlider.element.css({'margin-top':'-23px','height':'0','position':'relative'});
	
		$(this.volumeSlider.element).show();
		$(this.volumeSlider.element).animate({marginTop: '-123px', height: '100px'}, 600);
	}
}

VolumeControl.prototype.hideVolumeSlider = function() {
	if(this.isVolumeSliderShowing)
	{
		this.isVolumeSliderShowing = false;
		
		$(this.volumeSlider.element).animate({marginTop: '-23px', height: '0px'}, 600, function() {
			$(this).hide();
		});
	}
}

VolumeControl.prototype.onMouseEnter = function(event) {
	self = event.data.context;	
	self.showVolumeSlider();
}

VolumeControl.prototype.onMouseLeave = function(event) {
	self = event.data.context;	
	self.hideVolumeSlider();
}

// Fullscreen Button 

function FullscreenButton() {	
	this.element = $(document.createElement("a"));
	this.slice = new ImageSlice(this.element, FullscreenButton.UP_ASSET_DATA);
	
	this.element.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
	
	this.element.attr("href", "#");
	this.element.bind("click", {context: this}, this.onClick);
}

FullscreenButton.UP_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 2, 163, 35, 24);
FullscreenButton.OVER_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 42, 163, 35, 24);

FullscreenButton.prototype.element = undefined;
FullscreenButton.prototype.slice = undefined;

FullscreenButton.prototype.onMouseEnter = function(event) {
	event.data.context.slice.set(FullscreenButton.OVER_ASSET_DATA);
}

FullscreenButton.prototype.onMouseLeave = function(event) {
	event.data.context.slice.set(FullscreenButton.UP_ASSET_DATA);
}

FullscreenButton.prototype.onClick = function(event) {
	var videoPlayer = event.data.context.getVideoPlayer();
	
	return false;
}

// Menu Button
function MenuButton () {
	//this.videoMenu = new VideoMenu();

	this.element = $(document.createElement("table"));
	this.slice = new ImageSlice($(document.createElement("span")), MenuButton.BUTTON_RIGHT_ASSET_DATA);

	var tr = $(document.createElement("tr"));
	this.textField = $(document.createElement("td"));
	var td2 = $(document.createElement("td"));
	
	td2.append(this.slice.element);	//add closing right image
	
	tr.append(this.textField);	//add text cell to table row
	tr.append(td2);	//add closing right image cell to table row
	this.element.append(tr);	//add table row to table	
	
	this.textField.css({
		"padding": "0px 1px 0px 5px", 
		"fontWeight": "bold", 
		"color": MenuButton.FONT_COLOR,
		"fontFamily": MenuButton.FONT_FAMILY, 
		"fontSize": MenuButton.FONT_SIZE, 
		"whiteSpace": "nowrap"
	});
	
	this.element.attr("cellpadding", 0);
	this.element.attr("cellspacing", 0);
	this.element.attr("border", 0);
	this.textField.css("backgroundImage", "url(" + Controls.MENU_BUTTON_IMAGE + ")");
	this.textField.css("backgroundRepeat", "repeat-x");
	this.element.css({"cursor":"pointer"});	
	
	this.element.bind("click", {context: this}, this.onClick);
	this.element.bind("mouseenter", {context: this}, this.onMouseEnter);
	this.element.bind("mouseleave", {context: this}, this.onMouseLeave);
}

MenuButton.FONT_FAMILY = Constants.DEFAULT_FONT_FAMILY;
MenuButton.FONT_COLOR = Constants.DEFAULT_FONT_COLOR;
MenuButton.FONT_SIZE = Constants.DEFAULT_FONT_SIZE;

MenuButton.FONT_COLOR_OVER = "#2f83d9";

MenuButton.BUTTON_RIGHT_ASSET_DATA = new ImageSliceData(Config.ASSETS_PATH, 82, 164, 5, 23);

MenuButton.prototype.videoMenu = undefined;
MenuButton.prototype.element = undefined;
MenuButton.prototype.textField = undefined;
MenuButton.prototype.slice = undefined;
MenuButton.prototype.resumePlayback = false;

MenuButton.prototype.getVideoPlayer = function() {
	return VideoPlayer.findVideoPlayer(this.element);
}

MenuButton.prototype.attach = function() {
	var videoPlayer = this.getVideoPlayer();
	
	this.textField.text(videoPlayer.localization.MENU);
	
	videoPlayer.video.element.bind("play", {context: this}, this.onVideoPlay);
	videoPlayer.video.element.bind("ended", {context: this}, this.onVideoEnded);
	videoPlayer.video.element.bind("playing", {context: this}, this.onVideoPlaying);
}

MenuButton.prototype.onMouseEnter = function(event) {
	event.data.context.textField.css("color", MenuButton.FONT_COLOR_OVER);
}

MenuButton.prototype.onMouseLeave = function(event) {
	event.data.context.textField.css("color", MenuButton.FONT_COLOR);
}

MenuButton.prototype.onClick = function(event) {
	var self = event.data.context;
	var videoPlayer = self.getVideoPlayer();
	
	if (self.videoMenu.isShowing) {
		self.videoMenu.hideMenu();
	
		//resume playback if video was playing before menu was displayed	
		if(self.resumePlayback)
			videoPlayer.video.element.get(0).play();
			
		//send analytics
		AnalyticsUtils.buildAndSend(AnalyticsEventType.IVP_PLAYER_MENU_PANE_CLOSE_BUTTON_CLICKED, "", videoPlayer.config);
	} else {
		//store current state of video play (used to determine resuming of video when menu is hidden
		self.resumePlayback = !videoPlayer.video.element.get(0).paused;
		videoPlayer.video.element.get(0).pause();
		
		self.videoMenu.showMenu(videoPlayer);	

		//send analytics
		AnalyticsUtils.buildAndSend(AnalyticsEventType.IVP_PLAYER_MENU_PANE_OPEN_BUTTON_CLICKED, "", videoPlayer.config);
	}
}

MenuButton.prototype.onVideoPlay = function(event) {
	var self = event.data.context;
	
	if (self.videoMenu.isShowing) {
		self.videoMenu.hideMenu();
	}
}

MenuButton.prototype.onVideoEnded = function(event) {
	var self = event.data.context;
	var videoPlayer = self.getVideoPlayer();
	
	if (!self.videoMenu.isShowing) {
		self.videoMenu.showMenu(videoPlayer);
	}
}

MenuButton.prototype.onVideoPlaying = function(event) {
	var self = event.data.context;

	if (self.videoMenu.isShowing) {
		self.videoMenu.hideMenu();
	}
}

// Image Slice - display slice of part of an image

function ImageSlice(element, data) {
	this.element = element;
	
	if (data) {
		this.set(data);
	}
}

ImageSlice.prototype.element = undefined; // image slice html element

ImageSlice.prototype.set = function(data) {
	this.element.css("display", "block");
	this.element.css("overflow", "hidden");
	this.element.width(data.width + "px");
	this.element.height(data.height + "px");
	this.element.css("backgroundPosition", "-" + data.x + "px" + " " + "-" + data.y + "px");
	this.element.css("backgroundImage", "url(" + data.url + ")");
	this.element.css("outline", "none");
}

// Image Slice Data - image slice initialization data

function ImageSliceData(url, x, y, width, height) {
	this.url = url;
	this.x = x;
	this.y = y;
	this.width = width;
	this.height = height;
}

ImageSliceData.prototype.url = undefined;
ImageSliceData.prototype.x = undefined;
ImageSliceData.prototype.y = undefined;
ImageSliceData.prototype.width = undefined;
ImageSliceData.prototype.height = undefined;

///////////////
// UTILITIES //
///////////////

// Function Utilities - utility functions used for functions

function FunctionUtils() {}

// empty function
FunctionUtils.nothing = function() {}

// Math Utilities -  utility functions used for math

function MathUtils() {}

// constrain to a range
MathUtils.constrain = function(value, min, max) {
	min = typeof(min) != 'undefined' ? min : 0;
	max = typeof(max) != 'undefined' ? max : 1;
	
	value = (value > min) ? value : min;
	value = (value < max) ? value : max;
	
	return value;
}

MathUtils.zeroFill = function(number, digits) {
	var matches = number.toFixed(0).match(/\d/g);
	var length = matches ? matches.length : 0;
	
	var prefix = "";
	if (length < digits) {  
		var diff = digits - length;
		for (var i = 0; i < diff; i++) { prefix += "0"; }
	}
	return prefix + String(number);	
}

// Time Utilities - utility functions used for time

function TimeUtils() {}

TimeUtils.secondsToDigitalDisplay = function(seconds) {
	if (isNaN(seconds)) {
		seconds = 0;
	}
	
	// convert seconds to absolute value to avoid uint conversion error
	if (seconds < 0) {
		seconds *= -1;
	}
			
	var showHours = Boolean(seconds >= 3600);	
	if (showHours) {
		return  parseInt(seconds / 3600)
			+ ":" + MathUtils.zeroFill(parseInt((seconds % 3600) / 60), 2) 
			+ ":" + MathUtils.zeroFill(parseInt(seconds % 60), 2);
	} else {
		return MathUtils.zeroFill(parseInt(seconds / 60), 2) + ":" + MathUtils.zeroFill(parseInt(seconds % 60), 2);
	} 
}

//STRING UTILS
function StringUtils () {}

StringUtils.CleanString = function (val) {
	return StringUtils.ReplaceAll($.trim(val,"\n",""));
}

StringUtils.ReplaceAll = function (Source,stringToFind,stringToReplace){
	var temp = Source;
    var index = temp.indexOf(stringToFind);

    while(index != -1){
        temp = temp.replace(stringToFind,stringToReplace);
        index = temp.indexOf(stringToFind);
    }

    return temp;
}

StringUtils.ReplaceEncodedChars = function(inStr) {
	//replace encoded quotes
	var pattern = /&#39;/g; 
	var outStr = inStr.replace(pattern,"'");	
	pattern = /&quot;/g;  
	outStr = outStr.replace(pattern,"\"");
	pattern = /&#035;/g;  
	outStr = outStr.replace(pattern,"#");
	pattern = /&rsquo;/g;  
	outStr = outStr.replace(pattern,"'");
	pattern = /&lsquo;/g;  
	outStr = outStr.replace(pattern,"'");
	pattern = /&amp;/g;  
	outStr = outStr.replace(pattern,"&");
	pattern = /%3F/g;  
	outStr = outStr.replace(pattern,"?");
	pattern = /%26/g;  
	outStr = outStr.replace(pattern,"&");
	pattern = /&#092;/g;  
	outStr = outStr.replace(pattern,"\\");
	pattern = /&#92;/g;  
	outStr = outStr.replace(pattern,"\\");
	pattern = /&#34;/g;
	outStr = outStr.replace(pattern,"\"");
	pattern = /&#38;/g;
	outStr = outStr.replace(pattern,"&");

	return outStr;			
}

//ANALYTICS UTILS

function AnalyticsUtils () {}

AnalyticsUtils.buildAndSend = function (eventType, eventValue, configObj) {	
	var packet = AnalyticsUtils.buildPacket(eventType, eventValue, configObj);
	var dsid = (eventType == AnalyticsEventType.PLAYER_LOADED) ? AnalyticsEventType.DSID_PLAYER_LOADED : AnalyticsEventType.DSID_PLAYER_GENERIC;
		
	if(configObj.ssprod)
		AnalyticsUtils.send(packet, dsid);
}

AnalyticsUtils.buildPacket = function (eventType, eventValue, configObj) {
	var packet = "";
	var date = new Date();	
	
	if(eventType == AnalyticsEventType.PLAYER_LOADED)
	{
		packet += "evt=" + eventType + "&";
		packet += "ct=" + date.getTime() + "&";
		packet += "mpguid=" + configObj.mpguid + "&";
		packet += "pid=" + configObj.pid + "&";
		packet += "uid=" + configObj.uid + "&";
		packet += "pc=" + configObj.pc + "&";
		packet += "refpg=" + encodeURIComponent(configObj.refpg) + "&";
		packet += "plrid=" + configObj.plrid + "&";
		packet += "pver=" + configObj.pver + "&";
		packet += "pskin=" + configObj.pskin + "&";
		packet += "srchid=" + configObj.srchid + "&"; // Search ID
		packet += "cip=" + configObj.cip + "&";
		packet += "sip=" + configObj.sip + "&";
		packet += "prid=" + configObj.prid + "&";
		packet += "prtype=" + configObj.prtype + "&";
		packet += "ili=" + configObj.ili + "&";
		packet += "pf=" + configObj.pf + "&";
		packet += "seq=" + configObj.seq++;
	}
	else
	{
		packet += "evt=" + eventType + "&";
		packet += "evalu=" + eventValue + "&";
		packet += "ct=" + date.getTime() + "&";
		packet += "mpguid=" + configObj.mpguid + "&";
		packet += "pid=" + configObj.pid + "&";
		packet += "useid=" +  configObj.useid + "&";
		packet += "cid=" + configObj.mediaId + "&";
		packet += "plid=" + configObj.plid + "&";
		packet += "seq=" + configObj.seq++;
	}
	
	return packet;
}

AnalyticsUtils.send = function (packet, dsid) {
	var url = Constants.BEACON_URL + "dsid=" + dsid + "&dsv=1&b=" + encodeURIComponent(Base64.encode(packet));

	var beaconAjaxP = document.createElement('img');
	beaconAjaxP.src = url;

	//$("body").append(beaconAjaxP);
}


///// 64 ENCODE
var Base64 = {
 
	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
 
	// public method for encoding
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;
 
		input = Base64._utf8_encode(input);
 
		while (i < input.length) {
 
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);
 
			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;
 
			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}
 
			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
 
		}
 
		return output;
	},
 
	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
 
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
 
		while (i < input.length) {
 
			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));
 
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
 
			output = output + String.fromCharCode(chr1);
 
			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}
 
		}
 
		output = Base64._utf8_decode(output);
 
		return output;
 
	},
 
	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	},
 
	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}
 
}