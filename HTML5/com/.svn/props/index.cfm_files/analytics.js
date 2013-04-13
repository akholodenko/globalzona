// Constants - global constants

function Constants() {}

Constants.BEACON_URL = "http://b.myspace.com/~myspace/beacon/b.ashx?";

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

function VideoPlayerData() {}

VideoPlayerData.prototype.sources = {};
VideoPlayerData.prototype.videoTagID = undefined;
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
VideoPlayerData.prototype.width = undefined;
VideoPlayerData.prototype.height = undefined;
VideoPlayerData.prototype.playerType = undefined;

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

Config.prototype.videoTagID = undefined;
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
Config.prototype.playerType = undefined;	//video tag, iframe, or embed
	
Config.prototype.mediaId = undefined;

function HTML5VideoPlayerAnalytics(data) {
	this.videoTagID = data.videoTagID;
	this.setConfig(data);	
	
	//add event listeners
	$('#' + this.videoTagID).bind("timeupdate", {context: this}, this.onTimeUpdate);
	$('#' + this.videoTagID).bind("play", {context: this}, this.onVideoPlay);
	$('#' + this.videoTagID).bind("playing", {context: this}, this.onVideoPlaying);
	$('#' + this.videoTagID).bind("pause", {context: this}, this.onVideoPause);
	$('#' + this.videoTagID).bind("ended", {context: this}, this.onVideoEnded);	
	$('#' + this.videoTagID).bind("seeking", {context: this}, this.onSeeking);
	$('#' + this.videoTagID).bind("seeked", {context: this}, this.onSeeked);
	$('#' + this.videoTagID).bind("mouseup", {context: this}, this.onMouseUp);
	$('#' + this.videoTagID).bind("mousedown", {context: this}, this.onMouseDown);
		
	AnalyticsUtils.buildAndSend(AnalyticsEventType.PLAYER_LOADED, "", this.config);
}

HTML5VideoPlayerAnalytics.prototype.onMouseDown = function(event){
	var self = event.data.context;	
	self.seekStartTime = -1;	//clear previous seeking data
	self.isMouseDown = true;
}

HTML5VideoPlayerAnalytics.prototype.onMouseUp = function(event){
	var self = event.data.context;	
	self.isMouseDown = false;
	
	if(self.isSeeking)
	{
		self.isSeeking = false;
		
		//send analytics		
		var eventType = (self.seekStartTime <= self.seekEndTime) ? AnalyticsEventType.PLAYER_SEEK_FORWARD : AnalyticsEventType.PLAYER_SEEK_BACKWARD;
		AnalyticsUtils.buildAndSend(eventType, "", self.config);
	}	
			
	self.seekStartTime = -1;
	self.seekEndTime = -1;	
}

HTML5VideoPlayerAnalytics.prototype.onSeeking = function(event){
	var self = event.data.context;
	self.isSeeking = true;
	
	if(self.seekStartTime == -1)
		self.seekStartTime = $('#' + self.videoTagID).get(0).currentTime;
}

HTML5VideoPlayerAnalytics.prototype.onSeeked = function(event){
	var self = event.data.context;
	self.seekEndTime = $('#' + self.videoTagID).get(0).currentTime;	
}

HTML5VideoPlayerAnalytics.prototype.onTimeUpdate = function(event) {
	var self = event.data.context;
	
	if(!$('#' + self.videoTagID).get(0).paused)
	{
		var currentPercentCompletion = ($('#' + self.videoTagID).get(0).currentTime/$('#' + self.videoTagID).get(0).duration) * 100;
		
		//send 25% analytic beacon
		if(currentPercentCompletion >= 25 && currentPercentCompletion < 26 && !self.Beacon25Sent)
		{
			AnalyticsUtils.buildAndSend(AnalyticsEventType.TWENTY_FIVE_PLAY_COMPLETE, "", self.config);
			self.Beacon25Sent = true;
		}
		
		//send 50% analytic beacon
		if(currentPercentCompletion >= 50 && currentPercentCompletion < 51 && !self.Beacon50Sent)
		{
			AnalyticsUtils.buildAndSend(AnalyticsEventType.FIFTY_PLAY_COMPLETE, "", self.config);
			self.Beacon50Sent = true;
		}
		
		//send 75% analytic beacon
		if(currentPercentCompletion >= 75 && currentPercentCompletion < 76 && !self.Beacon75Sent)
		{
			AnalyticsUtils.buildAndSend(AnalyticsEventType.SEVENTY_FIVE_PLAY_COMPLETE, "", self.config);
			self.Beacon75Sent = true;
		}
	}
}

