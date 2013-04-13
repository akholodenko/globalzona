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

		//returns array of objects containing data for each column queried (multiple rows)
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

		//returns array of objects containing data for each column queried (single row)
		private static function GetDataRow ($query)
		{
			$result = Data::GetData($query);

			if ($result != -1) return mysql_fetch_array($result);
			else echo "Data::GetDataRow Failed";

			return false;
		}
		
		public static function GetYears ()
		{
			return Data::GetDataMatrix("SELECT distinct(year) FROM lemon_model ORDER BY year DESC");
		}
		
		public static function GetCarMakes ($year)
		{
			return Data::GetDataMatrix("
				SELECT lm.id, lm.name 
				FROM lemon_make lm, lemon_make_year lmy
				WHERE lm.id = lmy.make_id
				AND lmy.year = ".$year."
				ORDER BY lm.name"
			);
		}
		
		public static function GetCarModels ($year, $make_id)
		{
			return Data::GetDataMatrix("
				SELECT lm.id, lm.make_id, lm.year, lm.model_name_id, lmn.name 
				FROM lemon_model lm, lemon_model_name lmn
				WHERE lm.make_id = ".$make_id." 
				AND lm.year = '".$year."' 
				AND lm.model_name_id = lmn.id
				ORDER BY lmn.name"
			);
		}
		
		public static function GetCarProblemTypes ()
		{
			return Data::GetDataMatrix("SELECT id, name FROM lemon_problem_type ORDER BY name");
		}
		
		public static function GetCarProblem ($problem_type_id)
		{
			return Data::GetDataMatrix("
				SELECT *
				FROM lemon_problem
				WHERE problem_type_id = ".$problem_type_id." 
				ORDER BY name"
			);
		}
		
		public static function PostSubmit($year, $make_id, $model_id, $problem_type_id, $problem_id, $zipcode)
		{
			Data::SetData(true, "INSERT INTO lemon_post (year, make_id, model_id, problem_type_id, problem_id, zipcode) VALUES (".$year.", ".$make_id.", ".$model_id.", ".$problem_type_id.", ".$problem_id.", '".$zipcode."')");
		}
		
		public static function GetPostByDetails ($model_id, $problem_id)
		{
			return Data::GetDataRow("
				SELECT lm.name as make, lmn.name as model, lmo.year as year, lpt.name as problem_type, lp.name as problem
				FROM lemon_make lm, lemon_model lmo, lemon_model_name lmn, lemon_problem_type lpt, lemon_problem lp
				WHERE lmo.id = ".$model_id."
				AND lmo.make_id = lm.id
				AND lmo.model_name_id = lmn.id
				AND lp.id = ".$problem_id."
				AND lpt.id = lp.problem_type_id"
			);
		}
		
		public static function GetTopBadCars ($count)
		{
			return Data::GetDataMatrix("
				SELECT lmo.year, lm.name as make, lmn.name as model, lp.model_id, count(lp.model_id) as problem_count
				FROM lemon_post lp, lemon_make lm, lemon_model lmo, lemon_model_name lmn
				WHERE lmo.id = lp.model_id
				AND lmo.model_name_id = lmn.id
				AND lm.id = lmo.make_id
				GROUP BY lp.model_id
				ORDER BY count(lp.model_id) DESC
				LIMIT 0,".$count
			);
		}
