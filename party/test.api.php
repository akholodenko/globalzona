<script language="javascript" type="text/JavaScript" src="http://www.globalzona.com/party/js/submitEvent.js"></script>
<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/party/js/design_functions.js"></SCRIPT>

<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/party/js/check.contact.fields.js"></SCRIPT>
<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/party/js/check.profanity.js"></SCRIPT>
<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/party/js/ajax.js"></script>
<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/party/js/util.js"></script>
<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/party/js/event.js"></script>
<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/party/js/event_rotator.js"></script>


<script src="http://www.globalzona.com/jquery/jquery-1.2.6.js"></script>
<script src="http://www.globalzona.com/jquery/jquery.tooltip.js"></script>
<script src="http://www.globalzona.com/jquery/jquery.jtip.js"></script>
<script src="http://www.globalzona.com/jquery/jquery.lightbox.js"></script>
<script type="text/javascript" src="http://www.globalzona.com/jquery/ui.base.js"></script>
<script type="text/javascript" src="http://www.globalzona.com/jquery/ui.dialog.js"></script>

<script type="text/javascript" src="http://www.globalzona.com/jquery/ui.resizable.js"></script>
<script type="text/javascript" src="http://www.globalzona.com/jquery/ui.draggable.js"></script>

<?
	include "utils.php";
	//include "classes/api.php";

	$data = API::GetStates();

	for($x = 0; $x < count($data); $x++)
	{
		if($x % 5 == 0) echo "<br>";
		else echo " ";

		echo $data[$x]['state'];
	}

	if($_GET['state'] != "")
	{
		echo "<br>";
		$data = API::GetCitiesByState($_GET['state']);

		for($x = 0; $x < count($data); $x++)
		{
			echo $data[$x]['id']." - ".$data[$x]['name']."<br>";
		}
	}

	$event = new Event();
	$event->DisplayFeaturedEventRotator ();
?>