<?
	class LayoutHome extends Layout
	{
		public static $DEFAULT_PROFILE_ICON = 'http://www.globalzona.com/oorok/images/icons/instructor.png';

		public static function DisplayInstructorMain ()
		{
			echo "<div style='padding: 3px 0px 5px 20px;' class='text_welcome'>";
			echo $_SESSION['USER_f_name']." ".$_SESSION['USER_l_name'].", you have...";
			echo "</div>";
			echo "<div style='padding: 0px 20px 0px 20px;' class=''>";
					//self::MainInstructorFeed();
			echo "</div>";
		}
		
		public static function InstructorHomeSubNavContent ($welcome_user)
		{
			$items = array (
				0 => array("id" => "current", "text" => $welcome_user),
				1 => array("id" => "home_instructor", "text" => $welcome_user),
				2 => array("id" => "home_address_book", "text" => "Address Book")
			);
			self::SubNavMenu($items);
		}

		public static function InstructorPublicProfileSubNavContent ()
		{
			$items = array (
				0 => array("id" => "current", "text" => "Main"),
				1 => array("id" => "instructor_public_profile_main", "text" => "Main"),
				2 => array("id" => "instructor_public_profile_reviews", "text" => "Reviews"),
				3 => array("id" => "instructor_directory", "text" => "Back to Directory")
			);
			self::SubNavMenu($items);
		}

		public static function MainInstructorFeed ()
		{
			echo "<div id='instructor_main_feed' style='width: 250px; margin-left: auto;  margin-right: auto;' class='text_feed'>";

			echo '<div>';
			echo '  <b class="bg_feed">';
			echo '  <b class="bg_feed1"><b></b></b>';
			echo '  <b class="bg_feed2"><b></b></b>';
			echo '  <b class="bg_feed3"></b>';
			echo '  <b class="bg_feed4"></b>';
			echo '  <b class="bg_feed5"></b></b>';

			echo '  <div class="bg_feedfg" style="">';
			echo "		<div style='padding-top: 3px; padding-bottom: 7px; text-align: center;' class='text_welcome'>";
			echo "			:: Activity Feed ::";
			echo "		</div>";
						
						//get message feed info
						$isThereFeedData = false;
						$unread_message_count = Data::GetUserUnreadMessageCountByUserId($_SESSION['USER_id']);

						if($unread_message_count['message_count'] > 0)
						{
							self::MainFeedItem($unread_message_count['message_count'].' new message(s) received', 'images/icons/mail_35.png', "nav_click_default('instructor_inbox_content', 'true');");
							$isThereFeedData = true;
						}

						//get student request feed info
						self::MainFeedItem('1 student request(s) made', 'images/icons/students_35.png', "alert('clicked');");

						self::MainFeedItem('7 new lesson(s) scheduled', 'images/icons/calendar_35.png', "show_calendar_feed_details();");
						
						//get reviews feed info
						self::MainFeedItem('2 new reviews(s) submitted', 'images/icons/review_35.png', "show_review_feed_details();");

						if(!$isThereFeedData)
							self::MainFeedItem('nothing new', '', "");
			echo '  </div>';

			echo '  <b class="bg_feed">';
			echo '  <b class="bg_feed5"></b>';
			echo '  <b class="bg_feed4"></b>';
			echo '  <b class="bg_feed3"></b>';
			echo '  <b class="bg_feed2"><b></b></b>';
			echo '  <b class="bg_feed1"><b></b></b></b>';
			echo '</div>';
			echo "</div>";
		}

		public static function MainFeedItem ($text, $icon = '', $onClick_function = '')
		{
			echo "<div style='border-top: 1px solid #415e88; padding-top: 3px; padding-left: 15px; padding-right: 15px; padding-bottom: 3px;'>";
			echo "	<table cellpadding='0' cellspacing='0' border='0'>";
			echo "		<tr>";
			echo "			<td>";
								if($icon !=  '')
									echo "<img src='".$icon."' style='width: 35px;'>";
			echo "			</td>";
			echo "			<td valign='middle'>";
			echo "				<a href='#' style='margin-left: 12px;' onClick=\"".$onClick_function."return false;\" onMouseOver=\"$(this).css('text-decoration', 'underline');\" onMouseOut=\"$(this).css('text-decoration', 'none');\">".$text."</a>";
			echo "			</td>";
			echo "		</tr>";
			echo "	</table>";
			


			echo "</div>";
		}

		public static function DisplayInstructorDirectory ($categories)
		{
			$itemsPerRow = 3;
			$columnWidth = round(100 / $itemsPerRow);

			echo "<div id='sub_category_container' style='display: none'>&nbsp;</div>";

			echo "<div id='instructor_directory_container'>";
			echo "	<table width='100%' cellpadding='0' cellspacing='0' border='0' style='padding: 20px;'>";
			echo "		<tr>";
					for($x = 0; $x < count($categories); $x++)
					{
						if($x % $itemsPerRow == 0 && $x > 0)
							echo "</tr><tr>";

						echo "<td valign='top' class='text_instructor_category' align='center' width='".$columnWidth."%'>";
						echo "	<a id='category_link_".$categories[$x]['id']."' href='#' onMouseOver=\"$(this).css('text-decoration','underline');\" onMouseOut=\"$(this).css('text-decoration','none');\" onClick=\"show_sub_categories(".$categories[$x]['id']."); return false;\">";
						echo		$categories[$x]['name'];
						echo "	</a>";
						echo "</td>";
					}
			echo "		</tr>";
			echo "	</table>";
			echo "</div>";
		}

		public static function DisplayInstructorSubDirectory ($sub_categories)
		{
			self::DisplayRoundCornerTop("bg_sub_category");

			echo "<div style='width: 100%; padding: 0px 20px 0px 20px'>";

			for($x = 0; $x < count($sub_categories); $x++)
			{
				echo "<div style='width: 100%; text-align: left;' class='text_instructor_sub_category'>";
				echo "	<a href='#' onClick=\"show_sub_category_results(".$sub_categories[$x]['id'].");return false;\" onMouseOver=\"$(this).css('text-decoration','underline');\" onMouseOut=\"$(this).css('text-decoration','none');\">";
				echo		$sub_categories[$x]['name'];
				echo "	</a>";
				echo "</div>";
			}

			echo "</div>";
			self::DisplayRoundCornerBottom("bg_sub_category","");
		}

		public static function DisplayInstructorSubDirectoryUsers ($sub_category_id, $category_info, $users)
		{
			echo "<div style='text-align: right; padding: 3px 20px 5px 20px;' class='text_read_message'>";
			echo "	<a href='#' onClick=\"nav_click_default('view_index_content', 'false'); return false;\" onMouseOver=\"$(this).css('text-decoration', 'underline');\" onMouseOut=\"$(this).css('text-decoration', 'none');\">Back to directory</a>";
			echo "</div>";

			$header_text = "There are ".$category_info['totalCount']." instructors with the knowledge of <i>".$category_info['sub_category_name']."</i> in the area of <i>".$category_info['category_name']."</i>...";

			if($category_info['totalCount'] == 1)
				$header_text = "There is 1 instructor with the knowledge of <i>".$category_info['sub_category_name']."</i> in the area of <i>".$category_info['category_name']."</i>...";
			else if($category_info['totalCount'] == '')
			{
				$category_info_mini = Data::GetInstructorSubCategoryBasicInfo($sub_category_id);
				$header_text = "There is no instructors with the knowledge of <i>".$category_info_mini['sub_category_name']."</i> in the area of <i>".$category_info_mini['category_name']."</i>";
			}


			echo "<table style='background-color: #eeeeee;' width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr>";
			echo "		<td style='padding: 0px 20px 15px 20px;' class='text_welcome'>";
			echo			$header_text;
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";

			for($x = 0; $x < count($users); $x++)
			{
				self::DisplayInstructorMiniProfile($users[$x]);
			}
		}

		public static function DisplayInstructorMiniProfile ($user)
		{

			$messageClass = "text_read_message";
			$tableColor = "#eeeeee";

			$user_photo_url = "";
			if($user['user_photo_url'] != "")
				$user_photo_url = $user['user_photo_url'];
			else
				$user_photo_url = self::$DEFAULT_PROFILE_ICON;


			echo "<table style='background-color: ".$tableColor."' width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr><td colspan='3'><div style='width: 100%; background-color: #ffffff; height: 1px; font-size: 1px; line-height: 1px;'>&nbsp;</div></td></tr>";
			echo "	<tr id='directory_result_row_".$user['user_id']."' class='".$messageClass."' onMouseOver=\"highlight_directory_result_row(".$user['user_id'].")\" onMouseOut=\"highlight_directory_result_row(".$user['user_id'].")\">";
			echo "		<td style='width: 50px; padding: 5px 0px 5px 20px' valign='top'>";
			echo "			<img src='".$user_photo_url."' width='48'/>";
			echo "		</td>";
			echo "		<td style='padding: 0px 0px 0px 20px' valign='top'>";
			echo "			<a id='directory_result_link_".$user['user_id']."' class='text_unread_message' href='#' onClick=\"show_instructor_public_profile(".$user['user_id']."); return false;\">".$user['l_name'].", ".$user['f_name']."</a>&nbsp;";
			echo "			based in ".$user['city_name'].", ".$user['state'];
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		public static function DisplayInstructorPublicProfile ($user)
		{
			$user_photo_url = "";
			if($user['photo_url'] != "")
				$user_photo_url = $user['photo_url'];
			else
				$user_photo_url = self::$DEFAULT_PROFILE_ICON;

			echo "<div id='container_public_profile'>";
			echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr>";
			echo "		<td style='width: 50px; padding: 5px 0px 5px 20px' valign='top'>";
			echo "			<img src='".$user_photo_url."' width='120'/>";
			echo "		</td>";
			echo "		<td style='padding: 5px 0px 0px 20px' valign='top'>";
			echo "			<div class='text_public_profile_header'>".$user['f_name']." ".$user['l_name']."</div>";
			echo "			<div class='text_public_profile_subheader'>".$user['city_name'].", ".$user['state']."</div>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
			echo "</div>";
		}
	}
?>