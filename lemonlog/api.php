<?
	include("classes/database.class.php");	
	include("classes/data.class.php");
	
	//models by year/make
	if($_GET['f'] == 1)
	{
		$info = Data::GetCarModels($_GET['year'], $_GET['make_id']);
		
		echo "{";
		
		for($x = 0; $x < count($info); $x++)
		{
			if($x > 0)
				echo ", ";
				
			echo '"model'.$x.'": {
					"model_id": "'.$info[$x]['id'].'",
					"make_id": "'.$info[$x]['make_id'].'",
					"year":"'.$info[$x]["year"].'",
					"name":"'.$info[$x]["name"].'"							
				}';
		}
		
		echo "}";
	}
	
	//problem list by problem type id
	else if($_GET['f'] == 2)
	{
		$info = Data::GetCarProblem($_GET['problem_type_id']);
		
		echo "{";
		
		for($x = 0; $x < count($info); $x++)
		{
			if($x > 0)
				echo ", ";
				
			echo '"problem'.$x.'": {
					"problem_id": "'.$info[$x]['id'].'",
					"problem_type_id": "'.$info[$x]['problem_type_id'].'",
					"name":"'.$info[$x]["name"].'"							
				}';
		}
		
		echo "}";
	}
	
	//make list by year
	else if($_GET['f'] == 3)
	{
		$info = Data::GetCarMakes($_GET['year']);
		
		echo "{";
		
		for($x = 0; $x < count($info); $x++)
		{
			if($x > 0)
				echo ", ";
				
			echo '"make'.$x.'": {
					"make_id": "'.$info[$x]['id'].'",
					"name":"'.$info[$x]["name"].'"							
				}';
		}
		
		echo "}";
	}
?>