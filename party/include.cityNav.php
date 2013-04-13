<!--
<div align="center">
	<a href="#" onclick="window.open('http://www.globalzona.com/party/associate/processAssociate.php?associateId=12&associateURL=http://www.globalzona.com/party/images/banners/EuropaFridays.jpg','','scrollbars=no,location=no,width=555,height=820'); return false;">
		<img src="http://www.globalzona.com/party/images/banners/EuropaFridays_tmb.jpg" border="0" width="200" height="306" alt="Europa Fridays">
	</a>
</div>
-->
		<div align="center">
			<script type="text/javascript"><!--
			google_ad_client = "pub-2855839175509987";
			google_ad_width = 200;
			google_ad_height = 200;
			google_ad_format = "200x200_as";
			google_ad_type = "image";
			//2007-01-12: cityNav
			google_ad_channel = "0013808090";
			google_color_border = "555555";
			google_color_bg = "555555";
			google_color_link = "DDDDDD";
			google_color_text = "CCCCCC";
			google_color_url = "BBBBBB";
			//--></script>
			<script type="text/javascript"
			  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</div>
<table width="100%" border="0" cellspacing="3" cellpadding="2">
<!--
	<tr><td bgcolor='#333333' class="nav">&nbsp;&nbsp;&nbsp;Search Events
		<table width="100%" cellpadding="0" cellspacing="2" border="0">
		<form action='calendar.php?showDay=1&cityId=<? echo $_GET['cityId']; ?>' method='POST'>
			<tr><td align="center" bgcolor="#444444" class="spacer">
				<br>
					<? 
						//calendar_month('',''); 
						//calendar_day('','');
						//calendar_year('','');
					?>
				<br><br><input type="submit" name="Submit" class="form" value="Get <? //if ($_GET['cityId'] != "") echo dbFindCity($_GET['cityId']); else echo 'All Cities'; ?> Party List"><br><br>
			</td></tr>
		</form>
		</table>
	</td></tr>
-->
<!--
	<tr>
		<td bgcolor='#333333' class="nav">
			<a href="#" onClick="show_form_ext('SearchByCity');return false;" class="nav">
				&nbsp;&nbsp;<span id="SearchByCity_span">+</span>&nbsp;&nbsp;Search by City
			</a>
		</td>
	</tr>
	<tr id="SearchByCity_tr" style="display:none;" bgcolor="#999999"><td>
		<div id="SearchByCity_div" class="hidden_div">
			<table width="100%" border="0" cellspacing="3" cellpadding="2">
				<? dbGetCityTest('nav'); ?>
			</table>
		</div>
	</td></tr>
-->
	<? dbGetCity('nav'); ?>
<!--
	<tr><td bgcolor='#333333' class="nav">
		&nbsp;&nbsp;<a href='#' class='nav' onClick="return showHideBlock('SuggestCity');"><span id='SuggestCitySpan'>+</span>&nbsp;&nbsp;Suggest City</a>
		<div id='SuggestCity' style='display:none'>
			<table width="100%" cellpadding="0" cellspacing="2" border="0">		
			<form name='formCitySuggest' method='POST' onSubmit="suggestCity(this.citySuggest.value); return false;">
				<tr>
					<td align="center" bgcolor="#444444" class="spacer">
						<div id="citySuggest"><br><input name="citySuggest" class="form" size="25" maxlength="25"><br><br>
						<input type="submit" name="Submit" id="buttonMain" class="form" value="Submit City"><br><br></div>
						<div style="display:none; background-color: #ff6600" class="text" id="txtHint">&nbsp;</div>
					</td>
				</tr>
			</form>
			</table>
		</div>
	</td></tr>
-->
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="text" align='center'>
			<a href='http://www.globalzona.com/index.htm' target='_blank'>Looking for the old GlobalZona.com?</a>
		</td>
	</tr>	
</table>

<!--<div align="center"><img src="images/banner_204x102.jpg"></div>-->
