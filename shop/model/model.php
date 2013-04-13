<?
	/*
		This is the base model. All other models are extended from it
	*/

	class Model
	{
		public $data = array(); 

		function Model ()
		{
			//$this->Connect();
		}

		public function BuildData ()
		{
		}

		public function Connect ()
		{
			mysql_connect(
				Settings::$DB_LOCALHOST,
				Settings::$DB_USERNAME,
				Settings::$DB_PASSWORD
			);

			@mysql_select_db(Settings::$DB_NAME) or die( "Unable to select database");
		}

		public function ExecuteQuery ($iQuery, $autoClose)
		{
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

		//runs query in database
		protected function SetData ($autoClose, $query)
		{
			$this->Connect();
			$this->ExecuteQuery($query, $autoClose);
		}

		//returns raw results of the input query or -1 (error)
		private function GetData ($query)
		{
			$this->Connect();
			return $this->ExecuteQuery($query, true);
		}

		//returns array of objects containing data for each column queried (multiple rows)
		protected function GetDataMatrix ($query)
		{
			$result = $this->GetData($query);

			if ($result != -1)
			{
				$data = array();
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $data[$i] = mysql_fetch_array($result);
				return $data;
			}
			else echo "GetDataMatrix Failed";
			return false;
		}

		//returns array of objects containing data for each column queried (single row)
		protected function GetDataRow ($query)
		{
			$result = $this->GetData($query);

			if ($result != -1) return mysql_fetch_array($result);
			else echo "GetDataRow Failed";

			return false;
		}

		public function GetCategories ()
		{
			return $this->GetDataMatrix("SELECT * FROM shop_category ORDER BY name");
		}

		public function GetAllItems ()
		{
			return $this->GetDataMatrix("SELECT * FROM shop_item ORDER BY name");
		}
	}
?>