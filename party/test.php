<? include "utils.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Quickstart Tutorial</title>
<!--
	<script type="text/javascript" src="../yui/build/yahoo/yahoo.js"></script>
	<script type="text/javascript" src="../yui/build/event/event.js" ></script> 
	<script type="text/javascript" src="../yui/build/dom/dom.js" ></script>

	<script type="text/javascript" src="../yui/build/calendar/calendar.js"></script> 
	<link href="../yui/build/calendar/assets/skins/sam/calendar.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../yui/build/autocomplete/autocomplete.js"></script>
	<script type="text/javascript" src="../yui/build/utilities/utilities.js"></script>
	<script type="text/javascript" src="../yui/build/json/json.js"></script>
	<link rel="stylesheet" type="text/css" href="../yui/build/fonts/fonts-min.css" />
	<link rel="stylesheet" type="text/css" href="../yui/build/autocomplete/assets/skins/sam/autocomplete.css" />
	-->
<!--	<link rel="stylesheet" type="text/css" href="../yui/build/fonts/fonts-min.css" />-->

<link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/build/fonts/fonts-min.css?_yuiversion=2.5.0" />
<!--Auto Complete-->
<link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/build/autocomplete/assets/skins/sam/autocomplete.css?_yuiversion=2.5.0" />
<script type="text/javascript" src="http://developer.yahoo.com/yui/build/utilities/utilities.js?_yuiversion=2.5.0"></script>
<script type="text/javascript" src="http://developer.yahoo.com/yui/build/autocomplete/autocomplete.js?_yuiversion=2.5.0"></script>
<style type="text/css">
body {
	margin:0;
	padding:0;
}
/* custom styles for centered example */
body, h1 { margin:0;padding:0; } /* needed for known issue with Dom.getXY() in safari for absolute elements in positioned containers */
//#ysearch { text-align:center; }
#ysearchinput { position:static;width:20em; } /* to center, set static and explicit width: */
#ysearchcontainer { 
	text-align:left; 
	width:25em; 
	background-color: #cccccc;
}
</style>
<link href="http://www.globalzona.com/party/style.css" rel="stylesheet" type="text/css">
</head>
<body class="yui-skin-sam">
<div class="yui-skin-sam">

<!--
<form action="http://search.yahoo.com/search" onsubmit="return YAHOO.example.ACJson.validateForm();"> 
-->
    <div id="ysearch"> 
        <label>Event Search: </label> 
        <input id="ysearchinput" class='formLarge' type="text" name="p"> 
		<select id="searchType" class='formLarge' onChange="YAHOO.example.ACJson.setSearchType(document.getElementById('searchType').options[document.getElementById('searchType').selectedIndex].value);">
			<option value="event">Events</option>
			<option value="venue">Venues</option>
		</select>
   <!--     <input id="ysearchsubmit" type="submit" value="Submit Query"> -->
        <div id="ysearchcontainer" class='textBlack'></div> 
    </div> 
<!--
</form> 
-->
</div>

<script>
YAHOO.example.ACJson = new function(){
    this.oACDS = new YAHOO.widget.DS_XHR("http://www.globalzona.com/party/test.JSON.php", ["ResultSet.Result","Title","Url","CityName","StateCode","ImgURL"]);
    this.oACDS.queryMatchContains = true;
    this.oACDS.scriptQueryAppend = "searchType=" + document.getElementById('searchType').options[document.getElementById('searchType').selectedIndex].value; // Needed for YWS

    // Instantiate AutoComplete
    this.oAutoComp = new YAHOO.widget.AutoComplete("ysearchinput","ysearchcontainer", this.oACDS);
    this.oAutoComp.useShadow = true;
	this.oAutoComp.maxResultsDisplayed = 15;
	this.oAutoComp.minQueryLength = 2; 

    this.oAutoComp.formatResult = function(oResultItem, sQuery) {
		var itemHTML = "<table><tr>";
		itemHTML = itemHTML + "<td><img src='" + oResultItem[4] + "' width='40' height='30'></td>";
		itemHTML = itemHTML + "<td>" + oResultItem[0] + "<br><span class='textSmall' style='color: #888888'>" + oResultItem[2] + ", " + oResultItem[3] + "</span></td>";
		itemHTML = itemHTML + "</tr></table>";

		return itemHTML;
        //return "<div style='float: left'><img src='" + oResultItem[4] + "' width='25'></div>" + oResultItem[0] + "<br><span class='textSmall' style='color: #888888'>" + oResultItem[2] + ", " + oResultItem[3] + "</span>";
    };

    this.oAutoComp.doBeforeExpandContainer = function(oTextbox, oContainer, sQuery, aResults) {
        var pos = YAHOO.util.Dom.getXY(oTextbox);
        pos[1] += YAHOO.util.Dom.get(oTextbox).offsetHeight + 2;
        YAHOO.util.Dom.setXY(oContainer,pos);
        return true;
    };

	function Redirect(e, args) {
		document.location = args[2][1];
	}

	this.oAutoComp.itemSelectEvent.subscribe(Redirect);

	this.setSearchType = function(searchType) {
		this.oACDS.flushCache();
		this.oACDS.scriptQueryAppend = "searchType=" + searchType;
	};
};

