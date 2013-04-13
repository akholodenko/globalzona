<?
	class Utils
	{
		public function DisplayCityText ($cityObject, $showStateOrCountry = false)
		{
			$text = $cityObject['city_name'];

			if($showStateOrCountry)
			{
				if($cityObject['country_id'] == 1)
					$text = $text.", ".$cityObject['state'];
				else
					$text = $text.", ".$cityObject['country_name'];
			}

			return $text;
		}
	}
?>