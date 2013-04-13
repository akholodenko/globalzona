<?
	echo "<div id='HomePagePosts'>";
			if($_GET['postId'] != "")
				Layout::DisplayPost(Data::GetPostByID($_GET['postId']));
	echo "</div>";
?>