</script>
<hr>
<style type="text/css">
	.ttGroup {
		float:left;
		margin:10px;
	}

	.ttGroup .grphd  {
		font-weight:bold;
		background-color:#ccc;
		border:1px solid #000;
		padding:2px;
	}

	.ttGroup .grpbd {
		padding:10px;
	}

	#ttGroupB:after {
		content:".";
		display:block;
		clear:left;
		visibilty:hidden
	 	height:0;
		width:0;	
	}
</style>
<!--Tool Tip-->
<link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/build/container/assets/skins/sam/container.css?_yuiversion=2.5.0" />
<script type="text/javascript" src="http://developer.yahoo.com/yui/build/yahoo-dom-event/yahoo-dom-event.js?_yuiversion=2.5.0"></script>
<script type="text/javascript" src="http://developer.yahoo.com/yui/build/container/container.js?_yuiversion=2.5.0"></script>
Tool Tip:
	<div class="ttGroup" id="ttGroupA">
		<div class="grphd">Group A: Single Tooltip, text set using title</div>
		<div class="grpbd" id="containerA"></div>
	</div>
	<div class="ttGroup" id="ttGroupB">
		<div class="grphd">Group B: Single Tootip, text set using events</div>
		<div class="grpbd" id="containerB"></div>
	</div>

<script type="text/javascript">
	YAHOO.namespace("example.container");

	YAHOO.example.container.init = function() {

		// CREATE LINKS FOR EXAMPLE

		function createLink(i, container, title) {
			var a = document.createElement("a");
			a.href = "http://www.yahoo.com/";
			a.innerHTML = i + ".  Hover over me to see my Tooltip";

			if (title) {
			    a.title = title;
			}

			container.appendChild(a);
			container.appendChild(document.createElement("br"));
			container.appendChild(document.createElement("br"));
			return a;
		}

		function createTitledLinks() {
			var ids = [];
			var container = YAHOO.util.Dom.get("containerA");
			for (var i = 1; i <= 5; i++) {
				// NOTE: We're setting up titles for these links
				var a = createLink(i, container, "Tooltip for link A" + i + ", set through title");
				a.id = "A" + i;
				ids.push(a.id);
			}
			return ids;
		}

		function createUntitledLinks() {
			var ids = [];
			var container = YAHOO.util.Dom.get("containerB");
			for (var i = 1; i <= 5; i++) {

				// NOTE: We're not setting up titles for these links
				var a = createLink(i, container, null);
				a.id = "B" + i;
				ids.push(a.id);

				// Change standard text for the 3rd link, to reflect
				// that we'll disable the tooltip for it.
				if ( i == 3 ) {
					a.innerHTML = i + ". Tooltip display prevented";
				} 
			}
			return ids;
		}

		var groupAIds = createTitledLinks();
		var groupBIds = createUntitledLinks();

		// TOOLTIP CODE

		// For links in group A which all have titles, this is all we need.
		// The tooltip text for each context element will be set from the title attribute

		var ttA = new YAHOO.widget.Tooltip("ttA", { 
			context:groupAIds
		});

		// For links in group B, we'll set the tooltip text dynamically, 
		// right before the tooltip is triggered, using the id of the triggering context.
		// We'll also prevent the tooltip from being displayed for link B3.

		var ttB = new YAHOO.widget.Tooltip("ttB", { 
			context:groupBIds
		});

		// Stop the tooltip from being displayed for link B3.
		ttB.contextMouseOverEvent.subscribe(
			function(type, args) {
				var context = args[0];
				if (context && context.id == "B3") {
					return false;
				} else {
					return true;
				}	
			}
		);

		// Set the text for the tooltip just before we display it.
		ttB.contextTriggerEvent.subscribe(
			function(type, args) {
				var context = args[0];
				this.cfg.setProperty("text", "Tooltip for " + context.id + ", set using contextTriggerEvent");
			}
		);
	};

	YAHOO.util.Event.addListener(window, "load", YAHOO.example.container.init);
