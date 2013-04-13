<?
	class Event
	{
		var $VenueID;
		var $VenueName;
		var $VenueAddress;
		var $VenueCityName;
		var $VenueCityId;
		var $VenueStateName;
		var $VenueImg;

		var $EventId;

		function Event ()
		{
		}

		function SubmitEvent ()
		{
			$tableName = "event";

			$query = "INSERT into ".$tableName." (eventTitle,cityId,";
			if(check_int($_GET['venueId'])) $query = $query."venueId,";
			if(check_int($_GET['dayOfWeek'])) $query = $query."weekDay,IsActive,";
			$query = $query."venueName,address,state,flyerURL,date,message,guestListURL,hostName,hostEmail,hostPassword) values (";
			$query = $query."'".urlencode(stripslashes(urldecode($_GET['eventTitle'])))."',";
			$query = $query.$_GET['city'].',';
			if(check_int($_GET['venueId'])) $query = $query.$_GET['venueId'].',';
			if(check_int($_GET['dayOfWeek'])) $query = $query.$_GET['dayOfWeek'].',1,';
			$query = $query."'".urlencode(stripslashes(urldecode($_GET['venueName'])))."',";
			$query = $query."'".$_GET['address']."',";		
			$query = $query."'".$_GET['state']."',";	
			$query = $query."'".$_GET['flyer']."',";		
			$query = $query."'".$_GET['pYear']."-".$_GET['pMonth']."-".$_GET['pDay']." ".ampmConvert($_GET['hour'], $_GET['ampm']).":".$_GET['minute'].":00',";		//0000-00-00 00:00:00
			$query = $query."'".urlencode(stripslashes(urldecode($_GET['message'])))."',";		
			$query = $query."'".urlencode($_GET['guestlist'])."',";		
			$query = $query."'".$_GET['name']."',";		
			$query = $query."'".$_GET['email']."',";
			$query = $query."'".$_GET['password']."'";					
			$query = $query.')';
			//echo $query;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);


			$query = "SELECT id from ".$tableName." WHERE date = '".$_GET['pYear']."-".$_GET['pMonth']."-".$_GET['pDay']." ".ampmConvert($_GET['hour'], $_GET['ampm']).":".$_GET['minute'].":00' AND eventTitle = '".urlencode(stripslashes(urldecode($_GET['eventTitle'])))."' AND hostEmail = '".$_GET['email']."' AND cityId = ".$_GET['city'];
			//echo "<hr>".$query;
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);
			$num = mysql_numrows($result);
			if ($num == 1)
			{

				$results = mysql_fetch_array($result);
				$message = "Password: ".$_GET['password']."\nEvent URL: http://www.globalzona.com/party/eventDetails.php?eventId=".$results['id'];
				$headers = "From: info@globalzona.com";
				mail($_GET['email'], 'Thank You for Posting Your Event!', $message, $headers);
				$this->EventId = $results['id'];
				return true;
			}
			else echo "SubmitEvent Failed";
			return false;
		}

		
		function PrintSubmitEventFormNav ()
		{
			echo "	<tr class='nav' id='SubmittedTR' style='display: none;'>";
			echo "		<td colspan='5' id='eventSubmittedTDSubmitNav' class='lightGradient' align='center'>";
			echo "			Event Information Submitted";
			echo "		</td>";
			echo "	</tr>";	
			echo "	<tr class='nav' id='SubmitEventFormNavTR'>";
			echo "		<td id='eventCityTDSubmitNav' class='lightGradient' width='20%' align='center'>";
			echo "			<div id='eventCityDivSubmitNav'>Step 1:&nbsp;&nbsp;Event City</div>";
			echo "		</td>";
			echo "		<td id='partyInfoTDSubmitNav' class='lightGradientDim' width='20%' align='center'>";
//			echo "			<div id='partyInfoDivSubmitNav' onMouseOver=\"EventFormTabHighlight('partyInfoTDSubmitNav');\" onMouseOut=\"EventFormTabDim('partyInfoTDSubmitNav');\">Step 2:&nbsp;&nbsp;Party Info.</div>";
			echo "			<div id='partyInfoDivSubmitNav'>Step 2:&nbsp;&nbsp;Party Info.</div>";
			echo "		</td>";
			echo "		<td id='venueInfoTDSubmitNav' class='lightGradientDim' width='20%' align='center'>";
//			echo "			<div onMouseOver=\"EventFormTabHighlight('venueInfoTDSubmitNav');\" onMouseOut=\"EventFormTabDim('venueInfoTDSubmitNav');\" style='margin-left: 0px;'>Step 3:&nbsp;&nbsp;Venue Info.</div>";
			echo "			<div style='margin-left: 0px;'>Step 3:&nbsp;&nbsp;Venue Info.</div>";
			echo "		</td>";
			echo "		<td id='hostInfoTDSubmitNav' class='lightGradientDim' width='20%' align='center'>";
//			echo "			<div onMouseOver=\"EventFormTabHighlight('hostInfoTDSubmitNav');\" onMouseOut=\"EventFormTabDim('hostInfoTDSubmitNav');\" style='margin-left: 0px;'>Step 4:&nbsp;&nbsp;Host Info.</div>";
			echo "			<div style='margin-left: 0px;'>Step 4:&nbsp;&nbsp;Host Info.</div>";
			echo "		</td>";
			echo "		<td id='confirmInfoTDSubmitNav' class='lightGradientDim' width='20%' align='center'>";
			echo "			<div style='margin-left: 0px;'>Step 5:&nbsp;&nbsp;Confirm Info.</div>";
			echo "		</td>";
			echo "	</tr>";								
			echo "	<tr class='spacer'><td colspan='5'>&nbsp;</td></tr>";
		}

		function PrintStep1 ()
		{
			//$this->GetStateList();
			$this->GetCityList();
		}

		function PrintStep2 ()
		{
			echo "<div id='EventFormPartyInfo' style='display: none'>";
				echo "<table width='97%' border='0' cellspacing='0' cellpadding='2' align='center'>";
				echo "	<tr>";
				echo "		<td class='navTall'>";
								include "includes/eventForm.PartyInfo.php";
				//echo "			<br><a class='text' name='guestlistInfo'>&nbsp;&nbsp;&nbsp;(1) To use an email address for guestlist sign-up, type in (example) <b>mailto:email@domain.com</b></a>";
				echo "		</td>";
				echo "	</tr>";
				echo "	<tr>";
				echo "		<td class='navTall' align='center'><br>";
				echo "			<input onClick=\"Step1(); return false;\" type='button' class='formLarge' value='<< Return to Step 1: Event City'>&nbsp;";
				echo "			<input onClick=\"Step3(); return false;\" type='button' class='formLarge' value='Continue to Step 3: Venue Info >>'>";
				echo "		</td>";
				echo "	</tr>";
				echo "</table>";
			echo "</div>";
		}

		function PrintStep3 ()
		{
			echo "<div id='EventFormVenueInfo' style='display: none'>";
			echo "<table width='97%' border='0' cellspacing='0' cellpadding='2' align='center'>";
			echo "	<tr>";
			echo "		<td colspan='2' class='navTall'>";
			echo "			Please select or enter the venue of your event in <span id='Step3EventFormCityName'>here</span>:";
			echo "			<div class='spacer'>&nbsp;</div>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td width='50%' class='navTall'><span id='EventFormVenueList'>";
//			echo "			<div align='center' width='100%'><br><br><br><br><br>Loading Venue List<br><img src='http://www.globalzona.com/party/images/ajax-loader3.gif'><br><br><br><br><br><br></div></span>";
			echo "			<div id='NoCityVenues' align='center'>";
								$layoutLocal = new Layout();
								$layoutLocal->bubbleSub2BoxTop(80);
			echo "				<div class='text' width='100%' style='text-align: justify; padding-left: 15px; padding-right: 15px;'>";
			echo "					Sorry, but we have no venues listed in our directory for this city. Please enter the name and street address of your event's venue in the form on right.";
			echo "				</div>";
								$layoutLocal->bubbleSub2BoxBottom();
			echo "			</div></span>";
			echo "			<select id='eventVenueId' 'size=20' style='width: 325px; height: 400px; padding: 3px;' class='formLarge' onClick=\"GetVenueInfo(document.getElementById('eventVenueId').value,2);\">";
			echo "				<option value=''></option>";
			echo "			</select>";
			echo "		</td>";
			echo "		<td width='50%' class='navTall' valign='top'>";
							include "includes/eventForm.VenueInfo.php";
			echo "		</td>";
			echo "	</tr>";
				echo "	<tr>";
				echo "		<td class='navTall' align='center' colspan='2'><br>";
//				echo "			<input onClick=\"Step2(); return false;\" type='button' class='formLarge' value='<< Return to Step 2: Part Info'>&nbsp;";
				echo "			<input onClick=\"Step4(); return false;\" type='button' class='formLarge' value='Continue to Step 4: Host Info >>'>";
				echo "		</td>";
				echo "	</tr>";
			echo "</table>";
			echo "</div>";
		}

		function PrintStep4 ()
		{
			echo "<div id='EventFormHostInfo' style='display: none'>";
				echo "<table width='97%' border='0' cellspacing='0' cellpadding='2' align='center'>";
				echo "	<tr>";
				echo "		<td class='navTall'>";
								include "includes/eventForm.HostInfo.php";
				//echo "			<br><a class='text' name='hostDiscInfo'>&nbsp;&nbsp;&nbsp;(2) This information will not be shown to visitors; used for post editing only</a>";
				echo "		</td>";
				echo "	</tr>";
				echo "	<tr>";
				echo "		<td class='navTall' align='center'><br>";
				echo "			<input onClick=\"StepConfirm(); return false;\" type='button' class='formLarge' value='Continue to Confirm Event Info >>'>";
				echo "		</td>";
				echo "	</tr>";
				echo "</table>";
			echo "</div>";
		}

		function PrintStepConfirm ()
		{
			echo "<div id='EventFormConfirmInfo' style='display: none'>";
			echo "	<table align='center' width='100%' border='0' cellspacing='0' cellpadding='2'>";
			echo "		<tr><td width='220' align='center' valign='top'><div id='flyerX'>&nbsp;</div></td>";
			echo "			<td valign='top' align='left'>";
			echo "				<table align='center' width='98%' border='0' cellspacing='0' cellpadding='2'>";
			echo "					<tr><td align='right' class='navTall' width='30%'>Event Title:</td><td class='textBig'><div id='eventTitleX'>&nbsp;</div></td></tr>";
			echo "					<tr><td align='right' class='navTall' valign='top'>Date&nbsp;and&nbsp;Time:</td><td class='textBig'><div id='eventDate'>&nbsp;</div><div style='display: none' id='eventWeekly'>&nbsp;</div></td></tr>";
			echo "					<tr id='GuestlistConfirmTR'><td align='right' class='navTall' valign='top'>Guestlist URL:</td><td class='textBig'><div id='guestlistX'>&nbsp;</div></td></tr>";
			echo "					<tr><td align='right' class='navTall' valign='top'>Detailed&nbsp;Message:</td><td class='textBig'><div id='messageX' style='text-align: justify;'>&nbsp;</div></td></tr>";
			echo "					<tr><td align='right' class='navTall' valign='top'>Venue&nbsp;Name:</td><td class='textBig'><div id='venueNameX'>&nbsp;</div></td></tr>";
			echo "					<tr><td align='right' class='navTall' valign='top'>Address:</td><td class='textBig'><div id='addressX'>&nbsp;</div></td></tr>";
			echo "					<tr><td align='right' class='navTall' valign='top'>Host Name:</td><td class='textBig'><div id='nameX'>&nbsp;</div></td></tr>";
			echo "					<tr><td align='right' class='navTall' valign='top'>Email:</td><td class='textBig'><div id='emailX'>&nbsp;</div></td></tr>";
			echo "				</table>";
			echo "			</td>";
			echo "		</tr>";
			echo "		<tr>";
			echo "			<td colspan='2' class='navTall' align='center'><br>";
			echo "				<input onClick=\"Step2('',''); return false;\" id='EditEventButton' type='button' class='formLarge' value='<< Edit Event Info'>&nbsp;";
//			echo "				<a href='submitEventJS.php' style='text-decoration: none;'><input id='ResetEventButton' type='button' class='formLarge' value='Reset Event Info'></a>&nbsp;";
			echo "				<input onClick=\"StepComplete(); return false;\" id='submitEventButton' type='button' class='formLarge' value='Submit Event Info >>'>";
			echo "			</td>";
			echo "		</tr>";
			echo "	</table>";

			echo "</div>";
		}

		function GetVenueDirectory()
		{
			$query = "SELECT v.id, v.name, c.id as cityId, c.name as city, v.address, c.state, v.imgURL, v.text, v.website, ct.name as countryName";
			$query = $query." FROM venue v, city c, country ct";
			$query = $query." where c.id=v.cityId AND c.countryId=ct.id";
			$query = $query." ORDER BY name";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = array();
				$num = mysql_numrows($result);
							
				for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);				
				for ( $i = 0; $i < $num; ++$i ) 
				{
					//echo "<br>".$results[$i]['name']." - ".$results[$i]['id']." - ".$results[$i]['cityId']." - ".$results[$i]['city'];
					echo "<script>";
					echo "		event.venueDirectory[".$results[$i]['cityId']."][".$results[$i]['id']."] = '".$results[$i]['name']."';";
					echo "</script>";
				}


				return true;
			}
			else echo "GetVenueDirectory Failed";
			return false;
		}

		function GetVenueList($cityId)
		{
			$query = "SELECT v.id, v.name, c.name as city, v.address, c.state, v.imgURL, v.text, v.website, ct.name as countryName";
			$query = $query." FROM venue v, city c, country ct";
			$query = $query." where c.id=v.cityId AND c.countryId=ct.id AND c.id=".$cityId;
			$query = $query." ORDER BY name";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = array();
				$num = mysql_numrows($result);
							
				for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);	
				
				echo "<select id='eventVenueId' 'size=20' style='width: 325px;' class='formLarge'>";
				for ( $i = 0; $i < $num; ++$i ) $this->PrintVenueList($results[$i]);
				echo "</select>";

				return true;
			}
			else echo "GetVenueList Failed";
			return false;
		}

		function PrintVenueList ($venueInfo)
		{
			echo "<option value='".$venueInfo['id']."'>".urldecode($venueInfo['name'])." - ".$venueInfo['address']."</option>";
			/*
			echo "<table cellpadding='10' cellspacing='1' border='0' width='100%'><tr><td width='125'>";
			echo "	<table bgcolor='black' cellpadding='1' cellspacing='0' border='0'><tr><td>";
			echo "		<a href='venueDetails.php?venueId=".$venueInfo['id']."' class='textLink'>";
			echo "			<img src='".$venueInfo['imgURL']."' width='100' border='0'>";
			echo		"</a>";
			echo "	</td></tr></table>";
			echo "</td><td>";
			echo "<a href='venueDetails.php?venueId=".$venueInfo['id']."' class='textLinkBig'>";
			echo "<b>".urldecode($venueInfo['name'])."</b> - <i>".$venueInfo['city'].", ";
			
			if ($venueInfo['countryName'] != "" && $venueInfo['countryName'] != "USA")
				echo $venueInfo['countryName'];
			else
				echo $venueInfo['state'];
			
			echo "</i><br>";	
			echo substr($venueInfo['text'],0,150)."...";
			echo "</a></td>";
			echo "</tr></table>";
			*/
		}

		function GetStateList()
		{
			$queryEvents = "SELECT state FROM city WHERE CountryId=1 GROUP BY state ORDER BY state";
			$db = new Database($queryEvents);
			$result = $db->ExecuteQuery($queryEvents);

			if ($result != -1)
			{							
				$results = array();
				$num = mysql_numrows($result);

				for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);	

				$this->printStateList($results, $num);	
				
				return true;
			}
			else echo "GetStateList Failed";
			return false;
		}

		function printStateList($results, $num)
		{
			echo "<div id='EventFormEventState'>";
				echo "<table width='97%' border='0' cellspacing='0' cellpadding='2' align='center' style='background-image: url(images/velvetRope.jpg);background-position: center center; background-repeat: no-repeat;'>";
				echo "	<tr>";
							for ( $i = 0; $i < $num; $i++ )
							{
								if (($i%7) == 0 && $i != 0) echo "</tr><tr>";
								$this->printState($results[$i]['state']);				
							}
				echo "	</tr>";
				echo "</table>";
			echo "</div>";
		}

		function printState ($state)
		{
			echo "<td width='14%' align='right' class='nav'>";
			echo "	<div style='margin-right: 25px;'>";
			echo "		<a id='$city' onClick=\"return false;\" onMouseOver=\"EventFormCityNameHighlight('".$state."');\" onMouseOut=\"EventFormCityNameDim('".$state."')\" href='' class='textBig' >";
			echo			$state;
			echo "		</a>";
			echo "</div>";
			echo "</td>";
		}

		function GetCityList()
		{	
			$queryEvents = "SELECT c.id, c.name, c.state FROM city c WHERE c.CountryId=1 ORDER BY c.name";
			$db = new Database($queryEvents);
			$result = $db->ExecuteQuery($queryEvents);

			if ($result != -1)
			{
				$results = array();
				$num = mysql_numrows($result);
							
				for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);	
				$this->printCityList($results, $num);	
				
				return true;
			}
			else echo "GetCityList Failed";
			return false;
		}

		function printCityList($results,$num)
		{
			echo "<div id='EventFormEventCity'>";
				echo "<table width='97%' border='0' cellspacing='0' cellpadding='2' align='center' style='background-image: url(images/velvetRope.jpg);background-position: center center; background-repeat: no-repeat;'>";
				echo "	<tr>";
							for ( $i = 0; $i < $num; ++$i )
							{
								if (($i%4) == 0 && $i != 0) echo "</tr><tr>";
								$this->printCity($results[$i]['name'].', '.$results[$i]['state'],'#', $results[$i]['id']);				
							}
				echo "	</tr>";
				echo "</table>";
			echo "</div>";
		}

		function printCity ($city, $link, $cityId)
		{
			echo "<td width='25%' align='right' class='nav'>";
			echo "	<div style='margin-right: 25px;'>";
			echo "		<a id='$city' onClick=\"Step2(".$cityId.",'".$city."'); return false;\" onMouseOver=\"EventFormCityNameHighlight('".$city."');\" onMouseOut=\"EventFormCityNameDim('".$city."')\" href='".$link."' class='textBig' >";
			echo			$city;
			echo "		</a>";
			echo "</div>";
			echo "</td>";
		}

		function SetVenueInfo($venueId)
		{	
			$query = "SELECT c.name as CityName, c.state as CityState, c.id as CityId, v.address as VenueAddress, v.name as VenueName, v.id as VenueId, v.imgURL as VenueImg FROM city c, venue v WHERE c.id=v.cityId AND v.id=".$venueId;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = mysql_fetch_array($result);	
				$this->VenueCityId = $results['CityId'];
				$this->VenueCityName = $results['CityName'];
				$this->VenueCityState = $results['CityState'];
				$this->VenueAddress = $results['VenueAddress'];
				$this->VenueName = $results['VenueName'];
				$this->VenueID = $results['VenueId'];
				$this->VenueImg = $results['VenueImg'];
				
				return true;
			}
			else echo "Event.SetVenueInfo Failed";
			return false;
		}

		function FindEvent($index)
		{	
			$query = "SELECT * FROM event WHERE id=$index";
						
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{				
				$results = mysql_fetch_array($result);
				$results['venueName'] = urldecode($results['venueName']);
				$results['eventTitle'] = str_replace("\'","'",urldecode($results['eventTitle']));
				$results['message'] = str_replace("\'","'",urldecode($results['message']));
				
				return $results;
			}
			else echo "Event.FindEvent Failed";
			return false;
		}

		function DisplayFeaturedEventMiniProfile ()
		{
			$layout = new Layout();
			$layout->bubbleSubBoxTop(90);

			$this->DisplayFeaturedEventMiniProfileContent();
			$layout->bubbleSubBoxBottom();	
			$layout->bubbleBoxSpacer();
		}

		function DisplayFeaturedEventMiniProfileContent ()
		{
			$layout = new Layout();
			$featuredEventInfo = dbFindFeatured('event');
			?>
			<div id='featuredEventFlyerZoom' style='display: none;' class='eventFlyerZoom'>
				<a href='eventDetails.php?eventId=<? echo $featuredEventInfo['id']; ?>'>
					<img onMouseOut="$('#featuredEventFlyerZoom').fadeOut(700); document.getElementById('miniEventFlyer').style.visibility = 'visible';" class="imgBorder" src="<? echo $featuredEventInfo['flyerURL']; ?>" border="0" width="234">
<!--
					<img onMouseOut="document.getElementById('featuredEventFlyerZoom').style.display = 'none'; document.getElementById('miniEventFlyer').style.visibility = 'visible';" class="imgBorder" src="<? echo $featuredEventInfo['flyerURL']; ?>" border="0" width="234">
-->
				</a>
			</div>
			<table style='padding-left: 10px;' cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr class="text">
					<td rowspan='2' valign="top" width='90'>
						<img id='miniEventFlyer' onMouseOver="$('#featuredEventFlyerZoom').fadeIn(700); document.getElementById('miniEventFlyer').style.visibility = 'hidden';" class="imgBorder" src="<? echo $featuredEventInfo['flyerURL']; ?>" border="0" width="85">
<!--
						<img id='miniEventFlyer' onMouseOver="document.getElementById('featuredEventFlyerZoom').style.display = 'block'; document.getElementById('miniEventFlyer').style.visibility = 'hidden';" class="imgBorder" src="<? echo $featuredEventInfo['flyerURL']; ?>" border="0" width="85">
-->
					</td>
					<td valign="top">
						<div style="width: 90%; margin-left: auto; margin-right: auto; text-align: justify;">
							<div class='nav'><? echo urldecode($featuredEventInfo["eventTitle"]) ?></div>
							<span class='text'>
								<? 
									echo "<div><a href='calendar.php?showDay=1&pMonth=".date("n", strtotime($featuredEventInfo['date']))."&pDay=".date("j", strtotime($featuredEventInfo['date']))."&pYear=".date("Y", strtotime($featuredEventInfo['date']))."'>".date("M. j, Y", strtotime($featuredEventInfo['date']))."</a></div>"; 
									echo "<div class='textBoldWhite'>";
											$layout->printVenueNameUnderOnOffLink ("featuredEventSpan", urldecode($featuredEventInfo['venueName']), $featuredEventInfo['venueId']);
									echo "</div>";
									echo "<div>".date("g:i a", strtotime($featuredEventInfo['date']))."</div>";										
								?>
							</span>						
						</div>
					</td>
				</tr>
				<tr>
					<td class='text' valign='bottom'>
						<div style="width: 90%; margin-left: auto; margin-right: auto; text-align: justify;">
							<? echo "<div><a href='eventDetails.php?eventId=".$featuredEventInfo['id']."'>Event Details</a></div>"; ?>
						</div>
					</td>
				</tr>
			</table>
			<?
		}

		function DisplayFeaturedEventRotator ()
		{
			$layout = new Layout();
			$featuredEventInfoArray = API::GetUpcomingEvents(10);	//get up to 5 events
			$eventCount = count($featuredEventInfoArray);

			for($x = 0; $x < $eventCount; $x++)
			{
				$featuredEventInfo = $featuredEventInfoArray[$x];
				
				//if no flyer provided, default to placeholder
				$currentFlyerURL = $featuredEventInfo['flyerURL'];
				if($currentFlyerURL == "")
					$currentFlyerURL = "http://www.globalzona.com/party/images/no_flyer.jpg";

				if($x == 0) $divWrapStyle = "display: block";
				else $divWrapStyle = "display: none";
?>
				<div id="featuredEventInformation<? echo $x; ?>" style="<? echo $divWrapStyle; ?>">
					<div id='featuredEventFlyerZoom<? echo $x; ?>' style='display: none;' class='eventFlyerZoom'>
						<a href='eventDetails.php?eventId=<? echo $featuredEventInfo['id']; ?>'>
							<img onMouseOut="$('#featuredEventFlyerZoom<? echo $x; ?>').fadeOut(700); document.getElementById('miniEventFlyer<? echo $x; ?>').style.visibility = 'visible';" class="imgBorder" src="<? echo $currentFlyerURL; ?>" border="0" width="234">
						</a>
					</div>
					<table style='padding-left: 10px;' cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr class="text">
							<td rowspan='2' valign="top" width='90'>
								<img id='miniEventFlyer<? echo $x; ?>' onMouseOver="$('#featuredEventFlyerZoom<? echo $x; ?>').fadeIn(700); document.getElementById('miniEventFlyer<? echo $x; ?>').style.visibility = 'hidden';" class="imgBorder" src="<? echo $currentFlyerURL; ?>" border="0" width="85" height="110">
							</td>
							<td valign="top">
								<div style="width: 90%; margin-left: auto; margin-right: auto; text-align: justify;">
									<div class='navTall'><? echo $layout->printLimitedString(ucwords(strtolower(urldecode($featuredEventInfo["eventTitle"]))),17); ?></div>
									<span class='text'>
										<? 
											echo "<div><a href='calendar.php?showDay=1&pMonth=".date("n", strtotime($featuredEventInfo['date']))."&pDay=".date("j", strtotime($featuredEventInfo['date']))."&pYear=".date("Y", strtotime($featuredEventInfo['date']))."'>".date("M. j, Y", strtotime($featuredEventInfo['date']))."</a></div>"; 
											echo "<div class='textBoldWhite'>";
													$layout->printVenueNameUnderOnOffLink ("featuredEventSpan".$x, urldecode($featuredEventInfo['venueName']), $featuredEventInfo['venueId']);
											echo "</div>";
											echo "<div>".date("g:i a", strtotime($featuredEventInfo['date']))."</div>";										
										?>
									</span>						
								</div>
							</td>
						</tr>
						<tr>
							<td class='text' valign='bottom'>
								<div style="width: 90%; margin-left: auto; margin-right: auto; text-align: justify;">
									<? echo "<div><a href='eventDetails.php?eventId=".$featuredEventInfo['id']."'>Event Details</a></div>"; ?>
								</div>
							</td>
						</tr>
					</table>
				</div>
<?
			}
?>
			<script>
				//initialize and start the event rotator
				featuredEventRotator = new EventRotator ('featuredEventInformation', 'featuredEventNav', <? echo $eventCount; ?>, 2500);
				featuredEventRotator.start();
			</script>
<?
			echo "<div style='margin: 5px 0px 7px 11px;'>";
			for($i = 0; $i < $eventCount; $i++)
			{
				if($i == 0) $backgroundNav = "C229CF";
				else $backgroundNav = "777777";
				echo "<a href='eventDetails.php?eventId=".$featuredEventInfoArray[$i]['id']."'>";
				echo "	<div id='featuredEventNav".$i."' onMouseOver=\"document.getElementById('featuredEventNav".$i."').style.backgroundColor = '#EEEEEE'; featuredEventRotator.showSelectedEvent(".$i.");\" style='width: 10px; height: 10px; cursor: pointer; background-color: #".$backgroundNav."; border: 1px solid #EEEEEE; float: left; margin: 0px 5px 0px 0px; font-size: 1px'></div>";
				echo "</a>";
			}
			echo "</div>";
		}

		function GetEventByVenue ($venueId)
		{
			$query = "SELECT * FROM event WHERE venueId=".$venueId." AND (date >= '".date('Y-m-d', time())."' OR isactive = 1) ORDER BY date, weekDay";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = array();
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);								
				
				if ($num > 0) for ($x = 0; $x < $num; $x++) $this->PrintEventBrief($results[$x]);
				else printBlankMessage("<br><br><div class='textBig' padding='10' style='text-align: center'>No events found for this venue.<br>To submit an event, please <a href='submitEvent.php'>click here</a>.</div>");


				return true;
			}
			else echo "Event.GetEventByVenue Failed";
			return false;
		}

		function PrintEventBrief ($eventInfo)
		{
			if ($eventInfo['IsActive'] == 1) $linkStart = "<a href='eventDetails.php?weeklyDay=".$this->GetDayOfWeekByIndex($eventInfo['weekDay'])."&eventId=".$eventInfo['id']."'>";
			else $linkStart = "<a href='eventDetails.php?eventId=".$eventInfo['id']."'>";
			$linkEnd = "</a>";

			echo "<table cellpadding='0' cellspacing='7' border='0' width='100%'>";
			echo "	<tr class='textBig'>";
			echo "		<td width='15%' valign='top'>";
							if($eventInfo['flyerURL'] != "") echo $linkStart."<img style='margin-left: 5px;' class='imgBorder' src='".$eventInfo['flyerURL']."' width='100' height='75' border='0'>".$linkEnd;
							else echo $linkStart."<img style='margin-left: 5px;' class='imgBorder' src='http://www.globalzona.com/party/images/no_flyer.jpg' width='100' height='75' border='0'>".$linkEnd;;
			echo "		</td>";
			echo "		<td align='justify' valign='top' style='padding-left: 10px;'>";
			echo			$linkStart."<b>".stripslashes(urldecode($eventInfo['eventTitle']))."</b>".$linkEnd;
			
							if ($eventInfo['IsActive'] == 1) echo "<br>Weekly - ".$this->GetDayOfWeekByIndex($eventInfo['weekDay'])."s";
							else echo "<br>".date("l, F j, Y", strtotime($eventInfo['date']));

			echo "			<br>".date("g:i a", strtotime($eventInfo['date']));
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		function GetDayOfWeekByIndex ($index)
		{
			switch ($index)
			{
				case 0:
					return "Sunday";
				case 1:
					return "Monday";
				case 2:
					return "Tuesday";
				case 3:
					return "Wednesday";
				case 4:
					return "Thursday";
				case 5:
					return "Friday";
				case 6:
					return "Saturday";
			}
		}
	}
?>