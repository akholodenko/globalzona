<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSession())
	{
		$potluqs = Data::GetPotluqsByUserId($_SESSION['USER_id']);
		$potluqCount = count($potluqs);
?>

		<table width="100%" style='padding: 25px;' cellpadding="0" cellspacing='0' border="0">
			<tr>
				<td width="70%" valign='top'>
					<div id='mainBodyContent'>
						<?	Layout::DefaultModuleTop('100%', 'Upcoming Potluqs ('.$potluqCount.')');	?>
							<div class="moduleText">
								<?
									if($potluqCount > 0)
									{
										for($x = 0; $x < $potluqCount; $x++)
										{
											Layout::Potluq($potluqs[$x]);
										}
									}
									else
									{
										Layout::PotluqBlank();
									}
								?>
								<!--
								<table id='rowPotluq' width='100%' cellpadding='0' cellspacing='0' style='padding-left: 10px; padding-right: 10px;'>
									<tr class='moduleText' style='height: 25px'>
										<td width='25%' valign='middle'>
											January 24, 2009
										</td>
										<td width='75%' valign='middle'>
											<a href='#' class='moduleText' onClick="loadPotluq(123); return false;">Random Celebration</a>
										</td>
									</tr>
								</table>
								-->
							</div>
						<?	Layout::DefaultModuleBottom();	?>
					</div>
				</td>
				<td width="30%"  valign='top' style='padding-left: 25px;'>
					<?	Layout::DefaultModuleTop('100%', 'Menu');	?>
						<div class="moduleText" style='padding-left: 25px; padding-bottom: 5px;'>
							<a href='#' class='moduleText' onClick="loadMain('main'); return false;">Home</a>
						</div>
						<div class="moduleText" style='padding-left: 25px; padding-bottom: 5px;'>
							<a href='#' class='moduleText' onClick="loadNewPotluq(); return false;">Create New Potluq</a>
						</div>
						<div class="moduleText" style='padding-left: 25px; padding-bottom: 5px;'>
							<a href='#' class='moduleText' onClick="loadPastPotluqs(12345); return false;">Past Potluqs</a>
						</div>
					<?	Layout::DefaultModuleBottom();	?>
				</td>
			</tr>
		</table>
<?	}	?>