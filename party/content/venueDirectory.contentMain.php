<table width='97%' cellpadding='0' cellspacing='3' border='0'><tr><td>
<?
	$layout = new Layout();
	$leftLink = "<span id='cityAlphaLinkListVenues' style='visibility: hidden;'>";
	$leftLink = $leftLink."<a href='#cityAlphaA'>A</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaB'>B</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaC'>C</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaD'>D</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaE'>E</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaF'>F</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaG'>G</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaH'>H</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaI'>I</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaJ'>J</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaK'>K</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaL'>L</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaM'>M</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaN'>N</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaO'>O</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaP'>P</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaQ'>Q</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaR'>R</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaS'>S</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaT'>T</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaU'>U</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaV'>V</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaW'>W</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaX'>X</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaY'>Y</a>";
	$leftLink = $leftLink."&nbsp;&nbsp;<a href='#cityAlphaZ'>Z</a>";
	$leftLink = $leftLink."</span>";
	$moduleTitle = "Clubs, Lounges, and Bars";
	if(check_int($_GET['cityId']) == 1 && $_GET['cityId'] > 0) $moduleTitle = dbFindCity($_GET['cityId'])." ".$moduleTitle;
	else $moduleTitle = "All ".$moduleTitle;

	$layout->bubbleBoxTop($moduleTitle,$leftLink);
?>
	<div style='margin: 5px 15px -5px 15px;'>
		Globalzona.com now present you our own list of the top bars, clubs, and other night spots all over the planet. Our party-loving, bar-hopping team of reviewers have visited these places, listened to various feedback, and interviewed owners and local patrons to gauge the said list. In this list you'll find the best places for drinks as well as top locations for people looking to <a href="http://www.pokerstars.com/poker/games/">poker game</a>, watch sports actions, or just spend the whole night dancing. Have a look and judge for yourself if we got it right.
	</div>
	<table width="100%" cellpadding="15" cellspacing="0" border="0">					
		<tr><td align="center">
				<?	
					if (IsValidId($_GET['cityId'])) 
						dbGetTopVenueByCity($_GET['cityId']); 
					else 
					{
				?>
						<script>document.getElementById('cityAlphaLinkListVenues').style.visibility = 'visible';</script>
				<?
						dbGetCity("venue", "");
					}
				?>		
		</td></tr>	
<!--	<tr><td><? //include "ads/ad7.php"; ?></td></tr>-->
	</table>
<? 
	$layout->bubbleBoxBottom(); 
	$layout->bubbleBoxSpacer();
?>
</td></tr></table>