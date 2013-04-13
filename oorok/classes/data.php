<?
	class Data
	{
		//runs query in database
		private static function SetData ($autoClose, $query)
		{
			$db = Database::getInstance();
			$db->ExecuteQuery($query, $autoClose);
		}

		//returns raw results of the input query or -1 (error)
		private static function GetData ($query)
		{
			$db = Database::getInstance();
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


		public static function GetUserInfoByLogin ($email)
		{
			return Data::GetDataRow("SELECT id, f_name, l_name, email, password, account_type_id, about, phone FROM user WHERE email = '".$email."'");
		}

		public static function GetUserInfoById ($id)
		{			
			return Data::GetDataRow("SELECT c.name as city_name, s.abbr as state, u.photo_url as photo_url, aT.name as account_type, u.id as id, f_name, l_name, email, password, account_type_id, about, phone FROM user u, account_type aT, city c, state s WHERE u.id = '".$id."' AND aT.id = u.account_type_id AND c.id = u.city_id AND s.id = c.state_id");
		}

		public static function GetUserUnreadMessageCountByUserId ($user_id)
		{
			//echo "SELECT COUNT(mP.message_id) as message_count FROM messageParticipants mP WHERE mP.user_id = ".$user_id." AND mP.message_participant_type = 'to' AND mP.message_read_status_id = 1";

			// GROUP BY mP.user_id
			return Data::GetDataRow("SELECT COUNT(mP.message_id) as message_count FROM messageParticipants mP WHERE mP.user_id = ".$user_id." AND mP.message_participant_type = 'to' AND mP.message_read_status_id = 1");
		}

		public static function GetReceivedMessagesByUserId ($user_id)
		{
			return Data::GetDataMatrix("SELECT m.id as message_id, m.subject, m.body, m.date, mP2.user_id as from_user_id, u.f_name as from_f_name, u.l_name as from_l_name, mP.message_read_status_id FROM message m, messageParticipants mP, messageParticipants mP2, user u WHERE m.id = mP.message_id AND mP2.message_participant_type = 'from' AND mP2.message_id = m.id AND mP.message_participant_type = 'to' AND mP.user_id = ".$user_id." AND mP2.user_id = u.id ORDER BY m.date DESC");
		}

		public static function GetInboxMessagesByUserId ($user_id)
		{
			return Data::GetDirectoryMessagesByUserId($user_id, 1, 'to');
		}

		public static function GetSentMessagesByUserId ($user_id)
		{
			return Data::GetDirectoryMessagesByUserId($user_id, 2, 'from');
		}

		public static function GetTrashMessagesByUserId ($user_id)
		{
			return Data::GetDirectoryMessagesByUserId($user_id, 3, 'to');
		}

		//returns array of messages marked under inputted directory
		private static function GetDirectoryMessagesByUserId ($user_id, $directory_id, $message_participant_type)
		{
			$message_participant_type_X = '';
			if($message_participant_type == 'from')
				$message_participant_type_X = 'to';
			else
				$message_participant_type_X = 'from';

			return Data::GetDataMatrix("SELECT m.id as message_id, m.subject, m.body, m.date, mP2.user_id as from_user_id, u.f_name as from_f_name, u.l_name as from_l_name, mP.message_read_status_id, mP2.message_participant_type FROM message m, messageParticipants mP, messageParticipants mP2, user u WHERE m.id = mP.message_id AND mP2.message_participant_type = '".$message_participant_type_X."' AND mP2.message_id = m.id AND mP.message_participant_type = '".$message_participant_type."' AND mP.message_directory_id = ".$directory_id." AND mP.user_id = ".$user_id." AND mP2.user_id = u.id ORDER BY m.date DESC");
		}

		public static function GetReceivedMessageById ($id)
		{
			return Data::GetDataRow("SELECT m.id as message_id, m.subject, m.body, m.date, u.f_name as from_f_name, u.l_name as from_l_name, u.id as from_user_id FROM message m, messageParticipants mP, user u WHERE m.id = ".$id." AND mP.message_id = m.id AND mP.message_participant_type = 'from' AND mP.user_id = u.id");
		}

		public static function GetAddressBookByUserId ($user_id)
		{
			return Data::GetDataMatrix("SELECT u.id as contact_user_id, u.f_name, u.l_name, u.email, u.about, u.phone FROM addressBook aB, user u WHERE aB.owner_user_id = ".$user_id." AND aB.contact_user_id = u.id ORDER BY l_name, f_name ASC");
		}

		public static function UpdateUserNameByUserId($user_id, $f_name, $l_name)
		{
			Data::SetData(true, "UPDATE user SET f_name = '".$f_name."', l_name = '".$l_name."' WHERE id = '".$user_id."'");
		}

		public static function UpdateUserPhoneByUserId($user_id, $phone)
		{
			Data::SetData(true, "UPDATE user SET phone = '".$phone."' WHERE id = '".$user_id."'");
		}

		public static function UpdateMessageReadStatus($user_id, $message_id, $message_read_status_id)
		{
			Data::SetData(true, "UPDATE messageParticipants SET message_read_status_id = '".$message_read_status_id."' WHERE user_id = '".$user_id."' AND message_id = '".$message_id."'");
		}

		public static function MoveMessageToTrash ($user_id, $message_id)
		{
			self::UpdateMessageDirectory($user_id, $message_id, 3);
		}

		public static function UpdateMessageDirectory($user_id, $message_id, $directory_id)
		{
			Data::SetData(true, "UPDATE messageParticipants SET message_directory_id = '".$directory_id."' WHERE user_id = '".$user_id."' AND message_id = '".$message_id."'");
		}
		
		public static function DeleteMessageFromUser($user_id, $message_id)
		{
			Data::SetData(true, "DELETE FROM messageParticipants WHERE user_id = '".$user_id."' AND message_id = '".$message_id."'");
		}

		public static function SetNewMessage($from_user_id, $to_user_id, $subject, $body)
		{
			//create message
			Data::SetData(false, "INSERT INTO message (subject, body) VALUES ('".$subject."', '".$body."')");
						
			$message_id = mysql_insert_id();	//get new message id
			mysql_close();	//close database connection

			//create instance for SENT (from user)
			Data::SetData(false, "INSERT INTO messageParticipants (message_id, message_participant_type, user_id, message_read_status_id, message_directory_id) VALUES ('".$message_id."', 'from', '".$from_user_id."', '2', '2')");

			//create instance for INBOX (to user)
			Data::SetData(false, "INSERT INTO messageParticipants (message_id, message_participant_type, user_id, message_read_status_id, message_directory_id) VALUES ('".$message_id."', 'to', '".$to_user_id."', '1', '1')");

		}

		public static function GetInstructorCategories ()
		{
			return Data::GetDataMatrix("SELECT * FROM instructorCategory ORDER BY name ASC");
		}

		public static function GetInstructorSubCategoriesByCategoryId ($category_id)
		{
			return Data::GetDataMatrix("SELECT * FROM instructorSubCategory WHERE instructor_category_id = ".$category_id." ORDER BY name ASC");
		}

		public static function GetUserInfoBySubCategoryId ($sub_category_id)
		{
			return Data::GetDataMatrix("SELECT u.id as user_id, u.f_name, u.l_name, u.photo_url as user_photo_url, c.name as city_name,  s.abbr as state FROM user u, instructorCategoryMap iCM, city c, state s WHERE iCM.instructor_sub_category_id = ".$sub_category_id." AND iCM.instructor_user_id = u.id AND s.id = c.state_id AND u.city_id = c.id ORDER BY u.l_name ASC");
		}

		public static function GetInstructorSubCategoryCount ($sub_category_id)
		{
			return Data::GetDataRow("SELECT count(iSC.id) as totalCount, iC.name as category_name, iSC.name as sub_category_name FROM instructorSubCategory iSC,instructorCategoryMap iCM, instructorCategory iC WHERE iSC.id = ".$sub_category_id." AND iCM.instructor_sub_category_id = iSC.id AND iC.id = iSC.instructor_category_id GROUP BY iSC.id");
		}

		public static function GetInstructorSubCategoryBasicInfo ($sub_category_id)
		{
			return Data::GetDataRow("SELECT iC.name as category_name, iSC.name as sub_category_name FROM instructorSubCategory iSC, instructorCategory iC WHERE iSC.id = ".$sub_category_id." AND iC.id = iSC.instructor_category_id");
		}
/*
		public static function GetVenues ()
		{
			return Data::GetDataMatrix("SELECT id, name, address FROM venue ORDER BY name");
		}

		

		
		
		

		public static function GetVIP ($order = "first_name")
		{
			return Data::GetDataMatrix("SELECT id, first_name, last_name, email, phone FROM vip ORDER BY ".$order);
		}

		public static function SetNewVIP($first_name, $last_name, $email, $phone)
		{
			Data::SetData(true, "INSERT INTO vip (first_name, last_name, email, phone) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$phone."')");
		}

		public static function DeleteVIP($vip_id)
		{
			Data::SetData(true, "DELETE FROM vip WHERE id = ".$vip_id);
		}

		public static function GetVIPByEmail ($email)
		{
			return Data::GetDataMatrix("SELECT id, first_name, last_name, email, phone FROM vip WHERE email = '".$email."'");
		}

		public static function UpdateVIP($vip_id, $first_name, $last_name, $email, $phone)
		{
			Data::SetData(true, "UPDATE vip SET first_name = '".$first_name."', last_name = '".$last_name."', email = '".$email."', phone = '".$phone."' WHERE id = '".$vip_id."'");
		}

		public static function GetEventsCount ($status)
		{
			$limit = "";
			if($status == "future") $limit = "WHERE date >= '".date("Y-m-d",time())."'";
			else if($status == "past") $limit = "WHERE date < '".date("Y-m-d",time())."'";

			return Data::GetDataRow("SELECT count(id) as count_events FROM event ".$limit);
		}

		public static function GetVenuesCount ()
		{
			return Data::GetDataRow("SELECT count(id) as count_venues FROM venue");
		}

		public static function GetVIPCount ()
		{
			return Data::GetDataRow("SELECT count(id) as count_vip FROM vip");
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
			
			return Data::GetDataMatrix("SELECT event.has_guestlist, event.id, event.title, event.date, event.description, event.flyer_url, venue.name as venue_name, venue.address as venue_address FROM event, venue WHERE event.venue_id = venue.id ".$limit." ORDER BY date ".$order);
		}

		public static function SetNewEvent($title, $date, $venue_id, $flyer_url, $description, $has_guestlist)
		{
			Data::SetData(true, "INSERT INTO event (title, date, venue_id, flyer_url, description, has_guestlist) VALUES ('".$title."', '".$date."', '".$venue_id."', '".$flyer_url."', '".$description."', '".$has_guestlist."')");
		}

		public static function UpdateEvent($event_id, $title, $date, $venue_id, $flyer_url, $description, $has_guestlist)
		{
			Data::SetData(true, "UPDATE event SET title = '".$title."', date = '".$date."', venue_id = '".$venue_id."', flyer_url = '".$flyer_url."', description = '".$description."', has_guestlist = '".$has_guestlist."' WHERE id = '".$event_id."'");
		}

		public static function DeleteEvent($event_id)
		{
			Data::SetData(true, "DELETE FROM event WHERE id = ".$event_id);
		}

		public static function GetEventById ($event_id)
		{
			return Data::GetDataRow("SELECT event.has_guestlist, event.id, event.title, event.date, event.description, event.flyer_url, venue.id as venue_id, venue.name as venue_name, venue.address as venue_address FROM event, venue WHERE event.venue_id = venue.id AND event.id = ".$event_id);
		}

		public static function GetGuestlistByEventIdCount ($event_id)
		{
			return Data::GetDataRow("SELECT count(guestlist.id) as count_guestlist FROM guestlist, event WHERE guestlist.event_id = event.id AND event.id = '".$event_id."'");
		}

		public static function GetGuestlistByEventId ($event_id)
		{
			return Data::GetDataMatrix("SELECT first_name, last_name, email FROM guestlist WHERE event_id = '".$event_id."' ORDER BY first_name");
		}

		public static function SetNewGuest($event_id, $first_name, $last_name, $email)
		{
			Data::SetData(true, "INSERT INTO guestlist (event_id, first_name, last_name, email) VALUES ('".$event_id."', '".$first_name."', '".$last_name."', '".$email."')");
		}

		public static function GetContentById ($content_id)
		{
			return Data::GetDataRow("SELECT id, description, title, text FROM content WHERE id = ".$content_id);
		}

		public static function GetMainPageContent ()
		{
			return Data::GetContentById(1);
		}

		public static function GetTemplateContent ()
		{
			return Data::GetContentById(2);
		}
		*/
	}
?>