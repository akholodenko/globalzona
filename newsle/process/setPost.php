<?
	$classesIncludePrefix = "../";
	include "../classes/allClasses.php";

	if(Data::ValidatePost($_GET['title'], $_GET['url'], $_GET['categoryId']))
	{
		$post = new Post($_GET['title'], $_GET['url'], $_GET['categoryId']);
		Data::SetPost($post);

		echo "<div class='messageText' style='margin: 3px 15px 0px 15px; text-align: center'>Post Submitted</div>";
	}
	else
	{
		echo "<div class='messageText' style='margin: 3px 15px 0px 15px; text-align: center'>Problem submitting your article.</div>";
	}
?>