<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		if($_GET['message_id'] != '')
		{
			$message = Data::GetReceivedMessageById($_GET['message_id']);
			echo LayoutMessage::MessagePopUpReplyBody($message);

			$message_original_body = "\n\n-----original message-----\n".LayoutMessage::BR2NL(rawurldecode($message['body']));
			Form::TextArea("form_reply_message", "form_reply_message", "form_message_field", "width: 100%; height: 175px; margin-top: 10px;", $message_original_body);
		}
	}
	else
	{
		echo "Not logged in.";
	}
?>