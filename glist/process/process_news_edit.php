<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSessionWithRedirect())
	{
		if($_POST['content_id'] != "")
		{
			//replace double quotes with single quotes
			$content_title = urlencode(str_replace("\"", "'", stripslashes($_POST['title'])));
			$content_description =  urlencode(str_replace("\n", "<br/>", stripslashes($_POST['text'])));

			Data::UpdateContent($_POST['content_id'], $content_title, $content_description);
			header( 'Location: ../admin_news.php?&message=updated+content');
		}
		else
		{
			header( 'Location: ../admin_news.php?message=can+not+update+news+-+blank+id' );
		}
	}
?>

