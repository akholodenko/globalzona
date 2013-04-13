<?
	class Email
	{
		var $to;
		var $fromName;
		var $from;
		var $subject;
		var $body;


		function Email ()
		{
		}

		function SendMail ($IsHTML)
		{
			$mail = new PHPMailer();
			$mail->From = $this->from;
			$mail->FromName = $this->fromName;
			$mail->AddBCC($this->to, '');
			$mail->WordWrap = 50;
			$mail->IsHTML($IsHTML);
			$mail->Subject = $this->subject;
			$mail->Body = $this->body;

			return $mail->Send();
		}

		function GenerateEventNotificationEmailBody ($eventId)
		{
			$event = new Event();
			$eventInfo = $event->FindEvent($eventId);

			$layout = new Layout();

			if ($eventInfo['IsActive'] == 1) $date = date("l", strtotime($eventInfo['weekDay']))." (Weekly)";
			else $date = date("l, F j, Y", strtotime($eventInfo['date']));

			$this->body = "
				<html>
					<head>
						<style>
							* {
								font-family: Tahoma;
								font-size: 13px;
								color: white;
							}

							a {
								color: #dddddd;
							}

							.tableBorder {
								border-bottom: 1px solid #ffffff;
								border-left: 1px solid #ffffff;
								border-right: 1px solid #ffffff;
							}

							.imgBorder {
								border: 1px solid #cccccc;
							}
						</style>
					</head>
					<body bgcolor='#000000' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
						<table cellpadding='5' cellspacing='0' border='0' width='100%'>
							<tr>
								<td bgcolor='#000000' style='text-align: center;'>
									<table width='600' cellpadding='0' cellspacing='0' border='0' align='center' class='tableBorder' style='border-bottom: 1px solid #ffffff; border-left: 1px solid #ffffff; border-right: 1px solid #ffffff;'>
										<tr>
											<td align='center' colspan='2'>
												<a href='http://www.globalzona.com'><img width='600' src='http://www.globalzona.com/party/layout/index_02.jpg' border='0'></a>
											</td>
										</tr>
										<tr bgcolor='#555555'>
											<td width='200' valign='top' style='padding-left: 10px; padding-top: 10px;'>
												<a href='http://www.globalzona.com/party/eventDetails.php?eventId=".$eventInfo['id']."'>
													<img style='border: 1px solid #cccccc;' width='200' src='".$eventInfo['flyerURL']."' border='0'>
												</a>
											</td>
											<td valign='top' style='padding: 10px;'>
												<div style='font-family: Tahoma; font-size: 13px; color: white; background-color: #DAA520; padding: 10px; border: 1px solid #cccccc; text-align: justify;'>
													Hey!
													<p>There's a great event coming up in <a style='color: #dddddd;' href='http://www.globalzona.com/party/city.php?cityId=".$eventInfo['cityId']."'>".dbFindCity($eventInfo['cityId'])."</a> 
													that I think you should check out!
													<p>See you there!
													<br><a style='color: #dddddd;' href='mailto:".$this->from."'>".$this->fromName."</a>
												</div>
												<table width='100%' cellpadding='0' border='0' cellspacing='5' style='font-family: Tahoma; font-size: 13px; color: white; padding: 5px;'>
													<tr>
														<td width='25%'><div style='font-family: Tahoma; font-size: 13px; color: white;'>Event Title:</div></td>
														<td style='padding-left: 10px; font-weight: bold;'><div style='font-family: Tahoma; font-size: 13px; color: white;'>".$eventInfo['eventTitle']."</div></td>
													</tr>
													<tr>
														<td width='25%' valign='top'><div style='font-family: Tahoma; font-size: 13px; color: white;'>Date:</div></td>
														<td style='padding-left: 10px; text-align: justify;'><div style='font-family: Tahoma; font-size: 13px; color: white;'>".$date."</div></td>
													</tr>
													<tr>
														<td width='25%' valign='top'><div style='font-family: Tahoma; font-size: 13px; color: white;'>Time:</div></td>
														<td style='padding-left: 10px; text-align: justify;'><div style='font-family: Tahoma; font-size: 13px; color: white;'>".date("g:i a", strtotime($eventInfo['date']))."</div></td>
													</tr>
													<tr>
														<td width='25%' valign='top'><div style='font-family: Tahoma; font-size: 13px; color: white;'>Venue:</div></td>
														<td style='padding-left: 10px; text-align: justify;'><div style='font-family: Tahoma; font-size: 13px; color: white;'>".$layout->ReturnVenueName($eventInfo['venueName'],$eventInfo['venueId'],true,"#dddddd")."</div></td>
													</tr>
													<tr>
														<td width='25%' valign='top'><div style='font-family: Tahoma; font-size: 13px; color: white;'>Details:</div></td>
														<td style='padding-left: 10px; text-align: justify;'><div style='font-family: Tahoma; font-size: 13px; color: white;'>".$eventInfo['message']."</div></td>
													</tr>
													<tr>
														<td width='25%' valign='top'>&nbsp;</td>
														<td style='padding-left: 10px; text-align: justify;'>
															<div style='font-family: Tahoma; font-size: 13px; color: white;'>
																<br><a style='color: #dddddd;' href='http://www.globalzona.com/party/eventDetails.php?eventId=".$eventInfo['id']."'>See Additional Information</a>
															</div>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor='#333333'>
											<td align='center' colspan='2'>
												<div style='font-family: Tahoma; font-size: 13px; color: white;'>
													<a style='color: #dddddd; font-size: 11px;' href='http://www.globalzona.com'>This notification is brought to you by GlobalZona.com: <span style='font-weight: bold; font-size: 11px;'>Boot. Click. <font style='color: red; font-size: 11px;'>Party!</font></span></a>
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</body>
				</html>
			";
		}
	}
?>