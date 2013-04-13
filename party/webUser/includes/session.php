<?
	//session_save_path("/home/users/web/b1355/va.artem25/cgi-bin/tmp");
	session_start(); 

	include "../classes/database.php";
	include "classes/session.php";

	if ($_POST["login"] == "true")	//Logging In
	{
		$session = new Session();

		if(!$session->ValidateUser($_POST["email"],$_POST["password"])) 
		{
			header('Location: http://www.globalzona.com/party/webUser/login.php?failedLogin=true');
		}
	}
	else if ($_POST["register"] == "true")	//Registering
	{
		$session = new Session();

		if(!$session->RegisterUser($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]))
			header('Location: http://www.globalzona.com/party/webUser/login.php?failedRegistration=true&message='.urlencode($session->GetMessage()));
	}
	else	//Accessing page directly
	{
		$session = new Session();
		if(!$session->ValidateUser($_SESSION["email"],$_SESSION["password"])) 
			header('Location: http://www.globalzona.com/party/webUser/login.php?sessionEmpty=true&'.$_SERVER['QUERY_STRING']);
	}

	//if ($IsUserValid) header('Location: http://www.globalzona.com/party/webUser/login.php?failedLogin=true');
	//header('Location: http://www.globalzona.com/party/test.php?set=true');
?>