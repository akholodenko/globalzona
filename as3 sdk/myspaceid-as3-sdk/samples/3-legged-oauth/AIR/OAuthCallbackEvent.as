package
{
	import flash.events.Event;
		
	public class OAuthCallbackEvent extends Event
	{ 
		  public var oauth_token:String;
		  public var oauth_verifier:String;
		  public var isError:Boolean;
		  public var error_message:String;
		  
		  public function OAuthCallbackEvent(type:String) 
		  {
		   	super(type);
		   	this.isError = false;
		   	this.error_message = "";
		   	this.oauth_token = "";
		   	this.oauth_verifier = "";
		  } 
	 }
 }