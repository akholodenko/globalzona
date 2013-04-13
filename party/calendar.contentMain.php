<table width="95%" border="0" cellspacing="3" cellpadding="10">
    <tr> 
    	<td bgcolor="#333333" class="text" align="justify">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">

				<?
					if ($_GET['showDay'] == 1)	//single day
					{						
						$startDay = $_POST['pYear'].'-'.$_POST['pMonth'].'-'.$_POST['pDay'].' 00:00:00';
						$endDay = $_POST['pYear'].'-'.$_POST['pMonth'].'-'.$_POST['pDay'].' 23:59:59';	

						echo "<tr bgcolor='#555555' class='nav'>";
						echo "<td colspan='4' align='right'><b>".date('l, M. j, Y', strtotime($startDay)) ."</b>&nbsp;&nbsp;&nbsp;</td></tr>";
				?>
						<tr bgcolor='#777777'><td colspan=4>
							<div align='center'>
								<script type="text/javascript"><!--
								google_ad_client = "pub-2855839175509987";
								google_ad_width = 468;
								google_ad_height = 60;
								google_ad_format = "468x60_as";
								google_ad_type = "text";
								//2007-01-11: Center Text Ad
								google_ad_channel = "5359080215";
								google_color_border = "777777";
								google_color_bg = "777777";
								google_color_link = "DDDDDD";
								google_color_text = "CCCCCC";
								google_color_url = "777777";
								//--></script>
								<script type="text/javascript"
								  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
								</script>
							</div>
						</td></tr>
				<?
						dbGetWeeklyEvent ($startDay, $_GET['cityId']);
						dbGetEvent ($startDay,$endDay, $_GET['cityId'], "");							
					}
					else	//entire week
					{
						$loopStart = -1;
						if (check_int($_GET['showWeek']) == 1) $loopStart = $_GET['showWeek'];	//check which week to display when navigating the calendar
						calendarNav ($loopStart);
				?>
						<tr bgcolor='#777777'><td colspan=4>
							<div align='center'>
								<script type="text/javascript"><!--
								google_ad_client = "pub-2855839175509987";
								google_ad_width = 468;
								google_ad_height = 60;
								google_ad_format = "468x60_as";
								google_ad_type = "text";
								//2007-01-11: Center Text Ad
								google_ad_channel = "5359080215";
								google_color_border = "777777";
								google_color_bg = "777777";
								google_color_link = "DDDDDD";
								google_color_text = "CCCCCC";
								google_color_url = "777777";
								//--></script>
								<script type="text/javascript"
								  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
								</script>
							</div>
						</td></tr>
				<?
						for ($x = $loopStart; $x < $loopStart+7; $x++)	
						{
							calendarDay(time() + ($x * 24 * 60 * 60),$loopStart);	//24 hours, 60 minutes, 60 seconds = 1 day
							
							$currentTime = time() + ($x * 24 * 60 * 60);
							$startDay = date("Y",$currentTime).'-'.date("m",$currentTime).'-'.date("d",$currentTime).' 00:00:00';
							$endDay = date("Y",$currentTime).'-'.date("m",$currentTime).'-'.date("d",$currentTime).' 23:59:59';	

							dbGetWeeklyEvent ($startDay, $_GET['cityId']);
							dbGetEvent ($startDay,$endDay, $_GET['cityId'],"");
						}
						calendarNav ($loopStart);
					}
				?>
			</table>
		</td>
	</tr>
</table>