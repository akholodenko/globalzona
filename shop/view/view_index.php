<?
	/*
		This is the INDEX PAGE view.
	*/

	class View_Index extends View
	{
		function __contruct ()
		{
		}

		public function Draw ()
		{
			$navigation = Navigation::DefaultNavigation();
			$body = $this->Body();

			include "utils/template/template.php";
		}

		public function Body ()
		{
			$html = parent::CategoryPanel();
			$html = $html.parent::ShoppingCartPanel();
			$html = $html."<div id='".Constants::$DIV_ID_MAIN."'>";

			for($x = 0; $x < count($this->data['items']); $x++)
			{
				$html = $html.parent::ItemPreview($this->data['items'][$x]);
			}
			
			$html = $html."</div>";

			return $html;
		}
	}
?>