<? 
	if ($_GET['videoId'] != "")
	{
		$videoDetails = dbFindVideo($_GET['videoId']); 
?>
		<table width="93%" border="0" cellspacing="3" cellpadding="10">
			<tr> 
				<td bgcolor="#333333" class="text" align="justify">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr bgcolor="#555555" class="text"> 
							<td>&nbsp;&nbsp;&nbsp;<b><? echo $videoDetails['name']." - ".$videoDetails['title']; ?></b></td>
						</tr>
						<tr bgcolor="#888888" class="text">
							<td valign="top" align='center'>
								<table width="90%" cellpadding="4" cellspacing="0" border="0">					
									<tr bgcolor="#888888" class="text"> 
										<td align="center">
											<? echo $videoDetails['code']; ?>
										</td>		
									</tr>	
								</table>
								<a href="http://www.globalzona.com/party/contact.php?emailSubject=Problem with Music Video at GZP&specialMessage=There is a problem with <? echo $videoDetails['title']; ?> video [ID: <? echo $_GET['videoId'];?>].">Problem with the video?</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<? } 
	else if ($_GET['artistId'] != "")
	{
		$videoDetails = dbFindArtist($_GET['artistId']); 
?>
		<table width="93%" border="0" cellspacing="3" cellpadding="10">
			<tr> 
				<td bgcolor="#333333" class="text" align="justify">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr bgcolor="#555555" class="text"> 
							<td>&nbsp;&nbsp;&nbsp;<b><? echo $videoDetails['name']; ?></b></td>
						</tr>
						<tr bgcolor="#888888" class="text">
							<td valign="top" align='center'>
								<table width="100%" cellpadding="4" cellspacing="0" border="0">					
									<tr bgcolor="#888888" class="text"> 
										<td align="justify">
											<? dbGetActiveVideosByArtist($_GET['artistId']); ?>
										</td>		
									</tr>	
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<? } ?>