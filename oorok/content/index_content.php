<?
	echo "<table style='padding: 0px 20px 0px 20px' width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td>";	

	echo "<div class='text_welcome' id='sub_container_content_main' >";
	echo "	Please browse the directories to find the right instructor for you:";
			LayoutHome::DisplayInstructorDirectory(Data::GetInstructorCategories());
	echo "</div>";

	echo "</td></tr></table>";
?>