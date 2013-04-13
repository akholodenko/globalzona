<?
function findMe ($text, $needle)
{
	$result = explode(" ", $text);
	$index = 0;
	$count = 0;

	foreach ($result as $value) 
	{
		if(strtolower($value) == $needle)
		{
			if($count > 0)
				echo ",".$index;
			else
				echo $index;

			$count++;
		}

		$index += strlen($value) + 1;
	}
}

//findMe("Apple PEAR banana pineapple appLE","apple");
?>

<html>

  <head>

    <style type="text/css">

    #left { 
		background-color: red;
		float: left;
     }

     #center { 
		background-color: blue;
		float: left;
		margin-left: 200px;
     }

     #right { 
		background-color: yellow;
		float: left;
		margin-left: -400px;
     }

     .col {

       width: 200px;
	   height: 300px;


       text-align: center;

     }     

    </style>

  </head>

  <body>

    <div>

      <div id="left" class="col">left</div>

      <div id="center" class="col">center</div>

      <div id="right" class="col">right</div>

    </div>

  </body>

</html>