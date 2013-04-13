<link href="http://www.globalzona.com/party/style.css" rel="stylesheet" type="text/css">
<link href="http://www.globalzona.com/party/css/roundCorner.css" rel="stylesheet" type="text/css">

<script src="http://www.globalzona.com/jquery/jquery-1.2.5.js"></script>
<script src="http://www.globalzona.com/jquery/jquery.lightbox.js"></script>

<link rel="stylesheet" href="http://www.globalzona.com/jquery/css/lightbox.css" type="text/css">

<script>
		$(document).ready(function(){
			$(".lightbox").lightbox();
		});

</script>


<? include "utils.php"; 

	if($_POST['IsUpload'] == "true")
	{
		$upload = new Upload($_FILES['userfile']);
		$upload->UploadImage();
	}

	$layout = new Layout();
	$layout->bubbleSubBoxTop(90);
?>
<form enctype="multipart/form-data" action="" method="POST">
	<input type='hidden' name='IsUpload' value='true'>
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>
<?
	$layout->bubbleSubBoxBottom();
?>

<?

function dirList ($directory) 
{
    // create an array to hold directory list
    $results = array();

    // create a handler for the directory
    $handler = opendir($directory);

    // keep going until all files in directory have been read
    while ($file = readdir($handler)) {

        // if $file isn't this directory or its parent, 
        // add it to the results array
        if ($file != '.' && $file != '..')
            $results[] = $file;
    }

    // tidy up: close the handler
    closedir($handler);
    return $results;
}

$images = dirList("images/upload");

for($x = 0; $x < count($images); $x++)
{
	if(($x % 5) == 0) echo "<br>";
	echo "<a href='images/upload/".$images[$x]."' class='lightbox' title='my caption' rel='partypics'><img src='images/upload/".$images[$x]."' width='150' /></a>";
	
}
?>