<?
	class Layout
	{
		public static function GListTemplate ($mainFileName, $mainNavigation)
		{
			include "template/glistTemplate.php";
		}

		public static function AdminTemplate ($mainFileName, $mainNavigation)
		{
			include "template/adminTemplate.php";
		}	

		public static function DefaultTemplate ($mainFileName, $mainNavigation)
		{
			include "template/defaultTemplate.php";
		}
		
		public static function AdminPageMessage ($message)
		{
			if($message != '')
			{
				echo "<div class='text_message' style='color: black; background-color: orange; width: 100%; text-align: center; padding: 5px; font-weight: bold'>";
				echo	$message;
				echo "</div>";
			}
		}	

		public static function Navigation ()
		{
			echo "<table align='center' width='900' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr>";
			echo "		<td class='text_nav' width='350'>&nbsp;</td>";

			Layout::NavigationItem("Main","content/main_content.php?remote=true");
			Layout::NavigationItem("Events","content/events_content.php");
			Layout::NavigationItem("Photos","content/photos_content.php");
			Layout::NavigationItem("Affiliates","content/affiliates_content.php");
			Layout::NavigationItem("Contact","content/contact_content.php");

			echo "	</tr>";
			echo "</table>";
		}

		public static function NavigationItem ($text, $dataURL)
		{
			echo "<td class='text_nav' onMouseOut=\"setNavMouseOut(this);\" onMouseOver=\"setNavMouseOver(this);\"><a href='#' onClick=\"loadData('".$dataURL."'); return false;\">".$text."</td>";
		}

		public static function Truncate ($text, $maxlength)
		{
			if(strlen($text) > $maxlength)
			{
				return substr($text, 0, $maxlength - 3)."...";
			}
			else
			{
				return $text;
			}
		}

		public static function EventDetails ($event)
		{
			echo "<table border='0' cellpadding='2' cellspacing='2'>";			
			echo "	<tr class='text_body' valign='top'>";
			echo "		<td width='200'>";
			echo "			<a href='".urldecode($event['flyer_url'])."' class='lightbox'><img src='".urldecode($event['flyer_url'])."' style='width: 200px; border: 1px solid #9dca3a; padding: 5px;'></a>";
			echo "		</td>";
			echo "		<td>";
			echo "			<div style='font-weight: bold'>".urldecode($event['title'])."</div>";
			echo "			<div>".date("l, F j, Y",strtotime($event['date']))."</div>";
			echo "			<p><div style='font-weight: bold'>".urldecode($event['venue_name'])."</div>";
			echo "			<div>".urldecode($event['venue_address'])." (<a href='http://maps.google.com/?q=".urldecode($event['venue_address'])."' target='_blank'>map</a>)</div>";
			echo "			<p><div>".urldecode($event['description'])."</div>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		public static function EventDetailsSimple ($event)
		{
			echo "<table width='500px' border='0' cellpadding='0' cellspacing='0' align='center'>";
			echo "	<tr>";
			echo "		<td>";
			echo "			<img src='http://www.addictionsf.com/images/logo_red.png' style='width: 500px;'>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td align='center'>";
			echo "			<img src='".urldecode($event['flyer_url'])."' style='width: 300px; border: 1px solid #9dca3a; padding: 5px;'>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td align='center' class='title'>";
			echo			urldecode($event['title']);
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td align='center' class='title'>";
			echo "			On ".date("l, F j, Y",strtotime($event['date']))." at <a href='http://maps.google.com/?q=".urldecode($event['venue_address'])."' target='_blank'>".urldecode($event['venue_name'])."</a>" ;
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td align='center' class='text'>";
			echo			urldecode($event['description']);
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
			/*
			echo "		<div style='width: 300px'>";
			echo "			<img src='".urldecode($event['flyer_url'])."' style='width: 300px; border: 1px solid #9dca3a; padding: 5px;'>";
			echo "		</div>";
			echo "		<div class='text_header' style='width: 350px'>";
			echo "			<div style='font-weight: bold'>".urldecode($event['title'])."</div>";
			echo "			<div>".date("l, F j, Y",strtotime($event['date']))."</div>";
			echo "			<p><div style='font-weight: bold'>".urldecode($event['venue_name'])."</div>";
			echo "			<div>".urldecode($event['venue_address'])." (<a href='http://maps.google.com/?q=".urldecode($event['venue_address'])."' target='_blank'>map</a>)</div>";
			echo "			<p><div>".urldecode($event['description'])."</div>";
			echo "		</div>";
			*/
		}

		//MOVE TO FORM CLASS
		public static function GuestlistForm ($event_id)
		{
			echo "<table border='0' cellpadding='2' cellspacing='2'>";
			echo "	<form action='process/process_guestlist_new.php' method='POST' onSubmit=\"return validateGuestlist(this);\">";
			echo "	<input type='hidden' name='event_id' value='".$event_id."'>";
			echo "	<tr class='text_body' style='font-weight: bold'>";
			echo "		<td colspan='2' align='center'>Guestlist Sign-up</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td colspan='2'><hr style='color: #9dca3a;' noshade size='1'></td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td width='110'>First Name:</td>";
			echo "		<td>";
							Form::Input('first_name', 'first_name', 'form', 'width: 300px;', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td>Last Name:</td>";
			echo "		<td>";
							Form::Input('last_name', 'last_name', 'form', 'width: 300px;', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td width='100'>Email:</td>";
			echo "		<td>";
							Form::Input('email', 'email', 'form', 'width: 300px;', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td>&nbsp;</td>";
			echo "		<td>";
							Form::ButtonSubmit('submitButton', 'submitButton', '', '', 'submit', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	</form>";
			echo "</table>";
		}

		public static function EventList ($events, $div_id = "default_event_list")
		{
			echo "<div id=".$div_id." class='transparent_wrap float_right clear_both' style='width: 98%'>";

			echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
			echo "	<tr class='text_body' style='font-weight: bold'>";
			echo "		<td width='15%'>Date</td>";
			echo "		<td width='45%'>Title</td>";
			echo "		<td width='20%'>Venue</td>";
			echo "		<td width='10%'>&nbsp;</td>";
			echo "		<td width='10%'>&nbsp;</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td colspan='5'><div style='width: 100%; border-bottom: 1px red solid' /></td>";
			echo "	</tr>";

			for($x = 0; $x < count($events); $x++)
			{
				echo "<tr class='text_body'>";
				echo "	<td>";
				echo		date("F j, Y",strtotime($events[$x]['date']));
				echo "	</td>";
				echo "	<td>";
				echo "		<a href='admin_event.php?event_id=".$events[$x]['id']."'>".Layout::Truncate(urldecode($events[$x]['title']), 40)."</a>";			
				echo "	</td>";		
				echo "	<td>";
				echo		urldecode($events[$x]['venue_name']);					
				echo "	</td>";	
				echo "	<td><a href='admin_event_edit.php?event_id=".$events[$x]['id']."'>edit</a></td>";
				echo "	<td><a href='process/process_event_delete.php?event_id=".$events[$x]['id']."' onClick=\"return ConfirmDeleteEvent()\">delete</a></td>";
				echo "</tr>";
			}

			echo "</table>";

			echo "</div>";
		}

		public static function VenueList ($venues)
		{
			echo "<div class='transparent_wrap float_right clear_both' style='width: 98%'>";

				echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
				echo "	<tr class='text_body' style='font-weight: bold'>";
				echo "		<td>Name</td>";
				echo "		<td>Address</td>";
				echo "		<td>&nbsp;</td>";
				echo "	</tr>";
				echo "	<tr>";
				echo "		<td colspan='3'><hr style='color: red;' noshade size='1'></td>";
				echo "	</tr>";

				for($x = 0; $x < count($venues); $x++)
				{
					echo "<tr class='text_body'>";
					echo "	<td>";
					echo		urldecode($venues[$x]['name']);			
					echo "	</td>";
					echo "	<td>";
					echo		urldecode($venues[$x]['address']);			
					echo "	</td>";
					echo "	<td><a href='admin_venues_edit.php?venue_id=".$venues[$x]['id']."'>edit</a></td>";
					echo "</tr>";
				}

				echo "</table>";
			echo "</div>";
		}

		public static function VIPList ($vip)
		{
			echo "<div class='transparent_wrap float_right clear_both' style='width: 98%'>";

				echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
				echo "	<tr class='text_body' style='font-weight: bold'>";
				echo "		<td>First Name</td>";
				echo "		<td>Last Name</td>";
				echo "		<td>Email</td>";
				echo "		<td>Phone</td>";
				echo "		<td>&nbsp;</td>";
				echo "		<td style='font-weight: normal'><a href='admin_vip_list.php' target='_blank'>list</a></td>";
				echo "	</tr>";
				echo "	<tr>";
				echo "		<td colspan='6'><hr style='color: red;' noshade size='1'></td>";
				echo "	</tr>";

				for($x = 0; $x < count($vip); $x++)
				{
					echo "<tr class='text_body'>";
					echo "	<td>";
					echo		urldecode($vip[$x]['first_name']);			
					echo "	</td>";
					echo "	<td>";
					echo		urldecode($vip[$x]['last_name']);			
					echo "	</td>";
					echo "	<td>";
					echo		urldecode($vip[$x]['email']);			
					echo "	</td>";
					echo "	<td>";
					echo		urldecode($vip[$x]['phone']);			
					echo "	</td>";
					echo "	<td><a href='admin_vip_edit.php?vip_id=".$vip[$x]['id']."'>edit</a></td>";
					echo "	<td><a href='process/process_vip_delete.php?vip_id=".$vip[$x]['id']."' onClick=\"return ConfirmDeleteVIP('".urldecode($vip[$x]['first_name'])." ".urldecode($vip[$x]['last_name'])."')\">delete</a></td>";
					echo "</tr>";
				}

				echo "</table>";
			
			echo "</div>";
		}

		//MOVE TO FORM CLASS
		public static function VIPForm ($textWidth = '110', $style = 'width: 400px;', $trClass = 'text_body', $showHeader = true, $hrColor = '#9dca3a', $onSubmitJS = '', $onClickJS = '')
		{
			echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
			echo "	<form id='vip_form' ".$onSubmitJS." action='process/process_vip_new.php' method='POST'>";
			
			echo "	<tr class='".$trClass."'>";
			echo "		<td width='".$textWidth."' style='padding-left: 10px; font-weight: bold;'>First Name:</td>";
			echo "		<td>";
							Form::Input('first_name', 'first_name', 'form', $style, '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='".$trClass."'>";
			echo "		<td style='padding-left: 10px; font-weight: bold;'>Last Name:</td>";
			echo "		<td>";
							Form::Input('last_name', 'last_name', 'form', $style, '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='".$trClass."'>";
			echo "		<td style='padding-left: 10px; font-weight: bold;' width='".$textWidth."'>Email:</td>";
			echo "		<td>";
							Form::Input('email', 'email', 'form', $style, '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='".$trClass."'>";
			echo "		<td style='padding-left: 10px; font-weight: bold;'>Phone: (optional)</td>";
			echo "		<td>";
							Form::Input('phone', 'phone', 'form', $style, '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='".$trClass."'>";
			echo "		<td>&nbsp;</td>";
			echo "		<td>";
							Form::ButtonSubmit('submitButton', 'submitButton', '', '', 'submit', $onClickJS);
			echo "		</td>";
			echo "	</tr>";
			echo "	</form>";
			echo "</table>";
		}

		public static function EventTop ($event, $flyerWidth, $showGuestlistLink = true, $isNextEvent = false)
		{
			$next_event_text = "";

			if($isNextEvent)
			{
				echo "<script>";
				echo "	text_blink = new Blink('next_event_".$event['id']."', 500);";
				echo "	text_blink.start();";
				echo "</script>";
				$next_event_text = "<span id='next_event_".$event['id']."' class='text_header_red'>NEXT&nbsp;EVENT:&nbsp;</span>";
			}

			echo "<div class='text_header_black' style='background-color: orange; margin: 10px 0px 10px 0px;'>".$next_event_text.Layout::Truncate(urldecode($event['title']),50)."</div>";
			echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
			echo "	<tr class='text_body'>";
			echo "		<td valign='top' width='".$flyerWidth."' style='padding-left: 10px;'>";
			echo "			<a href='".urldecode($event['flyer_url'])."' class='lightbox'><img src='".urldecode($event['flyer_url'])."' width='".$flyerWidth."' style='border: 1px solid #9dca3a; padding: 5px;'></a>";
			
			if ($showGuestlistLink && $event['has_guestlist'] == 1)
			{
				echo "		<div style='text-align: center; margin-top: 10px;'><a href='http://addictionsf.com/admin_event_sign_up.php?event_id=".$event['id']."' target='_blank'>SIGN UP FOR THE GUESTLIST</a></div>";
			}
			
			echo "		</td>";
			echo "		<td valign='top' style='text-align: right; padding-right: 10px;'>";
			echo "			<div class='text_body_large_white'>".date("l, F j, Y",strtotime($event['date']))."</div>";
			echo "			<p><div style='font-weight: bold'>".urldecode($event['venue_name'])."</div>";
			echo "			<div>".urldecode($event['venue_address'])." (<a href='http://maps.google.com/?q=".urldecode($event['venue_address'])."' target='_blank'>map</a>)</div>";
			echo "			<hr style='color: #9dca3a;' noshade size='1'>";
			echo "			<p><div>".urldecode($event['description'])."</div>";

			if ($showGuestlistLink && $event['has_guestlist'] == 1)
			{
				echo "		<div><a href='http://addictionsf.com/admin_event_sign_up.php?event_id=".$event['id']."' target='_blank'>SIGN UP FOR THE GUESTLIST</a></div>";
			}

			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		public static function EventsMiniList ($events)
		{
			for($x = 1; $x < count($events); $x++)
			{
				Layout::EventTop($events[$x], 150);
			}
		}

		public static function DirectoryList ($directory) 
		{
			// create an array to hold directory list
			$results = array();

			// create a handler for the directory
			$handler = opendir($directory);

			// keep going until all files in directory have been read
			while ($file = readdir($handler)) {

				// if $file isn't this directory or its parent, 
				// add it to the results array
				if ($file != '.' && $file != '..')
					$results[] = $file;
			}

			// tidy up: close the handler
			closedir($handler);
			return $results;
		}

		public static function PhotoAlbum ($directory)
		{
			$images = Layout::DirectoryList($directory);

			echo "<table align='center' cellspacing='0' cellpadding='0' border='0'><tr>";
			for($x = 0; $x < count($images); $x++)
			{
				if(($x % 3) == 0) echo "</tr><tr>";
				echo "<td valign='top'><a href='images/photos/".$images[$x]."' class='lightbox' rel='partypics'><img src='images/photos/".$images[$x]."' width='180' style='border: 1px solid #9dca3a; padding: 5px; margin: 5px;'/></a></td>";
				
			}
			echo "</tr></table>";
		}

		public static function Copyright ()
		{
			echo "<div id='copyright'  class='text_body_small' style='position: fixed; bottom: 0px; width: 100%; background-color: black; border-top: 1px dashed #50671d; padding: 8px 0px 8px 0px;'>";
			echo "		Copyright &copy ".date("Y").". Created by <a href='http://www.globalzona.com/web/' target='_blank'>GZP</a>.";
			echo "		All brands and tradenames are the property of their respective owners.";
			echo "</div>";
		}

		public static function TitleTextContent ($item)
		{
			$title = "(title)";
			$text = "(text)";

			if($item['title'] != "") $title = urldecode($item['title']);
			if($item['text'] != "") $text = urldecode($item['text']);

			echo "<div class='text_header'>".$title."</div>";
			echo "<div class='text_body'>".$text."</div>";
		}

		public static function WelcomeMessage ()
		{
			$welcome_message = Data::GetContentById(1);
			
			if($welcome_message['title'] != "")
			{
				echo "<div class='text_body_large_white' style='margin: 0px 4px 0px 4px;'>";
				echo	urldecode($welcome_message['title']);
				echo "	<hr style='color: white;' noshade size='1'>";
				echo "</div>";
			}
			echo "<div class='text_body_white' style='margin: 0px 15px 10px 15px; text-align: justify;'>";
			echo	urldecode($welcome_message['text']);
			echo "</div>";
		}

		public static function NewsSpecials ()
		{
			$news_content = Data::GetContentById(2);
			
			echo "<div class='text_body_large_white' style='margin: 7px 4px 0px 4px;'>";
			echo	urldecode($news_content['title']);
			echo "	<hr style='color: white;' noshade size='1'>";
			echo "</div>";
			echo "<div class='text_body_white' style='margin: 0px 4px 7px 4px;'>";
			echo	urldecode($news_content['text']);
			echo "</div>";
			echo "<div style='margin: 7px 4px 0px 4px;'>";
			echo "	<hr style='color: white;' noshade size='1'>";
			echo "	<a href='mailto:seva@addictionsf.com?subject=Request for GOGO Dancers Information&body=Please list the following in order for us to get back to you ASAP:  Location, Venue, Time, and what you are looking for.'>";
			echo "		<img src='http://c2.ac-images.myspacecdn.com/images02/32/l_4d910dd61bf44c08a333303f50a64ee9.jpg' width='220' border='0'>";
			echo "	</a>";
			echo "</div>";
			echo "<div style='margin: 7px 4px 0px 4px;'>";
			echo "	<hr style='color: white;' noshade size='1'>";
			echo "	<a href='mailto:vip@addictionsf.com?subject=2Nite Vodka&body='>";
			echo "		<img src='images/affiliates/2nite.png' border='0'>";
			echo "	</a>";
			echo "</div>";
		}

		public static function BoxTab ($text)
		{
			echo "<div class='box_top_large text_tab transparent'>".$text."</div>";
		}
	}
?>