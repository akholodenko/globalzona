<?
	class Layout
	{
		public static $IconsArray = array("inbox" => "mail.png");

		public static function DefaultTemplate ($main_content, $side_content, $nav_content)
		{
			include "templates/default.php";
		}

		public static function NavTab ($id, $text, $link, $width, $state, $loadSide = "false", $customText = "")
		{
			Layout::NavTab_ON($id, $text, $link, $width, $state, $customText);
			Layout::NavTab_OFF($id, $text, $link, $width, $state, $customText);
			Layout::NavTab_OVER($id, $text, $link, $width, $loadSide, $customText);
		}

		public static function NavTab_ON ($id, $text, $link, $width, $state, $customText)
		{
			$display = "display: none;";
			if($state == "ON") $display = "display: block;";

			echo "<div id='".$id."' style='width: ".$width."px; float: right; margin-left: 7px; ".$display."'>";
			echo "  <b class='bg_corner'>";
			echo "  <b class='bg_corner1'><b></b></b>";
			echo "	<b class='bg_corner2'><b></b></b>";
			echo "  <b class='bg_corner3'></b>";
			echo "  <b class='bg_corner4'></b>";
			echo "  <b class='bg_corner5'></b></b>";

			echo "		<div class='bg_cornerfg' style='text-align: center'>";
			echo "			<a class='text_nav' href='#' onClick=\"return false;\">".$text.$customText."</a>";
			echo "		</div>";
			echo "</div>";
		}

		public static function NavTab_OFF ($id, $text, $link, $width, $state, $customText)
		{
			$display = "display: none;";
			if($state == "OFF") $display = "display: block;";

			echo "<div id='".$id."_off' style='width: ".$width."px; float: right; margin-left: 7px; ".$display."'>";
			echo "  <b class='nav_off'>";
			echo "  <b class='nav_off1'><b></b></b>";
			echo "	<b class='nav_off2'><b></b></b>";
			echo "  <b class='nav_off3'></b>";
			echo "  <b class='nav_off4'></b>";
			echo "  <b class='nav_off5'></b></b>";

			echo "		<div class='nav_offfg' style='text-align: center'>";
			echo "			<a class='text_nav_off' href='".$link."' onMouseOver=\"nav_off_over('".$id."')\">".$text.$customText."</a>";
			echo "		</div>";
			echo "</div>";
		}

		public static function NavTab_OVER ($id, $text, $link, $width, $loadSide = "false", $customText)
		{
			echo "<div id='".$id."_over' style='width: ".$width."px; float: right; margin-left: 7px; display: none;'>";
			echo "  <b class='nav_over'>";
			echo "  <b class='nav_over1'><b></b></b>";
			echo "	<b class='nav_over2'><b></b></b>";
			echo "  <b class='nav_over3'></b>";
			echo "  <b class='nav_over4'></b>";
			echo "  <b class='nav_over5'></b></b>";

			echo "		<div class='nav_overfg' style='text-align: center'>";
			echo "			<a class='text_nav_over' href='#' onClick=\"nav_click_default('".$id."', '".$loadSide."'); return false;\" onMouseOut=\"nav_out('".$id."')\">".$text.$customText."</a>";
			echo "		</div>";
			echo "</div>";
		}			

		public static function MainHeaderContainer ($type, $custom_data = "")
		{
			//echo "<div style='padding: 3px 10px 10px 10px; width: 100%;'>";
			echo "<table style='padding: 3px 10px 10px 10px;' width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td>";
			echo "<div>";
			echo "	<b class='menu_content'>";
			echo "	<b class='menu_content1'><b></b></b>";
			echo "	<b class='menu_content2'><b></b></b>";
			echo "	<b class='menu_content3'></b>";
			echo "	<b class='menu_content4'></b>";
			echo "	<b class='menu_content5'></b></b>";

			echo "	<div class='menu_contentfg'>";
				
				switch($type)
				{
					case "instructor_inbox":
						LayoutMessage::InboxSubNavContent();
						break;
					case "instructor_home":
						LayoutHome::InstructorHomeSubNavContent($custom_data);
						break;
					case "instructor_profile":
						LayoutProfile::InstructorProfileSubNavContent();
						break;
					case "instructor_calendar":
						LayoutCalendar::InstructorCalendarSubNavContent();
						break;
					case "student_inbox":
						LayoutMessage::InboxSubNavContent();
						break;
					case "instructor_public_profile":
						LayoutHome::InstructorPublicProfileSubNavContent();
						break;
					default:
						echo "&nbsp;";
				}

			echo "	</div>";

			echo "	<b class='menu_content'>";
			echo "	<b class='menu_content5'></b>";
			echo "	<b class='menu_content4'></b>";
			echo "	<b class='menu_content3'></b>";
			echo "	<b class='menu_content2'><b></b></b>";
			echo "	<b class='menu_content1'><b></b></b></b>";
			echo "</div>";
			echo "</td></tr></table>";
			//echo "</div>";
		}		


		

		public static function SubNavMenu ($items)
		{
			echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr>";
			echo "		<td class='sub_nav_current'>::&nbsp;<span id='subnav_current'>".$items[0]['text']."</span>&nbsp;::</td>";
			for($x = 1; $x < count($items); $x++)
			{
				Layout::SubNavItem($items[$x]['id'], $items[$x]['text']);		
			}

			echo "	</tr>";
			echo "</table>";
		}

		public static function SubNavItem ($id, $text)
		{
				echo "	<td class='sub_nav' valign='middle'>";
				echo "		<span id='subnav_".$id."' onMouseOut=\"sub_nav_highlight('subnav_".$id."');\" onMouseOver=\"sub_nav_highlight('subnav_".$id."');\" onClick=\"sub_nav_click('subnav_".$id."', '".$text."');\">".$text."</span>";
				echo "	</td>";
		}	

		public static function BR2NL($string)
		{
			return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
		}

		public static function Truncate($string, $length)
		{
			if(strlen($string) > $length)
				return substr($string, 0, $length - 3).'...';
			else
				return $string;
		}

		public static function DisplayRoundCornerTop ($class)
		{
			echo "<div>";
			echo "	<b class='".$class."'>";
			echo "	<b class='".$class."1'><b></b></b>";
			echo "	<b class='".$class."2'><b></b></b>";
			echo "	<b class='".$class."3'></b>";
			echo "	<b class=".$class."4'></b>";
			echo "	<b class='".$class."5'></b></b>";

			echo "	<div class='".$class."fg'>";
		}		

		public static function DisplayRoundCornerBottom ($class)
		{

			echo "	</div>";

			echo "	<b class='".$class."'>";
			echo "	<b class='".$class."5'></b>";
			echo "	<b class='".$class."4'></b>";
			echo "	<b class='".$class."3'></b>";
			echo "	<b class='".$class."2'><b></b></b>";
			echo "	<b class='".$class."1'><b></b></b></b>";
			echo "</div>";
		}
	}
?>