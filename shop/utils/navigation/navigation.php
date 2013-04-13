<?
	class Navigation
	{
		public static function DefaultNavigation ()
		{
			$html = "
				<ul>
					<li>
						<a href='?page=index'><img src='".Settings::$PATH_IMG."home_64.png' border='0' /></a>
					</li>
					<li>
						<a href='#'>test</a>
					</li>
				</ul>
			";

			return $html;
		}
	}
?>