package com.myspace.sdk.oAuth
{
	import com.myspace.sdk.oAuth.Hurlant.crypto.Crypto;
	import com.myspace.sdk.oAuth.Hurlant.crypto.hash.HMAC;
	import com.myspace.sdk.oAuth.Hurlant.util.Base64;
	import com.myspace.sdk.oAuth.Hurlant.util.Hex;
	
	import flash.utils.ByteArray;
	
	public class OAuthSignatureMethod_HMAC_SHA1 implements IOAuthSignatureMethod
	{
		public function OAuthSignatureMethod_HMAC_SHA1()
		{
		}
		
		public function get name():String {
			return "HMAC-SHA1";
		}
		
		public function signRequest(request:OAuthRequest):String {
			// get the signable string
			var toBeSigned:String = request.getSignableString();
			
			// get the secrets to encrypt with
			var sSec:String = request.consumer.secret + "&"
			if (request.token)
				sSec += request.token.secret;
			
			// hash them
			var hmac:HMAC = Crypto.getHMAC("sha1");
			var key:ByteArray = Hex.toArray(Hex.fromString(sSec));
			var message:ByteArray = Hex.toArray(Hex.fromString(toBeSigned));

			trace("sSec: " + sSec);
			trace(toBeSigned);

			var result:ByteArray = hmac.compute(key,message);
			var ret:String = Base64.encodeByteArray(result);
			
			//var testSign:String = request.createOAuthSignature();
			//trace(testSign);
			
			return ret;
		}
	}
}
