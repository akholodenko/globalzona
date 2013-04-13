<?
	class LayoutMessage extends Layout
	{
		public static function DisplayInboxMessages ($messages, $type, $showPermDelete = false)
		{
			$direction = $type;
			if($type == "trash") $direction = "from";

			echo "<table style='background-color: #eeeeee;' width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr>";
			echo "		<td width='25%' style='padding: 3px 0px 5px 20px;' class='text_welcome'>".$direction."</td>";
			echo "		<td width='50%' style='padding: 3px 0px 5px 0px;' class='text_welcome'>subject</td>";
			echo "		<td width='25%' style='padding: 3px 20px 5px 0px; text-align: right;' class='text_welcome'>date</td>";

			if($showPermDelete)
			{
				echo "	<td style='padding: 3px 26px 5px 0px; text-align: right;' class='text_welcome'>&nbsp;</td>";
			}

			echo "	</tr>";
			echo "</table>";

			for($x = 0; $x < count($messages); $x++)
			{
				self::DisplayInboxMessage($messages[$x], $type, $showPermDelete);
			}

			echo "<table style='background-color: #eeeeee' width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "<tr><td><div style='width: 100%; background-color: #ffffff; height: 1px; font-size: 1px; line-height: 1px;'>&nbsp;</div></td></tr>";
			echo "	<tr>";
			echo "		<td style='padding: 0px 0px 0px 20px'>&nbsp;</td>";
			echo "	</tr>";
			echo "</table>";
		}

		public static function DisplayInboxMessage ($message, $type, $showPermDelete = false)
		{
			//make room for delete icon
			if($showPermDelete)
				$colspan = 4;
			else
				$colspan = 3;

			if($message['message_read_status_id'] == 1)
			{
				$messageClass = "text_unread_message";
				$tableColor = "#ffffff";
			}
			else if($message['message_read_status_id'] == 2)
			{
				$messageClass = "text_read_message";
				$tableColor = "#eeeeee";
			}

			echo "<table id='message_table_".$message['message_id']."' style='background-color: ".$tableColor."' width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr><td colspan='".$colspan."'><div style='width: 100%; background-color: #ffffff; height: 1px; font-size: 1px; line-height: 1px;'>&nbsp;</div></td></tr>";
			echo "	<tr id='message_row_".$message['message_id']."' class='".$messageClass."' onMouseOver=\"highlight_message_row(".$message['message_id'].")\" onMouseOut=\"highlight_message_row(".$message['message_id'].")\">";
			echo "		<td width='25%' style='padding: 0px 0px 0px 20px'>";
			echo			$message['from_f_name']." ".$message['from_l_name'];
			echo "		</td>";
			echo "		<td width='45%' style='padding: 0px 0px 0px 0px'>";
			echo "			<a id='message_link_".$message['message_id']."' onClick=\"mark_message_as_read(".$message['message_id'].", ".$message['message_read_status_id']."); show_message_window('".$message['subject']."', '".self::MessagePopUpBody($message, $type)."'); return false;\" target='_blank' href=''>";
			echo 				self::Truncate(rawurldecode($message['subject']), 70);
			echo "			</a>";
			echo "		</td>";
			echo "		<td width='30%' style='text-align: right; padding: 0px 20px 0px 0px'>";
			echo			date("F j, Y @ g:ia",strtotime($message['date']));
			echo "		</td>";

			if($showPermDelete)
			{
				echo "	<td style='text-align: center; padding: 0px 10px 0px 0px'>";
				echo "		<a href='#' onClick=\"delete_message('".$message['message_id']."'); return false;\"><img src='images/icons/delete_mail.png' width='20' border='0'></a>";
				echo "	</td>";		
			}

			echo "	</tr>";
			echo "</table>";
		}

		public static function MessagePopUpNewBody ($contact)
		{
			$message_body = self::MessagePopUpNewNav($contact);
			$message_body = $message_body.self::MessagePopUpNewBodyHeader($contact);
			$message_body = $message_body.self::MessagePopUpNewBodyContent($contact);
			

			return rawurlencode($message_body);
		}

		public static function MessagePopUpNewBodyHeader ($contact)
		{
			$value = "<table width='100%' cellpadding='0' cellspacing='0' border'0' style='border-top: 0px; border-right: 0px; border-left: 0px; border-bottom: 1px solid #555555'>";
			$value = $value."<tr>";
			$value = $value."<td style='border: 0px'>";
			$value = $value."	<div style='width: 100%; padding: 20px 0px 10px 0px' class='text_message_pop_up_header'>To: ".$contact['f_name']." ".$contact['l_name']."</div>";
			$value = $value."</td>";
			$value = $value."<td style='border: 0px'>";
			$value = $value."	&nbsp;";
			$value = $value."</td>";
			$value = $value."</tr>";
			$value = $value."</table>";

			return $value;
		}
		
		public static function MessagePopUpNav ($message)
		{
			return "<div class='text_message_pop_up_nav'>".self::MessagePopUpNavItem(1, 'reply', $message, '', 'mail_reply.png').self::MessagePopUpNavItem(2, 'delete', $message, 'move_message_to_trash('.$message['message_id'].')').self::MessagePopUpNavItem(3, 'mark as unread', $message, 'mark_message_as_unread('.$message['message_id'].', '.$message['message_read_status_id'].')')."</div>";
		}

		public static function MessagePopUpReplyNav ($message)
		{
			$js_function_onClick = "message_pop_up_nav_SEND_CLICK (".$message['from_user_id'].", 'Re: ".$message['subject']."', $('#form_reply_message').val())";
			return "<div class='text_message_pop_up_nav'>".self::MessagePopUpNavItem(4, 'send', '', $js_function_onClick).self::MessagePopUpNavItem(5, 'discard', '')."</div>";
			//return "<div class='text_message_pop_up_nav'>".self::MessagePopUpNavItem(4, 'send', $message).self::MessagePopUpNavItem(5, 'discard', $message)."</div>";
		}

		public static function MessagePopUpBody ($message, $type)
		{
			$message_body = "";
			
			//don't show reply/delete/mark unread nav unless MAIN directory (from)
			if($type != "to" && $type != "trash")
				$message_body = self::MessagePopUpNav($message);

			$message_body = $message_body.self::MessagePopUpBodyHeader($message);

			$message_body = $message_body."<div style='margin-top: 20px'>".$message['body']."</div>";
			return rawurlencode($message_body);
		}

		public static function MessagePopUpReplyOriginalBody ($message)
		{
			return "<div style='margin-top: 10px; font-style: italic; height: 100px; overflow: auto;'>".$message['body']."</div>";
		}

		public static function MessagePopUpReplyBody ($message)
		{
			$message_body = self::MessagePopUpReplyNav($message);
			$message_body = $message_body.self::MessagePopUpBodyReplyHeader($message);
			//$message_body = $message_body.self::MessagePopUpReplyOriginalBody($message);
			//return rawurlencode($message_body);
			return $message_body;
		}

		public static function MessagePopUpNewBodyContent ($contact)
		{
			$value = Form::Input ("form_new_message_subject", "form_new_message_subject", "form_message_field", "width: 100%; margin-top: 10px;", "[subject here]", "onClick=\"text_field_clear_default(this,'[subject here]');\"", true, 100);
			$value = $value.Form::TextArea("form_new_message_body", "form_new_message_body", "form_message_field", "width: 100%; height: 175px; margin-top: 10px;", "[write message here]", "onClick=\"text_field_clear_default(this,'[write message here]');\"", true);

			return $value;
		}

		public static function MessagePopUpNewNav ($contact)
		{
			$js_function_onClick = "message_pop_up_nav_SEND_CLICK (".$contact['contact_user_id'].", escape($('#form_new_message_subject').val()), $('#form_new_message_body').val())";
			return "<div class='text_message_pop_up_nav'>".self::MessagePopUpNavItem(4, 'send', '', $js_function_onClick).self::MessagePopUpNavItem(5, 'discard', '')."</div>";
		}

		public static function MessagePopUpNavItem ($id, $text, $message, $js_function_onClick = "", $icon = "")
		{
			$local_js_function_onClick = "message_pop_up_nav_item_CLICK('".$id."', '".$message['message_id']."')";

			if($js_function_onClick != "")
				$local_js_function_onClick = $js_function_onClick;

			if($icon != "")
				return "<span id='message_pop_up_nav_".$id."' onClick=\"".$local_js_function_onClick."\" onMouseOut=\"highlight_message_pop_up_nav_item_OUT('".$id."')\" onMouseOver=\"highlight_message_pop_up_nav_item_OVER('".$id."')\" style='padding: 2px 10px 2px 10px; margin-right: 5px'>".$text."</span></span>";
			else
				return "<span id='message_pop_up_nav_".$id."' onClick=\"".$local_js_function_onClick."\" onMouseOut=\"highlight_message_pop_up_nav_item_OUT('".$id."')\" onMouseOver=\"highlight_message_pop_up_nav_item_OVER('".$id."')\" style='padding: 2px 10px 2px 10px; margin-right: 5px'>".$text."</span>";
		}

		public static function InboxSubNavContent ()
		{
			$items = array (
				0 => array("id" => "current", "text" => "Main"),
				1 => array("id" => "main", "text" => "Main"),
				2 => array("id" => "sent", "text" => "Sent"),
				3 => array("id" => "trash", "text" => "Trash")
				
			);
			self::SubNavMenu($items);
		}

		
		public static function MessagePopUpBodyHeader ($message)
		{
			$message_participant_type = "";
			if($message['message_participant_type'] == 'to')
				$message_participant_type = "To: ";
			else if($message['message_participant_type'] == 'from')
				$message_participant_type = "From:";


			$value = "<table width='100%' cellpadding='0' cellspacing='0' border'0' style='border-top: 0px; border-right: 0px; border-left: 0px; border-bottom: 1px solid #555555'>";
			$value = $value."<tr>";
			$value = $value."<td style='border: 0px'>";
			$value = $value."	<div style='width: 100%; padding: 20px 0px 10px 0px' class='text_message_pop_up_header'>".$message_participant_type." ".$message['from_f_name']." ".$message['from_l_name']."</div>";
			$value = $value."</td>";
			$value = $value."<td style='border: 0px'>";
			$value = $value."	<div style='width: 100%; text-align: right; padding: 20px 0px 10px 0px' class='text_message_pop_up_header'>".date("F j, Y",strtotime($message['date']))." :: ".date("g:ia",strtotime($message['date']))."</div>";
			$value = $value."</td>";
			$value = $value."</tr>";
			$value = $value."</table>";

			return $value;
		}

		public static function MessagePopUpBodyReplyHeader ($message)
		{
			$value = "<table width='100%' cellpadding='0' cellspacing='0' border'0' style='border-top: 0px; border-right: 0px; border-left: 0px; border-bottom: 1px solid #555555'>";
			$value = $value."<tr>";
			$value = $value."<td style='border: 0px'>";
			$value = $value."	<div style='width: 100%; padding: 20px 0px 10px 0px' class='text_message_pop_up_header'>To: ".$message['from_f_name']." ".$message['from_l_name']."</div>";
			$value = $value."</td>";
			$value = $value."<td style='border: 0px'>";
			$value = $value."	&nbsp;";
			$value = $value."</td>";
			$value = $value."</tr>";
			$value = $value."</table>";

			return $value;
		}
	}
?>