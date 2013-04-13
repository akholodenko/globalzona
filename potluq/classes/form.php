<?
	class Form
	{
		public static function Input ($id, $name, $class, $style, $value)
		{
			echo "<input type='text' id='".$id."' name='".$name."' class='".$class."' style='".$style."' value='".$value."'>";
		}
		
		public static function Password ($id, $name, $class, $style, $value)
		{
			echo "<input type='password' id='".$id."' name='".$name."' class='".$class."' style='".$style."' value='".$value."'>";
		}

		public static function Button ($id, $name, $class, $style, $value, $JS)
		{
			if ($class == '') $class = 'formBigButton';

			echo "<input type='button' id='".$id."' name='".$name."' class='".$class."' style='".$style."' value='".$value."' ".$JS.">";
		}
		
		public static function Select ($id, $name, $size, $multiple, $class, $style, $JS, $data)
		{
			$multipleText = '';
			if($multiple) $multipleText = 'multiple';
			echo "<select name='".$name."' id='".$id."' class='".$class."' size='".$size."' style='".$style."' ".$multipleText." ".$JS.">";
			
			if($data != null)
			{
			for($x = 0; $x < count($data); $x++)
			{
				echo "	<option value='".$data[$x]['id']."'>".$data[$x]['name']."</option>";
			}
			}

			echo "</select>";
		}		

		public static function DateSelect ($class)
		{
			$month = null;
			$month[] = array(name => 'month', id => '');
			for($x = 1; $x <= 12; $x++)
			{
				$month[] = array(name => $x, id => $x);
			}
			Form::Select('month', 'month', 1, false, $class, '', '', $month);

			$day = null;
			$day[] = array(name => 'day', id => '');
			for($x = 1; $x <= 31; $x++)
			{
				$day[] = array(name => $x, id => $x);
			}
			Form::Select('day', 'day', 1, false, $class, '', '', $day);

			$year = null;
			$year[] = array(name => 'year', id => '');
			for($x = date("Y"); $x <= date("Y") + 1; $x++)
			{
				$year[] = array(name => $x, id => $x);
			}
			Form::Select('year', 'year', 1, false, $class, '', '', $year);
		}

		public static function ValidateLogin ($email, $password)
		{
			$userInfo = Data::GetUserInfoByEmail($email);

			if (urldecode($userInfo['email']) == $email && urldecode($userInfo['password']) == $password)
			{
				Session::SetUserInfo($userInfo);

				return true;
			}
			else
				return false;
		}

		public static function ValidateSignup ($f_name, $l_name, $email, $password)
		{
			

			if ($f_name == '' || $l_name == '' || $email == '' || $password == '')
			{		
				return false;
			}
			else
			{
				//get info from database based on submitted email
				$userInfo = Data::GetUserInfoByEmail($email);

				//if email already exists in the system; no repeat emails
				if (urldecode($userInfo['email']) == $email)
				{
					return false;
				}
				else
				{
					$return_id = Data::SetUser($f_name, $l_name, $email, $password);
					
					$userInfo = Data::GetUserInfoById($return_id);
					Session::SetUserInfo($userInfo);
					return true;
				}
			}
		}
	}
?>