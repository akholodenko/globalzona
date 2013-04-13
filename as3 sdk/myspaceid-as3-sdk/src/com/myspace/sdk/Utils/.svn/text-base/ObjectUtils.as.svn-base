package com.myspace.sdk.Utils
{
	import com.myspace.sdk.Utils.URLEncoding;
	
	/**
	 * Supports various operations on Objects (key/value).
	 * 
	*/
	public class ObjectUtils
	{
		public function ObjectUtils()
		{
		}
		
		/**
		 * merges 2 objects and returns the result
		 **/
		public static function merge (objX:Object, objY:Object):Object
		{
			for (var param:String in objY) 
			{
				if(param == "status")	//certain values don't need to be URLEncoded
					objX[param] = objY[param];					
				else
					objX[param] = URLEncoding.encode(objY[param]);
			}
			
			return objX;
		}
		
		/**
		 * returns TRUE if input param is in the input object
		 **/
		public static function isParamInObject (param:String, obj:Object):Boolean
		{
			for (var objParam:String in obj) 
			{
				if(objParam == param)
					return true;
			}
			
			return false;
		}
		
		public static function getQueryStringFromObject (obj:Object):String
		{
			var aParams:Array = new Array();
			
			for (var param:String in obj) 
			{
					/* KDF: hack to allow for multiple values to be passed for the same parameter name. */
					if (obj[param] is Array)
					{
						for (var element:String in obj[param]) 
						{
							aParams.push(param + "=" + URLEncoding.encode(obj[param][element].toString()));
						}
					}
					else
					/* KDF: end hack */
						aParams.push(param + "=" + URLEncoding.encode(obj[param].toString()));
			}
			
			// put them in the right order
			aParams.sort();

			// return them like a querystring
			return aParams.join("&");
		}
	}
}
