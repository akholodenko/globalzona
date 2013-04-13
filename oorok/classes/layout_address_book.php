<?
	class LayoutAddressBook extends Layout
	{
		public static function DisplayAddressBook ($address_book)
		{
			echo "<table style='background-color: #eeeeee;' width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr>";
			echo "		<td width='25%' style='padding: 3px 0px 5px 20px;' class='text_welcome'>last, first name</td>";
			echo "		<td width='25%' style='padding: 3px 0px 5px 0px;' class='text_welcome'>email</td>";
			echo "		<td width='25%' style='padding: 3px 0px 5px 0px;' class='text_welcome'>phone</td>";
			echo "		<td width='25%' style='padding: 3px 20px 5px 0px; text-align: right;' class='text_welcome'>&nbsp;</td>";
			echo "	</tr>";
			echo "</table>";

			for($x = 0; $x < count($address_book); $x++)
			{
				self::DisplayAddressBookContact($address_book[$x]);
			}

			echo "<table style='background-color: #eeeeee' width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "<tr><td><div style='width: 100%; background-color: #ffffff; height: 1px; font-size: 1px; line-height: 1px;'>&nbsp;</div></td></tr>";
			echo "	<tr>";
			echo "		<td style='padding: 0px 0px 0px 20px'>&nbsp;</td>";
			echo "	</tr>";
			echo "</table>";
		}

		public static function DisplayAddressBookContact ($contact)
		{
			$colspan = 4;

			$messageClass = "text_read_message";
			$tableColor = "#eeeeee";


			echo "<table style='background-color: ".$tableColor."' width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr><td colspan='".$colspan."'><div style='width: 100%; background-color: #ffffff; height: 1px; font-size: 1px; line-height: 1px;'>&nbsp;</div></td></tr>";
			echo "	<tr id='address_book_row_".$contact['contact_user_id']."' class='".$messageClass."' onMouseOver=\"highlight_address_book_row(".$contact['contact_user_id'].")\" onMouseOut=\"highlight_address_book_row(".$contact['contact_user_id'].")\">";
			echo "		<td width='25%' style='padding: 0px 0px 0px 20px'>";
			echo			$contact['l_name'].", ".$contact['f_name'];
			echo "		</td>";
			echo "		<td width='25%' style='padding: 0px 0px 0px 0px'>";
			echo 			$contact['email'];
			echo "		</td>";
			echo "		<td width='25%' style='padding: 0px 0px 0px 0px'>";
			echo 				$contact['phone'];
			echo "		</td>";
			echo "		<td width='25%' style='text-align: right; padding: 0px 20px 0px 0px'>";
			echo "			<a id='address_book_link_".$contact['contact_user_id']."' onClick=\"show_message_window('New Message', '".LayoutMessage::MessagePopUpNewBody($contact)."'); return false;\" href='#'>";
			echo "				send message";
			echo "			</a>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}
	}
?>