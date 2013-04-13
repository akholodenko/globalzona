<?
	class PhotoAlbum
	{
		var $photoAlbumInfo = array();

		function PhotoAlbum ()
		{
		}

		function SetPhotoAlbums ($query)
		{
			$db = new Database($query);
			$result = $db->ExecuteQuery($query);

			if ($result != -1)
			{
				$num = mysql_numrows($result);
				for ( $i = 0; $i < $num; ++$i ) $this->photoAlbumInfo[$i] = mysql_fetch_array($result);
				return true;
			}
			else echo "SetPhotoAlbums Failed";
			return false;
		}

		function SetRecentPhotoAlbums ($limit)
		{
			$query = "SELECT p.id, p.albumCoverURL, p.eventTitle, p.eventDate, c.name as cityName, v.id as venueId, v.name as venueName  FROM photoAlbum p, city c, venue v WHERE v.Id = p.eventVenueId AND c.id = v.cityId ORDER BY p.eventDate DESC LIMIT ".$limit;
			$this->SetPhotoAlbums($query);
		}

		function PrintPhotoAlbumPreviewInfo ($rowCount)
		{
			$layout = new Layout();
			echo "<table width='100%' border='0' cellpadding='2' cellspacing='0' class='textBig'>";
			echo "	<tr class='nav'><td colspan='".$rowCount."' align='center' class='lightGradient'>Recently Added Photo Albums</td></tr>";
			echo "	<tr class='spacer'><td colspan='".$rowCount."'>&nbsp;</td></tr>";
			echo "	<tr>";
			for ($x = 0; $x < count($this->photoAlbumInfo); $x++)
			{
				$tooltip = urldecode($this->photoAlbumInfo[$x]['eventTitle'])." at ".$this->photoAlbumInfo[$x]['venueName']." in ".$this->photoAlbumInfo[$x]['cityName'];

				if ($x > 0 && ($x % $rowCount == 0))
				{
					echo "</tr><tr>";
				}

				echo "		<td style='padding-left: 10px'>";
				echo "			<a href='photoView.php?photoAlbumId=".$this->photoAlbumInfo[$x]['id']."'>";
				echo "				<img class='imgBorder' src='".$this->photoAlbumInfo[$x]['albumCoverURL']."' width=130 alt=\"".$tooltip."\" title=\"".$tooltip."\">";
				echo "			</a>";
				echo "			<br><a href='photoView.php?photoAlbumId=".$this->photoAlbumInfo[$x]['id']."' title=\"".$tooltip."\">".$layout->printLimitedString(urldecode($this->photoAlbumInfo[$x]['eventTitle']),20)."</a>";
				echo "			<div class='textSmallWhiteBold'>";
				echo				date("M d, Y", strtotime($this->photoAlbumInfo[$x]['eventDate']));
				echo "			</div>";
				echo "		</td>";

				

			}
			echo "	</tr>";
			echo "</table>";
		}
	}
?>