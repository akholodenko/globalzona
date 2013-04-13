<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
		echo "<div style='padding: 3px 0px 5px 20px;' class='text_welcome'>";
		echo "	Welcome, ".$_SESSION['USER_f_name']." ".$_SESSION['USER_l_name']."!";
		echo "</div>";
		echo "<div style='padding: 10px 10px 0px 10px; border-top: 1px solid #415e88;' class=''>";
		echo "	[content here]";
		echo "</div>";
	}
?>