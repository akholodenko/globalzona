package {
	import flash.display.Sprite;
	import com.myspace.sdk.MySpaceID.MySpace;
	import com.myspace.sdk.Utils.URLEncoding;
	import com.myspace.sdk.oAuth.*;

	public class MySpaceIdDemoAS3 extends Sprite
	{
		public var ms:MySpace;
		private var ms2:MySpace;
		
		private var oAuthToken:OAuthToken;
        private var oAuthAccessToken:OAuthToken;		
		
		private var _xml_ns:Namespace = new Namespace("api-v1.myspace.com");
		
		//SET YOUR VALUES FOR THE BELOW VARIABLES
		public var userId_internal:String = "";
		private var key:String = "";
        private var secret:String = "";        
        public var callbackURL:String = "";
        	
        /*
        *	In order to use the SDK offsite, you need to go through the process
        *	of retrieving a request token, followed by authorization, and getting
        *	an access token. 
        */
		public function MySpaceIdDemoAS3()
		{
			ms = new MySpace(this.key, this.secret);
			
			this.getProfile();
			//ms.getRequestToken(onRequestCompleteRequestToken, this.callbackURL);
		}
		
		public function getProfile ():void
		{				
			ms.setDateFormatTimeZone("ISO8601",8);
			ms.getProfile(this.userId_internal, onGetProfileRequestComplete);				
		}
		
		public function onGetProfileRequestComplete (xml:XML):void
		{
			trace("=================onGetProfileRequestComplete===================");
			trace(xml);
			
			/* profilePhoto.source = xml._xml_ns::imageuri;
			profileName.text = xml._xml_ns::displayname;
			profileGender.text = xml._xml_ns::profile._xml_ns::gender;
			profileLastUpdate.text = "Last update: " + xml._xml_ns::lastupdateddate; */
		}
		
		public function onRequestCompleteRequestToken (response:String):void
		{
			//raw request token key and secret
			trace(response);
			/*
				OAuthToken can either taken key(token)/secret values, 
				or a raw response string, which it parses
			*/
			this.oAuthToken = new OAuthToken("","",response);
			
			var authURL:String = ms.getAuthorizationURL(this.oAuthToken);
			trace("Authorization URL: " + authURL);
			
			/*
				now you need to copy/paste the Authorization URL into
				a browser window and confirm (login or click continue)
				
				next, copy/paste the traced raw string of token/secret 
				into the oAuthToken contructor in testGetAccessToken()
				
				next, copy/paste verified from redirected-to URL, and
				pass it into the getAccessToken function 
				(in testGetAccessToken())
				
				now run testGetAccessToken()
			*/
		}
		
		public function testGetAccessToken ():void
		{
			//paste in the request token raw string to create request token
			var newToken:OAuthToken = new OAuthToken("","","oauth_token=klidsk6RfxtjFh2F%2FLbEhRJIOgyOTvKR0ggggrx27wSreoUDyf%2BKm%2BsiYut6%2BQBSSopna3bEelT84Lo%2F0OM59dIQiaWKG0MAAEgPU3%2FpxzTQy2fnmgfJESmd%2FbumehOI&oauth_token_secret=d18a33ad3203446ab3bd50c6d2d2c52b5a6b537555a84050bb67368135d1d48d&oauth_callback_confirmed=true");
			ms.getAccessToken(newToken, onRequestCompleteAccessToken, "5a928af7-a7cd-402e-9ecb-63177373ec61");
		}
		
		public function onRequestCompleteAccessToken (response:String):void
		{
			trace("=================onRequestCompleteAccessToken===================");
			trace(response);
			/*
				OAuthToken can either taken key(token)/secret values, 
				or a raw response string, which it parses
			*/
			this.oAuthAccessToken = new OAuthToken("","",response);
			ms2 = new MySpace(this.key, this.secret, true, this.oAuthAccessToken.key, this.oAuthAccessToken.secret);
			ms2.getUserId(onRequestUserIdComplete);
			ms2.getUser(onGetRequestComplete);
		}
		
		public function onRequestUserIdComplete (retrievedUserId:String):void
		{
			trace("=================onRequestUserIdComplete===================");
			trace("USER ID: " + retrievedUserId);
		}
		
		public function onGetRequestComplete (xml:XML):void
		{
			trace("=================onGetRequestComplete===================");
			trace(xml);
		}
	}
}