</script>
<hr>
<!--
<div class="yui-skin-sam">
	<style>
		.yui-skin-sam .yui-calendar 
		{
			font-family: tahoma;
			font-size: 11px;
			color: white;
		}

		.yui-skin-sam .yui-calcontainer 
		{ 
			    background-color:#333333; 
			    border:1px solid #808080; 
			    padding: 10px;
		} 

		.yui-skin-sam .yui-calendar .calweekdaycell 
		{
			color: #dddddd;
		}

		.yui-skin-sam .yui-calendar td.calcell.today 
		{
			background-color: #222222;
		}

		.yui-skin-sam .yui-calendar td.calcell 
		{
			background-color: #dddddd;
		}

		.yui-skin-sam .yui-calendar td.calcell.oom 
		{
			background-color: #333333;
			color: #666666;
		}
	</style>
	<div id="cal1Container"></div> 
</div>

<script> 
    YAHOO.namespace("example.calendar"); 
 
    YAHOO.example.calendar.init = function() { 
        cal1 = new YAHOO.widget.Calendar("cal1","cal1Container"); 
		//YAHOO.example.calendar.cal1 = new YAHOO.widget.Calendar("cal1","cal1Container",{ pagedate:"10/2007", selected:"10/5/2007-10/27/2007,10/30/2007" }); 
		cal1.selectEvent.subscribe(showMyDate, cal1, true); 
		//YAHOO.util.Event.addListener(YAHOO.example.calendar.cal1, "click",alert(YAHOO.example.calendar.cal1.getSelectedDates()));
        cal1.render();
	}  
    YAHOO.util.Event.onDOMReady(YAHOO.example.calendar.init); 


	function showMyDate ()
	{
		var DateInfo = new Array();
		DateInfo = cal1.getSelectedDates()[0];
		//alert((DateInfo.getMonth()+1) + '/' + DateInfo.getDate() + '/' + DateInfo.getFullYear());
		document.myform.action = 'calendar.php?showDay=1&pMonth=' + (DateInfo.getMonth()+1) + '&pDay=' + DateInfo.getDate() + '&pYear=' + DateInfo.getFullYear();
		document.myform.submit();
	}

</script>
<div style="clear:both" ></div>
<form name="myform" method="POST"></form>
-->
<!--<a href='#' onClick="alert(cal1.getSelectedDates()); return false;">SHOW DATE</a>-->
</body>
</html>



<p>




<!--
<STYLE>
//    BODY  {  background-color: black;color: gold;font: 24pt sans-serif; }
	UL.ActivateTextEffect  {  color: orange;letter-spacing: 2; }
</STYLE>

<UL onmouseover = "this.className = 'ActivateTextEffect'"
    onmouseout = "this.className = ';'">Part I: Dynamic HTML Text Features
</UL>
-->



<?

$redirectURL =  urldecode($_GET['guestListURL']);
echo strrpos($redirectURL,"www.");
echo strrpos($redirectURL,"http://");

			if (strrpos($redirectURL,"www.") >= 0 && strrpos($redirectURL,"http://") == "")
				$redirectURL =  "http://".$redirectURL;
echo $redirectURL;

?>
<? echo stripslashes($_POST['test']); ?>
<form method="POST">
	<input type='text' name='test'>
	<input type='submit'>
</form>

<!-- SiteSearch Google -->
<form method="get" action="http://www.globalzona.com/party/test.php" target="_top">
	<table border="0" bgcolor="#333333">
		<tr>
			<td nowrap="nowrap">
				<input type="hidden" name="domains" value="www.globalzona.com"></input>
				<input type="text" name="q" size="25" class='form' maxlength="255" value="<? echo $_GET['q']; ?>" id="sbi"></input>
				<input type="submit" name="sa" class='form' value="Search" id="sbb"></input>
			</td>
		</tr>
	</table>
	<input type="hidden" name="sitesearch" value="www.globalzona.com" id="ss1"></input>
	<input type="hidden" name="client" value="pub-2855839175509987"></input>
	<input type="hidden" name="forid" value="1"></input>
	<input type="hidden" name="ie" value="ISO-8859-1"></input>
	<input type="hidden" name="oe" value="ISO-8859-1"></input>
	<input type="hidden" name="cof" value="GALT:#cccccc;GL:1;DIV:#333333;VLC:cccccc;AH:center;BGC:333333;LBGC:333333;ALC:bbbbbb;LC:bbbbbb;T:ffffff;GFNT:dddddd;GIMP:dddddd;LH:50;LW:220;L:http://www.globalzona.com/party/layout/index_02.jpg;S:http://www.globalzona.com;FORID:11"></input>
	<input type="hidden" name="hl" value="en"></input>
