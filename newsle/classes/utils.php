<?
	class Utils
	{
		public static function StringTruncate ($string, $maxLength)
		{
			if(strlen($string) > $maxLength)
				return substr($string, 0, $maxLength - 3)."...";
			else
				return $string;
		}

		public static function SubmitFormParams ()
		{
			return "document.getElementById('submitPostTitle'), document.getElementById('submitPostURL'), document.getElementById('submitPostCategory')";
		}

		public static function SubmitFormParamValues ()
		{
			return "document.getElementById('submitPostTitle').value, document.getElementById('submitPostURL').value, document.getElementById('submitPostCategory').options[document.getElementById('submitPostCategory').selectedIndex].value";
		}

		public static function GetDomain ($url)
		{
			$explode = explode(".", $url);
			$tld = $explode[2];
			$tld = explode("/", $tld);
			$name = $explode[1];

			return ucfirst(strtolower($name.".".$tld[0]));
		}

		public static function GetHomePageDate ($date)
		{
			$d1 = strtotime($date);
			$d2 = time();
			//$d1=mktime(22,0,0,1,1,2007);
			//$d2=mktime(0,0,0,1,2,2007);
			/*
			echo "Hours difference = ".floor(($d2-$d1)/3600) . "<br>";
			echo "Minutes difference = ".floor(($d2-$d1)/60) . "<br>";
			echo "Seconds difference = " .($d2-$d1). "<br>";


			echo "Month difference = ".floor(($d2-$d1)/2628000) . "<br>";
			echo "Days difference = ".floor(($d2-$d1)/86400) . "<br>";
			echo "Year difference = ".floor(($d2-$d1)/31536000) . "<br>";
			*/
			if(($d2-$d1) <= 0) 
				return "just posted";	//due to server timestamp difference need to check for negative
			else if(($d2-$d1) > 0 && ($d2-$d1) < 60) 
				return ($d2-$d1)." seconds ago";
			else if(($d2-$d1) >= 60 && floor(($d2-$d1)/60) < 60) 
				return floor(($d2-$d1)/60)." minutes ago";
			else if (floor(($d2-$d1)/60) >= 60 && floor(($d2-$d1)/3600) < 24)
				return floor(($d2-$d1)/3600). " hours ago";
			else
				return date("F j, Y",strtotime($date));
		}
	}
?>