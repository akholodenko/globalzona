<?
	include("../classes/database.class.php");	
	include("../classes/data.class.php");

	Data::PostSubmit($_GET['year'], $_GET['make_id'], $_GET['model_id'], $_GET['problem_type_id'], $_GET['problem_id'], $_GET['zipcode']);
	
	$info = Data::GetPostByDetails($_GET['model_id'], $_GET['problem_id']);
	
	echo "<div class='subtitle'><a id='link_check_in' href='#'>Check-in with car trouble</a> | <a id='link_log' href='#'>The Log</a></div>";
	echo "<div class='subtitle'>";
	echo "The ".$info["problem_type"]." problem with the ".$info["problem"]." of your ".$info["year"]." ".$info["make"]." ".$info["model"]." has been submitted! Thank you!";
	echo "</div>";
?>