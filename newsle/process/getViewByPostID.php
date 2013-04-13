<?
	$classesIncludePrefix = "../";
	include "../classes/allClasses.php";
	
	if($_GET['postId'] != "")
	{
		$postViews = Data::GetViewsByPostID($_GET['postId']);
		echo $postViews[0]['views'];
		if($postViews[0]['views'] == 1)
			echo " view";
		else
			echo " views";
	}
	else
		echo "-1";
?>