<? 
//if valid data has been submitted, redirect
if (all_validate() == true) { header("Location: http://www.yahoo.com/"); }

//array used for data storage throughout the form
$values = Array("fname" => null, "lname" => null, "gender" => null, "dob" => null, "street" => null, "city" => null, "state" => null);

//simulated input from passed in object from the back-end (d.o.b. passed in is invalid)
$data = Array("fname" => "Jane", "lname" => "Doe", "gender" => "f", "dob" => Array(8, 0, 1970), "street" => null, "city" => null, "state" => null);

//print out a form field with pre-loaded data
function print_field($field_title, $field_value, $error)
{
	$format = "";

	//additional error message for d.o.b.
	if($field_title == 'dob' && date_validate($field_value) == false) {
		$error = false;
		echo "<tr><td colspan='2' class='text' align='right'><font color='red'><b>d.o.b. format: mm/dd/yyyy</b></font></td></tr>";
	}

	echo "<tr>";
	if ($error == false) echo "<td colspan='2' class='text' align='right'><font color='red'>Please enter a valid ".$field_title."</font></td></tr><tr>"; //prints out error message
	
	echo "<td class='text'>";
	if ($error == false) echo "<font color='red'>*</font>"; //marks off the row with error

	echo $field_title."</td><td>";
	echo "<input type='text'";
	
	if ($error == false) echo "class='error'"; //change form field color based on error status
	else echo "class='form'";
	
	echo "name='".$field_title."' value='".$field_value."'></td></tr>";
}

//validate date for proper values
function date_validate($dobinput)
{
	$dob = $dobinput;
	if($_GET['id'] == 1) $dob = config_dob ($dobinput); //accounting for different format
	if($dob[0] < 1 || $dob[0] > 12) return false; //if month is out of range
	if($dob[0] == 1 || $dob[0] == 3 || $dob[0] == 5 || $dob[0] == 7 || $dob[0] == 8 || $dob[0] == 10 || $dob[0] == 12) { //if month is 31 days long
		if($dob[1] < 1 || $dob[1] > 31) return false; //if date is out of range			
	}	
	if($dob[0] == 4 || $dob[0] == 6 || $dob[0] == 9 || $dob[0] == 11) { //if month is 30 days long	
		if($dob[1] < 1 || $dob[1] > 30) return false; //if date is out of range			
	}
	if($dob[0] == 2) { //if month is february (assume 28 days, don't account for leap-year)
		if($dob[1] < 1 || $dob[1] > 28) return false; //if date is out of range
	}
	//if year is unrealistic
	if($dob[2] < 1900 || $dob[2] > 2005) return false;

	return true;
}

//takes dob string and converts into array
function config_dob ($dob)
{
	$temp[0] = strtok($dob, '/');
	$temp[1] = strtok('/');
	$temp[2] = strtok('/');
	return $temp;
}

//determines if user's 1st visit or error refresh
function set_values($trigger, $data, &$values)
{
	if($trigger == 1){
		$values[fname] = $_POST['fname'];
		$values[lname] = $_POST['lname'];
		$values[gender] = $_POST['gender'];
		$values[dob] = config_dob($_POST['dob']);
		$values[street] = $_POST['street'];
		$values[city] = $_POST['city'];
		$values[state] = $_POST['state'];
	}
	else{
		$values[fname] = $data[fname];
		$values[lname] = $data[lname];
		$values[gender] = $data[gender];
		$values[dob] = $data[dob];
		$values[street] = $data[street];
		$values[city] = $data[city];
		$values[state] = $data[state];
	}
}

//returns false if empty field
function text_validate($value)
{
	$id=$_GET['id'];

	if($id == 1) {
		if($value == '') return false;
		else return true;
	}
	else return true;
}

//quick validation to determine whether to redirect
function all_validate()
{
	if($_GET['id'] != 1) return false;

	$count = 0;
	if(text_validate($_POST['fname']) == false) $count = $count + 1;
	if(text_validate($_POST['lname']) == false) $count = $count + 1;
	if(text_validate($_POST['gender']) == false) $count = $count + 1;
	if(text_validate($_POST['dob']) == false || date_validate($_POST['dob']) == false) $count = $count + 1;
	if(text_validate($_POST['street']) == false) $count = $count + 1;
	if(text_validate($_POST['city']) == false) $count = $count + 1;
	if(text_validate($_POST['state']) == false) $count = $count + 1;
	if($count > 0) return false;
	else return true;
}
?>

<html>
<head>
<style type="text/css">
<!--
.text {  
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	font-size: 8.5pt; 
	font-style: normal; 
	letter-spacing: 1px; 
	word-spacing: 1px; 
	line-height: 22px
}
.form { 
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	font-size: 8pt; font-style: normal; 
	line-height: normal; 
	font-weight: bold; 
	font-variant: normal; 
	letter-spacing: 1px; 
	word-spacing: 1px; 
	color: #FFFFFF; 
	background-color: #999999
}
.error { 
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	font-size: 8pt; font-style: normal; 
	line-height: normal; 
	font-weight: bold; 
	font-variant: normal; 
	letter-spacing: 1px; 
	word-spacing: 1px; 
	color: black; 
	background-color: yellow
}
-->
</style>
</head>
<body>
	<form action='yahootest.php?id=1' method='POST'">
		<table>
			<?	set_values($_GET['id'], $data, $values);
				$error = text_validate($_POST['fname']);
				print_field('fname', $values[fname], $error); 
			?>
			<?	$error = text_validate($_POST['lname']);
				print_field('lname', $values[lname], $error); 
			?>
			<?	$error = text_validate($_POST['gender']);
				print_field('gender', $values[gender], $error); 
			?>
			<?	$error = text_validate($_POST['dob']);
				print_field('dob', $values[dob][0].'/'.$values[dob][1].'/'.$values[dob][2], $error);
			?>
			<?	$error = text_validate($_POST['street']);
				print_field('street', $values[street], $error); 
			?>
			<?	$error = text_validate($_POST['city']);
				print_field('city', $values[city], $error); 
			?>
			<?	$error = text_validate($_POST['state']);
				print_field('state', $values[state], $error); 
			?>
			<tr>
				<td>
					<input type="submit" class='form' value="Submit" name="submit">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>