<?
	class Session
	{
		public static function SetUserInfo ($userInfo)
		{
			$_SESSION['USER_id'] = $userInfo['id'];
			$_SESSION['USER_f_name'] = stripslashes(urldecode($userInfo['f_name']));
			$_SESSION['USER_l_name'] = stripslashes(urldecode($userInfo['l_name']));
			$_SESSION['USER_email'] = $userInfo['email'];
			$_SESSION['USER_password'] = stripslashes(urldecode($userInfo['password']));
		}

		public static function ValidateSession ()
		{
			$dbUserInfo = Data::GetUserInfoById($_SESSION['USER_id']);

			if(	$_SESSION['USER_email'] == $dbUserInfo['email'] && 
				$_SESSION['USER_password'] == $dbUserInfo['password'] && 
				$_SESSION['USER_email'] != '' && 
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
		}
	}
?>