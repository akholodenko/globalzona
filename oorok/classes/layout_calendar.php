<?
	class LayoutCalendar extends Layout
	{
		public static function InstructorCalendarSubNavContent ()
		{
			$items = array (
				0 => array("id" => "current", "text" => 'Main'),
				1 => array("id" => "calendar_instructor_main", "text" => 'Main'),
				2 => array("id" => "calendar_instructor_add_lesson", "text" => 'Add Lesson')
			);
			self::SubNavMenu($items);
		}

		public static function DisplayInstructorCalendar ($user)
		{

		}
	}
?>