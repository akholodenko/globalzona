<?
	class Form
	{
		public static function Input ($id, $name, $class, $style, $value)
		{
			echo "<input type='text' id='".$id."' name='".$name."' class='".$class."' style='".$style."' value=\"".$value."\">";
		}
		
		public static function Password ($id, $name, $class, $style, $value)
		{
			echo "<input type='password' id='".$id."' name='".$name."' class='".$class."' style='".$style."' value=\"".$value."\">";
		}

		public static function TextArea ($id, $name, $class, $style, $value)
		{
			echo "<textarea type='text' id='".$id."' name='".$name."' class='".$class."' style='".$style."' wrap='on'>";
			echo	$value;
			echo "</textarea>";
		}

		public static function Button ($id, $name, $class, $style, $value, $JS)
		{
			if ($class == '') $class = 'formButton';

			echo "<input type='button' id='".$id."' name='".$name."' class='".$class."' style='".$style."' value='".$value."' ".$JS.">";
		}

		public static function ButtonSubmit ($id, $name, $class, $style, $value, $JS)
		{
			if ($class == '') $class = 'formButton';

			echo "<input type='submit' id='".$id."' name='".$name."' class='".$class."' style='".$style."' value='".$value."' ".$JS.">";
		}
		
		public static function Select ($id, $name, $size, $multiple, $class, $style, $JS, $data, $selected = "")
		{
			$multipleText = '';
			if($multiple) $multipleText = 'multiple';
			echo "<select name='".$name."' id='".$id."' class='".$class."' size='".$size."' style='".$style."' ".$multipleText." ".$JS.">";
			
			if($data != null)
			{
			for($x = 0; $x < count($data); $x++)
			{
				echo "<option value='".$data[$x]['id']."'";

				if($data[$x]['id'] == $selected) echo " SELECTED";

				echo ">";
				echo	urldecode($data[$x]['name']);
				echo "</option>";
			}
			}

			echo "</select>";
		}		

		public static function DateSelect ($class, $style, $selectedMonth = "", $selectedDay = "", $selectedYear = "")
		{
			$month = null;
			$month[] = array(name => 'month', id => '');
			for($x = 1; $x <= 12; $x++)
			{
				$month[] = array(name => Form::GetMonthString($x), id => $x);
			}
			Form::Select('month', 'month', 1, false, $class, $style, '', $month, $selectedMonth);

			$day = null;
			$day[] = array(name => 'day', id => '');
			for($x = 1; $x <= 31; $x++)
			{
				$day[] = array(name => $x, id => $x);
			}
			Form::Select('day', 'day', 1, false, $class, $style, '', $day, $selectedDay);

			$year = null;
			$year[] = array(name => 'year', id => '');
			for($x = date("Y") - 1; $x <= date("Y") + 1; $x++)
			{
				$year[] = array(name => $x, id => $x);
			}
			Form::Select('year', 'year', 1, false, $class, $style, '', $year, $selectedYear);
		}

		public static function VenueSelect ($class, $style, $selected = "")
		{
			$venues_data = Data::GetVenues();	//get venues info from database
			$venues = null;	//clear venues select array
			$venues[] = array(name => '-=venues=-', id => '');	//set drop down header text

			for($x = 0; $x < count($venues_data); $x++)
			{
				$venues[] = array(name => $venues_data[$x]['name'], id => $venues_data[$x]['id']);
			}
			Form::Select('venues', 'venues', 1, false, $class, $style, '', $venues, $selected);
		}

		public static function HasGuestlistSelect ($class, $style, $selected = "")
		{
			$has_guestlist = null;	//clear venues select array
			$has_guestlist[] = array(name => 'yes', id => '1');
			$has_guestlist[] = array(name => 'no', id => '0');

			Form::Select('has_guestlist', 'has_guestlist', 1, false, $class, $style, '', $has_guestlist, $selected);
		}

		public static function ValidateLogin ($username, $password)
		{
			$userInfo = Data::GetUserInfoByLogin($username);

			if (urldecode($userInfo['username']) == $username && urldecode($userInfo['password']) == $password)
			{
				Session::SetUserInfo($userInfo);

				return true;
			}
			else
				return false;
		}
		
		public static function GetMonthString($n)
		{
			$timestamp = mktime(0, 0, 0, $n, 1, 2005);
			
			return date("F", $timestamp);
		}

		public static function br2nl($string)
		{
			return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
		}

		public static function LoginForm ()
		{
			echo "<table width='250' cellpadding='0' cellspacing='5' border='0' align='center'>";
			echo "	<form action='admin_validate.php' method='POST'>";
			echo "		<input type='hidden' name='type' value='login'>";

				if($_GET['message'] != "") 
				{ 

					echo "<tr class='text_message'>";
					echo "	<td>&nbsp;</td>";
					echo "	<td>".$_GET['message']."</td>";
					echo "</tr>";
				}
			echo "	<tr class='text_body'>";
			echo "		<td width='30%' valign='middle'>";
			echo "			<b>username:</b>";
			echo "		</td>";
			echo "		<td width='70%' valign='middle'>";
							Form::Input('username', 'username', 'form', '', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td valign='middle'>";
			echo "			<b>password:</b>";
			echo "		</td>";
			echo "		<td valign='middle'>";
							Form::Password('password', 'password', 'form', '', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td>&nbsp;</td>";
			echo "		<td>";
							Form::ButtonSubmit('loginButton', 'loginButton', '', '', 'log-in', '');
			echo "		</td>";
			echo "	</tr>";
			echo "</form>";
			echo "</table>";
		}

		public static function AddEventForm ()
		{
			echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
			echo "	<form action='process/process_event_new.php' method='POST'>";
			echo "	<tr class='text_body'>";
			echo "		<td width='60'>Title:</td>";
			echo "		<td>";
							Form::Input('title', 'title', 'form', 'width: 400px;', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td width='60'>Date:</td>";
			echo "		<td>";
							Form::DateSelect ('form', 'width: 100px;');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td width='60'>Venue:</td>";
			echo "		<td>";
							Form::VenueSelect ('form', 'width: 400px;');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td>Flyer URL:</td>";
			echo "		<td>";
							Form::Input('flyer_url', 'flyer_url', 'form', 'width: 400px;', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td valign='top'>Description:</td>";
			echo "		<td>";
							Form::TextArea('description', 'description', 'form', 'width: 400px; height: 200px;', '10:00pm - 2:00am');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td width='60'>Guestlist?:</td>";
			echo "		<td>";
							Form::HasGuestlistSelect ('form', 'width: 200px;');
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

		public static function AddVenueForm ()
		{
			echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
			echo "	<form action='process/process_venue_new.php' method='POST'>";
			echo "	<tr class='text_body'>";
			echo "		<td width='60'>Name:</td>";
			echo "		<td>";
							Form::Input('venue_name', 'venue_name', 'form', 'width: 400px;', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='text_body'>";
			echo "		<td>Address:</td>";
			echo "		<td>";
							Form::Input('venue_address', 'venue_address', 'form', 'width: 400px;', '');
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
	}
?>