/*
				

		public static function GetVenues ()
		{
			return Data::GetDataMatrix("SELECT id, name, address FROM gl_venue WHERE user_id = ".$_SESSION['USER_id']." ORDER BY name");
		}

		public static function SetNewVenue($venue_name, $venue_address)
		{
			Data::SetData(true, "INSERT INTO gl_venue (user_id, name, address) VALUES (".$_SESSION['USER_id'].", '".$venue_name."', '".$venue_address."')");
		}

		
		
		public static function UpdateVenue($venue_id, $venue_name, $venue_address)
		{
			Data::SetData(true, "UPDATE gl_venue SET name = '".$venue_name."', address = '".$venue_address."' WHERE id = '".$venue_id."' AND user_id = ".$_SESSION['USER_id']);
		}

		public static function GetVIP ($order = "first_name")
		{
			return Data::GetDataMatrix("SELECT id, first_name, last_name, email, phone FROM gl_vip WHERE user_id = ".$_SESSION['USER_id']." ORDER BY ".$order);
		}

		

		public static function DeleteVIP($vip_id)
		{
			Data::SetData(true, "DELETE FROM gl_vip WHERE id = ".$vip_id." AND user_id = ".$_SESSION['USER_id']);
		}

		public static function GetVIPById ($vip_id)
		{
			return Data::GetDataRow("SELECT id, first_name, last_name, email, phone FROM gl_vip WHERE id = ".$vip_id." AND user_id = ".$_SESSION['USER_id']);
		}

		public static function GetVIPByEmail ($email)
		{
			return Data::GetDataMatrix("SELECT id, first_name, last_name, email, phone FROM gl_vip WHERE email = '".$email."' AND user_id = ".$_SESSION['USER_id']);
		}

		public static function UpdateVIP($vip_id, $first_name, $last_name, $email, $phone)
		{
			Data::SetData(true, "UPDATE gl_vip SET first_name = '".$first_name."', last_name = '".$last_name."', email = '".$email."', phone = '".$phone."' WHERE id = '".$vip_id."' AND user_id = ".$_SESSION['USER_id']);
		}

		public static function GetEventsCount ($status)
		{
			$limit = "";
			if($status == "future") $limit = "AND date >= '".date("Y-m-d",time())."'";
			else if($status == "past") $limit = "AND date < '".date("Y-m-d",time())."'";

			return Data::GetDataRow("SELECT count(id) as count_events FROM gl_event WHERE user_id = ".$_SESSION['USER_id']." ".$limit);
		}

		public static function GetVenuesCount ()
		{
			return Data::GetDataRow("SELECT count(id) as count_venues FROM gl_venue WHERE user_id = ".$_SESSION['USER_id']);
		}

		public static function GetVIPCount ()
		{
			return Data::GetDataRow("SELECT count(id) as count_vip FROM gl_vip WHERE user_id = ".$_SESSION['USER_id']);
		}

		public static function GetEvents ($status)
		{
			$limit = "";
			$order = "";
			if($status == "future") 
			{
				$limit = "AND date >= '".date("Y-m-d",time())."'";
				$order = "ASC";
			}
			else if($status == "past") 
			{
				$limit = "AND date < '".date("Y-m-d",time())."'";
				$order = "DESC";
			}
			
			return Data::GetDataMatrix("SELECT gl_event.has_guestlist, gl_event.id, gl_event.title, gl_event.date, gl_event.description, gl_event.flyer_url, gl_venue.name as venue_name, gl_venue.address as venue_address FROM gl_event, gl_venue WHERE gl_event.venue_id = gl_venue.id AND gl_event.user_id = ".$_SESSION['USER_id']." ".$limit." ORDER BY date ".$order);
		}

		public static function SetNewEvent($title, $date, $venue_id, $flyer_url, $description, $has_guestlist)
		{
			Data::SetData(true, "INSERT INTO gl_event (user_id, title, date, venue_id, flyer_url, description, has_guestlist) VALUES (".$_SESSION['USER_id'].", '".$title."', '".$date."', '".$venue_id."', '".$flyer_url."', '".$description."', '".$has_guestlist."')");
		}

		public static function UpdateEvent($event_id, $title, $date, $venue_id, $flyer_url, $description, $has_guestlist)
		{
			Data::SetData(true, "UPDATE gl_event SET title = '".$title."', date = '".$date."', venue_id = '".$venue_id."', flyer_url = '".$flyer_url."', description = '".$description."', has_guestlist = '".$has_guestlist."' WHERE id = '".$event_id."' AND user_id = ".$_SESSION['USER_id']);
		}

		public static function DeleteEvent($event_id)
		{
			Data::SetData(true, "DELETE FROM gl_event WHERE id = ".$event_id." AND user_id = ".$_SESSION['USER_id']);
		}

		public static function GetEventById ($event_id, $doUserCheck = true)
		{
			$userCheck = "";
			if($doUserCheck)
				$userCheck = "AND gl_event.user_id = ".$_SESSION['USER_id'];

			return Data::GetDataRow("SELECT gl_event.has_guestlist, gl_event.id, gl_event.title, gl_event.date, gl_event.description, gl_event.flyer_url, gl_venue.id as venue_id, gl_venue.name as venue_name, gl_venue.address as venue_address FROM gl_event, gl_venue WHERE gl_event.venue_id = gl_venue.id AND gl_event.id = ".$event_id." ".$userCheck);
		}

		public static function GetGuestlistByEventIdCount ($event_id)
		{
			return Data::GetDataRow("SELECT count(gl_guestlist.id) as count_guestlist FROM gl_guestlist, gl_event WHERE gl_guestlist.event_id = gl_event.id AND gl_event.id = '".$event_id."' AND gl_event.user_id = ".$_SESSION['USER_id']);
		}

		public static function GetGuestlistByEventId ($event_id)
		{
			return Data::GetDataMatrix("SELECT first_name, last_name, email FROM gl_guestlist, gl_event WHERE event_id = '".$event_id."' AND gl_event.id = event_id AND gl_event.user_id = ".$_SESSION['USER_id']." ORDER BY first_name");
		}

		public static function SetNewGuest($event_id, $first_name, $last_name, $email)
		{
			Data::SetData(true, "INSERT INTO gl_guestlist (event_id, first_name, last_name, email) VALUES ('".$event_id."', '".$first_name."', '".$last_name."', '".$email."')");
		}

		public static function GetContentById ($content_id)
		{
			return Data::GetDataRow("SELECT id, description, title, text FROM gl_content WHERE id = ".$content_id);
		}

		public static function GetMainPageContent ()
		{
			return Data::GetContentById(1);
		}

		public static function GetTemplateContent ()
		{
			return Data::GetContentById(2);
		}

		public static function UpdateContent($content_id, $title, $text)
		{
			Data::SetData(true, "UPDATE gl_content SET title = '".$title."', text = '".$text."' WHERE id = '".$content_id."'");
		}

		public static function SetNewUser($first_name, $last_name, $username, $password)
		{
			Data::SetData(true, "INSERT INTO gl_user (first_name, last_name, username, password) VALUES ('".$first_name."', '".$last_name."', '".$username."', '".$password."')");
		}

		public static function UpdateUser($first_name, $last_name, $username, $password)
		{
			Data::SetData(true, "UPDATE gl_user SET first_name = '".$first_name."', last_name = '".$last_name."', username = '".$username."', password = '".$password."' WHERE id = ".$_SESSION['USER_id']);
		}
*/		
	}
?>