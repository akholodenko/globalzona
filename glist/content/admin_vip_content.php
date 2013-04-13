<?
	Layout::AdminPageMessage(stripslashes(urldecode($_GET['message'])));

	echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
	echo "	<tr>";
	echo "		<td valign='top'>";
					Layout::BoxTab('My VIP List');		
					Layout::VIPList(Data::GetVIP());
	echo "		</td>";
	echo "		<td width='25'>&nbsp;</td>";
	echo "		<td width='485' valign='top' style='padding-right: 5px;'>";
					Layout::BoxTab('Add VIP');
	echo "			<div class='transparent_wrap float_right clear_both'>";						
						Layout::VIPForm();
	echo "			</div>";
	echo "		</td>";
	echo "	</tr>";
	echo "</table>";		
?>