</form>
<!-- SiteSearch Google -->

<!-- Google Search Result Snippet Begins -->
<div  class='text'>
<div id="googleSearchUnitIframe"></div>

<script type="text/javascript">
   var googleSearchIframeName = 'googleSearchUnitIframe';
   var googleSearchFrameWidth = 700;
   var googleSearchFrameborder = 0 ;
   var googleSearchDomain = 'www.google.com';
</script>
<script type="text/javascript"
         src="http://www.google.com/afsonline/show_afs_search.js">
</script>
</div>
<!-- Google Search Result Snippet Ends -->


<link href="http://www.globalzona.com/party/css/roundCorner.css" rel="stylesheet" type="text/css">

<hr>
<?
/*
$event = new Event();
$eventInfo = $event->FindEvent(800);
echo "Title: ".$eventInfo['eventTitle']."<br>";

echo "test
est";*/
$layout = new Layout();
//echo $layout->getCityScore(5);
//$currentDate = getdate();
//echo $currentDate['year']."-".$currentDate['mon']."-".$currentDate['mday'];
//print_r(getdate());
?>
<? //echo GetLetterPosition('k'); ?>
<table width="200" cellpadding=0 cellspacing=0 border=0><tr><td>
<?
/*
$poll = new Poll(3);
$poll->printPoll();
$poll->setPollResults();
$poll->printPollResults();
*/
/*
	$layout = new Layout();

	$layout->cityListBubble();

	$leftLink = "<a href='http://www.globalzona.com/party/calendar.php?cityId=".$_GET['cityId']."'>View Full Calendar</a>";
	$layout->bubbleBoxTop(dbFindCity($_GET['cityId'])." Events",$leftLink);
	$layout->cityViewCalendar($_GET['cityId']); 
	$layout->bubbleBoxBottom(); 

	$layout->bubbleBoxSpacer();

	$leftLink = "<a href='http://www.globalzona.com/party/venueDirectory.php?cityId=".$cityId."'>View Full Venue Directory</a>";
	$layout->bubbleBoxTop(dbFindCity($_GET['cityId'])." Clubs and Bars",$leftLink);
	$layout->cityViewVenues($_GET['cityId']); 
	$layout->bubbleBoxBottom(); 

	$layout->bubbleBoxSpacer();	

	$leftLink = "<a href='http://www.globalzona.com/party/photo.php?cityId=".$cityId."'>Full Album Collection</a>";
	$layout->bubbleBoxTop(dbFindCity($_GET['cityId'])." Photo Albums",$leftLink);
	$layout->cityViewPhotos($_GET['cityId']);
	$layout->bubbleBoxBottom(); 
	*/
?>
</td></tr></table>
<?



/*
	session_save_path("/home/users/web/b1355/va.artem25/cgi-bin/tmp");
		echo session_save_path();
	session_start(); 

	if($_GET["set"] == "true") 
	 $_SESSION["username"] = "artem";

	echo "session:".$_SESSION["username"]." sid:".SID ;

	phpinfo();
	*/


	
