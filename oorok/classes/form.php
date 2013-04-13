<?
	class Form
	{
		public static function ValidateLogin ($email, $password)
		{
			$userInfo = Data::GetUserInfoByLogin($email);

			if (urldecode($userInfo['email']) == $email && urldecode($userInfo['password']) == $password)
			{
				Session::SetUserInfo($userInfo);

				return true;
			}
			else
				return false;
		}

		public static function Input ($id, $name, $class, $style, $value, $js = "", $returnAsString = false, $maxlength = 500)
		{
			$field_html = "<input type='text' id='".$id."' name='".$name."' ".$js."class='".$class."' style='".$style."' value=\"".$value."\" maxlength='".$maxlength."' />";

			if($returnAsString)
				return $field_html;
			else
				echo $field_html;
		}
		
		public static function Password ($id, $name, $class, $style, $value)
		{
			echo "<input type='password' id='".$id."' name='".$name."' class='".$class."' style='".$style."' value=\"".$value."\">";
		}

		public static function TextArea ($id, $name, $class, $style, $value, $js = "", $returnAsString = false)
		{
			$field_html = "<textarea type='text' id='".$id."' name='".$name."' ".$js." class='".$class."' style='".$style."' wrap='on'>";
			$field_html =	$field_html.$value;
			$field_html =	$field_html."</textarea>";

			if($returnAsString)
				return $field_html;
			else
				echo $field_html;
		}

		public static function Button ($id, $name, $class, $style, $value, $JS)
		{
			if ($class == '') $class = 'formButton';

			echo "<input type='button' id='".$id."' name='".$name."' class='".$class."' style='".$style."' value='".$value."' ".$JS.">";
		}

		public static function ButtonSubmit ($id, $name, $class, $style, $value, $JS = "")
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
			for($x = date("Y"); $x <= date("Y") + 1; $x++)
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

		
		
		public static function GetMonthString($n)
		{
			$timestamp = mktime(0, 0, 0, $n, 1, 2005);
			
			return date("F", $timestamp);
		}

		public static function br2nl($string)
		{
			return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
		}
	}
?>