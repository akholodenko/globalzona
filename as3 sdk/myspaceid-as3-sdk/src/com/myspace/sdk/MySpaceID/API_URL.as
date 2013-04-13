package com.myspace.sdk.MySpaceID
{
	public class API_URL
	{
		public static const PLACEHOLDER_FRIENDID:String = "_FRIENDID_";
		public static const PLACEHOLDER_FRIENDSID:String = "_FRIENDSID_";
		public static const PLACEHOLDER_ALBUMID:String = "_ALBUMID_";
		public static const PLACEHOLDER_PHOTOID:String = "_PHOTOID_";
		public static const PLACEHOLDER_VIDEOID:String = "_VIDEOID_";
		public static const PLACEHOLDER_APP_DATA_KEYS:String = "_APP_DATA_KEYS_";
		public static const PLACEHOLDER_CAPTCHAGUID:String = "_CAPTCHAGUID_";
		public static const PLACEHOLDER_CAPTCHASOLUTION:String = "_CAPTCHASOLUTION_";
				
		//WORK
		public static const OAUTH_REQUEST_TOKEN_URL:String = "http://api.myspace.com/request_token";
		public static const OAUTH_AUTHORIZATION_URL:String = "http://api.myspace.com/authorize";
		public static const OAUTH_ACCESS_TOKEN_URL:String = "http://api.myspace.com/access_token";
		
		public static const TEST:String = "http://api.myspace.com/v1/users/_FRIENDID_/friend/_FRIENDID_.xml";
		public static const ACTIVITIES:String = "http://api.myspace.com/v1/users/_FRIENDID_/activities.atom";
		public static const ALBUMS:String = "http://api.myspace.com/v1/users/_FRIENDID_/albums.xml";
		public static const ALBUM:String = "http://api.myspace.com/v1/users/_FRIENDID_/albums/_ALBUMID_/photos.xml";
		public static const ALBUMPHOTO:String = "http://api.myspace.com/v1/users/_FRIENDID_/albums/_ALBUMID_/photos/_PHOTOID_.xml";
		public static const ALBUMINFO:String = "http://api.myspace.com/v1/users/_FRIENDID_/albums/_ALBUMID_.xml";
		public static const APPDATA:String = "http://api.myspace.com/v1/users/_FRIENDID_/appdata.xml";
		public static const APPDATAKEYS:String = "http://api.myspace.com/v1/users/_FRIENDID_/appdata/_APP_DATA_KEYS_.xml";
		public static const CREATE_ALBUM:String = "http://opensocial.myspace.com/roa/09/albums/_FRIENDID_/@self";		
		public static const FRIENDS:String = "http://api.myspace.com/v1/users/_FRIENDID_/friends.xml";
		public static const FRIENDS_ACTIVITIES:String = "http://api.myspace.com/v1/users/_FRIENDID_/friends/activities.atom";
		public static const FRIENDS_APP_DATA:String = "http://api.myspace.com/v1/users/_FRIENDID_/friends/appdata.xml";
		public static const FRIENDS_APP_DATA_KEYS:String = "http://api.myspace.com/v1/users/_FRIENDID_/friends/appdata/_APP_DATA_KEYS_.xml";
		public static const FRIENDS_LIST:String = "http://api.myspace.com/v1/users/_FRIENDID_/friendslist/_FRIENDSID_.xml";
		public static const FRIENDSSTATUS:String = "http://api.myspace.com/v1/users/_FRIENDID_/friends/status.xml";
		public static const FRIENDSHIP:String = "http://api.myspace.com/v1/users/_FRIENDID_/friends/_FRIENDSID_.xml";
		public static const GLOBALAPPDATA:String = "http://api.myspace.com/v1/appdata/global.xml";
		public static const GLOBALAPPDATAKEYS:String = "http://api.myspace.com/v1/appdata/global/_APP_DATA_KEYS_.xml";
		public static const MOOD:String = "http://api.myspace.com/v1/users/_FRIENDID_/mood.xml";
		public static const MOODS:String = "http://api.myspace.com/v1/users/_FRIENDID_/moods.xml";
		public static const PHOTOS:String = "http://api.myspace.com/v1/users/_FRIENDID_/photos.xml";
		public static const PHOTO:String = "http://api.myspace.com/v1/users/_FRIENDID_/photos/_PHOTOID_.xml";		
		public static const INDICATORS:String = "http://api.myspace.com/v1/users/_FRIENDID_/indicators.xml";
		public static const PROFILE:String = "http://api.myspace.com/v1/users/_FRIENDID_/profile.xml";
		public static const STATUS:String = "http://api.myspace.com/v1/users/_FRIENDID_/status.xml";
		public static const UPLOAD_PHOTO:String = "http://opensocial.myspace.com/roa/09/mediaitems/_FRIENDID_/@self/_ALBUMID_";
		public static const UPLOAD_GALLEY_PHOTO:String = "http://api.myspace.com/1.0/logoimage";
		public static const UPLOAD_GALLEY_PHOTO_STAGE:String = "http://216.178.39.20/1.0/logoimage";		
		public static const VIDEO:String = "http://api.myspace.com/v1/users/_FRIENDID_/videos/_VIDEOID_.xml";
		public static const VIDEOS:String = "http://api.myspace.com/v1/users/_FRIENDID_/videos.xml";	
		
		public static const LOGIN:String = "https://roa.myspace.com/roa/09/messaging/login";
		public static const LOGIN_WITH_CAPTCHA:String = "https://roa.myspace.com/roa/09/messaging/login/_CAPTCHAGUID_/_CAPTCHASOLUTION_";		
		
		//DON'T WORK
		public static const USER_INFO:String = "http://api.myspace.com/v1/user.xml";				
		public static const COMMENTS:String = "http://api.myspace.com/v1/users/_FRIENDID_/comments.xml";
		public static const PREFERENCES:String = "http://api.myspace.com/v1/users/_FRIENDID_/preferences.xml";
	}
}
