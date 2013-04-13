<?
class Database {
	var $localhost="localhost";
	var $username="artemk";
	var $password="gz5p@ss";
	var $database="oorok";

	private static $m_pInstance;

	function __construct ()
	{
		//mysql_connect($this->localhost,$this->username,$this->password);
		//@mysql_select_db($this->database) or die( "Unable to select database");
	}

	public static function getInstance ()
	{
		if(!self::$m_pInstance)
		{
			self::$m_pInstance = new Database();
		}

		return self::$m_pInstance;
	}

	private function CreateConnection ()
	{
		mysql_connect($this->localhost,$this->username,$this->password);
		@mysql_select_db($this->database) or die( "Unable to select database");
	}

	public function ExecuteQuery ($iQuery, $autoClose)
	{
		self::CreateConnection();

		if(!$result=mysql_query($iQuery)) 
		{
			echo "Can't execute query.";
			mysql_close();
			return -1;
		}
		else
		{
			if($autoClose)
			{
				mysql_close();
			}
			return $result;
		}
	}
}
?>