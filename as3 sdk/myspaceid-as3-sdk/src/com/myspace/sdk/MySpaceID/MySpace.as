package com.myspace.sdk.MySpaceID
{
	import com.myspace.sdk.Utils.ObjectUtils;
	import com.myspace.sdk.Utils.URLEncoding;
	import com.myspace.sdk.oAuth.*;
	
	import flash.display.Sprite;
	import flash.errors.*;
	import flash.events.*;
	import flash.net.*;
	import flash.utils.ByteArray;

	/**
	 * The MySpace class provides a set of APIs to get and set various user data.
	 * 
	 * GET APIs require a "responseCallback" function, written by the user to be called upon
	 * successful retrieval of data. Expected input parameters for the user-written callback
	 * functions are stated in the description of each API.  
	 * 
	 * Certain APIs are not accesible without special access privileges given to the application
	 * 
	 */
	public class MySpace extends Sprite
	{	
		private var _key:String;
		private var _secret:String;
		private var _urlLoader:URLLoader;
		
		private var _oAuthConsumer:OAuthConsumer;
		private var _oAuthRequest:OAuthRequest;
		private var _oAuthAccessToken:OAuthToken = null;
		
		private var _responseCallback:Function;
		private var _responseCallbackObject:Object = new Object();
		private var _isApplicationOffSite:Boolean = false;
		
		private var _timeZone:int;
		private var _dateFormat:String = "";
		
		private var _xml_ns:Namespace = new Namespace("api-v1.myspace.com");
		private var _contentType_URLEncoded:String = "application/x-www-form-urlencoded";
		private var _contentType_JSON:String = "application/json";
		
		/**
		 * Constructor Class
		 * 
		 * @param consumerKey key assigned to the developer's application
		 * @param consumerSecret secret generated for the developer's application
		 * @param isApplicationOffSite (!) flag to be set if developer's application is OFF SITE
		 * @param accessTokenKey (!) key retrieved by the process of OFF SITE authorization and the final step using getAccessToken()
		 * @param accessTokenSecret (!) secret retrieved by the process of OFF SITE authorization and the final step using getAccessToken()
		 * 
		 * (!) - items requred for OFF SITE application development and usage
		 */
		public function MySpace(consumerKey:String, consumerSecret:String, isApplicationOffSite:Boolean = false, accessTokenKey:String = null, accessTokenSecret:String = null)
		{
			this._key = consumerKey;
			this._secret = consumerSecret;				

			this._oAuthConsumer = new OAuthConsumer(this._key, this._secret);
			
			//API is going to be used off-site
			if(isApplicationOffSite)
			{
				this._isApplicationOffSite = true;
				
				if(accessTokenKey != null && accessTokenSecret != null)
					this._oAuthAccessToken = new OAuthToken(accessTokenKey, accessTokenSecret);
			}
		}
		
		/* Basic callback function called on completion of GET urlLoader request */
		private function onComplete(event:Event):void
		{
			Message.dataGetComplete();			
			this._responseCallback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getProfile() urlLoader request */
		private function onCompleteGetProfile(event:Event):void
		{
			Message.dataGetComplete("getProfile");	
			var callback:Function = this._responseCallbackObject["getProfile"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getActivitiesAtom() urlLoader request */
		private function onCompleteGetActivitiesAtom(event:Event):void
		{
			Message.dataGetComplete("getActivitiesAtom");	
			var callback:Function = this._responseCallbackObject["getActivitiesAtom"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getFriendsActivitiesAtom() urlLoader request */
		private function onCompleteGetFriendsActivitiesAtom(event:Event):void
		{
			Message.dataGetComplete("getFriendsActivitiesAtom");	
			var callback:Function = this._responseCallbackObject["getFriendsActivitiesAtom"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getMoods() urlLoader request */
		private function onCompleteGetMoods(event:Event):void
		{
			Message.dataGetComplete("getMoods");	
			var callback:Function = this._responseCallbackObject["getMoods"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getMood() urlLoader request */
		private function onCompleteGetMood(event:Event):void
		{
			Message.dataGetComplete("getMood");	
			var callback:Function = this._responseCallbackObject["getMood"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getStatus() urlLoader request */
		private function onCompleteGetStatus(event:Event):void
		{
			Message.dataGetComplete("getStatus");	
			var callback:Function = this._responseCallbackObject["getStatus"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getUser() urlLoader request */
		private function onCompleteGetUser(event:Event):void
		{
			Message.dataGetComplete("getUser");
			var callback:Function = this._responseCallbackObject["getUser"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getUserId() urlLoader request */
		private function onCompleteUserId(event:Event):void
		{
			Message.dataGetComplete("getUserid");
			var callback:Function = this._responseCallbackObject["getUserId"];
			callback(XML(event.target.data)._xml_ns::userid);
		}
		
		/* Callback function called on completion of get[XXXXXX]Token() urlLoader request */
		private function onCompleteToken(event:Event):void
		{
			Message.dataGetComplete("Token");		
			var callback:Function = this._responseCallbackObject["getToken"];	
			callback(String(event.target.data));
		}
		
		/* Basic callback function called on completion of PUT urlLoader request */
		private function onCompletePut(event:Event):void
		{
			Message.dataPutComplete();
			
			if(this._responseCallback != null)
				this._responseCallback();
		}
		
		/* Callback function called on completion of getAlbums() urlLoader request */
		private function onCompleteGetAlbums(event:Event):void
		{
			Message.dataGetComplete("getAlbums");	
			var callback:Function = this._responseCallbackObject["getAlbums"];
			callback(XML(event.target.data));
		}
		
		/*	Callback function call on completion of addAlbum() urlLoader request */
		private function onCompleteAddAlbum(event:Event):void
		{
			Message.dataPutComplete();
			var callback:Function = this._responseCallbackObject["addAlbum"];
			
			if(callback != null)
			{				
				var rawResponse:String = String(event.target.data);
				var albumID:String = null;
				var albumIDIdentifier:String = "myspace.com.album.";
				
				//parse out the albumID
				if(rawResponse.indexOf(albumIDIdentifier) > -1)
					albumID = rawResponse.substring(rawResponse.indexOf(albumIDIdentifier) + albumIDIdentifier.length, rawResponse.length - 2);
				
				callback(albumID, rawResponse);
			}
		}
		
		/*	Callback function call on completion of addPhoto() urlLoader request */
		private function onCompleteAddPhoto(event:Event):void
		{
			Message.dataPutComplete();
			var callback:Function = this._responseCallbackObject["addPhoto"];

			if(callback != null)
			{				
				var rawResponse:String = String(event.target.data);
				var pattern:RegExp = /(\\\/)/g;
				var imageMetadataUrl:String = rawResponse.substring(15, rawResponse.length - 2).replace(pattern, "/");
				
				callback(rawResponse, imageMetadataUrl);
			}
		}
		
		/* Callback function call on completion of addGalleryPhoto() urlLoader request*/
		private function onCompleteAddGalleryPhoto(event:Event):void
		{
			Message.dataPutComplete();
			var callback:Function = this._responseCallbackObject["addGalleryPhoto"];

			if(callback != null)
			{				
				callback(XML(event.target.data));
			}
		}
		
		/*	Callback function call on completion of getMediaItemMetadata() urlLoader request */
		private function onCompleteGetMediaItemMetadata(event:Event):void
		{
			Message.dataGetComplete("getMediaItemMetadata");
			var callback:Function = this._responseCallbackObject["getMediaItemMetadata"];
			callback(XML(event.target.data));					
		}

		/* Callback function called on completion of getAlbum() urlLoader request */
		private function onCompleteGetAlbum(event:Event):void
		{
			Message.dataGetComplete("getAlbum");	
			var callback:Function = this._responseCallbackObject["getAlbum"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getAlbumPhoto() urlLoader request */
		private function onCompleteGetAlbumPhoto(event:Event):void
		{
			Message.dataGetComplete("getAlbumPhoto");	
			var callback:Function = this._responseCallbackObject["getAlbumPhoto"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getAlbumInfo() urlLoader request */
		private function onCompleteGetAlbumInfo(event:Event):void
		{
			Message.dataGetComplete("getAlbumInfo");	
			var callback:Function = this._responseCallbackObject["getAlbumInfo"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of postMood() request */
		private function onCompletePostMood(event:Event):void
		{
			Message.dataPutComplete();
			var callback:Function = this._responseCallbackObject["postMood"];
			if(callback != null)
				callback();
		}
		
		/* Callback function called on completion of postStatus() request */
		private function onCompletePostStatus(event:Event):void
		{
			Message.dataPutComplete();
			var callback:Function = this._responseCallbackObject["postStatus"];
			if(callback != null)
				callback();
		}
		
		/* Callback function called on completion of getPhotos() urlLoader request */
		private function onCompleteGetPhotos(event:Event):void
		{
			Message.dataGetComplete("getPhotos");	
			var callback:Function = this._responseCallbackObject["getPhotos"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getPhoto() urlLoader request */
		private function onCompleteGetPhoto(event:Event):void
		{
			Message.dataGetComplete("getPhoto");	
			var callback:Function = this._responseCallbackObject["getPhoto"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getFriendsStatus() urlLoader request */
		private function onCompleteGetFriendsStatus(event:Event):void
		{
			Message.dataGetComplete("getFriendsStatus");	
			var callback:Function = this._responseCallbackObject["getFriendsStatus"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getVideos() urlLoader request */
		private function onCompleteGetVideos(event:Event):void
		{
			Message.dataGetComplete("getVideos");	
			var callback:Function = this._responseCallbackObject["getVideos"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getFriendship() urlLoader request */
		private function onCompleteGetFriendship(event:Event):void
		{
			Message.dataGetComplete("getFriendship");	
			var callback:Function = this._responseCallbackObject["getFriendship"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getVideo() urlLoader request */
		private function onCompleteGetVideo(event:Event):void
		{
			Message.dataGetComplete("getVideo");	
			var callback:Function = this._responseCallbackObject["getVideo"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getPreferences() urlLoader request */
		private function onCompleteGetPreferences(event:Event):void
		{
			Message.dataGetComplete("getPreferences");	
			var callback:Function = this._responseCallbackObject["getPreferences"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getIndicators() urlLoader request */
		private function onCompleteGetIndicators(event:Event):void
		{
			Message.dataGetComplete("getIndicators");	
			var callback:Function = this._responseCallbackObject["getIndicators"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getAppData() urlLoader request */
		private function onCompleteGetAppData(event:Event):void
		{
			Message.dataGetComplete("getAppData");	
			var callback:Function = this._responseCallbackObject["getAppData"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getGlobalAppData() urlLoader request */
		private function onCompleteGetGlobalAppData(event:Event):void
		{
			Message.dataGetComplete("getGlobalAppData");	
			var callback:Function = this._responseCallbackObject["getGlobalAppData"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of putGlobalAppData() request */
		private function onCompletePutGlobalAppData(event:Event):void
		{
			Message.dataPutComplete();
			var callback:Function = this._responseCallbackObject["putGlobalAppData"];
			if(callback != null)
				callback();
		}
		
		/* Callback function called on completion of putAppData() request */
		private function onCompletePutAppData(event:Event):void
		{
			Message.dataPutComplete();
			var callback:Function = this._responseCallbackObject["putAppData"];
			if(callback != null)
				callback();
		}
		
		/* Callback function called on completion of getUserFriendsAppData() urlLoader request */
		private function onCompleteGetUserFriendsAppData(event:Event):void
		{
			Message.dataGetComplete("getUserFriendsAppData");	
			var callback:Function = this._responseCallbackObject["getUserFriendsAppData"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getFriends() urlLoader request */
		private function onCompleteGetFriends(event:Event):void
		{
			Message.dataGetComplete("getFriends");	
			var callback:Function = this._responseCallbackObject["getFriends"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getFriendsList() urlLoader request */
		private function onCompleteGetFriendsList(event:Event):void
		{
			Message.dataGetComplete("getFriendsList");	
			var callback:Function = this._responseCallbackObject["getFriendsList"];
			callback(XML(event.target.data));
		}
		
		/* Callback function called on completion of getComments() urlLoader request */
		private function onCompleteGetComments(event:Event):void
		{
			Message.dataGetComplete("getComments");	
			var callback:Function = this._responseCallbackObject["getComments"];
			callback(XML(event.target.data));
		}
		
		/*	Callback function call on completion of login() urlLoader request */
		private function onCompleteLogin(event:Event):void
		{
			Message.dataGetComplete("login");
			Message.dataPutComplete();
			var callback:Function = this._responseCallbackObject["login"];
			callback(XML(event.target.data));
		}
		
		/**
		 * Basic callback function called on failure of any urlLoader request
		 * @param event Error event
		 */
		public function onIOError(event:Event):void
		{
			Message.error(event.toString());
		}	
		
		/**
		 * Send REST request to get user data (XML)
		 * @param url URL prefix to use
		 * @param API_params additional parameters to send that are specific to this request
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param onCompleteFunction function to be called upon positive response from url request
		 * @param token optinally needed oAuthToken that is instance/request specific 
		 */
		private function getUserData (url:String, API_params:Object, responseCallback:Function, onCompleteFunction:Function = null, token:OAuthToken = null):void
		{
			if(onCompleteFunction == null) onCompleteFunction = onComplete;
			
			if (API_params == null)
			    API_params = {};

			// Add the time zone and date format parameters to the request
			if (this._dateFormat != "")
			{
				API_params["dateFormat"] = this._dateFormat;
				API_params["timeZone"] = this._timeZone;
			}
			
			this._responseCallback = responseCallback;	//set callback function, which is called in onComplete
			this._oAuthRequest = new OAuthRequest("GET", url, API_params, this._oAuthConsumer, token);
			
			this._urlLoader = new URLLoader();
			this._urlLoader.addEventListener(Event.COMPLETE, onCompleteFunction);
			this._urlLoader.addEventListener(IOErrorEvent.IO_ERROR, onIOError);
			var requestURL:String = this._oAuthRequest.buildRequest(new OAuthSignatureMethod_HMAC_SHA1());

			this._urlLoader.load(new URLRequest(requestURL));
		}
		
		/**
		 * Send REST request to put user data
		 * @param url URL prefix to use
		 * @param API_params additional parameters to send that are specific to this request
		 * @param appParams request-specific params sent in the body of the request (user-provided)
		 * @param method request method to be used (PUT, DELETE) 
		 */
		private function putUserData (url:String, API_params:Object, appParams:Object, method:String = "PUT", responseCallback:Function = null, onCompleteFunction:Function = null, token:OAuthToken = null, contentType:String = null):void
		{
			if(contentType == null)
				contentType = this._contentType_URLEncoded;
				
			if(onCompleteFunction == null) onCompleteFunction = onCompletePut;
			this._responseCallback = responseCallback;
						 
			// merge the user's input with needed params for signature
			API_params = ObjectUtils.merge(API_params, appParams);

			this._oAuthRequest = new OAuthRequest("POST", url, API_params, this._oAuthConsumer, token, appParams);
			
			this._urlLoader = new URLLoader();
			this._urlLoader.addEventListener(Event.COMPLETE, onCompleteFunction);
			this._urlLoader.addEventListener(IOErrorEvent.IO_ERROR, onIOError);
			var requestURL:String = this._oAuthRequest.buildRequest(new OAuthSignatureMethod_HMAC_SHA1());
			
			var header:URLRequestHeader = new URLRequestHeader("X-HTTP-Method-Override", method);
            var request:URLRequest = new URLRequest(requestURL);
            request.contentType = contentType;                      
 
 			if(contentType == this._contentType_URLEncoded)
           		request.data = new URLVariables(ObjectUtils.getQueryStringFromObject(appParams));
           	else
           		request.data = appParams;

            	
            request.method = URLRequestMethod.POST;
            request.requestHeaders.push(header);

			this._urlLoader.load(request);
		}
		
		/**
		 * Returns (XML) the albums of the given user
		 * @param userId ID (friendID) of user who's albums to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param page specifies which page
		 * @param pageSize specifies number of items per page
		 */
		public function getAlbums (userId:String, responseCallback:Function = null, page:int = -1, pageSize:int = -1):void
		{	
			var API_params:Object = new Object();
			this._responseCallbackObject["getAlbums"] = responseCallback;
			
			if (page != -1) API_params["page"] = page;
			if (pageSize != -1) API_params["pageSize"] = pageSize;
			
			var url:String = API_URL.ALBUMS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);						
			this.getUserData(url, API_params, responseCallback, onCompleteGetAlbums, this._oAuthAccessToken); 			
		}
		
		/**
		 * Returns the albumID (string) and the raw JSON response
		 * @param userId ID (friendID) of user who's albums to retrieve
		 * @param caption string used as the title of the album
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function addAlbum (userId:String, caption:String, responseCallback:Function = null):void
		{
			var API_params:Object = new Object();
			var appParams:Object = new Object();
			var contentType:String = this._contentType_JSON;
			
			appParams = '{"caption":"' + caption + '"}';				
			this._responseCallbackObject["addAlbum"] = responseCallback;
			
			var url:String = API_URL.CREATE_ALBUM.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			
			this.putUserData(url, API_params, appParams, "PUT", responseCallback, this.onCompleteAddAlbum, this._oAuthAccessToken, contentType);
		}
		
		/**
		 * Returns the statusLink [raw response] (string) and the imageMetadataUrl (string)
		 * http://mywiki.corp.myspace.com/index.php/OpenSocial0.9MediaItems
		 * 
		 * @param userId ID (friendID) of user who's albums to retrieve
		 * @param albumId ID of album to which the photo is being added to
		 * @param caption string used as the title of the album
		 * @param imageData ByteArray (data) of image being uploaded
		 * @param contentType type of image being uploaded (example: image/jpeg)
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function addPhoto(userId:String, albumId:String, caption:String, imageData:ByteArray, contentType:String, responseCallback:Function = null):void
		{
			var API_params:Object = new Object();
			API_params["type"] = "image";
			API_params["caption"] = caption;

			var appParams:Object = new Object();
			appParams = imageData;

			this._responseCallbackObject["addPhoto"] = responseCallback;

			//replace friendID and albumID placeholders with input values 
			var url:String = API_URL.UPLOAD_PHOTO.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			url = url.replace(new RegExp(API_URL.PLACEHOLDER_ALBUMID, "g"), albumId);

			this.putUserData(url, API_params, appParams, "PUT", responseCallback, this.onCompleteAddPhoto, this._oAuthAccessToken, contentType);	
		}

		public function addGalleryPhoto(imageData:ByteArray, contentType:String, responseCallback:Function = null, useStage:Boolean = false):void
		{
			var API_params:Object = new Object();
			API_params["type"] = "image";
			API_params["format"] = "xml";

			var appParams:Object = new Object();
			appParams = imageData;

			this._responseCallbackObject["addGalleryPhoto"] = responseCallback;
 
			var url:String = API_URL.UPLOAD_GALLEY_PHOTO;
			
			if(useStage) url = API_URL.UPLOAD_GALLEY_PHOTO_STAGE;
			
			this.putUserData(url, API_params, appParams, "PUT", responseCallback, this.onCompleteAddGalleryPhoto, this._oAuthAccessToken, contentType);
		}

		/**
		 * Returns the data (XML) with token info or error for login
		 * @param username username for login
		 * @param password password for login
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param captchaGuid the gui value for catpcha verification
		 * @param captchaSolution the solution entered to the guid
		 */
		 
		public function login(username:String, password:String, responseCallback:Function = null, captchaGuid:String = "", captchaSolution:String = ""):void
		{
			var API_params:Object = new Object();
			var appParams:Object = new Object();
			var contentType:String = this._contentType_JSON;
			
			API_params["format"] = "xml";
			//appParams = '{"password":"' + password + '","username":"' + username + '"}';
			appParams = '<login xmlns="http://myspace.com/roa/login/0.9" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
			appParams += '<password>' + password + '</password>';
			appParams += '<username>' + username + '</username>';
			appParams += '</login>';
			
			this._responseCallbackObject["login"] = responseCallback;
			
			var url:String = API_URL.LOGIN;
			
			//if catpcha is required, replace input params in URL
			if(captchaGuid != "" && captchaSolution != "")
			{
				url = API_URL.LOGIN_WITH_CAPTCHA.replace(new RegExp(API_URL.PLACEHOLDER_CAPTCHAGUID, "g"), captchaGuid);
				url = url.replace(new RegExp(API_URL.PLACEHOLDER_CAPTCHASOLUTION, "g"), captchaSolution);
			}
				
			this.putUserData(url, API_params, appParams, "PUT", responseCallback, this.onCompleteLogin, this._oAuthAccessToken, contentType);
		}
		
		/**
		 * Returns the data (XML) about the image
		 * @param mediaItemUrl url string returned whena new photo is added (addPhoto())
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getMediaItemMetadata(mediaItemUrl:String, responseCallback:Function):void
		{
			var API_params:Object = new Object();
			API_params["format"] = "xml";
			this._responseCallbackObject["getMediaItemMetadata"] = responseCallback;
			
			this.getUserData(mediaItemUrl, API_params, responseCallback, onCompleteGetMediaItemMetadata, this._oAuthAccessToken);
		}

		/**
		 * Returns (XML) an album of the given user
		 * @param userId ID (friendID) of user who's albums to retrieve
		 * @param albumId ID of album, information of which to return
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getAlbum (userId:String, albumId:String, responseCallback:Function):void	
		{			
			var API_params:Object = new Object();	//this api currently doesn't have any additional parameters
			this._responseCallbackObject["getAlbum"] = responseCallback;
			
			//replace friendID and albumID placeholders with input values 
			var url:String = API_URL.ALBUM.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			url = url.replace(new RegExp(API_URL.PLACEHOLDER_ALBUMID, "g"), albumId);
						
			this.getUserData(url, API_params, responseCallback, onCompleteGetAlbum, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) a photo in an album of the given user
		 * @param userId ID (friendID) of user who's album's photo to retrieve
		 * @param albumId ID of album, which contains the desired photo
		 * @param photoId ID of photo, information of which to return
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getAlbumPhoto (userId:String, albumId:String, photoId:String, responseCallback:Function):void	
		{			
			var API_params:Object = new Object();	//this api currently doesn't have any additional parameters
			this._responseCallbackObject["getAlbumPhoto"] = responseCallback;
			
			//replace friendID, albumID, and photoID placeholders with input values 
			var url:String = API_URL.ALBUMPHOTO.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			url = url.replace(new RegExp(API_URL.PLACEHOLDER_ALBUMID, "g"), albumId);
			url = url.replace(new RegExp(API_URL.PLACEHOLDER_PHOTOID, "g"), photoId);
						
			this.getUserData(url, API_params, responseCallback, onCompleteGetAlbumPhoto, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) an album's info of the given user
		 * @param userId ID (friendID) of user who's albums info to retrieve
		 * @param albumId ID of album, information of which to return
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getAlbumInfo (userId:String, albumId:String, responseCallback:Function):void	
		{			
			var API_params:Object = new Object();	//this api currently doesn't have any additional parameters
			this._responseCallbackObject["getAlbumInfo"] = responseCallback;
			
			//replace friendID and albumID placeholders with input values 
			var url:String = API_URL.ALBUMINFO.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			url = url.replace(new RegExp(API_URL.PLACEHOLDER_ALBUMID, "g"), albumId);
						
			this.getUserData(url, API_params, responseCallback, onCompleteGetAlbumInfo, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the mood of the given user
		 * @param userId ID (friendID) of user who's mood to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getMood (userId:String, responseCallback:Function):void
		{
			var API_params:Object = new Object();

			this._responseCallbackObject["getMood"] = responseCallback;
			var url:String = API_URL.MOOD.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);						
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetMood, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the moods available for the given user
		 * @param userId ID (friendID) of user who's moods to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param culture identifier for the language in which the list of moods is returned (ex: ru-RU -> Russian)
		 */
		public function getMoods (userId:String, responseCallback:Function, culture:String = null):void
		{
			var API_params:Object = new Object();			
			this._responseCallbackObject["getMoods"] = responseCallback;
			
			if(culture != null)
				API_params["culture"] = culture;
						
			var url:String = API_URL.MOODS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);						
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetMoods, this._oAuthAccessToken);
		}
		
		/**
		 * Sets user's mood
		 * @param userId ID (friendID) of user who's mood is being set
		 * @param mood Code of mood (e.g., 3 ( = annoyed))
		 */
		public function postMood (userId:String, mood:int, responseCallback:Function = null):void
		{
			var API_params:Object = new Object();
			var appParams:Object = new Object();		
			appParams["mood"] = mood;	
			this._responseCallbackObject["postMood"] = responseCallback;
			
			var url:String = API_URL.MOOD.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			this.putUserData(url, API_params, appParams, "PUT", responseCallback, this.onCompletePostMood, this._oAuthAccessToken);
		}
		
		/**
		 * Wrapper for postMood() 
		 */		 
		public function setMood (userId:String, mood:int, responseCallback:Function = null):void
		{
			this.postMood(userId, mood, responseCallback);
		}
		
		/**
		 * Sets user's status
		 * @param userId ID (friendID) of user who's status is being set
		 * @param status user's new status, which will be updated
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function postStatus (userId:String, status:String, responseCallback:Function = null):void
		{
			var API_params:Object = new Object();
			var appParams:Object = new Object();		
			appParams["status"] = status;	
			this._responseCallbackObject["postStatus"] = responseCallback;
			
			var url:String = API_URL.STATUS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			this.putUserData(url, API_params, appParams, "PUT", responseCallback, this.onCompletePostStatus, this._oAuthAccessToken);
		}
		
		/**
		 * Wrapper for postStatus() 
		 */
		public function setStatus (userId:String, status:String, responseCallback:Function = null):void
		{
			this.postStatus(userId, status, responseCallback);
		}
		
		/**
		 * Returns (XML) the photos for the given user
		 * @param userId ID (friendID) of user who's photos to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param page specifies which page
		 * @param pageSize specifies number of items per page
		 */
		public function getPhotos (userId:String, responseCallback:Function, page:int = -1, pageSize:int = -1):void
		{	
			var API_params:Object = new Object();
			this._responseCallbackObject["getPhotos"] = responseCallback;
			
			if (page != -1) API_params["page"] = page;
			if (pageSize != -1) API_params["pageSize"] = pageSize;
			
			var url:String = API_URL.PHOTOS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);						
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetPhotos, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the photo for the given user
		 * @param userId ID (friendID) of user who's photos to retrieve
		 * @param photoId ID of the photo to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getPhoto (userId:String, photoId:String, responseCallback:Function = null):void
		{	
			var API_params:Object = new Object();
			this._responseCallbackObject["getPhoto"] = responseCallback;
			
			var url:String = API_URL.PHOTO.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			url = url.replace(new RegExp(API_URL.PLACEHOLDER_PHOTOID, "g"), photoId);
									
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetPhoto, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the profile for the given user
		 * @param userId ID (friendID) of user who's profile to retrieve
		 * @param detailType "basic", "full" or "extended"
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getProfile (userId:String, responseCallback:Function = null, detailType:String = "full"):void
		{	
			var API_params:Object = new Object();
			this._responseCallbackObject["getProfile"] = responseCallback;
			
			API_params["detailType"] = detailType;
						
			var url:String = API_URL.PROFILE.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);						
			this.getUserData(url, API_params, responseCallback, onCompleteGetProfile, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the status for the given user
		 * @param userId ID (friendID) of user who's status to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getStatus (userId:String, responseCallback:Function):void
		{
			var API_params:Object = new Object();
			
			this._responseCallbackObject["getStatus"] = responseCallback;
			var url:String = API_URL.STATUS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);						
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetStatus, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the status of the given user's friends
		 * @param userId ID (friendID) of user who's friends status to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getFriendsStatus (userId:String, responseCallback:Function):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["getFriendsStatus"] = responseCallback;
			
			var url:String = API_URL.FRIENDSSTATUS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);						
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetFriendsStatus, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the videos of the given user
		 * @param userId ID (friendID) of user who's videos to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getVideos (userId:String, responseCallback:Function):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["getVideos"] = responseCallback;

			var url:String = API_URL.VIDEOS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);						
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetVideos, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the video of the given user
		 * @param userId ID (friendID) of user who's video to retrieve
		 * @param videoId ID of video to be retrieved
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getVideo (userId:String, videoId:String, responseCallback:Function):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["getVideo"] = responseCallback;

			var url:String = API_URL.VIDEO.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			url = url.replace(new RegExp(API_URL.PLACEHOLDER_VIDEOID, "g"), videoId);
									
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetVideo, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the friendship of the given user with other users
		 * @param userId ID (friendID) of user who's friendships to retrieve
		 * @param friendsIds IDs of friends to check, separated by semicolons
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getFriendship (userId:String, friendsIds:String, responseCallback:Function):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["getFriendship"] = responseCallback;

			var url:String = API_URL.FRIENDSHIP.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			url = url.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDSID, "g"), friendsIds);
									
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetFriendship, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the preferences for a given user (API RESTRICTED TO APPLICATIONS WITH PERMISSIONS TO ACCESS THIS INFORMATION)
		 * @param userId ID (friendID) of user who's preferences to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getPreferences (userId:String, responseCallback:Function):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["getPreferences"] = responseCallback;

			var url:String = API_URL.PREFERENCES.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);									
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetPreferences, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the indicators for a given user
		 * @param userId ID (friendID) of user who's indicators to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getIndicators (userId:String, responseCallback:Function):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["getIndicators"] = responseCallback;

			var url:String = API_URL.INDICATORS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);									
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetIndicators, this._oAuthAccessToken);
		}

		/**
		 * Returns (XML) activity stream of the user 
		 * @param userId ID of user who's activities are being pulled
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param culture NOT USED YET
		 * @param lastRetrievalTimeStamp NOT USED YET
		 * @param activityTypes takes in piped (|) activity type parameters to filter result data; http://developerwiki.myspace.com/index.php?title=ActivityStream_Queries
		 * @param extensions takes in piped (|) extension parameters to organize result data; http://developerwiki.myspace.com/index.php?title=ActivityStream_Queries
		 * @param composite Whether or not to return the stream as composite entries; http://developerwiki.myspace.com/index.php?title=ActivityStream_Queries
		 */		
		public function getActivitiesAtom (userId:String, responseCallback:Function, culture:String = null, lastRetrievalTimeStamp:String = null, activityTypes:String = null, extensions:String = null, composite:Boolean = false):void
		{
			var API_params:Object = new Object();			
			this._responseCallbackObject["getActivitiesAtom"] = responseCallback;
			
			if(activityTypes != null)
				API_params["activityTypes"] = activityTypes;
			
			API_params["composite"] = composite ? 'true' : 'false';
			
			if(extensions != null)	
				API_params["extensions"] = extensions;
			
			var url:String = API_URL.ACTIVITIES.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);									
			this.getUserData(url, API_params, responseCallback, onCompleteGetActivitiesAtom, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) activity stream of the user's friends 
		 * @param userId ID of user who's friends' activities are being pulled
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param culture NOT USED YET
		 * @param lastRetrievalTimeStamp NOT USED YET
		 * @param activityTypes takes in piped (|) activity type parameters to filter result data; http://developerwiki.myspace.com/index.php?title=ActivityStream_Queries
		 * @param extensions takes in piped (|) extension parameters to organize result data; http://developerwiki.myspace.com/index.php?title=ActivityStream_Queries
		 * @param composite Whether or not to return the stream as composite entries; http://developerwiki.myspace.com/index.php?title=ActivityStream_Queries
		 */		
		public function getFriendsActivitiesAtom (userId:String, responseCallback:Function, culture:String = null, lastRetrievalTimeStamp:String = null, activityTypes:String = null, extensions:String = null, composite:Boolean = false):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["getFriendsActivitiesAtom"] = responseCallback;

			if(activityTypes != null)
				API_params["activityTypes"] = activityTypes;
				
			API_params["composite"] = composite ? 'true' : 'false';
			
			if(extensions != null)
				API_params["extensions"] = extensions;
				
			var url:String = API_URL.FRIENDS_ACTIVITIES.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);									
			this.getUserData(url, API_params, responseCallback, onCompleteGetFriendsActivitiesAtom, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the app data for a given user
		 * @param userId ID (friendID) of user who's app data to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param keys keys for data to be retrieved, separated by semicolons
		 */
		public function getAppData (userId:String, responseCallback:Function, keys:String = null):void
		{
			var API_params:Object = new Object();
			var url:String = "";
			this._responseCallbackObject["getAppData"] = responseCallback;
			
			if(keys == null)
				url = API_URL.APPDATA.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);									
			else
			{
				url = API_URL.APPDATAKEYS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
				url = url.replace(new RegExp(API_URL.PLACEHOLDER_APP_DATA_KEYS, "g"), keys);
			}
			
			this.getUserData(url, API_params, responseCallback, onCompleteGetAppData, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the global app data for a given user
		 * @param userId ID (friendID) of user who's global app data to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param keys keys for data to be retrieved, separated by semicolons
		 */
		public function getGlobalAppData (responseCallback:Function, keys:String = null):void
		{
			var API_params:Object = new Object();
			var url:String = "";
			this._responseCallbackObject["getGlobalAppData"] = responseCallback;
			
			if(keys == null)
				url = API_URL.GLOBALAPPDATA;
			else
				url = API_URL.GLOBALAPPDATAKEYS.replace(new RegExp(API_URL.PLACEHOLDER_APP_DATA_KEYS, "g"), keys);
													
			this.getUserData(url, API_params, responseCallback, onCompleteGetGlobalAppData, this._oAuthAccessToken);
		}
		
		/**
		 * Sets the global app data using key/value pairs
		 * @param appParams hash object for data to be set, separated by semicolons
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function putGlobalAppData (appParams:Object, responseCallback:Function = null):void
		{		
			var API_params:Object = new Object();
			this._responseCallbackObject["putGlobalAppData"] = responseCallback;			

			this.putUserData(API_URL.GLOBALAPPDATA, API_params, appParams, "PUT", responseCallback, onCompletePutGlobalAppData, this._oAuthAccessToken);
		}		
		
		/**
		 * Clears the global app data for given keys
		 * @param keys keys of data to be cleared, separated by semicolons
		 */
		public function clearGlobalAppData (keys:String):void
		{
			var API_params:Object = new Object();
			var appParams:Object = new Object();
			appParams["value"] = "none";	//Workaround, because AS3 defaults to GET (instead of POST) if no request.data is present
			
			var url:String = API_URL.GLOBALAPPDATAKEYS.replace(new RegExp(API_URL.PLACEHOLDER_APP_DATA_KEYS, "g"), keys);
			this.putUserData(url, API_params, appParams, "DELETE", null, null, this._oAuthAccessToken);
		}
		
		/**
		 * Sets the app data using key/value pairs
		 * @param userId ID (friendID) of user who's app data to set
		 * @param appParams hash object for data to be set, separated by semicolons
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function putAppData (userId:String, appParams:Object, responseCallback:Function = null):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["putAppData"] = responseCallback;			
			
			var url:String = API_URL.APPDATA.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			this.putUserData(url, API_params, appParams, "PUT", responseCallback, onCompletePutAppData, this._oAuthAccessToken);
		}
		
		/**
		 * Clears the app data for given keys
		 * @param userId ID (friendID) of user who's app data to clear
		 * @param keys keys of data to be cleared, separated by semicolons
		 */
		public function clearAppData (userId:String, keys:String):void
		{
			var API_params:Object = new Object();
			var appParams:Object = new Object();
			appParams["value"] = "none";	//Workaround, because AS3 defaults to GET (instead of POST) if no request.data is present
			
			var url:String = API_URL.APPDATAKEYS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			url = url.replace(new RegExp(API_URL.PLACEHOLDER_APP_DATA_KEYS, "g"), keys);
			
			this.putUserData(url, API_params, appParams, "DELETE", null, null, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) user's friends' app data
		 * @param userId ID (friendID) of target user
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param keys separated by semicolons
		 */
		public function getUserFriendsAppData (userId:String, responseCallback:Function, keys:String = null):void
		{
			var API_params:Object = new Object();
			var url:String = "";
			this._responseCallbackObject["getUserFriendsAppData"] = responseCallback;	
			
			if(keys == null)
				url = API_URL.FRIENDS_APP_DATA.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			else
			{
				url = API_URL.FRIENDS_APP_DATA.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
				url = url.replace(new RegExp(API_URL.PLACEHOLDER_APP_DATA_KEYS, "g"), keys);
			}
													
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetUserFriendsAppData, this._oAuthAccessToken);
		}
		
		/**
		 * Returns (XML) the current user object
		 * @param responseCallback function to be called upon completion of the url request (user-provided)		 
		 */
		public function getUser (responseCallback:Function, onCompleteFunction:Function = null):void
		{		
			if(this.IsAuthorized())
			{
				if(onCompleteFunction == null) 
					onCompleteFunction = onCompleteGetUser;
				
				this._responseCallbackObject["getUser"] = responseCallback;
				this.getUserData(API_URL.USER_INFO, null, responseCallback, onCompleteFunction, this._oAuthAccessToken);
			}			
			else
				Message.accessTokenNotSet();
		}
		
		/**
		 * Returns (STRING) the current user's ID
		 * @param responseCallback function to be called upon completion of the url request (user-provided) 
		 */
		public function getUserId (responseCallback:Function):void
		{		
			this._responseCallbackObject["getUserId"] = responseCallback;
			this.getUser(responseCallback, onCompleteUserId);
		}	
		
		/**
		 * Returns (STRING) the request token (this function is the 1st step for OFF SITE app authorization)
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param callbackURL URL for user to be redirected to after signing in (developer-provided) 
		 */
		public function getRequestToken (responseCallback:Function, callbackURL:String = ""):void
		{		
			var API_params:Object = new Object();
			
			if(callbackURL != "")
				API_params["oauth_callback"] = callbackURL;
			
			this._responseCallbackObject["getToken"] = responseCallback;
			this.getUserData(API_URL.OAUTH_REQUEST_TOKEN_URL, API_params, responseCallback, onCompleteToken);
		}		
		
		/**
		 * Returns (STRING) the authorization URL (this function is the 2nd step for OFF SITE app authentication)
		 * @param requestToken token returned by calling getRequestToken() 
		 */
		public function getAuthorizationURL (requestToken:OAuthToken):String
		{
			this._oAuthRequest = new OAuthRequest("GET", API_URL.OAUTH_AUTHORIZATION_URL, null, this._oAuthConsumer, requestToken);
			return this._oAuthRequest.buildRequest(new OAuthSignatureMethod_HMAC_SHA1());
		}
		
		/**
		 * Returns (STRING) the access token (this function is the 3rd step for OFF SITE app authentication)
		 * @param requestToken token returned by calling getRequestToken()
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * 
		 * NOTE: new request token returns &oauth_callback_confirmed=true appended to the key/secret query string; 
		 * this portion needs to be removed before passing in the string to create the request token OAuthToken object   
		 */
		public function getAccessToken (requestToken:OAuthToken, responseCallback:Function, oAuthVerifier:String = ""):void
		{			
			var API_params:Object = new Object();
			
			if(oAuthVerifier != "")
				API_params["oauth_verifier"] = oAuthVerifier;
				
			this._responseCallbackObject["getToken"] = responseCallback;
			this.getUserData(API_URL.OAUTH_ACCESS_TOKEN_URL, API_params, responseCallback, onCompleteToken, requestToken);
		}
		
		/**
		 * Returns (XML) the friends of the given user
		 * @param userId ID (friendID) of given user
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param page specifies which page
		 * @param pageSize specifies number of items per page (if not set, all friends will be returned)
		 * @param list Can be one of 'top', 'online' or 'app'
		 * @param show can be a combination of 'mood', 'status', 'online' separated by '|'.  Do not put spaces in this string.
		 */
		public function getFriends (userId:String, responseCallback:Function, page:int = -1, pageSize:int = -1, list:String = null, show:String = null):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["getFriends"] = responseCallback;
			
			if (page != -1) API_params["page"] = page;
			
			if (pageSize == -1) API_params["page_size"] = "all";
			else API_params["page_size"] = pageSize;
			
			//validate LIST of friends; can only be "top", "online", or "app" (one of the 3)
			if (list != null)
			{
				list = list.toLowerCase();
				
				//only set "list" parameter if it is one of the valid values
				if(list != "top" || list != "online" || list != "app")
					API_params["list"] = list;
			} 
			
			//validate SHOW; can be any combination of "mood", "status", and "online" - separated by |
			if (validateShowString(show)) 
				API_params["show"] = show;
			
			var url:String = API_URL.FRIENDS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);						
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetFriends, this._oAuthAccessToken);	
		}
		
		/**
		 * Returns (XML) the specified friends of the given user
		 * @param userId ID (friendID) of given user
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 * @param friendsIds list of friend ID's separated by semicolons
		 * @param show can be a combination of 'mood', 'status', 'online' separated by '|'.  Do not put spaces in this string.
		 */
		public function getFriendsList (userId:String, responseCallback:Function, friendsIds:String, show:String = null):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["getFriendsList"] = responseCallback;
			
			//validate SHOW; can be any combination of "mood", "status", and "online" - separated by |
			if (validateShowString(show)) 
				API_params["show"] = show;
			
			var url:String = API_URL.FRIENDS_LIST.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);
			url = url.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDSID, "g"), friendsIds);						
			this.getUserData(url, API_params, responseCallback, this.onCompleteGetFriendsList, this._oAuthAccessToken);
		}
		
		/*	Validates user input for SHOW (can be a combination of 'mood', 'status', 'online' separated by '|') */
		private function validateShowString (show:String):Boolean
		{
			//valid show types
			var mood:String = "mood";
			var status:String = "status";
			var online:String = "online";					
			
			if(show != null)
			{
				show = show.toLowerCase();
				
				if(show.indexOf("|") == -1)	//only 1 of 3 types
				{
					if(show == mood || show == status || show == online)
						return true;
					else
						return false;
				}
				else	//contains combination of multiple types
				{
					var showArray:Array = show.split("|");
					
					if(showArray.length > 3)	//max. 3 valid values
						return false;
						
					for(var x:Number = 0; x < showArray.length; x++)
					{
						//if the type doesn't match any allowed
						if(showArray[x] != mood && showArray[x] != status && showArray[x] != online)
							return false;
					}
					
					//all types matched allowed values
					return true;
				}
			}
			else
				return false;	
		}
		
		/* Checks that an access token has been set up (done via input to contructor) */ 
		private function IsAuthorized ():Boolean
		{
			if(this._isApplicationOffSite && this._oAuthAccessToken != null)
				return true;
			else if(!this._isApplicationOffSite)
				return true;
			else
				return false;
		}		
		
		/**
		 * Returns (XML) the comments for a given user (API RESTRICTED TO APPLICATIONS WITH PERMISSIONS TO ACCESS THIS INFORMATION)
		 * @param userId ID (friendID) of user who's preferences to retrieve
		 * @param responseCallback function to be called upon completion of the url request (user-provided)
		 */
		public function getComments (userId:String, responseCallback:Function):void
		{
			var API_params:Object = new Object();
			this._responseCallbackObject["getComments"] = responseCallback;
					
			var url:String = API_URL.COMMENTS.replace(new RegExp(API_URL.PLACEHOLDER_FRIENDID, "g"), userId);						
			this.getUserData(url, null, responseCallback, this.onCompleteGetComments, this._oAuthAccessToken);
		}
		
		/**
		 * Sets the date format and time zone format for the response times
		 * See the developer wiki for more details - http://developerwiki.myspace.com/index.php?title=Date%2C_Time_and_Timezone_Formats
		 * @param dateFormat one of the following date formats (ISO8601, GMT, EPOCH, UTC) 
		 * @param timeZone integer for the time zone
		 */
		public function setDateFormatTimeZone(dateFormat:String, timeZone:int):void
		{
			this._dateFormat = dateFormat;
			this._timeZone = timeZone;
		}
		
		/**
		 * Returns the date format being used by the API
		 */
		public function getDateFormat():String
		{
			return this._dateFormat;
		}
		
		/**
		 * Returns the time zone being used by the API
		 */
		public function getTimeZone():int
		{
			return this._timeZone;
		}
	}
}
