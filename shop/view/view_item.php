<?
	/*
		This is the ITEM PAGE view.
	*/

	class View_Item extends View
	{
		public function __contruct ()
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

			$html = $html."<div id='".Constants::$DIV_ID_MAIN."'>";

			$html = $html."ITEM BODY func.: <br/>".$this->data['test']['title'];
			
			$html = $html."</div>";

			return $html;
		}
	}
?>