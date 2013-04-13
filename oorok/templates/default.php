<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
 <HEAD>
  <TITLE>Oorok!</TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">

	<link href="http://www.globalzona.com/oorok/css/corners.css" rel="stylesheet" type="text/css">
	<link href="http://www.globalzona.com/oorok/css/style.css" rel="stylesheet" type="text/css">
	<link href="http://www.globalzona.com/oorok/css/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css">

	<script src="http://www.globalzona.com/oorok/js/utils.js" type="text/JavaScript"></script>
	<script src="http://www.globalzona.com/oorok/js/jquery-1.3.2.min.js" type="text/JavaScript"></script>
	<script src="http://www.globalzona.com/oorok/js/jquery-ui-1.7.2.custom.min.js" type="text/JavaScript"></script>
	<script src="http://www.globalzona.com/oorok/js/jquery_urlencode.js" type="text/JavaScript"></script>
	<script src="http://www.globalzona.com/oorok/js/jquery_setup.js" type="text/JavaScript"></script>


 </HEAD>

 <BODY bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?
	echo "<div id='message_modal_window' title='' style='font-size: 14px; font-family: Tahoma;'>";
	echo "	<div id='message_modal_window_content'></div>";
	echo "</div>";
	
	//pops up moddal window with passed in message
	if($_GET['message'] != "")
	{
		echo "<script>autoModalPopUp = true; autoModalSubject = 'Attention!'; autoModalBody = '".rawurlencode($_GET['message'])."';</script>";
	}
?>	
	<table width='85%' cellpadding='0' cellspacing='0' border='0' align='center'>
		<tr>
			<td style='vertical-align: bottom'>
				<? 
					if($nav_content != "")
						include $nav_content; 
				?>
			</td>			
			<td style='width: 627px; text-align: right;'><img src='images/header.jpg'></td>
		</tr>
	</table>
	
	<table width='85%' cellpadding='0' cellspacing='0' border='0' align='center'>
		<tr>
			<td>
				<div>
				  <b class="bg_corner">
				  <b class="bg_corner1"><b></b></b>
				  <b class="bg_corner2"><b></b></b>
				  <b class="bg_corner3"></b>
				  <b class="bg_corner4"></b>
				  <b class="bg_corner5"></b></b>

				  <div class="bg_cornerfg">
					<!-- BODY -->
					<table width='100%' cellpadding='0' cellspacing='0' border='0' align='center' style='padding: 7px 0px 7px 10px;'>
						<tr>
							<td style='width: 74%; vertical-align: top'>
							<!--margin: 7px 0px 7px 10px;-->
								<div style=''>
									<div>
									  <b class="bg_content_corner">
									  <b class="bg_content_corner1"><b></b></b>
									  <b class="bg_content_corner2"><b></b></b>
									  <b class="bg_content_corner3"></b>
									  <b class="bg_content_corner4"></b>
									  <b class="bg_content_corner5"></b></b>

									  <div class="bg_content_cornerfg">
										<div id='content_main'>
											<?
												if($main_content != "")
													include $main_content;
											?>
										</div>
									  </div>

									  <b class="bg_content_corner">
									  <b class="bg_content_corner5"></b>
									  <b class="bg_content_corner4"></b>
									  <b class="bg_content_corner3"></b>
									  <b class="bg_content_corner2"><b></b></b>
									  <b class="bg_content_corner1"><b></b></b></b>
									</div>
								</div>
							</td>
							<td style='width: 26%; vertical-align: top;'>
								<div id='content_side'>
									<?
										if($side_content != "")
											include $side_content;
									?>		
								</div>
							</td>
						</tr>
					</table>
				  </div>

				  <b class="bg_corner">
				  <b class="bg_corner5"></b>
				  <b class="bg_corner4"></b>
				  <b class="bg_corner3"></b>
				  <b class="bg_corner2"><b></b></b>
				  <b class="bg_corner1"><b></b></b></b>
				</div>
			</td>
		</tr>
	</table>
 </BODY>
</HTML>