/*
function dbSelect($query)
{		
	$db = new DB_Connect();
	mysql_connect($db->localhost,$db->username,$db->password);
	@mysql_select_db($db->database) or die( "Unable to select database");
	
	if(!mysql_query($query)) echo "CAN'T SELECT";
	else
	{
		$results = array();
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		mysql_close();
		echo $num . " results.";						
		for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);
		
		 for ( $i = 0; $i < $num; ++$i )
		   echo "<br>".$results[$i]['name'];		  
	}
}

dbSelect("SELECT * FROM city ORDER BY name");

if (recordAffiliate(1,'show'))
	echo "<p>recorded";
else
	echo "failed 1";


displayAffiliate ();

$affiliateBannerInfo = dbFindAffiliateBanner(1);
echo "Total Clicked: ".$affiliateBannerInfo['totalClicked'];
*/
?>
<!--SLIDE START-->
<!--
<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/party/js/util.js"></script>
<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/party/js/design_functions.js"></SCRIPT>
<table width="30%" border="0" cellspacing="3" cellpadding="2">
	<tr><td bgcolor='#333333' class="nav">&nbsp;&nbsp;&nbsp;Search by Date
		<table width="100%" cellpadding="0" cellspacing="2" border="0">
		<form action='calendar.php?showDay=1&cityId=<? echo $_GET['cityId']; ?>' method='POST'>
			<tr><td align="center" bgcolor="#444444" class="spacer">
				<br>
					<? 
						calendar_month('',''); 
						calendar_day('','');
						calendar_year('','');
					?>
				<br><br><input type="submit" name="Submit" class="form" value="Get <? if ($_GET['cityId'] != "") echo dbFindCity($_GET['cityId']); else echo 'All Cities'; ?> Party List"><br><br>
			</td></tr>
		</form>
		</table>
	</td></tr>
	<tr>
		<td bgcolor='#333333' class="nav">
			<a href="#" onClick="show_form_ext('SearchByCity');return false;" class="nav">
				&nbsp;&nbsp;<span id="SearchByCity_span">+</span>&nbsp;&nbsp;Search by City
			</a>
		</td>
	</tr>
	<tr id="SearchByCity_tr" style="display:none;" bgcolor="#bbbbbb"><td>
		<div id="SearchByCity_div" class="hidden_div">
			<table width="100%" border="0" cellspacing="3" cellpadding="2">
				<? dbGetCityTest('nav'); ?>
			</table>
		</div>
	</td></tr>
	<tr><td bgcolor='#333333' class="nav">&nbsp;&nbsp;&nbsp;Search Events
		
	</td></tr>
</table>
-->
<!--SLIDE END-->
<!--
<? echo "2nd Saturday: ".date('l, F j, Y',strtotime("2nd Saturday")); ?>
<br>
<? echo "4th Saturday: ".date('l, F j, Y',strtotime("4th Saturday")); ?>
<br>
<? echo "Last Saturday: ".date('l, F j, Y',strtotime("last Saturday", time())); ?>
<hr>
-->
Associates<hr>
<? dbGetAssociateLog(); ?>

<style>
.layerTrans {
	background-color: silver;
	opacity:.50;
	filter: alpha(opacity=50); 
	-moz-opacity: 0.5; 
	position: relative; 
	left: 0px; 
	top: 0px; 
	height: 50px; 
	width: 500px; 
	margin-bottom: -60px; 
	padding: 5px; 
	border: 1px solid gray;
	float: left;
}
</style>

<!--
		<div style="background-color: silver;opacity:.50;filter: alpha(opacity=50); -moz-opacity: 0.5; position: relative; left: 150px; top: 10px; height: 50px; width: 300px; margin-bottom: -60px; padding: 10px; border: 1px solid gray;">layer stuff</div>


<div style="border:2px solid white;width:400px;height:100%;background:url(http://www.mandarindesign.com/images/monday.jpg) top left repeat-x;">    
	
<div style="border:2px solid white;width:200px;height:275px;margin-right:0px;padding:0px;color:#366;background:white;float:right;filter:alpha(opacity=50);-moz-opacity:.50;opacity:.50;font-family:Verdana, Arial, Helvetica;font-size: 28px;line-height:26px;text-align:right;">
     <b>this text is</b>
     in the second div <b>with bold</b> and plain text
     <b>over the image with an </b>
     opaque background
    </div>
    
<p style="margin-top:159px;text-align:justify;">There are two <code>div</code> tags in action here. The first <code>div</code> is <code>400px</code> wide and 
contains a background image that is <code>200 x 159</code>.  It is a simple <code>div</code>, used as a container for the rest of the code. </p> 

<p>The second <code>div</code> is inside of the first <code>div</code>. For simplicity it is the same width as the image. 
Again, for simplicity we set the <code>margin-top</code> in the paragraph to <code>159px</code>. The only thing magic 
about <code>159</code> is that it is the height of the image. That's all. 
</p> 
<p> 
The second <code>div</code> is the workhorse. It's applying the opacity and floating the text. To force the appearance that we want we're defining the height on the right side opacity filtered text as <code>275px</code>. 
The goal was to start the text below the image on the left. The image ends in the 159 position. </p> 
</div> 
<div style="clear:both;"></div>
-->

