<?
	class Layout
	{
		public static function HomePageTemplate ($mainFileName)
		{
			include "template/homepage.php";
		}	

		public static function DefaultTemplate ($mainFileName, $mainNavigation)
		{
			include "template/default.php";
		}		

		public static function DefaultModuleTop ($width, $text)
		{
			echo "<div style='width: ".$width.";'>";
			echo "  <b class='moduleOrangeDarkTop'>";
			echo "  <b class='moduleOrangeDarkTop1'><b></b></b>";
			echo "  <b class='moduleOrangeDarkTop2'><b></b></b>";
			echo "  <b class='moduleOrangeDarkTop3'></b>";
			echo "  <b class='moduleOrangeDarkTop4'></b>";
			echo "  <b class='moduleOrangeDarkTop5'></b></b>";
			echo "  <div class='moduleOrangeDarkfg'>";
			echo "	<div style='text-align: center; padding-bottom: 5px; background-color: #bbbbbb;' class='moduleHeaderText'>";
			echo		$text;
			echo "	</div>";
			echo "	<div style='width: 100%; background-color: #fe8300; height: 1px; font-size: 2px; line-height: 1px; margin-bottom: 10px;'>&nbsp;</div>";
		}

		public static function PlainModuleTop ($width)
		{
			echo "<div style='width: ".$width.";'>";
			echo "  <b class='moduleOrangeDark'>";
			echo "  <b class='moduleOrangeDark1'><b></b></b>";
			echo "  <b class='moduleOrangeDark2'><b></b></b>";
			echo "  <b class='moduleOrangeDark3'></b>";
			echo "  <b class='moduleOrangeDark4'></b>";
			echo "  <b class='moduleOrangeDark5'></b></b>";
			echo "  <div class='moduleOrangeDarkfg'>";
		}

		public static function DefaultModuleBottom ()
		{
			echo "	</div>";
			echo "	<b class='moduleOrangeDark'>";
			echo "	<b class='moduleOrangeDark5'></b>";
			echo "  <b class='moduleOrangeDark4'></b>";
			echo "  <b class='moduleOrangeDark3'></b>";
			echo "  <b class='moduleOrangeDark2'><b></b></b>";
			echo "  <b class='moduleOrangeDark1'><b></b></b></b>";
			echo "</div>";
		}

		public static function NavigationTab ($id, $width, $text, $state)
		{
			echo "<div id='".$id."' style='display: ".$state."; width: ".$width."; margin-right: 10px;'>";
			echo "  <b class='bodyOrange'>";
			echo "  <b class='bodyOrange1'><b></b></b>";
			echo "  <b class='bodyOrange2'><b></b></b>";
			echo "  <b class='bodyOrange3'></b>";
			echo "  <b class='bodyOrange4'></b>";
			echo "  <b class='bodyOrange5'></b></b>";

			echo "  <div class='bodyOrangefg tabText' style='height: 25px; text-align: center'>";
			echo		$text;
			echo "	</div>";
			echo "</div>";
		}

		public static function NavigationTabOff ($id, $width, $text, $state)
		{
			echo "<div id='".$id."Off' style='display: ".$state."; width: ".$width."; margin-right: 10px;'>";
			echo "  <b class='navigationTabOff'>";
			echo "  <b class='navigationTabOff1'><b></b></b>";
			echo "  <b class='navigationTabOff2'><b></b></b>";
			echo "  <b class='navigationTabOff3'></b>";
			echo "  <b class='navigationTabOff4'></b>";
			echo "  <b class='navigationTabOff5'></b></b>";

			echo "  <div class='navigationTabOfffg tabText' style='height: 25px; text-align: center'>";
			echo "		<a href='#' class='tabText' onClick=\"loadContent('".$id."'); return false;\">".$text."</a>";
			echo "	</div>";
			echo "</div>";
		}

		public static function GuestlistForm ($sel1, $sel2)
		{
			echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr class='moduleText'>";
			echo "		<td align='center'>Address Book</td>";
			echo "		<td>&nbsp;</td>";
			echo "		<td align='center'>Potluq Invitees</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td align='left'>";
							Form::Select('sel1', 'sel1', 10, true, 'formBig', 'height: 100px', '', $sel1);						
			echo "		</td>";
			echo "		<td align='center'>";
			echo "			<input type='button' id='rightButton' value='>>' class='formBigButton' onclick=\"moveOptions(document.getElementById('sel1'), document.getElementById('sel2'));\">";
			echo "			<div style='width: 100%; height: 1px; font-size: 2px; line-height: 1px;'>&nbsp;</div>";
			echo "			<input type='button' id='leftButton' value='<<' class='formBigButton' onclick=\"moveOptions(document.getElementById('sel2'), document.getElementById('sel1'));\">";
			echo "		</td>";
			echo "		<td align='right'>";
							Form::Select('sel2', 'sel2', 10, true, 'formBig', 'height: 100px', '', $sel2);
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		public static function AddressBookContact ($contact)
		{
			echo "<div id='rowPotluq".$contact['id']."'>";
			echo "	<table id='rowPotluq' width='100%' cellpadding='0' cellspacing='0' border='0' style='padding-left: 10px; padding-right: 10px;'>";
			echo "		<tr class='moduleText' style='height: 25px'>";
			echo "			<td width='30%' valign='middle'>";
			echo				$contact['f_name']." ".$contact['l_name'];
			echo "			</td>";
			echo "			<td width='30%' valign='middle'>";
			echo				$contact['email'];
			echo "			</td>";
			echo "			<td width='30%' valign='middle' align='right'>";
			echo "				<span><a href='#' class='moduleText' onClick=\"loadEditContact(".$contact['id']."); return false;\">edit</a></span>";
			echo "				<span><a href='#' class='moduleText' onClick=\"deleteContact(".$contact['id'].", '".$contact['f_name']."', '".$contact['l_name']."'); return false;\">delete</a></span>";
			echo "			</td>";
			echo "		</tr>";
			echo "	</table>";
			echo "</div>";
		}

		public static function AddressBookContactBlank ()
		{
			echo "<div id='rowPotluqBlank'>";
			echo "	<table id='rowPotluq' width='100%' cellpadding='0' cellspacing='0' border='0' style='padding-left: 10px; padding-right: 10px;'>";
			echo "		<tr class='moduleText' style='height: 25px'>";
			echo "			<td valign='middle' align='center' style='color: #999999; font-weight: bold'>";
			echo "				no contacts found";
			echo "			</td>";
			echo "		</tr>";
			echo "	</table>";
			echo "</div>";
		}

		public static function AddressBookEditContact ($contact)
		{
			echo "<div id='rowPotluq".$contact['id']."'>";
			echo "	<table id='rowPotluq' width='100%' cellpadding='0' cellspacing='0' border='0' style='padding-left: 10px; padding-right: 10px;'>";
			echo "		<tr class='moduleText' style='height: 25px'>";
			echo "			<td width='25%' valign='middle'>";
								Form::Input('f_name'.$contact['id'], 'f_name'.$contact['id'], 'formBig', 'width: 150px;', $contact['f_name']);
			echo "			</td>";
			echo "			<td width='25%' valign='middle'>";
								Form::Input('l_name'.$contact['id'], 'l_name'.$contact['id'], 'formBig', 'width: 150px;', $contact['l_name']);
			echo "			</td>";
			echo "			<td width='25%' valign='middle'>";
								Form::Input('email'.$contact['id'], 'email'.$contact['id'], 'formBig', 'width: 150px;', $contact['email']);
			echo "			</td>";
			echo "			<td width='25%' valign='middle' align='right'>";
			echo "				<span><a href='#' class='moduleText' onClick=\"updateContact(".$contact['id']."); return false;\">save</a></span>";
			echo "				<span><a href='#' class='moduleText' onClick=\"getContact(".$contact['id']."); return false;\">cancel</a></span>";
			echo "			</td>";
			echo "		</tr>";
			echo "	</table>";
			echo "</div>";
		}

		public static function Potluq ($potluq)
		{
			echo "<div id='rowPotluq".$potluq['id']."'>";
			echo "	<table id='rowPotluq' width='100%' cellpadding='0' cellspacing='0' border='0' style='padding-left: 10px; padding-right: 10px;'>";
			echo "		<tr class='moduleText' style='height: 25px'>";
			echo "			<td width='30%' valign='middle'>";
			echo				date("l, F j, Y",strtotime($potluq['date']));
			echo "			</td>";
			echo "			<td width='75%' valign='middle'>";
			echo "				<a href='#' class='moduleText' onClick=\"loadPotluq(".$potluq['id']."); return false;\">".stripslashes(urldecode($potluq['title']))."</a>";
			echo "			</td>";
			echo "		</tr>";
			echo "	</table>";
			echo "</div>";
		}

		public static function PotluqBlank ()
		{
			echo "<div id='rowPotluqBlank'>";
			echo "	<table id='rowPotluq' width='100%' cellpadding='0' cellspacing='0' border='0' style='padding-left: 10px; padding-right: 10px;'>";
			echo "		<tr class='moduleText' style='height: 25px'>";
			echo "			<td valign='middle' align='center' style='color: #999999; font-weight: bold'>";
			echo "				no potluqs found";
			echo "			</td>";
			echo "		</tr>";
			echo "	</table>";
			echo "</div>";
		}

		public static function PotluqBasics ($potluq)
		{
			echo "<table width='100%' cellpadding='0' cellspacing='0' style='padding-left: 10px; padding-right: 10px; padding-bottom: 5px;'>";
			echo "	<tr class='moduleText'>";
			echo "		<td width='25%' valign='middle'>";
			echo			date("l, F j, Y",strtotime($potluq['date']));
			echo "		</td>";
			echo "		<td width='75%' valign='middle'>";
			echo "			<b>".stripslashes(urldecode($potluq['location']))."</b>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='moduleText'>";
			echo "		<td width='25%' valign='middle'>&nbsp;</td>";
			echo "		<td width='75%' valign='middle'>";
			echo			stripslashes(urldecode($potluq['address']));
			echo "			(<a href='http://maps.google.com/?q=".stripslashes(urldecode($potluq['address']))."' target='_blank'>map</a>)";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr><td colspan='2'>&nbsp;</td></tr>";
			echo "	<tr class='moduleText'>";
			echo "		<td width='25%' valign='middle'>&nbsp;</td>";
			echo "		<td width='75%' valign='middle'>";
			echo			stripslashes(urldecode($potluq['description']));
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		public static function PotluqGuestlist ($potluq_guestlist, $potluq_guestlist_confirmed_count, $potluq_guestlist_awaiting_count)
		{
			echo "<table width='100%' cellpadding='0' cellspacing='0' style='padding: 10px 10px 5px 10px;'>";
			echo "	<tr class='moduleText'>";
			echo "		<td width='25%' valign='top'>";
			echo "			<div>";
			echo "				<b>Guestlist</b>&nbsp;<span id='guestlistEditLink'>(<a href='#' onClick=\"loadPotluqEditGuestlist(".$potluq_guestlist[0]['potluq_id']."); return false;\">edit</a>)</span>";
			echo "			</div>";
			echo "			<div style='margin-top: 10px;'>Confirmed: ".$potluq_guestlist_confirmed_count."</div>";
			echo "			<div>Awaiting: ".$potluq_guestlist_awaiting_count."</div>";
			echo "		</td>";
			echo "		<td width='75%' valign='top'>";
			echo "			<div id='potluqGuestlist'>";

								for($x = 0; $x < count($potluq_guestlist); $x++)
								{
									echo "<div>".$potluq_guestlist[$x]['f_name']." ".$potluq_guestlist[$x]['l_name']."</div>";
								}

			echo "			</div>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		public static function PotluqItems ($potluq_items, $potluq_items_assigned_count, $potluq_items_remaining_count)
		{
			echo "<table width='100%' cellpadding='0' cellspacing='0' style='padding: 10px 10px 5px 10px;'>";
			echo "	<tr class='moduleText'>";
			echo "		<td width='25%' valign='top'>";
			echo "			<div>";
			echo "				<b>Food 'n Drink</b>&nbsp;<span id='itemEditLink'>(<a href='#' onClick=\"loadPotluqEditItem(".$potluq_items[0]['potluq_id']."); return false;\">edit</a>)</span>";
			echo "			</div>";
			echo "			<div style='margin-top: 10px;'>Assigned: ".$potluq_items_assigned_count."</div>";
			echo "			<div>Remaining: ".$potluq_items_remaining_count."</div>";
			echo "		</td>";
			echo "		<td width='75%' valign='top'>";
			echo "			<div id='potluqItem'>";

								for($x = 0; $x < count($potluq_items); $x++)
								{
									echo "<div>".$potluq_items[$x]['name']."</div>";
								}

			echo "			</div>";
			echo "		</td>";
			echo "	</tr>";			
			echo "</table>";
		}

		public static function Message ($message, $isPositive)
		{
			$style = "font-weight: bold;";
			if($isPositive)
			{
				$style = $style."color: green;";
			}
			else
			{
				$style = $style."color: red;";
			}

			return "<span style='".$style."'>".$message."</span>";
		}
	}
?>