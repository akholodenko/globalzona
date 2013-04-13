<?
	class Session
	{
		var $reviewVenue = array();
		var $userVenueReviews = array();
		var $message;

		function GetMessage ()
		{
			return $this->message;
		}

		function RegisterUser ($firstName, $lastName, $email, $password)
		{
			
			if(!$this->IsValidUserRegistrationInput($firstName, $lastName, $email, $password))
				return false;

			if(!$this->IsExistingUser($email))
			{
				$newUser['firstName'] = $firstName;
				$newUser['lastName'] = $lastName;
				$newUser['email'] = $email;
				$newUser['password'] = $password;
				if($this->SubmitNewUserInfo($newUser)) return true;
				else return false;
			}
			else return false;
			//return true;
		}

		function SubmitNewUserInfo($newUser)
		{
			$confirmationCode = rand(100000,999999);	//generate random 6 digit code

			$query = "INSERT INTO webUser (firstName,lastName,email,password,confirmationCode) values ";
			$query = $query."('".$newUser['firstName']."','".$newUser['lastName']."','".$newUser['email']."','".$newUser['password']."','".$confirmationCode."')";
			//echo $query;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			$query = "SELECT id from webUser WHERE firstName = '".$newUser['firstName']."' AND lastName = '".$newUser['lastName']."' AND email = '".$newUser['email']."' AND password = '".$newUser['password']."'";
			
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			$results = mysql_fetch_array($result);
			$message = "Click the link to finalize your registration:\n http://www.globalzona.com/party/webUser/login.php?userId=".$results['id']."&email=".$newUser['email']."&confirmationCode=".$confirmationCode."&venueId=".$_POST['venueId'];
			$headers = "From: info@globalzona.com";
			mail($newUser['email'], 'ACTION REQUIRED: Confirm GlobalZona.com Registration', $message, $headers);

			return true;
		}

		function ConfirmNewUser($userInfo)
		{
			$query = "SELECT confirmationCode FROM webUser WHERE id=".$userInfo['id'];
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				$results = mysql_fetch_array($result);	
				
				if ($num != 1) return false;
				else if ($userInfo['confirmationCode'] == $results['confirmationCode'])
				{
					$this->ActivateUser($userInfo['id']);
					return true;
				}
				else return false;
			}
			else echo "ConfirmNewUser Failed";
			return false;
		}

		function ActivateUser ($userId)
		{
			$query = "UPDATE webUser SET isActive=1 WHERE id=".$userId;
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);			
		}

		function IsValidUserRegistrationInput ($firstName, $lastName, $email, $password)
		{
			$this->message = "<ul class='text'>";

			if(!$this->CheckString($firstName))
				$this->message = $this->message."<li>The first name value is invalid</li>";
			if(!$this->CheckString($lastName))
				$this->message = $this->message."<li>The last name value is invalid</li>";
			if(!$this->CheckEmail($email))
				$this->message = $this->message."<li>The email value is invalid</li>";
			if($password == "")
				$this->message = $this->message."<li>The password is blank</li>";

			$this->message = $this->message."</ul>";

			if ($this->message != "<ul class='text'></ul>") return false;
			return true;
		}

		function CheckString ($string)
		{
			if(eregi("[[:alpha:]]", $string)) 
				return 1;
			else
				return 0;
		}

		function CheckEmail ($email)
		{
			if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) 
				return 1;
			else
				return 0;
		}

		function IsExistingUser ($username)
		{
			$query = "SELECT id FROM webUser WHERE email='".$username."'";
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				$results = mysql_fetch_array($result);	
				
				if ($num > 0) return true;
				else if ($num == 0) return false;
				else return false;
			}
			else echo "CheckForExistingUser Failed";
			return false;
		}

		function ValidateUser ($username, $password)
		{
			$query = "SELECT id, email, password, firstName, lastName FROM webUser WHERE isActive=1 AND email='".$username."'";
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				$results = mysql_fetch_array($result);	
				
				if ($num != 1) return false;
				else if ($password == $results['password'])	
				{
					$_SESSION["userId"] = $results['id'];
					$_SESSION["email"] = $results['email'];
					$_SESSION["firstName"] = $results['firstName'];
					$_SESSION["lastName"] = $results['lastName'];
					$_SESSION["password"] = $results['password'];
					return true;
				}
				else return false;
			}
			else echo "ValidateUser Failed";
			return false;
		}

		function SetVenueById ($venueId)
		{
			$query = "SELECT v.id, v.name, c.name as city, v.address, c.state, v.imgURL, v.text, v.website, ct.name as countryName";
			$query = $query." FROM venue v, city c, country ct WHERE c.countryId=ct.Id AND v.cityId=c.Id AND v.id=".$venueId;
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
				$this->reviewVenue = mysql_fetch_array($result);
			else
				echo "SetVenueById Failed";
		}

		function GetVenueById ($venueId)
		{
			$this->SetVenueById ($venueId);
			return $this->reviewVenue;
		}

		function SetUserVenueReviews ($userId)
		{
			$query = "SELECT r.approved, r.id as reviewId, v.id as venueId, v.name as venueName, r.rating, r.review, c.name as cityName";
			$query = $query." FROM venueReview r, venue v, city c WHERE c.id=v.cityId AND r.venueId=v.id AND r.webUserId=".$userId;
			$query = $query." ORDER BY v.name";
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $results[$i] = mysql_fetch_array($result);
				$this->userVenueReviews = $results;
			}
			else echo "SetUserVenueReviews Failed";
		}

		function GetUserVenueReviews ($userId)
		{
			$this->SetUserVenueReviews($userId);
			return $this->userVenueReviews;
		}

		function ProcessNewVenueReview ($venueId,$webUserId,$rating,$review)
		{
			$venueReview['venueId'] = $venueId;
			$venueReview['webUserId'] = $webUserId;
			$venueReview['rating'] = $rating;
			$venueReview['review'] = $review;

			if($this->IsValidVenueReviewInput($venueReview))
			{
				if($this->SubmitNewVenueReview($venueReview)) return true;
				else return false;
			}
			else return false;
		}

		function HasUserReviewedVenue($venueReview)
		{
			$query = "SELECT id FROM venueReview WHERE webUserId=".$venueReview['webUserId']." and venueId=".$venueReview['venueId'];
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				$results = mysql_fetch_array($result);	
				
				if ($num > 0) return true;
				else if ($num == 0) return false;
				else return false;
			}
			else echo "HasUserReviewedVenue Failed";
			return false;
		}

		function IsValidVenueReviewInput ($venueReview)
		{
			if($this->HasUserReviewedVenue($venueReview))
			{
				$this->message = "It appears you have previously reviewed this venue.";
				return false;
			}
			if($venueReview['venueId'] == "")
				return false;
			if($venueReview['webUserId'] == "")
				return false;
			if($venueReview['rating'] == "")
				return false;
			if($venueReview['review'] == "")
				return false;

			return true;
		}

		function SubmitNewVenueReview($venueReview)
		{
			$query = "INSERT INTO venueReview (venueId,webUserId,rating,review) values ";
			$query = $query."(".$venueReview['venueId'].",".$venueReview['webUserId'].",".$venueReview['rating'].",'".urlencode($venueReview['review'])."')";
			//echo $query;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			return true;
		}
	}

?>