package com.myspace.sdk.oAuth
{
	import com.myspace.sdk.Utils.URLEncoding;
	
	/**
	 * The OAuthToken class is for holding on to a Token key and private strings.
	*/
	public class OAuthToken
	{
		private var _key:String;
		private var _secret:String;
		
		/**
		 * Constructor class.
		 * 
		 * @param key Token key. Default is an empty string.
		 * @param secret Token secret. Default is an empty string.
		 * 
		 * @param fullResponse is the full query string response from getRequestToken 
		*/
		public function OAuthToken(key:String="",secret:String="", fullResponse:String="")
		{
			//both key (token) and secret are passed in
			if(key != "" && secret != "")
			{
				_key = key;
				_secret = secret;
			}
			//raw response string from getRequestToken is passed in
			else if(fullResponse != "")
			{
				/*  
				//parse value for oauth_token
				var keyStartIndex:Number = fullResponse.indexOf("=",0) + 1;
				var keyEndIndex:Number = fullResponse.indexOf("&", keyStartIndex + 1);				
				this._key = URLEncoding.decode(fullResponse.substring(keyStartIndex,keyEndIndex));
								
				//parse value for oauth_secret
				var secretStartIndex:Number = fullResponse.indexOf("=", keyEndIndex + 1) + 1;
				this._secret = fullResponse.substring(secretStartIndex,fullResponse.length);
				 */

				var responseArray:Array = fullResponse.split("&");
				
				if(responseArray.length >= 2)
				{
					this._key = URLEncoding.decode(this.getQueryStringNodeValue(responseArray[0]));
					this._secret = this.getQueryStringNodeValue(responseArray[1]);					
				}
				else
				{
					this._key = "";
					this._secret = "";
				}
			}
		}
		
		/**
		 * Parse query string value from key/value pair 
		 */
		 private function getQueryStringNodeValue (keyValue:String):String
		 {
		 	var keyValueArray:Array = keyValue.split("=");
		 	
		 	if(keyValueArray.length == 2)	//1st node is key, 2nd node is value
		 		return keyValueArray[1];
		 	else
		 		return "";
		 }
		 
		/**
		 * Token key
		*/
		public function get key():String {
			return _key;
		}
		
		/**
		 * @private
		*/
		public function set key(val:String):void {
			if (val != _key)
				_key = val;
		}
		
		/**
		 * Token secret
		*/
		public function get secret():String {
			return _secret;
		}
		
		/**
		 * @private
		*/
		public function set secret(val:String):void {
			if (val != _secret)
				_secret = val;
		}
		
		/**
		 * Returns if the Token is empty or not
		*/
		public function get isEmpty():Boolean {
			if (key.length == 0 && secret.length == 0) {
				return true;
			} else {
				return false;
			}
		}
	}
}
