<?
	class Layout
	{
		function contentBoxTop ($title)
		{
			echo "<table width='97%' border='0' cellspacing='3' cellpadding='5'>";
			echo "	<tr>";
			echo "		<td bgcolor='#333333' class='text' align='justify'>";
			echo "			<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			echo "				<tr class='navTall'><td class='featuredBG' align='right'><div style='margin-top: -1px; padding-top: -1px; padding-right: 10px; padding-bottom: 2px;'>".$title."</div></td></tr>";
			echo "				<tr><td class='spacer'>&nbsp;</td></tr>";
			echo "				<tr class='nav' bgcolor='#777777'><td>";
		}

		function contentBoxBottom ()
		{
			echo "					</td></tr>";
			echo "			</table>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		function bubbleBoxTop ($title, $leftLink)
		{
			?>
			<div><b class="roundCorner"><b class="roundCorner1"><b></b></b><b class="roundCorner2"><b></b></b><b class="roundCorner3"></b><b class="roundCorner4"></b><b class="roundCorner5"></b></b>
			<div class="roundCornerfg">
			<?
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' >";
			echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
			echo "	<tr>";
			echo "		<td class='text' align='right' style=\"background-image: url(http://www.globalzona.com/party/layout/navBG.jpg); background-position: top; background-repeat: no-repeat;\">";
			echo "			<div style='margin-top: 0px; padding-right: 10px; padding-bottom: 2px;' class='navTall'><div style='float: left;'>&nbsp;&nbsp;".$leftLink."</div>".$title."</div>";
			echo "			<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			echo "				<tr class='nav'><td>";
		}

		function bubbleBoxBottom ()
		{
			echo "				</td></tr>";
			echo "			</table>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
			?>
			</div>
			<b class="roundCorner"><b class="roundCorner5"></b><b class="roundCorner4"></b><b class="roundCorner3"></b><b class="roundCorner2"><b></b></b><b class="roundCorner1"><b></b></b></b></div>				
			<?
		}

		function bubbleSubBoxTop ($widthPercent)
		{
			?>
			<div style='width: <? echo $widthPercent; ?>%; text-align: center;'><b class="roundCornerDark"><b class="roundCornerDark1"><b></b></b><b class="roundCornerDark2"><b></b></b><b class="roundCornerDark3"></b><b class="roundCornerDark4"></b><b class="roundCornerDark5"></b></b>
			<div class="roundCornerDarkfg">
			<?
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' >";
			echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
			echo "	<tr>";
			echo "		<td>";
			echo "			<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			echo "				<tr class='nav'><td>";
		}

		function bubbleSubBoxBottom ()
		{
			echo "				</td></tr>";
			echo "			</table>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
			echo "</table>";
			?>
			</div>
			<b class="roundCornerDark"><b class="roundCornerDark5"></b><b class="roundCornerDark4"></b><b class="roundCornerDark3"></b><b class="roundCornerDark2"><b></b></b><b class="roundCornerDark1"><b></b></b></b></div>				
			<?
		}

		function bubbleTab ($content, $widthPercent)
		{
			?>
			<div style='width: <? echo $widthPercent; ?>%; text-align: center;'><b class="roundCornerDark"><b class="roundCornerDark1"><b></b></b><b class="roundCornerDark2"><b></b></b><b class="roundCornerDark3"></b><b class="roundCornerDark4"></b><b class="roundCornerDark5"></b></b>
			<div class="roundCornerDarkfg">
			<?
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' >";
			echo "	<tr>";
			echo "		<td>";
			echo "			<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			echo "				<tr class='navTall'><td align='center'>";
			echo					$content;
			echo "				</td></tr>";
			echo "			</table>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
			echo "</div>";
			echo "</div>";
		}

		function bubbleTab2 ($content, $widthPercent)
		{
			?>
			<div style='width: <? echo $widthPercent; ?>%; text-align: center;'><b class="roundCornerSub2"><b class="roundCornerSub21"><b></b></b><b class="roundCornerSub22"><b></b></b><b class="roundCornerSub23"></b><b class="roundCornerSub24"></b><b class="roundCornerSub25"></b></b>
			<div class="roundCornerSub2fg">
			<?
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' >";
			echo "	<tr>";
			echo "		<td>";
			echo "			<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			echo "				<tr class='navTall'><td align='center'>";
			echo					$content;
			echo "				</td></tr>";
			echo "			</table>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
			echo "</div>";
			echo "</div>";
		}

		function bubbleSub2BoxTop ($widthPercent)
		{
			?>
			<div style='width: <? echo $widthPercent; ?>%; text-align: center;'><b class="roundCornerSub2"><b class="roundCornerSub21"><b></b></b><b class="roundCornerSub22"><b></b></b><b class="roundCornerSub23"></b><b class="roundCornerSub24"></b><b class="roundCornerSub25"></b></b>
			<div class="roundCornerSub2fg">
			<?
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' >";
			echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
			echo "	<tr>";
			echo "		<td>";
			echo "			<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			echo "				<tr class='textBig'><td>";
		}

		function bubbleSub2BoxBottom ()
		{
			echo "				</td></tr>";
			echo "			</table>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
			echo "</table>";
			?>
			</div>
			<b class="roundCornerSub2"><b class="roundCornerSub25"></b><b class="roundCornerSub24"></b><b class="roundCornerSub23"></b><b class="roundCornerSub22"><b></b></b><b class="roundCornerSub21"><b></b></b></b></div>				
			<?
		}

		function bubbleBoxSpacer ()
		{
			echo "<div class='spacer2'>&nbsp;</div>";
		}

		function loginForm ()
		{
			echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
			echo "<form action='mainMenu.php' method='post'>";
			echo "	<input type='hidden' name='login' value='true'>";
			echo "	<input type='hidden' name='venueId' value='".$_GET['venueId']."'>";
			echo "	<tr class='nav'>";
			echo "		<td colspan='2' class='lightGradient'>&nbsp;&nbsp;&nbsp;Returning Visitor</td>";
			echo "	</tr>";
			
			if($_GET['failedLogin'] == "true") 
				echo "<tr class='nav' bgcolor='red'><td align='center' colspan='2'>The email and/or password did not match.</td></tr>";

			echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
			echo "	<tr class='navTall'>";
			echo "		<td width='30%' valign='top' align='right'>Email</td>";
			echo "		<td width='70%'><input name='email' id='emailLogin' type='text' class='formWidth' maxlength='100'></td>";
			echo "	</tr>";
			echo "	<tr class='navTall'>";
			echo "		<td valign='top' align='right'>Password</td>";
			echo "		<td><input name='password' type='password' class='formWidth' maxlength='100'></td>";
			echo "	</tr>";
			echo "	<tr class='navTall'>";
			echo "		<td>&nbsp;</td>";
			echo "		<td><input type='submit' name='Submit' class='form' value='Login'></td>";
			echo "	</tr>";
			echo "	<tr class='text'>";
			echo "		<td colspan='2' align='center'>";
			echo "			<div id='forgotPasswordLink' style='padding-right: 10px; text-align: right;'><a href='#' onClick=\"showForgotPassword(); return false;\">forgot your password</a></div>";
			echo "			<div id='forgotPasswordForm' style='display: none; padding: 5px;'>";
								$this->bubbleSub2BoxTop(80);
			echo "				<div id='forgotPasswordBubbleContent' style='text-align: center;'>";
			echo "					Email:&nbsp;<input name='emailForPassword' id='emailForPassword' type='text' class='formWidth' maxlength='100'><br>";
			echo "					<div class='spacer'>&nbsp;</div>";
			echo "					<input onClick=\"sendForgotPassword(); return false;\" type='button' name='Submit' class='form' value='Send Password'>";
			echo "					&nbsp;<input onClick=\"hideForgotPassword(); return false;\" type='button' name='CancelSubmit' class='form' value='Cancel'>";
									$this->bubbleSub2BoxBottom();
			echo "				</div>";
			echo "			</div>";
			echo "		</td>";
			echo "	</tr>";
			echo " </form>";
			echo "</table>";
		}

		function registrationForm ()
		{
			echo "<table cellpadding=2 cellspacing=0 border=0 width='100%'>";
			echo "<form action='confirmNewWebUser.php' method='post'>";
			echo "	<input type='hidden' name='register' value='true'>";
			echo "	<input type='hidden' name='venueId' value='".$_GET['venueId']."'>";
			echo "	<tr class='nav'>";
			echo "		<td colspan='2' class='lightGradient'>&nbsp;&nbsp;&nbsp;New Visitor</td>";
			echo "	</tr>";
				
			if($_GET['failedRegistration'] == "true") 
			{
				echo "<tr bgcolor='red'><td colspan='2'>";
				echo "	<div class='navTall' align='center'>The registration did not succeed.</div>";
				echo "<hr color='black' noshade size='1'>";
				
				if($_GET["message"] != "<ul class='text'></ul>") echo urldecode($_GET["message"]);
				else
				{
					echo "	<ul class='text'>";
					echo "		<li>The email you provided is already registered.</li>";
					echo "	</ul>";
				}
				echo "</td></tr>";
			}

			echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
			echo "	<tr class='navTall'>";
			echo "		<td valign='top' align='right'>First Name</td>";
			echo "		<td><input name='firstname' type='text' class='formWidth' maxlength='100'></td>";
			echo "	</tr>";
			echo "	<tr class='navTall'>";
			echo "		<td valign='top' align='right'>Last Name</td>";
			echo "		<td><input name='lastname' type='text' class='formWidth' maxlength='100'></td>";
			echo "	</tr>";
			echo "	<tr class='navTall'>";
			echo "		<td width='30%' valign='top' align='right'>Email</td>";
			echo "		<td width='70%'><input name='email' type='text' class='formWidth' maxlength='100'></td>";
			echo "	</tr>";
			echo "	<tr class='navTall'>";
			echo "		<td width='30%' valign='top' align='right'>Password</td>";
			echo "		<td><input name='password' type='password' class='formWidth' maxlength='100'></td>";
			echo "	</tr>";
			echo "	<tr class='navTall'>";
			echo "		<td>&nbsp;</td>";
			echo "		<td valign='top'><input type='submit' name='Submit' class='form' value='Register'></td>";
			echo "	</tr>";
			echo "</form>";
			echo "</table>";
		}

		function cityViewCalendar($cityId)
		{
			echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			echo "	<tr class='nav' bgcolor='#333333'>";
			echo "		<td>";

							$currentTime = time() + (1 * 24 * 60 * 60);
							$weekPlusTime = time() + (7 * 24 * 60 * 60);
							$startDay = date("Y",$currentTime).'-'.date("m",$currentTime).'-'.date("d",$currentTime).' 00:00:00';
							$endDay = date("Y",$weekPlusTime).'-'.date("m",$weekPlusTime).'-'.date("d",$weekPlusTime).' 23:59:59';	
							dbGetEvent ($startDay,$endDay, $cityId,"main"); 

			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		function cityViewVenues($cityId)
		{
			if (cityHasVenues($cityId))
			{
				echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
				echo "	<tr class='nav' bgcolor='#333333'>";
				echo "		<td>";
								dbGetTopVenueRandomByCity(3,$cityId);
				echo "		</td>";
				echo "	</tr>";
				echo "</table>";
			}
		}

		function cityViewPhotos($cityId)
		{
			if (cityHasPhotos($cityId))
			{
				echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
				echo "	<tr class='nav' bgcolor='#333333'>";
				echo "		<td valign='top'>";
								dbGetRecentAlbumByCity(3,$cityId);
				echo "		</td>";
				echo "	</tr>";		
				echo "</table>";
			}
		}

		function cityListBubble($columnCount)
		{
			$leftLink = "<span class='textBig'>Please select your city to find local events, venues, and photos</span>";
			$this->bubbleBoxTop("Welcome to GlobalZona.com!",$leftLink);
			$this->cityList($columnCount);
			$this->bubbleBoxBottom(); 
		}

		function cityList($columnCount)
		{
			echo "	<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			echo "	<tr class='nav' bgcolor='#333333'>";
			echo "		<td width='69%' valign='top' align='center'>";
			echo "			<div style='padding-left: 15px; padding-right: 2px; text-align: justify'>";
								$this->bubbleBoxSpacer(); 
								$this->bubbleSubBoxTop(100);							
								$this->dbGetCityList($columnCount);
			echo "				<div id='citySuggestDiv' style='width: 45%; padding: 5px; padding-right: 50px; display: none; float: right;'>";
									$this->bubbleSub2BoxTop(100);
									$this->suggestCity();
									$this->bubbleSub2BoxBottom();
			echo "				</div>";
								$this->bubbleSubBoxBottom();

								$this->bubbleBoxSpacer(); 
								$this->bubbleSubBoxTop(100);
								include "ads/ad12_468x60_image.php";
								$this->bubbleSubBoxBottom();								

								$this->bubbleBoxSpacer(); 
								$this->bubbleSubBoxTop(100);
								$photoAlbums = new PhotoAlbum();
								$photoAlbums->SetRecentPhotoAlbums(4);
								$photoAlbums->PrintPhotoAlbumPreviewInfo(4);

			echo "				<table cellpadding='0' cellspacing='0' width='100%' border='0'><tr><td>";
			echo "					<div style='padding-top: 10px; padding-left: 15px;'>";
			echo "						<a href='contact.php?emailSubject=Please Add My Photo Album&specialMessage=paste link to your album here'>send us your album link</a>";
			echo "					</div>";
			echo "				</td><td>";
			echo "					<div style='padding-top: 10px; padding-right: 15px; text-align: right;'>";
			echo "						<a href='photo.php'>view all albums</a>";
			echo "					</div>";
			echo "				</td></tr></table>";

								$this->bubbleSubBoxBottom();

								$this->bubbleBoxSpacer(); 
								$this->bubbleSubBoxTop(100);
								include "ads/ad12_468x60_image.php";
								$this->bubbleSubBoxBottom();
								/*
								$this->bubbleBoxSpacer(); 
								$this->bubbleSubBoxTop(100);
								$articles = new Article();
								$articles->SetMostRecentArticles(6);
								$articles->PrintArticleInfo(true);
								$this->bubbleSubBoxBottom();
								*/
			echo "			</div>";
			echo "		</td>";
			echo "		<td rowspan='2' width='31%' valign='top' align='center'>"; 
							$this->bubbleBoxSpacer(); 
							$this->bubbleSubBoxTop(90);

							$event = new Event();
							$event->DisplayFeaturedEventRotator ();
							$this->bubbleBoxSpacer(); 

							//$this->printUploadPhoto();
							$this->bubbleBoxSpacer(); 
							$this->dbGetRecentEvents(5);
							echo "<table width='100%' border='0' cellpadding='2' cellspacing='0' class='textBig'>";
							echo "	<tr class='nav'><td align='center' class='lightGradient'>Calendar</td></tr>";
							echo "	<tr><td align='center'>";
										include "includes/calendarYUI.basic.php";
										DrawCalendarBasic(90, "#222222", false);
							echo "	</td></tr>";
							echo "</table>";
							$this->bubbleSubBoxBottom();
							include "include.textlinkads.php";
							/*
							$this->bubbleBoxSpacer(); 
							$this->bubbleSubBoxTop(90);
							include "ads/ad3.php";
							$this->bubbleSubBoxBottom();
							*/
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
			$this->bubbleBoxSpacer();
		}

		function printUploadPhoto ()
		{				
			echo "<table cellpadding='2' cellspacing='0' border='0' width='100%'>";
			echo "	<tr class='nav'><td colspan='2' align='center' class='lightGradient'>Submit YOUR Party Pics!</td></tr>";
			echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
			echo "	<tr>";
			echo "		<form enctype='multipart/form-data' action='' method='POST'>";
			echo "		<td>";
			echo "			<div class='textBigNormal' style='padding-left: 10px; padding-right: 10px; text-align: center;'>";
								if($_POST['IsUpload'] == "true")
								{
									$upload = new Upload($_FILES['userfile']);
									$upload->UploadImage();
									
									echo "<div class='spacer'>&nbsp</div>";
									echo "Thanks, your photo was uploaded and will be added to the upcoming gallery!";
								}
								else
								{
									echo "We're putting together a gallery of party pics! So upload those crazy shots...";
								}
								?>												
									<div class='spacer'>&nbsp</div>
									<input type='hidden' name='IsUpload' value='true'>
									<input name="userfile" type="file"/>
									<div class='text' style='color: #dddddd'>Image file must be 250KB or less</div>
									<div class='spacer'>&nbsp</div>
									<input class="formLarge" type="submit" value="Submit Photo!" />												
								<?
			echo "			</div>";
			echo "		</td>";
			echo "		</form>";
			echo "	</tr>";	
			echo "</table>";
		}

		function dbGetCityList($columnCount)
		{	
			$queryEvents = "SELECT c.id, c.name, c.state, c.imgURL FROM city c, event e WHERE c.id = e.cityId AND (e.date >= '".date('Y-m-d 00:00:00', time())."' OR e.IsActive=1) group by c.name, c.id, c.state";

			$db = new DB_Connect();
			mysql_connect($db->localhost,$db->username,$db->password);
			@mysql_select_db($db->database) or die( "Unable to select database");
			
			if(!$result = mysql_query($queryEvents))
			{
				echo "Can't get city list.";
				mysql_close();
			}
			else
			{
				$results = array();
				$num = mysql_numrows($result);
				mysql_close();
							
				for ( $i = 0; $i < $num; ++$i ) 
				{
					$results[$i] = mysql_fetch_array($result);	

					//Takes out San Francisco from general list
					//if ($results[$i]['id'] == 1)
					$excludedCityId = array(1);
					if ($this->IsValueInArray($results[$i]['id'],$excludedCityId))
					{
						unset($results[$i--]);
						$num--;
					}
				}
				$this->printCityList($results, $num, $columnCount);				
			}
		}

		function IsValueInArray ($value,$array)
		{
			for($x = 0; $x < count($array); $x++)
			{
				if($array[$x] == $value) return true;
			}
			return false;
		}

		function printCityList($results,$num,$columnCount)
		{
			echo "<table width='95%' border='0' cellspacing='0' cellpadding='2' align='center'>";
			echo "	<tr>";
			echo "		<td>";
			echo "			<div style='margin-right: 25px;'>";
								$this->printPrimeCity ("San Francisco, CA", 1, "http://www.globalzona.com/party/images/cityImages/SF75.jpg");
			echo "			</div>";
			echo "		</td>";
			/*
			echo "		<td>";
			echo "			<div style='margin-right: 25px;'>";
								$this->printPrimeCity ("San Jose, CA", 2, "http://www.globalzona.com/party/images/cityImages/SanJose.jpg");
			echo "			</div>";
			echo "		</td>";
			*/
			echo "	</tr>";
			echo "</table>";
			echo "<div id='ViewAllCities' style='display: block;'>";
			echo "<table width='95%' border='0' cellspacing='0' cellpadding='2' align='center' style='background-image: url(images/velvetRope.jpg);background-position: center center; background-repeat: no-repeat;'>";
			echo "	<tr><td colspan='3'><hr noshade color='#dddddd' size='1'></td></tr>";
			echo "	<tr>";
						for ( $i = 0; $i < $num; ++$i )
						{
							if (($i%$columnCount) == 0 && $i != 0) echo "</tr><tr>";
							$this->printCity($results[$i]['name'].', '.$results[$i]['state'],'calendar.php?cityId='.$results[$i]['id'], $results[$i]['id']);				
						}
			echo "	</tr>";
			echo "</table>";
			echo "</div>";
			echo "<table width='95%' border='0' cellspacing='0' cellpadding='2' align='center'>";
			echo "	<tr>";
			echo "		<td align='right'>";
			echo "			<hr noshade color='#dddddd' size='1'>";
			echo "			<div style='margin-right: 25px;'>";
			//echo "				<input type='hidden' id='cityListHiddenParam' value='closed'>";
			//echo "				<a href='#' onClick=\"showCityListDiv(); return false;\" class='text' style='text-decoration: underline;'>View All Cities</a>&nbsp;";
			echo "				<input type='hidden' id='citySuggestHiddenParam' value='closed'>";
			echo "				<span class='text'>Don't see a city you want? No problem, please <a href='#' onClick=\"showCitySuggestDiv(); return false;\" class='text' style='text-decoration: underline;'>suggest a new city</a>.</span>";
			echo "			</div>";

			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		function printPrimeCity ($city, $cityId, $cityImg)
		{
			echo "				<table cellpadding='0' cellspacing='1' border='0'>";
			echo "					<tr><td><img class='imgBorder' src='".$cityImg."' width='40' border='0'></td>";
			echo "						<td valign='middle'>";
			echo "							<div style='padding-left: 10px;'>";
			echo "								<a id='".$city."' href='city.php?cityId=1' onMouseOver=\"document.getElementById('".$city."').style.textDecoration='underline'; document.getElementById('".$city."').style.color='#C229CF'\" onMouseOut=\"document.getElementById('".$city."').style.textDecoration='none';document.getElementById('".$city."').style.color='#ffffff'\" class='navHeader'>";
			echo "									<b>".$city."</b>";
			echo "								</a><br>";
			echo "								<span class='navTall'>";
			echo "									<table width='240' class='navTall' cellpadding='0' cellspacing='1' border='0'><tr>";
			echo "										<td width='80'><a id='EventsPage".$cityId."' class='underLineOff' onMouseOver=\"document.getElementById('EventsPage".$cityId."').className='underLineOn';\" onMouseOut=\"document.getElementById('EventsPage".$cityId."').className='underLineOff';\" href='calendar.php?cityId=".$cityId."'>".$this->getCityEventCount($cityId)." events</a></td>";
			echo "										<td width='80'><a id='VenuePage".$cityId."' class='underLineOff' onMouseOver=\"document.getElementById('VenuePage".$cityId."').className='underLineOn';\" onMouseOut=\"document.getElementById('VenuePage".$cityId."').className='underLineOff';\" href='venueDirectory.php?cityId=".$cityId."'>".$this->getCityVenueCount($cityId)." venues</a></td>";
			echo "										<td width='80'><a id='AlbumPage".$cityId."' class='underLineOff' onMouseOver=\"document.getElementById('AlbumPage".$cityId."').className='underLineOn';\" onMouseOut=\"document.getElementById('AlbumPage".$cityId."').className='underLineOff';\" href='photo.php?cityId=".$cityId."'>".$this->getCityAlbumCount($cityId)." albums</a></td>";
			echo "									</table>";
			echo "								</span>";
			echo "							</div>";
			echo "					</td></tr>";
			echo "				</table>";
		}

		function printCity ($city, $link, $cityId)
		{
			echo "<td width='33%' align='right' class='nav'>";
			echo "	<div style='margin-right: 25px;'>";
			echo "		<a id='$city' onMouseOver=\"document.getElementById('$city').style.textDecoration='underline'; document.getElementById('$city').style.color='#C229CF'\" onMouseOut=\"document.getElementById('$city').style.textDecoration='none';document.getElementById('$city').style.color='#ffffff'\" href='city.php?cityId=".$cityId."' class='textBig bubbleTip' title=\"".$this->getCityCountBreakDown($cityId)."\">";
			echo			$city."&nbsp;(".$this->getCityScore($cityId).")";
			echo "		</a>";
			echo "</div>";
			echo "</td>";
		}

		function getCityCountBreakDown ($cityId)
		{
			$returnVal = "<div id='cityInfoBreakDown'>";
			$returnVal = $returnVal."	<ul>";
			$returnVal = $returnVal."		<li>".$this->getCityEventCount($cityId)."&nbsp;events&nbsp;</li>";
			$returnVal = $returnVal."		<li>".$this->getCityVenueCount($cityId)."&nbsp;venues&nbsp;</li>";
			$returnVal = $returnVal."		<li>".$this->getCityAlbumCount($cityId)."&nbsp;albums</li>";
			$returnVal = $returnVal."	</ul>";
			$returnVal = $returnVal."</div>";

			return $returnVal;
		}

		function getCityEventCount ($cityId)
		{
			$currentDate = getdate();
			$query = "SELECT count(*) as eventCount FROM event WHERE cityId = ".$cityId." and (Date >= '".$currentDate['year']."-".$currentDate['mon']."-".$currentDate['mday']."' or IsActive = 1)";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = mysql_fetch_array($result);
				return $results['eventCount'];
			}
			else echo "getCityEventCount Failed";
			return false;
		}

		function getCityVenueCount ($cityId)
		{
			$currentDate = getdate();
			$query = "SELECT count(*) as venueCount FROM venue WHERE cityId = ".$cityId;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = mysql_fetch_array($result);
				return $results['venueCount'];
			}
			else echo "getCityVenueCount Failed";
			return false;
		}

		function getCityAlbumCount ($cityId)
		{
			$currentDate = getdate();
			$query = "SELECT count(*) as albumCount FROM photoAlbum WHERE eventCityId = ".$cityId;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = mysql_fetch_array($result);
				return $results['albumCount'];
			}
			else echo "getCityAlbumCount Failed";
			return false;
		}

		function getCityScore ($cityId)
		{
			return $this->getCityEventCount($cityId) + $this->getCityVenueCount($cityId) + $this->getCityAlbumCount($cityId);
		}

		function searchEventsBubble()
		{
			$leftLink = "";
			$this->bubbleBoxTop("Search Events",$leftLink);
			$this->searchEvents();
			$this->bubbleBoxBottom(); 
		}

		function searchEvents ()
		{

			echo "<table width='100%' cellpadding='1' cellspacing='2' border='0'>";
			echo "	<form action='calendar.php?showDay=1&cityId=".$_GET['cityId']."' method='POST'>";
			echo "		<tr><td align='center' class='spacer'>";
			echo "			<br>";
								calendar_month('',''); 
								calendar_day('','');
								calendar_year('','');
			echo "			<br><br><input type='submit' name='Submit' class='form' value='Get ";
							if ($_GET['cityId'] != "") echo dbFindCity($_GET['cityId']); 
							else echo 'All Cities';
			echo " Party List'><br><br>";
			echo "		</td></tr>";
			echo "	</form>";
			echo "	</table>";

		}

		function mailListBubble()
		{
			$leftLink = "";
			$this->bubbleBoxTop("Get All the Updates!",$leftLink);
			$this->mailList();
			$this->bubbleBoxBottom(); 
		}

		function mailList()
		{
			echo "<table width='100%' cellpadding='1' cellspacing='2' border='0'>";
			echo "	<tr><td align='center' class='spacer'><br>";
							if ($_POST['guestlist'] == "true") 
							{ 
								recordGuestList($_POST['firstname'],$_POST['lastname'],$_POST['email2'],'');	//record guestlist entry	
								echo "<div class='text'>Thank you for signing up.</div>";
							} 
							else 
							{
								echo "<div id='guestListSideBar'>";
								echo "	<table width='100%' cellpadding='1' cellspacing='0' border='0'>";
								echo "		<form onSubmit='return check_submitGuestList(this);' method='POST'>";
								echo "			<input type='hidden' name='guestlist' value='true'>";
								echo "			<tr class='text'><td width='10%'>&nbsp;</td><td><input onClick=\"if(document.getElementById('firstname').value=='First Name') document.getElementById('firstname').value='';\" type='text' id='firstname' name='firstname' class='form' size='25' maxlength='50' value='First Name'></td></tr>";
								echo "			<tr class='text'><td width='10%'>&nbsp;</td><td><input onClick=\"if(document.getElementById('lastname').value=='Last Name') document.getElementById('lastname').value='';\" type='text' id='lastname' name='lastname' class='form' size='25' maxlength='50' value='Last Name'></td></tr>";
								echo "			<tr class='text'><td width='10%'>&nbsp;</td><td><input onClick=\"if(document.getElementById('email2').value=='Email') document.getElementById('email2').value='';\" type='text' id='email2' name='email2' class='form' size='25' maxlength='50' value='Email'></td></tr>";
								echo "			<tr class='text'><td width='10%'>&nbsp;</td><td><input type='submit' name='submit' value='Sign-up!' class='form'></td></tr>";
								echo "		</form>";
								echo "	</table>";
								echo "</div>";
							}
			echo "		<br>";
			echo "	</td></tr>";
			echo "</table>";
		}

		function suggestCityBubble()
		{
			$leftLink = "";
			$this->bubbleBoxTop("Suggest a New City",$leftLink);
			$this->suggestCity();
			$this->bubbleBoxBottom(); 
		}

		function suggestCity()
		{
			echo "<table width='100%' cellpadding='1' cellspacing='2' border='0'>";	
			echo "<form name='formCitySuggest' method='POST' onSubmit=\"suggestCity(this.citySuggest.value); return false;\">";
			echo "	<tr>";
			echo "		<td align='center' class='spacer'>";
			echo "			<div id='citySuggest'><br><input name='citySuggest' class='formLarge' size='25' maxlength='45'><br><br>";
			echo "			<input type='submit' name='Submit' id='buttonMain' class='formLarge' value='Suggest City'><br><br></div>";
			echo "			<div style=\"display:none; background-color: #ff6600\" class='text' id='txtHint'>&nbsp;</div>";
			echo "		</td>";
			echo "	</tr>";
			echo "	</form>";
			echo "</table>";
		}

		function notifyOfEvent($eventId)
		{
			echo "<div id='notifyOfEvent'>";
			echo "	<div id='responseFromNotifyOfEvent'>&nbsp;</div>";
			echo "<table width='100%' cellpadding='1' cellspacing='2' border='0'>";	
			echo "<form name='formNotifyAboutEvent' method='POST'>";
			echo "	<tr>";
			echo "		<td align='right' width='35%' class='textBig'>Your Name:&nbsp;</td>";
			echo "		<td class='spacer'>";
			echo "				<input name='fromName' id='fromName' class='formLarge' size='25' maxlength='55'>";
			echo "		</td>";
			echo  "	</tr>";
			echo  "	<tr>";
			echo "		<td align='right' width='35%' class='textBig'>Your Email:&nbsp;</td>";
			echo "		<td class='spacer'>";
			echo "			<input name='fromName' id='fromEmail' class='formLarge' size='25' maxlength='55'>";
			echo "		</td>";
			echo "	</tr>";
			echo  "	<tr>";
			echo "		<td align='right' width='35%' class='textBig'>Your Friend's Email:&nbsp;</td>";
			echo "		<td class='spacer'>";
			echo "			<input name='fromName' id='toEmail' class='formLarge' size='25' maxlength='55'>";
			echo "		</td>";
			echo "	</tr>";
			echo  "	<tr>";
			echo "		<td>&nbsp;</td>";
			echo "		<td>";
			echo "			<input onClick=\"SentNotifyOfEvent(".$eventId."); return false;\" type='button' name='Submit' id='buttonMain' class='formLarge' value='Tell a Friend'><br>";
			echo "		</td>";
			echo "	</tr>";
			echo "	</form>";
			echo "</table>";
			echo "</div>";
		}

		function dbGetRecentEvents ($limit)
		{
			
			$query = "SELECT e.flyerURL, e.date, e.Id as eventId, e.eventTitle, e.venueName, e.venueId, c.Id as cityId, c.name as cityName, e.message, c.state as cityState ";
			$query = $query."FROM event e, city c ";
			$query = $query."WHERE c.Id = e.cityId AND e.date >= '".date('Y-m-d 00:00:00', time())."'";
			$query = $query." ORDER BY e.submitted desc";
			$db = new DB_Connect();

			
			mysql_connect($db->localhost,$db->username,$db->password);
			@mysql_select_db($db->database) or die( "Unable to select database");

			if(!mysql_query($query)) 
			{
				echo "Can't get most recent events.";
				mysql_close();
			}
			else
			{
				$results = array();
				$result = mysql_query($query);
				$num = mysql_numrows($result);
				mysql_close();
							
				for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);

				$eventDate = array();		
				$eventId = array();
				$eventTitle = array();
				$venueName = array();
				$cityName = array();
				$message = array();
				$state = array();				
				$venueId = array();	
				$cityId = array();	
				$flyerURL = array();

				for ($i = 0; $i < $num; ++$i) $eventDate[$i] = $results[$i]['date'];
				for ($i = 0; $i < $num; ++$i) $eventId[$i] = $results[$i]['eventId'];
				for ($i = 0; $i < $num; ++$i) $eventTitle[$i] = str_replace("\'","'",urldecode($results[$i]['eventTitle']));
				for ($i = 0; $i < $num; ++$i) $venueName[$i] = str_replace("\'","'",urldecode($results[$i]['venueName']));
				for ($i = 0; $i < $num; ++$i) $venueId[$i] = $results[$i]['venueId'];
				for ($i = 0; $i < $num; ++$i) $cityName[$i] = $results[$i]['cityName'];
				for ($i = 0; $i < $num; ++$i) $state[$i] = $results[$i]['cityState'];		
				for ($i = 0; $i < $num; ++$i) $cityId[$i] = $results[$i]['cityId'];		
				for ($i = 0; $i < $num; ++$i) $message[$i] = str_replace("\'","'",urldecode($results[$i]['message']));
				for ($i = 0; $i < $num; ++$i) $flyerURL[$i] = $results[$i]['flyerURL'];	
				$this->printRecentEvent($eventDate,$eventId,$eventTitle,$venueName,$venueId,$cityId,$cityName,$message, $state, $flyerURL, $limit);
			}
		}

		function printRecentEvent ($eventDate, $eventId, $eventTitle, $venueName, $venueId, $cityId, $cityName, $message, $state, $flyerURL, $limit)
		{
			if (count($eventId) == 0) echo "&nbsp;&nbsp;&nbsp;No recent events listed.";
			else
			{

				if (count($eventId) < $limit) $loopRun = count($eventId);
				else $loopRun = $limit;
				
				echo "<table cellpadding='2' cellspacing='0' border='0' width='100%' style='background-image: url(layout/recentEventsBG.jpg);background-position: center center; background-repeat: no-repeat;'>";
				echo "	<tr class='nav'><td colspan='2' align='center' class='lightGradient'>Recently Posted Events</td></tr>";

				for ($i = 0; $i < $loopRun; ++$i)
				{
					echo "<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
					echo "<tr id='recentEventRow".$eventId[$i]."' onMouseOver=\"document.getElementById('recentEventRow".$eventId[$i]."').className='bgMouseOverDetails';\" onMouseOut=\"document.getElementById('recentEventRow".$eventId[$i]."').className='';\">";
					echo "	<td style='padding-left: 10px' valign='middle'>";

					echo "<a href='eventDetails.php?eventId=".$eventId[$i]."'>";
					
					if ($flyerURL[$i] != "") echo "	<img class='imgBorder' src='".$flyerURL[$i]."' border='0' width='45' height='35'>";
					else echo "	<img class='imgBorder' src='http://www.globalzona.com/party/images/no_flyer.jpg' border='0' width='45' height='35'>";
					
					echo "</a>";

					echo "	</td>";
					echo "	<td class='textBigNormal'>";
					//echo "		<a href='eventDetails.php?eventId=".$eventId[$i]."' onMouseOver=\"$('#eventDetailsBG".$eventId[$i]."').fadeIn(500);\" onMouseOut=\"$('#eventDetailsBG".$eventId[$i]."').fadeOut(500);\">".$this->printLimitedString($eventTitle[$i],25)."</a>";
					echo "		<a href='eventDetails.php?eventId=".$eventId[$i]."' onMouseOver=\"document.getElementById('eventDetailsBG".$eventId[$i]."').style.display = 'block'\" onMouseOut=\"document.getElementById('eventDetailsBG".$eventId[$i]."').style.display = 'none'\">".$this->printLimitedString($eventTitle[$i],26)."</a>";
					echo "		<div id='eventDetailsBG".$eventId[$i]."' style='display: none;' class='layerEventTrans'>";
							?>
									<div id="eventDetailsText" style="z-index:11;">
										<table align='center' width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr><td class='nav' colspan='2' align='center' bgcolor='#333333'>Event Summary</td></tr>
											<tr><td align='right' class='navTall' width='20%'><font color=black>&nbsp;Date:&nbsp;</font></td><td class='text' style='padding-left: 5px; padding-right: 5px;'><? echo date("m.d.Y", strtotime($eventDate[$i])); ?></td></tr>
											<tr><td align='right' class='navTall'><font color=black>&nbsp;Venue:&nbsp;</font></td><td class='text' style='padding-left: 5px; padding-right: 5px;'><? $this->printVenueName($venueName[$i],$venueId[$i],false); ?></td></tr>
											<tr><td align='right' class='navTall'><font color=black>&nbsp;City:&nbsp;</font></td><td class='text' style='padding-left: 5px; padding-right: 5px;'><? echo $cityName[$i].', '.$state[$i]; ?></td></tr>
											<tr><td align='right' class='navTall' valign='top'><font color=black>&nbsp;Description:&nbsp;</font></td><td class='text' style='text-align: justify; padding-left: 5px; padding-right: 5px;'><? echo substr($message[$i],0,150)."..."; ?></td></tr>
										</table>
									</div> 
							<?
					echo "		</div>";
					echo "		<div class='textBoldWhite'>";
					echo			date("m.d", strtotime($eventDate[$i]))." - ";	
									$this->printVenueNameUnderOnOffLink("EventVenueSmall".$eventId[$i],$venueName[$i],$venueId[$i]);
									/*
					echo "			<span id='EventVenueSmall".$eventId[$i]."' class='textBoldWhite' onMouseOver=\"document.getElementById('EventVenueSmall".$eventId[$i]."').style.textDecoration='underline'; document.getElementById('EventVenueSmall".$eventId[$i]."').style.color='#FFFFFF'\" onMouseOut=\"document.getElementById('EventVenueSmall".$eventId[$i]."').style.textDecoration='none';\">";
										$this->printVenueName($venueName[$i],$venueId[$i],true);
					echo "			</span>";
					*/
					echo "		</div>";
					echo "	</td>";
					//echo "	<td class='textBig' width='20%'><a href='city.php?cityId=".$cityId[$i]."'>".$cityName[$i].", ".$state[$i]."</a></td>";
					echo "</tr>";	
				}
				echo "	<tr class='spacer'><td colspan='2'>&nbsp;</td></tr>";
				echo "</table>";
			}
		}

		function printVenueNameUnderOnOffLink ($id, $venueName, $venueId)
		{
			echo "<span id='".$id."' class='textBoldWhite' onMouseOver=\"document.getElementById('".$id."').style.textDecoration='underline'; document.getElementById('".$id."').style.color='#FFFFFF'\" onMouseOut=\"document.getElementById('".$id."').style.textDecoration='none';\">";
					$this->printVenueName($venueName,$venueId,true);
			echo "</span>";
		}

		function GetFullURL ($url)
		{
			if (strrpos($url,"www.") === 0 && strrpos($url,"http://") === false)
				$url =  "http://".$url;

			return $url;
		}

		function printLimitedString ($string, $maxLen)
		{
			if (strlen($string) > $maxLen) return substr($string, 0, $maxLen)."...";
			else return $string;
		}

		function GetVenueName ($venueId)
		{
			$query = "SELECT name FROM venue WHERE id = ".$venueId;
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);
			$num = mysql_numrows($result);
			if ($num == 1)
			{
				$results = mysql_fetch_array($result);
				return $results['name'];
			}
			else echo "GetVenueName Failed";
			return false;
		}

		function GetVenueAddress ($venueId)
		{
			$query = "SELECT address FROM venue WHERE id = ".$venueId;
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);
			$num = mysql_numrows($result);
			if ($num == 1)
			{
				$results = mysql_fetch_array($result);
				return $results['address'];
			}
			else echo "GetVenueAddress Failed";
			return false;
		}

		function printVenueName($venueName,$venueId,$IsLink)
		{
			if ($this->IsVenueId($venueId)) 
			{
				if($IsLink) echo "<a href='venueDetails.php?venueId=".$venueId."'>".$this->printLimitedString(urldecode($this->GetVenueName($venueId)),20)."</a>";
				else echo $this->printLimitedString(urldecode($this->GetVenueName($venueId)),20);
			}
			else echo $this->printLimitedString($venueName,20);
		}

		function ReturnVenueName($venueName,$venueId,$IsLink,$LinkColor)
		{
			if ($this->IsVenueId($venueId)) 
			{
				if($IsLink) return "<a style='color: ".$LinkColor.";' href='http://www.globalzona.com/party/venueDetails.php?venueId=".$venueId."'>".$this->GetVenueName($venueId)."</a>";
				else return $this->GetVenueName($venueId);
			}
			else return $venueName;
		}

		function IsVenueId($venueId)
		{
			if (check_int($venueId) && $venueId > 0) return true;
			else return false;
		}

		function printVenueAddress ($eventDetails)
		{
			if ($this->IsVenueId($eventDetails['venueId'])) echo $this->GetVenueAddress($eventDetails['venueId']).', '.dbFindCity($eventDetails['cityId']).', '.dbFindState($eventDetails['cityId']);
			else echo printMapLink($eventDetails,0);
		}

		function adBannerBubble()
		{
			$leftLink = "";
			$this->bubbleBoxTop("Advertisement",$leftLink);
			$this->adBanner();
			$this->bubbleBoxBottom(); 
		}

		function adBanner()
		{
			echo "<table width='100%' cellpadding='1' cellspacing='2' border='0'>";	
/*
			echo "	<tr>";
			echo "		<td align='center' class='spacer'>";
			echo "			<a href='http://zzgor.com/' target='_blank'>";
			echo "				<img src='http://www.globalzona.com/party/images/banners/zveri.jpg' border='0' width='195' alt='Zveri Concert'>";
			echo "			</a>";
			echo "		</td>";
			echo "	</tr>";
*/
			echo "	<tr>";
			echo "		<td align='center' class='spacer'>";
			echo "			<a href='http://www.dimplearts.com/blog' target='_blank'>";
			echo "				<img src='http://www.globalzona.com/party/images/banners/dimpleArts_banner.jpg' border='0' width='195' alt='DimpleArts Photography'>";
			echo "			</a>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td align='center' class='spacer'>";
							list($width, $height, $type, $attr) = getimagesize("http://i104.photobucket.com/albums/m182/artem_k/GZ%20Pics/Flyers/Fluid_Thursdays_MWeb.jpg");
							$width+=20;
							$height+=20;
			echo "			<a href='#' onclick=\"window.open('http://www.globalzona.com/party/associate/processAssociate.php?associateId=1&associateURL=http://i104.photobucket.com/albums/m182/artem_k/GZ%20Pics/Flyers/Fluid_Thursdays_MWeb.jpg','','scrollbars=no,location=no,width=".$width.",height=".$height."'); return false;\">";
			echo "				<img src='http://www.globalzona.com/party/images/banners/Fluid_Thursdays_MWeb_tmb.jpg' border='0' width='195' alt='RhythmEthics'>";
			echo "			</a>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td align='center' class='spacer'>";
			echo "			<a href='http://www.russiandining.net' target='_blank'>";
			echo "				<img src='http://www.globalzona.com/party/images/banners/RussianDining.jpg' border='0' width='195' alt='Russian Food and Dining'>";
			echo "			</a>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td align='center' class='spacer'>";
			echo "			<a href='http://www.playdoughboy.com' target='_blank'>";
			echo "				<img src='http://www.globalzona.com/party/images/banners/playdoughboy_195.jpg' border='0' width='195' alt='Playdoughboy'>";
			echo "			</a>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td align='center' class='text'>";
			echo "			<a href='http://www.globalzona.com/party/ad.php'>";
			echo "				Ad Your Banner Here";
			echo "			</a>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		function showRating($rating,$type)
		{
			$imgPath = "http://www.globalzona.com/party/images/smiley.jpg";
			if ($type == "dark") $imgPath = "http://www.globalzona.com/party/images/smileyDark.jpg";

			for ($i = 0; $i < $rating; $i++) 
				echo "<img src='".$imgPath."'>";
		}

		function showStatus($status)
		{
			$imgPath = "http://www.globalzona.com/party/images/check-yes.jpg";
			if ($status == 0) $imgPath = "http://www.globalzona.com/party/images/check-pending.jpg";

			echo "<img src='".$imgPath."' width='20' height='20'>";
		}
	}
?>