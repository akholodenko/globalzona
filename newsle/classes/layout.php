<?
	class Layout
	{
		public static function DefaultTemplate ($mainFileName, $sideFileName, $mainNavigation)
		{
			include "template/default.php";
		}

		public static function DisplayDropDownCategory ($id, $cssClass)
		{
			$categories = Data::GetCategories("title");

			echo "<select id='".$id."' name='".$id."' class='".$cssClass."'>";
			echo "	<option value=''>Select Category</option>";

			for($x = 0; $x < count($categories); $x++)
			{
				echo "	<option value='".$categories[$x]["id"]."'>&nbsp;".$categories[$x]["title"]."</option>";
			}

			echo "</select>";
		}

		public static function DisplayHomePagePosts ($posts, $showCategory)
		{
			$colspan = 3;
			echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>";

			for($x = 0; $x < count($posts); $x++)
			{
				echo "<tr class='postText' id='postRow".$posts[$x]["id"]."' onMouseOver=\"HighlightPostRow(".$posts[$x]["id"].")\" onMouseOut=\"HighlightPostRow(".$posts[$x]["id"].")\">";
				
				if($showCategory)
				{
					$colspan = 4;
					echo "	<td style='width: 20%; padding-left: 15px; font-weight: bold;'>";
					echo		$posts[$x]["category"];
					echo "	</td>";
				}

				echo "	<td style='padding-left: 15px;'>";
				echo "		<a id='postLink".$posts[$x]["id"]."' href='".urldecode($posts[$x]["url"])."' target='_blank' onClick=\"Data.GetPostByID(".$posts[$x]["id"]."); return false;\">".Utils::StringTruncate(stripslashes(urldecode($posts[$x]["title"])), 75)."</a>";
				echo "	</td>";
				echo "	<td style='width: 20%; text-align: right; padding-right: 10px;'>";
				echo		Utils::GetHomePageDate($posts[$x]["date"]);
				echo "	</td>";
				echo "	<td style='width: 5%; text-align: right; padding-right: 15px;' valign='middle'>";
				echo "		<a href='#' onClick=\"return false;\">";

				if($posts[$x]["spamFlag"] == 1) 
				{
					$spamImageSrc = "images/alert15.png";
					$spamImgTagText = "post has been marked as spam";
				}
				else 
				{
					$spamImageSrc = "images/spam.png";
					$spamImgTagText = "mark post as spam";
				}

				echo "			<img alt='".$spamImgTagText."' title='".$spamImgTagText."' id='spamImage".$posts[$x]["id"]."' onClick=\"AjaxUtils.RecordSpam(".$posts[$x]["id"].")\" src='".$spamImageSrc."' width='18' border='0' style=' margin-bottom: -3px;'>";
				echo "		</a>";
				echo "	</td>";
				echo "</tr>";
				echo "<tr><td colspan='".$colspan."'><div style='width: 100%; background-color: #eeeeee; height: 1px; font-size: 1px; line-height: 1px;'>&nbsp;</div></td></tr>";
			}
			echo "	<tr><td colspan='".$colspan."'>&nbsp;</td></tr>";
			echo "</table>";
		}

		public static function DisplayPagination ($currentPage, $totalPages)
		{
			echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr><td colspan='3'><div style='width: 100%; background-color: #eeeeee; height: 1px; font-size: 1px; line-height: 1px;'>&nbsp;</div></td></tr>";
			echo "	<tr class='paginationText'>";				
			echo "		<td width='30%' style='padding-left: 15px; padding-top: 5px;'>";
			echo "			<a id='prevPage' href='#' style='display: none;' onClick=\"Pagination.PreviousPage(); return false;\">Previous Page</a>";
			echo "		</td>";
			echo "		<td width='40%' style='padding-top: 5px; text-align: center;'>";
			echo "			<span id='currentPageNumber'></span>";
			echo "				&nbsp;of&nbsp;";
			echo "			<span id='totalPageNumber'></span>";
			echo "		</td>";
			echo "		<td width='30%' style='padding-right: 15px; text-align: right; padding-top: 5px;'>";
			echo "			<a id='nextPage' href='#' onClick=\"Pagination.NextPage(); return false;\">Next Page</a>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
			echo "<script>";
			echo "	Pagination.DisplayCurrentPageNumber();";
			echo "	Pagination.DisplayTotalPageNumber(0);";
			echo "</script>";
		}

		public static function DisplaySubmitPostForm ()
		{
			echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<form action='#' method='POST' onSubmit=\"Data.ValidateSubmitPost(".Utils::SubmitFormParams()."); return false; \">";
			echo "		<tr>";
			echo "			<td style='padding: 5px 15px 5px 15px;'>";
			echo "				<input id='submitPostTitle' name='submitPostTitle' maxlength='250' type='text' value=' Title' class='submitForm' onClick=\"ClearTextField('submitPostTitle');\">";
			echo "			</td>";
			echo "		</tr>";
			echo "		<tr>";
			echo "			<td style='padding: 0px 15px 5px 15px;'>";
			echo "				<input id='submitPostURL' name='submitPostURL' type='text' value=' Article Link' class='submitForm' onClick=\"ClearTextField('submitPostURL');\">";
			echo "			</td>";
			echo "		</tr>";
			echo "		<tr>";
			echo "			<td style='padding: 0px 15px 5px 15px;'>";
								Layout::DisplayDropDownCategory ('submitPostCategory','submitFormCategory');
			echo "			</td>";
			echo "		</tr>";
			echo "		<tr>";
			echo "			<td style='padding: 0px 15px 5px 15px; text-align: center;'>";
			echo "				<input id='submitPostButton' name='submitPostButton' type='submit' value='Submit Article' class='submitFormButton'>";
			echo "			</td>";
			echo "		</tr>";
			echo "	</form>";
			echo "</table>";
		}

		public static function DisplayTopPosts ($posts)
		{
			$colspan = 2;
			echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>";

			for($x = 0; $x < count($posts); $x++)
			{
				echo "<tr class='postTopText' id='postTopRow".$posts[$x]["id"]."' onMouseOver=\"HighlightTopPostRow(".$posts[$x]["id"].")\" onMouseOut=\"HighlightTopPostRow(".$posts[$x]["id"].")\">";
				echo "	<td style='padding-left: 15px;'>";
				echo "		<a id='postTopLink".$posts[$x]["id"]."' href='".urldecode($posts[$x]["url"])."' target='_blank' onClick=\"AjaxUtils.GetPostByID(".$posts[$x]["id"]."); return false;\">".Utils::StringTruncate(stripslashes(urldecode($posts[$x]["title"])),27)."</a>";
				echo "	</td>";
				echo "	<td style='padding-right: 15px; text-align: right;'>";
				echo		$posts[$x]["views"]." views"	;
				echo "	</td>";
				echo "</tr>";
				echo "<tr><td colspan='2'><div style='width: 100%; background-color: #eeeeee; height: 1px; font-size: 1px; line-height: 1px;'>&nbsp;</div></td></tr>";
			}
			echo "	<tr><td colspan='2'>&nbsp;</td></tr>";
			echo "</table>";
		}

		public static function DisplayNavigation ($categories)
		{
			echo "<table cellpadding='0' cellspacing='0' border='0' align='center'>";
			echo "	<tr>";

			Layout::DisplayNavigationItem (array("id" => 0, "title" => "All"),-1,count($categories));

			for($x = 0; $x < count($categories); $x++)
			{
				Layout::DisplayNavigationItem ($categories[$x],$x,count($categories));
			}
			
			echo "	</tr>";
			echo "</table>";
			echo "<div style='float: right; margin: -21px 5px 0px 0px' id='HomePagePostsLoaderImage'>&nbsp;</div>";
		}

		private static function DisplayNavigationItem ($category,$index,$count)
		{
			if($category["id"] == 0)
				$appendData = "font-weight: bold;";
			echo "<td class='navigation' style='text-align: center; padding-bottom: 6px;'>";
			echo "	<a href='#' style=' ".$appendData."' id='navCategory".$category["id"]."' onClick=\"Pagination.FirstPage(".$category["id"]."); return false;\">".$category["title"]."</a>";

			if($index + 1 < $count)
			{
				echo "&nbsp;|&nbsp;";
			}

			echo "</td>";
		}

		public static function DisplayPost ($post)
		{
			//echo "<script>AjaxUtils.RecordView(".$post[0]['id'].");</script>";	//record view of post

			echo "<div class='postHeaderText' style='padding-top: 9px; padding-left: 15px;'>";
			echo "	<a href='".urldecode($post[0]["url"])."' target='_blank'>";
			echo	stripslashes(urldecode($post[0]['title']));
			echo "	</a>";
			echo "</div>";
			echo "<div class='postSubheaderText' style='float: right; padding-right: 15px;'>";
			echo "	<span id='postSubHeaderViews' class='postSubheaderText'>&nbsp;</span>";
			echo "	since ".date("F j, Y",strtotime($post[0]["date"]));
			echo "</div>";

			//echo "<script>AjaxUtils.GetViewByPostID(".$post[0]['id'].");</script>";	//asynchronously update the number of views for the post

			echo "<div class='postSubheaderText' style='padding-bottom: 9px; padding-left: 15px;'>";
			echo "	Posted from ".Utils::GetDomain(urldecode($post[0]["url"]));
			echo "</div>";
			echo "<div style='width: 100%; background-color: #eeeeee; height: 1px; font-size: 1px; line-height: 1px;'>&nbsp;</div>";
		}
	}
?>