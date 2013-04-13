package com.myspace.sdk.oAuth
{
	/**
	 * The OAuthConsumer class is for holding on to the consumer's key and private strings.
	*/
	public class OAuthConsumer
	{
		private var _key:String;
		private var _secret:String;
		
		/**
		 * Constructor class.
		 * 
		 * @param key Consumer's key. Default is an empty string.
		 * @param secret Consumer's secret. Default is an empty string.
		*/
		public function OAuthConsumer(key:String="",secret:String="")
		{
			_key = key;
			_secret = secret;
		}
		
		/**
		 * Consumer key
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
		 * Consumer secret
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
		 * Returns if the Consumer is empty or not
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
