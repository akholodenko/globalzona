<?
	include("../classes/database.php");	
	include("../classes/data.php");
	
	//header("Content-type: application/json");
	
	//get username and password from POST data
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$user_info = Data::GetUserInfoByLogin($username);

	if(1)//if($user_info['password'] != '' && $user_info['password'] == $password)
	{
		//success response
		echo '{
			"message": "Your credentials have been confirmed. Logging in...",
        	"status": "true"
		}';
		
		//TODO - Store to SESSION
	}
	else
	{
		//failed response	
		echo '{
			"message": "Unfortunately, your credentials do not match our current records.",
        	"status": "false"
		}';	
	}
?>