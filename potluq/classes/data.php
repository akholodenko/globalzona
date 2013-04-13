<?
	class Data
	{
		//runs query in database
		private static function SetData ($autoClose, $query)
		{
			$db = new Database();
			$db->ExecuteQuery($query, $autoClose);
		}

		//returns raw results of the input query or -1 (error)
		private static function GetData ($query)
		{
			$db = new Database();
			return $db->ExecuteQuery($query, true);
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

		//returns array of objects containing data for each column queried
		private static function GetDataRow ($query)
		{
			$result = Data::GetData($query);

			if ($result != -1) return mysql_fetch_array($result);
			else echo "Data::GetDataRow Failed";

			return false;
		}

		public static function GetUserInfoByEmail ($email)
		{
			return Data::GetDataRow("SELECT id, f_name, l_name, email, password FROM user WHERE email = '".$email."'");
		}

		public static function GetUserInfoById ($id)
		{
			return Data::GetDataRow("SELECT id, f_name, l_name, email, password FROM user WHERE id = '".$id."'");
		}

		public static function GetUserAddressBook ($id)
		{
			return Data::GetDataMatrix("SELECT id, f_name, l_name, email FROM address_book WHERE user_id = ".$id." ORDER BY f_name");
		}

		public static function GetUserRemainingAddressBook ($user_id, $potluq_id)
		{
			return Data::GetDataMatrix("SELECT * FROM address_book WHERE user_id = ".$user_id." and id NOT IN (SELECT address_book_id FROM guest WHERE potluq_id = ".$potluq_id.")");
		}

		public static function GetContact ($id)
		{
			return Data::GetDataRow("SELECT id, f_name, l_name, email FROM address_book WHERE id = ".$id);
		}

		public static function GetPotluqsByUserId ($user_id)
		{
			return Data::GetDataMatrix("SELECT id, title, date, description, location, address FROM potluq WHERE user_id = ".$user_id." AND date >= '".date("Y-m-d", time())."'");
		}

		public static function GetOldPotluqsByUserId ($user_id)
		{
			return Data::GetDataMatrix("SELECT id, title, date, description, location, address FROM potluq WHERE user_id = ".$user_id." AND date < '".date("Y-m-d", time())."'");
		}

		public static function SetNewContact($user_id, $f_name, $l_name, $email)
		{
			Data::SetData(true, "insert into address_book (user_id, f_name, l_name, email) values (".$user_id.", '".$f_name."', '".$l_name."', '".$email."')");
		}

		public static function UpdateContact($contact_id, $f_name, $l_name, $email)
		{
			Data::SetData(true, "UPDATE address_book SET f_name = '".$f_name."', l_name = '".$l_name."', email = '".$email."' WHERE id = '".$contact_id."'");
		}

		public static function DeleteContact($id)
		{
			Data::SetData(true, "DELETE FROM address_book WHERE id = ".$id);
		}

		public static function SetNewPotluqBasics($user_id, $title, $date, $location, $address, $description)
		{
			Data::SetData(false, "insert into potluq (user_id, title, date, description, location, address) values (".$user_id.", '".$title."', '".$date."', '".$description."', '".$location."', '".$address."')");
			$return_id = mysql_insert_id();
			mysql_close();

			return $return_id;
		}

		public static function SetNewPotluqGuestlist($guestlist, $potluq_id)
		{
			for($x = 0; $x < count($guestlist); $x++)
			{
				echo $guestlist[$x]."<br>";
				Data::SetData(true, "insert into guest (address_book_id, potluq_id) values (".$guestlist[$x].", ".$potluq_id.")");
			}
		}

		public static function SetNewPotluqItems($items, $potluq_id)
		{
			for($x = 0; $x < count($items); $x++)
			{
				echo $items[$x]."<br>";
				Data::SetData(true, "insert into item (name, potluq_id) values ('".$items[$x]."', ".$potluq_id.")");
			}
		}

		public static function GetPotluqId ($user_id, $title, $date, $location, $address, $description)
		{
			return Data::GetDataRow("SELECT id FROM potluq WHERE user_id = ".$user_id." AND title = '".$title."' AND date = '".$date."' AND location = '".$location."' AND address = '".$address."'");
		}

		public static function GetPotluqById ($potluq_id)
		{
			return Data::GetDataRow("SELECT id, user_id, title, date, location, address, description FROM potluq WHERE id = ".$potluq_id);
		}

		public static function GetPotluqGuestlistById ($potluq_id)
		{
			return Data::GetDataMatrix("SELECT address_book.f_name, address_book.l_name, guest.id, guest.address_book_id, guest.potluq_id FROM guest, address_book WHERE address_book.id = guest.address_book_id AND potluq_id = ".$potluq_id." ORDER BY address_book.f_name");
		}

		public static function GetPotluqItemsById ($potluq_id)
		{
			return Data::GetDataMatrix("SELECT id, name, potluq_id, guest_id FROM item WHERE potluq_id = ".$potluq_id);
		}

		public static function GetPotluqItemsRemainingCountById ($potluq_id)
		{
			return Data::GetDataRow("SELECT count(id) FROM item WHERE guest_id = 0 AND potluq_id = ".$potluq_id);
		}

		public static function GetPotluqItemsAssignedCountById ($potluq_id)
		{
			return Data::GetDataRow("SELECT count(id) FROM item WHERE guest_id > 0 AND potluq_id = ".$potluq_id);
		}

		public static function GetPotluqGuestlistAwaitingCountById ($potluq_id)
		{
			return Data::GetPotluqGuestlistCountByStatusById ($potluq_id, 0);
		}

		public static function GetPotluqGuestlistConfirmedCountById ($potluq_id)
		{
			return Data::GetPotluqGuestlistCountByStatusById ($potluq_id, 1);
		}

		public static function GetPotluqGuestlistDeclinedCountById ($potluq_id)
		{
			return Data::GetPotluqGuestlistCountByStatusById ($potluq_id, -1);
		}

		public static function GetPotluqGuestlistCountByStatusById ($potluq_id, $status)
		{
			return Data::GetDataRow("SELECT count(id) FROM guest WHERE confirmed = ".$status." AND potluq_id = ".$potluq_id);
		}

		public static function UpdateProfile($user_id, $f_name, $l_name, $email, $password)
		{
			Data::SetData(true, "UPDATE user SET f_name = '".$f_name."', l_name = '".$l_name."', email = '".$email."', password = '".$password."' WHERE id = '".$user_id."'");
		}

		public static function SetUser($f_name, $l_name, $email, $password)
		{
			Data::SetData(false, "INSERT INTO user (f_name, l_name, email, password) values ('".$f_name."', '".$l_name."', '".$email."', '".$password."')");
			$return_id = mysql_insert_id();
			mysql_close();

			return $return_id;
		}
/*
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
		*/
	}
?>