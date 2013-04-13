<?
	echo "<div id='HomePagePosts'>";
			Layout::DisplayHomePagePosts(Data::GetPostByCategoryID(Config::$GET_RECENT_POSTS_MAX,0,0), true);
	echo "</div>";
	echo "<div id='HomePagePagination'>";
			Layout::DisplayPagination(0,1);
	echo "</div>";
?>