<?
	class Data
	{
		//runs query in database
		private static function SetData ($query)
		{
			$db = new Database();
			$db->ExecuteQuery($query);
		}

		//returns raw results of the input query or -1 (error)
		private static function GetData ($query)
		{
			$db = new Database();
			return $db->ExecuteQuery($query);
		}

		//returns array of objects containing data for each column queried
		private static function GetDataMatrix ($query)
		{
			$result = Data::GetData($query);

			if ($result != -1)
			{
				$data = array();
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $data[$i] = mysql_fetch_array($result);
				return $data;
			}
			else echo "Data::GetDataMatrix Failed";
			return false;
		}

		public static function GetCategories ($order)
		{
			return Data::GetDataMatrix("SELECT id, title FROM category ORDER BY ".$order);
		}

		public static function GetTopPosts($maxCount)
		{
			return Data::GetDataMatrix("SELECT COUNT(post_id) as views, post_id as id, post.title as title, post.url as url FROM view, post WHERE post.id = view.post_id GROUP BY post_id, post.title ORDER BY COUNT(view.post_id) DESC LIMIT ".$maxCount);
		}

		public static function GetPostByCategoryID($maxCount,$categoryId,$page)
		{
			$appendLogic = "";
			if($categoryId > 0) $appendLogic = " AND c.id = ".$categoryId;

			return Data::GetDataMatrix("SELECT p.id as id, p.title as title, p.date as date, url, c.title as category, p.spamFlag as spamFlag FROM post p, category c WHERE c.id = p.category_id ".$appendLogic." ORDER BY p.date DESC LIMIT ".($page * $maxCount).",".$maxCount);
		}

		public static function GetPostByID($postId)
		{
			return Data::GetDataMatrix("SELECT p.id as id, p.title as title, p.date as date, url, c.title as category, p.spamFlag as spamFlag FROM post p, category c WHERE c.id = p.category_id AND p.id = ".$postId);
		}

		public static function GetViewsByPostID($postId)
		{
			return Data::GetDataMatrix("SELECT COUNT(id) as views FROM view WHERE post_id = ".$postId);
		}

		public static function GetTotalPageCount($categoryId)
		{
			$appendLogic = "";
			if($categoryId > 0) $appendLogic = "WHERE category_id = ".$categoryId;

			return Data::GetDataMatrix("SELECT COUNT(id) as pages FROM post ".$appendLogic);
		}

		public static function SetPost($post)
		{
			Data::SetData("insert into post (title, url, category_id) values ('".urlencode($post->title)."', '".urlencode($post->url)."', ".$post->categoryId.")");
		}

		public static function ValidatePost($title, $url, $categoryId)
		{
			if($title == '' || $url == '' || $categoryId == '') return false;
			return true;
		}

		public static function SetView($postId)
		{
			Data::SetData("insert into view (post_id) values (".$postId.")");
		}

		public static function SetSpam($postId)
		{
			Data::SetData("UPDATE post SET spamFlag = 1 WHERE id =".$postId);
		}
	}
?>