<!-- side color: #dddddd -->
<div style='padding-top: 10px;'>
  <b class="roundCornerPopular">
  <b class="roundCornerPopular1"><b></b></b>
  <b class="roundCornerPopular2"><b></b></b>
  <b class="roundCornerPopular3"></b>
  <b class="roundCornerPopular4"></b>
  <b class="roundCornerPopular5"></b></b>

  <div class="roundCornerPopularfg">
	<div style='text-align: center; padding-bottom: 5px;' class='moduleHeaderText'>
		Top Articles
	</div>
	<div style='width: 100%; background-color: #eeeeee; height: 2px; font-size: 2px; line-height: 1px;'>&nbsp;</div>
	<div id='HomePageTopPosts'>
	<?
		Layout::DisplayTopPosts(Data::GetTopPosts(Config::$GET_TOP_POSTS_MAX));
	?>
	</div>
  </div>

  <b class="roundCornerPopular">
  <b class="roundCornerPopular5"></b>
  <b class="roundCornerPopular4"></b>
  <b class="roundCornerPopular3"></b>
  <b class="roundCornerPopular2"><b></b></b>
  <b class="roundCornerPopular1"><b></b></b></b>
</div>