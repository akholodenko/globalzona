<?
	class Post
	{
		var $title;
		var $url;
		var $categoryId;

		function Post ($iTitle, $iURL, $iCategoryId)
		{
			$this->title = $iTitle;
			$this->url = $iURL;
			$this->categoryId = $iCategoryId;
		}
	}
?>