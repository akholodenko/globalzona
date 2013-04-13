<?
	class Article
	{
		var $articleInfo = array();
		var $articleTitle = array();
		var $articleSource = array();

		function Article ()
		{
		}

		function SetArticles ($query)
		{
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $this->articleInfo[$i] = mysql_fetch_array($result);
				return true;
			}
			else echo "SetAllArticles Failed";
			return false;
		}

		function SetAllArticles ($sortOrder)
		{
			$query = "SELECT * FROM articles ORDER BY dateAdded ".$sortOrder;
			$this->SetArticles($query);
		}

		function SetMostRecentArticles ($limit)
		{
			$query = "SELECT * FROM articles ORDER BY dateAdded DESC LIMIT ".$limit;
			$this->SetArticles($query);
		}

		function PrintArticleInfo ($IsPreview)
		{
			echo "<table width='100%' border='0' cellpadding='2' cellspacing='0' class='textBig' style='background-image: url(layout/articlesBG.jpg);background-position: top right; background-repeat: no-repeat;'>";
			echo "	<tr class='nav'><td align='center' class='lightGradient'>Nightlife Articles</td></tr>";

			for ($x = 0; $x < count($this->articleInfo); $x++)
			{
				echo "<tr class='spacer'><td>&nbsp;</td></tr>";
				echo "<tr id='articleRow".$this->articleInfo[$x]['id']."' onMouseOver=\"document.getElementById('articleRow".$this->articleInfo[$x]['id']."').className='bgMouseOverDetails';\" onMouseOut=\"document.getElementById('articleRow".$this->articleInfo[$x]['id']."').className='';\">";
				echo "		<td style='padding-left: 10px'>";
				echo "			<a href='".$this->articleInfo[$x]['sourceURL']."' target='_blank'>".$this->articleInfo[$x]['title']."</a>";
				echo "			<div class='textSmallWhiteBold'>";

				if ($IsPreview) echo "Source: ".$this->articleInfo[$x]['source'];
				else echo "Added on ".date("M d, Y", strtotime($this->articleInfo[$x]['dateAdded']))." from ".$this->articleInfo[$x]['source'];

				echo "			</div>";
				echo "		</td>";
				echo "</tr>";
			}
			
			if ($IsPreview)
			{
				echo "<tr>";
				echo "	<td align='right' style='padding-right: 10px;'>";
				echo "		<a href='http://www.globalzona.com/party/articles.php'>Read All Articles (".$this->GetArticleCount().")</a>";
				echo "	</td>";
				echo "</tr>";
			}
			echo "</table>";
		}

		function GetArticleCount ()
		{
			$query = "SELECT count(*) as articleCount FROM articles";

			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$results = mysql_fetch_array($result);
				return $results['articleCount'];
			}
			else echo "GetArticleCount Failed";
			return false;
		}
	}
?>