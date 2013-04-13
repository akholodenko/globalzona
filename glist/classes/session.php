<?
	class Session
	{
		public static function SetUserInfo ($userInfo)
		{
			$_SESSION['USER_id'] = $userInfo['id'];
			$_SESSION['USER_f_name'] = stripslashes(urldecode($userInfo['first_name']));
			$_SESSION['USER_l_name'] = stripslashes(urldecode($userInfo['last_name']));
			$_SESSION['USER_username'] = $userInfo['username'];
			$_SESSION['USER_password'] = stripslashes(urldecode($userInfo['password']));
		}

		public static function ValidateSession ()
		{
			$dbUserInfo = Data::GetUserInfoById($_SESSION['USER_id']);

			if(	$_SESSION['USER_username'] == $dbUserInfo['username'] && 
				$_SESSION['USER_password'] == $dbUserInfo['password'] && 
				$_SESSION['USER_username'] != '' && 
				$dbUserInfo['password'] != ''
			)
			{
				return true;
			}
			else
			{				
				return false;
			}
		}

		public static function ValidateSessionWithRedirect ()
		{
			if(!Session::ValidateSession())
			{
				header( 'Location: index.php?message=you+are+not+logged+in' );
			}
			else
			{
				return true;
			}
		}
	}
?>