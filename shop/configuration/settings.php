<?
	/*
		This file stores various settings variables, such as database credentials
	*/

	class Settings
	{
		public static $DB_LOCALHOST = "localhost";
		public static $DB_USERNAME = "artemk";
		public static $DB_PASSWORD = "gz5p@ss";
		public static $DB_NAME = "newsle";

		public static $PATH_CONTROLLER = "controller/controller_{VALUE}.php";
		public static $PATH_VIEW = "view/view_{VALUE}.php";
		public static $PATH_MODEL = "model/model_{VALUE}.php";
		public static $PATH_IMG = "http://www.globalzona.com/shop/utils/img/";

		public static function GetPathForController ($page)
		{
			return str_replace("{VALUE}", $page, Settings::$PATH_CONTROLLER);
		}

		public static function GetPathForView ($page)
		{
			return str_replace("{VALUE}", $page, Settings::$PATH_VIEW);
		}

		public static function GetPathForModel ($page)
		{
			return str_replace("{VALUE}", $page, Settings::$PATH_MODEL);
		}
	}

?>