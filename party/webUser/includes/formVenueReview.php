<table width="100%" cellpadding="2" cellspacing="0" border="0">		
	<form name="reviewForm" id="reviewForm" onSubmit="return checkVenueReview (this);" method="POST">
		<input type="hidden" name="submitUserReview" value="true">
		<input type="hidden" name="venueId" value="<? echo $venueDetails["id"]; ?>">
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">		
					<tr class="nav">
						<td align="center">1</td>
						<td align="center">2</td>
						<td align="center">3</td>
						<td align="center">4</td>
						<td align="center">5</td>
					</tr>
					<tr>
						<td align="center"><input type="radio" class="form" id="reviewRating" name="reviewRating" value="1"></td>
						<td align="center"><input type="radio" class="form" id="reviewRating" name="reviewRating" value="2"></td>
						<td align="center"><input type="radio" class="form" id="reviewRating" name="reviewRating" value="3"></td>
						<td align="center"><input type="radio" class="form" id="reviewRating" name="reviewRating" value="4"></td>
						<td align="center"><input type="radio" class="form" id="reviewRating" name="reviewRating" value="5"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="text"> 
			<td align="justify">
				<textarea onKeyDown="limitText(this.form.reviewText,this.form.countdown,1000);" onKeyUp="limitText(this.form.reviewText,this.form.countdown,1000);" id='reviewText' name="reviewText" style="width: 450px; height: 200px;" wrap="VIRTUAL" class="form"><? echo $_POST['message']; ?></textarea>
				<br>&nbsp;You have <input class='form' readonly type="text" name="countdown" size="3" value="1000"> characters left.
			</td>		
		</tr>	
		<tr><td align='right'><input type="submit" name="Submit" class="form" value="Submit Review"></td></tr>
	</form>
</table>