<?
	$message_count = Data::GetUserUnreadMessageCountByUserId($_SESSION['USER_id']);

	Layout::NavTab("instructor_profile_content", "Profile","","100", "OFF", "true");
	Layout::NavTab("instructor_calendar_content", "Calendar","","100", "OFF", "true");
	Layout::NavTab("instructor_inbox_content", "Inbox","","105", "OFF", "true", "&nbsp;(<span id='nav_inbox_message_count' class='nav_inbox_message_count_class'>".$message_count['message_count']."</span>)");
	Layout::NavTab("instructor_home_content", "Home","","100", "ON", "true");
?>