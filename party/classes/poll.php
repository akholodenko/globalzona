<?
	class Poll
	{
		var $pollId;
		var $pollQuestion;
		var $voteCount;
		var $pollAnswers = array();
		var $pollResults = array();

		function Poll ($iPollId)
		{
			$this->pollId = $iPollId;
			$this->setPollData();
		}

		function setPollCount ()
		{
			$query = "SELECT count(*) as countPoll ";
			$query = $query."FROM pollResponse ";
			$query = $query."WHERE pollId=".$this->pollId;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				$results = mysql_fetch_array($result);	
				
				$this->voteCount = $results['countPoll'];
				return true;

			}
			else echo "setPollCount Failed";
			return false;
		}

		function setPollDataQuestion ()
		{
			//sets the poll question
			$query = "SELECT poll.question ";
			$query = $query."FROM poll poll ";
			$query = $query."WHERE poll.id=".$this->pollId;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				$results = mysql_fetch_array($result);	
				
				$this->pollQuestion = $results['question'];
				return true;

			}
			else echo "setPollData - Question Failed";

			$query = "SELECT pollAnswer.text ";
			$query = $query."FROM pollAnswer pollAnswer ";
			$query = $query."WHERE pollAnswer.pollId=".$this->pollId;

			$result = $db->ExecuteQuery($query);

			return false;
		}

		function setPollDataAnswers ()
		{
			//sets the poll answers
			$query = "SELECT pollAnswer.text, pollAnswer.id ";
			$query = $query."FROM pollAnswer pollAnswer ";
			$query = $query."WHERE pollAnswer.pollId=".$this->pollId;

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $this->pollAnswers[$i] = mysql_fetch_array($result);
				return true;

			}
			else echo "setPollData - Answers Failed";

			return false;
		}

		function setPollResults ()
		{
			//sets the poll answers
			$query = "SELECT count(pollResponse.pollAnswerId) as pollCount, pollResponse.pollAnswerId, pollAnswer.text ";
			$query = $query."FROM pollResponse pollResponse, pollAnswer pollAnswer ";
			$query = $query."WHERE pollAnswer.id = pollResponse.pollAnswerId AND pollResponse.pollId=".$this->pollId;
			$query = $query." GROUP BY pollResponse.pollAnswerId ";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $this->pollResults[$i] = mysql_fetch_array($result);
				return true;

			}
			else echo "setPollResults Failed";

			return false;
		}

		function setPollData ()
		{
			$this->setPollDataQuestion();
			$this->setPollDataAnswers();
		}

		function getPollQuestion ()
		{
			return $this->pollQuestion;
		}

		function printPoll ()
		{
			//prints the poll question and answers
			$layout = new Layout();
			$leftLink = "";
			$layout->bubbleBoxTop("Pop Quiz",$leftLink);
			$this->printPollForm();
			$layout->bubbleBoxBottom(); 
		}

		function printPollForm ()
		{
			echo "<div id='pollDiv' style='text-align: center;'>";
			echo "<table width='100%' cellpadding='1' cellspacing='0' border='0'>";
			echo "	<form name='poll' onSubmit=\"recordPollVote(document.poll.pollId.value,GetSelectedItem()); return false;\" method='POST'>";
			echo "		<input type='hidden' id='pollId' name='pollId' value='".$this->pollId."'>";
			echo "		<tr><td align='center' class='spacer'>";
			echo "			<br><table width='100%' border=0 cellpadding=1 cellspacing=1>";
			echo "					<tr><td valign='middle' align='center'><img src='http://www.globalzona.com/party/images/question.jpg'></td><td class='nav'>".$this->pollQuestion."<div style='height: 3px;'></div></td></tr>";

					for ($x = 0; $x < count($this->pollAnswers); $x++)
					{
						echo "<tr class='text'><td valign='middle' align='center' width='25%'>";
						echo "	<input type='radio' name='pollAnswerId' value='".$this->pollAnswers[$x]['id']."'>";
						echo "</td><td valign='middle'>";
						echo	$this->pollAnswers[$x]['text'];
						echo "</td></tr>";
					}

			echo "			</table><br><br><input type='submit' name='Submit' class='form' value='Vote'><br><br>";
			echo "		</td></tr>";
			echo "	</form>";
			echo "	</table>";
			echo "</div>";
		}

		function printPollResults ()
		{
			$this->setPollResults();
			$this->setPollCount();
			//prints the quantity of answers for each question
			echo "<div id='pollResultDiv' style='text-align: center;'>";
			echo "<table width='100%' cellpadding='1' cellspacing='0' border='0'>";
			echo "		<tr><td align='center' class='spacer'>";
			echo "			<br><table width='100%' border=0 cellpadding=1 cellspacing=1>";
			echo "					<tr><td valign='middle' align='center'><img src='http://www.globalzona.com/party/images/question.jpg'></td><td class='nav'>".$this->pollQuestion."<div style='height: 3px;'></div></td></tr>";

					for ($x = 0; $x < count($this->pollResults); $x++)
					{
						echo "<tr class='text'><td valign='middle' align='center' width='25%'>";
						echo	(round($this->pollResults[$x]['pollCount']/$this->voteCount, 2) * 100)."%";
						echo "</td><td valign='middle'>";
						echo	$this->pollResults[$x]['text'];
						echo "</td></tr>";
					}

			echo "			</table>";
			echo "		</td></tr>";
			echo "	</table>";
			echo "</div>";			
		}

		function recordPollResponse ($pollQuestionId, $pollAnswerId, $ipAddress)
		{
			//records the poll question and answers
			//echo $pollQuestionId."<br>";
			//echo $pollAnswerId."<br>"; 
			//echo $ipAddress;

			if($this->validatePollResponse($pollQuestionId,$pollAnswerId,$ipAddress))
			{
				$query = "INSERT INTO pollResponse (pollId,pollAnswerId,ipAddress) values ";
				$query = $query."(".$pollQuestionId.",".$pollAnswerId.",'".$ipAddress."')";
				$db = new Database($query);
				$result = $db->ExecuteQuery($query);
				echo "<div class='text' style='color: yellow; padding: 5px;'>Thank you for voting!</div>";
			}
			else
			{
				echo "<div class='text' style='padding: 5px;'>Sorry, your vote wasn't cast.</div>";
			}
		}

		function validatePollResponse ($pollQuestionId,$pollAnswerId,$ipAddress)
		{
			if ($pollQuestionId == "" || $pollAnswerId == "" || $ipAddress == "") return false;
			else if ($this->IsUsedPollIPAddress($pollQuestionId,$ipAddress)) 
			{
				echo "<div class='text' style='padding: 5px;'>You have previously cast your vote.</div>";
				return false;
			}
			else return true;
		}

		function IsUsedPollIPAddress ($pollQuestionId,$ipAddress)
		{
			$query = "SELECT id FROM pollResponse WHERE pollId=".$pollQuestionId." and ipAddress='".$ipAddress."'";
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
			else echo "IsUsedPollIPAddress Failed";
			return false;
		}
	}
?>