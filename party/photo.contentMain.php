<table width="93%" border="0" cellspacing="3" cellpadding="10">
    <tr> 
    	<td bgcolor="#333333" class="text" align="justify">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#555555" class="nav"> 
					<td align='right'>Event Photo Gallery <? if(check_int($_GET['cityId']) == 1 && $_GET['cityId'] > 0) echo ": ".dbFindCity($_GET['cityId']); ?>&nbsp;&nbsp;&nbsp;</td>
				</tr>
				<tr bgcolor="#888888" class="text">
					<td valign="top" align='center'>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">					
							<tr bgcolor="#888888" class="text"> 
								<td align="justify">
									<?	
										if (check_int($_GET['cityId']) == 1 && $_GET['cityId'] > 0) dbGetAlbumByCity($_GET['cityId']); 
										else dbGetCity("album", "");
									?>		
								</td>		
							</tr>	
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>