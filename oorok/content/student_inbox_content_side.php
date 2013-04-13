<?
	session_start();
	
	if($_GET['ajax'] == true) 
	{
		$classesPrefix = "../";
		include "../classes/allClasses.php";
	}

	if(Session::ValidateSession())
	{
?>
		<div style='text-align: center;  margin: 25px 0px 20px 0px'>
			<img src='images/icons/mail.png'>
		</div>
<?	} ?>