<!--

		
<script language="javascript" type="text/JavaScript" SRC="http://www.globalzona.com/party/js/ajax.js"></SCRIPT>
		<table width="500" cellpadding="0" cellspacing="2" border="0">		
		<form method='POST' onSubmit="suggestCity(this.citySuggest.value); return false;">
			<tr><td align="center" bgcolor="#444444" class="spacer">
			<div class="layerTrans">layer stuff</div>
			<br>
					<input name="citySuggest" class="form" size="25" maxlength="25" value="cityName">
					<br><br><input type="submit" name="Submit" id="buttonMain" class="form" value="Submit City"><br><br>
					<div id="txtHint">&nbsp;</div>
			</td></tr>
		</form>
		</table>
				<div class='spacer'>&nbsp;</div>



<table width="300" cellpadding=3 cellspacing=0 border=0><tr><td>
<?
	$leftLink = "";
	$layout->bubbleBoxTop("Submit Your Event",$leftLink);
	$layout->bubbleBoxSpacer();	
?>
	
		<table cellpadding="2" cellspacing="0" border="0" width="100%">
		<form action="submitEvent.php" method="POST">
			<tr class="navTall"> 
            <td width="30%" valign="top" align="right">Event Title</td>
            <td width="70%"><input name="eventTitle" type="text" class="form" size="31" maxlength="30" value="<? echo $_POST['eventTitle']; ?>"></td>
          </tr>
          <tr class="navTall"> 
            <td width="30%" valign="top" align="right">Date</td>
            <td width="70%">
				<? 
					calendar_month ($_POST['pMonth'],'pMonthSubmit');
					calendar_day ($_POST['pDay'],'pDaySubmit');
					calendar_year ($_POST['pYear'],'pYearSubmit'); 
				?>
			</td>
          </tr>
          <tr class="navTall"> 
            <td width="30%" valign="top" align="right">Time</td>
            <td width="70%">
				<? 
					calendar_hour ($_POST['hour']);
					calendar_minute ($_POST['minute']);
					calendar_ampm ($_POST['ampm']); 
				?>
			</td>
          </tr>		  
		  <tr><td colspan='2' align='center'>
				<input class='form' type="submit" value="Submit">
		  </td></tr>
		</form>
		 </table>
<?
$layout->bubbleBoxSpacer();	
	$layout->bubbleBoxBottom(); 
?>
</td></tr></table>

-->
<!--DJ INFO-->
<!--
<?	
	$layout->bubbleBoxSpacer(); 
	$leftLink = "<a target='_blank' href='http://www.playdoughboy.com/'>Official Website</a>";
	$layout->bubbleBoxTop("DJ Playdoubghboy",$leftLink);
	$layout->bubbleBoxSpacer(); 
?>

	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr class="text">
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td valign="top" align="justify">
				<div style="width: 95%; margin-left: auto; margin-right: auto;">
				<? 
					//include "ads/ad4.php"; 
					$layout->bubbleBoxSpacer(); 
				?>					
					Ukraine born producer/remixer/DJ. DJing since 1998, and composing
					music since 1996. As part of Asylum Group (Ukraine) - had his tracks
					featured on radio stations in Ukraine as early as 1997.
					<p>
					After moving
					to California in 2000 Playdoughboy continued collaborating with Asylum
					Group as well as starting up a solo project, integrating some hardware
					pieces into the software based studio, concentrating on dirty electro
					house and minimal techno sound.
					<p>
					In the past Playdoughboy played records and performed live at numerous
					San Francisco clubs - Mighty, BOCA, Supperclub, Roe/Prive, Studio Z,
					Club 6, RX Gallery, Whisper to name a few... Playdoughboy also
					appeared on El Otro Mundo Sessions on Pulse Radio and his tracks were
					aired on SF Bay Area radio stations, as well as Master Radio in
					Kharkov and radio stations in Ireland and Canada. His bootleg remix on
					Justin Timberlake's "Sexy Back" became a cult hit in Russia in the
					summer of 2006, and two tracks are scheduled for major realease on
					compilations in Greece and the US.										
				</div>
			</td>
			<td width="215" valign="top" align="left"><img class="imgBorder" src="http://www.globalzona.com/party/images/banners/playdoughboy_tmb.jpg" border="0" width="200"></td>
		</tr>						
	</table>

<? 
	$layout->bubbleBoxBottom(); 
	$layout->bubbleBoxSpacer();
?>
-->
<hr>
<?
echo date('Y-m-d', time());
?>
<? 
/*
	$articles = new Article();
	$articles->SetAllArticles();
	$articles->PrintArticleInfo();
	for ($x = 0; $x < count($articles->articleInfo); $x++)
	{
		echo $articles->articleInfo[$x]['title']."<br>";
	}
	*/
?>