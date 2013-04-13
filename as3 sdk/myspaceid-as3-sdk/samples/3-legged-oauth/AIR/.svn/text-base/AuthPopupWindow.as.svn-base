package 
{
	import flash.events.Event;
	import flash.html.HTMLLoader;
	import flash.net.URLRequest;
	
	import mx.core.UIComponent;
	import mx.core.Window;
	import mx.utils.URLUtil;
	
	[Event(name="oauthcallbackevent")]

	public class AuthPopupWindow extends Window
	{
		private var htmlContainer:UIComponent;
		private var htmlLoader:HTMLLoader;

		private var authUrl:String;
		
		public function AuthPopupWindow(authUrl:String, width:Number, height:Number)
		{
			super();
			this.authUrl = authUrl;			
			this.width = width;
			this.height = height;
			
			this.htmlContainer = new UIComponent();
			htmlContainer.percentWidth = 100;
			htmlContainer.percentHeight = 100;			
			addChild(this.htmlContainer);
		}

		public function show() : void
		{
			htmlLoader = new HTMLLoader();
			htmlContainer.addChild(htmlLoader);
			
			// Listen to URL load complete events
			//	
			htmlLoader.addEventListener(Event.COMPLETE, onUrlLoadHandler);
			
			var request:URLRequest = new URLRequest(authUrl);											
			htmlLoader.load(request);
			this.open();
		}

		override protected function updateDisplayList(unscaledWidth:Number, unscaledHeight:Number):void
		{
			htmlLoader.width = unscaledWidth;
			htmlLoader.height= unscaledHeight;
		}

		private function onUrlLoadHandler(event:Event) : void
		{
			// This handler will be called each time a URL load is completed
			
			// i.e. first for the auth window content load
			//      next when the callback happens
			//
			// We catch the oauth callback by ignoring the authorize page load
			//
			var location:String = event.target.location;
			if (location.indexOf("http://api.myspace.com/authorize", 0) != -1)
				return; // auth page load...just return

			// Not authorize page load...let's see if the auth succeeded or not

			// Parse the query params
			var qStr = location.substring( location.indexOf("?") + 1, location.length);
			var queryParams:Object = URLUtil.stringToObject(qStr, "&", false);			
			
			// Check to see if there was an error. For example, user clicked cancel
			//	
			if (queryParams.hasOwnProperty("oauth_problem")) 
			{
				var oauthcallbackevent:OAuthCallbackEvent = new OAuthCallbackEvent('oauthcallbackevent');
				oauthcallbackevent.isError = true;
				oauthcallbackevent.error_message = queryParams.oauth_problem;
				
				dispatchEvent(oauthcallbackevent);
			}

			var oauthcallbackevent:OAuthCallbackEvent = new OAuthCallbackEvent('oauthcallbackevent');
			if (queryParams.hasOwnProperty("oauth_token"))
				oauthcallbackevent.oauth_token = queryParams.oauth_token;
			if (queryParams.hasOwnProperty("oauth_verifier"))
				oauthcallbackevent.oauth_verifier = queryParams.oauth_verifier;

			dispatchEvent(oauthcallbackevent);
		}	
	}
}