HTML5VideoPlayerAnalytics.prototype.onVideoEnded = function(event) {
	var self = event.data.context;

	//send analytics
	var currentTime = Math.round($('#' + self.videoTagID).get(0).currentTime*100)/100;
	AnalyticsUtils.buildAndSend(AnalyticsEventType.PLAY_COMPLETED, currentTime, self.config);
	
	self.playEnded = true;
	
	//reset analytics beacons
	self.Beacon25Sent = false;
	self.Beacon50Sent = false;
	self.Beacon75Sent = false;
}

HTML5VideoPlayerAnalytics.prototype.onVideoPause = function(event) {
	var self = event.data.context;
	var currentTime = Math.round($('#' + self.videoTagID).get(0).currentTime * 1000);	//currentTime is in seconds; needs to be in milliseconds

	//send analytics
	AnalyticsUtils.buildAndSend(AnalyticsEventType.PLAY_INTERRUPT_BY_PAUSE, currentTime, self.config);
}

HTML5VideoPlayerAnalytics.prototype.onVideoPlay = function(event) {
	var self = event.data.context;
	
	//send analytics
	AnalyticsUtils.buildAndSend(AnalyticsEventType.PLAY, "", self.config);
}

HTML5VideoPlayerAnalytics.prototype.onVideoPlaying = function(event) {
	var self = event.data.context;
	
	//send analytics	
	if(!self.playInitStarted)
	{
		AnalyticsUtils.buildAndSend(AnalyticsEventType.PLAY_REQUEST_ON_NEW_MEDIA_START, "", self.config);
		self.playInitStarted = true;
	}
	
	if(self.playEnded)
	{
		AnalyticsUtils.buildAndSend(AnalyticsEventType.IVP_REPLAY_BUTTON_CLICK, "", self.config);
		self.playEnded = false;
	}
}

HTML5VideoPlayerAnalytics.prototype.setConfig = function(data) {
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
	
	this.config.playerType = data.playerType;
	
	//content usage type id (auto play = 1, manual play = 2)
	if(data.autoplay)
		this.config.useid = 1;	
	else
		this.config.useid = 2;	
}

HTML5VideoPlayerAnalytics.prototype.config = new Config(); // video player configuration
HTML5VideoPlayerAnalytics.prototype.playInitStarted = false;
HTML5VideoPlayerAnalytics.prototype.playEnded = false;
HTML5VideoPlayerAnalytics.prototype.isMouseDown = false;
HTML5VideoPlayerAnalytics.prototype.isSeeking = false;
HTML5VideoPlayerAnalytics.prototype.seekStartTime = -1;
HTML5VideoPlayerAnalytics.prototype.seekEndTime = -1;
HTML5VideoPlayerAnalytics.prototype.Beacon25Sent = false;	//flag for 25% analytic beacon
HTML5VideoPlayerAnalytics.prototype.Beacon50Sent = false;	//flag for 50% analytic beacon
HTML5VideoPlayerAnalytics.prototype.Beacon75Sent = false;	//flag for 75% analytic beacon


// Debug

function Debug() {}

Debug.out = function(value) {
	window.console.log(value);
}

Debug.log = function() {
	var args = [].splice.call(arguments, 0);
	window.console.log(args.join(" "));
}

//ANALYTICS UTILS

function AnalyticsUtils () {}

AnalyticsUtils.buildAndSend = function (eventType, eventValue, configObj) {	
	var packet = AnalyticsUtils.buildPacket(eventType, eventValue, configObj);
	var dsid = (eventType == AnalyticsEventType.PLAYER_LOADED) ? AnalyticsEventType.DSID_PLAYER_LOADED : AnalyticsEventType.DSID_PLAYER_GENERIC;
		
	if(configObj.ssprod)
		AnalyticsUtils.send(packet, dsid);
	/*
	else
		Debug.out(packet);
		* */
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