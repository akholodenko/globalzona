package com.myspace.sdk.MySpaceID
{
	public class Message
	{
		public function Message()
		{ 
			trace("hi");
		}
		
		/**
		 * Displays generic message that is passed in
		 * @param subject header of message
		 * @param body body of message
		 */
		public static function manualMessage (subject:String, body:String):void
		{
			trace("====================" + subject + "====================");
			trace(body);	
		}
		
		/**
		 *	Displays message when OFF SITE applications don't have the proper authorization 
		 */
		public static function accessTokenNotSet ():void
		{
			var subject:String = "Access Token Not Set!";
			var body:String = "You are using a MySpace object OFF SITE, which requires an access token for data access.";
			body += "\nAfter obtaining the access token, use the constructor that has parameters for access token key and secret.";
			body += "\nIf you are running an onsite application, use a MySpace object with isApplicationOffSite = FALSE";
			
			Message.manualMessage(subject, body);
		}
		
		/**
		 * Displays message for successful data retrieval request
		 * @param subSubject additional header information (usually used for specific function/data names)
		 */
		public static function dataGetComplete (subSubject:String = null):void
		{
			var subjectInsert:String;
			
			if(subSubject)
				subjectInsert = " (" + subSubject + ")";
			else
				subjectInsert = "";
						
			var subject:String = "Data [Get]" + subjectInsert + " Complete!";
			var body:String = "Calling passed-in callback function...";
			
			Message.manualMessage(subject, body);
		}
		
		/**
		 * Displays generic message for successful data writting request
		 */
		public static function dataPutComplete ():void
		{
			var subject:String = "Data [Put] Complete!";
			var body:String = "";
			
			Message.manualMessage(subject, body);
		}
		
		/**
		 * Displays message for erroneous data retrieval/writting request
		 * @param info additional error-specific information 
		 */
		public static function error (info:String):void
		{
			var subject:String = "Request Error!";
			var body:String = info;
			body += "\nPlease use Fiddler to view full erroneous response.";
			
			Message.manualMessage(subject, body);
		}

	}
}
