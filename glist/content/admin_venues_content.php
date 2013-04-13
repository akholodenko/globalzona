<?
	Layout::AdminPageMessage(stripslashes(urldecode($_GET['message'])));

	echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
	echo "	<tr>";
	echo "		<td valign='top'>";
					Layout::BoxTab('My Venues');
					Layout::VenueList(Data::GetVenues());
	echo "		</td>";
	echo "		<td width='25'>&nbsp;</td>";
	echo "		<td width='485' valign='top' style='padding-right: 5px;'>";
					Layout::BoxTab('Add Venue');
	echo "			<div class='transparent_wrap float_right clear_both'>";						
						Form::AddVenueForm();
	echo "			</div>";
	echo "		</td>";
	echo "	</tr>";
	echo "</table>";
?>