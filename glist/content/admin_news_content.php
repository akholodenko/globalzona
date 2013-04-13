<?
	Layout::AdminPageMessage(stripslashes(urldecode($_GET['message'])));

	$main_page = Data::GetMainPageContent();
	$template = Data::GetTemplateContent();

	echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
	echo "	<tr class='text_body'>";
	echo "		<td colspan='2'>";
	echo "			<span style='font-weight: bold'>News / Updates</span>";
	echo "			<span style='margin-left: 15px;'>|</span>";
	echo "			<span style='margin-left: 15px;'><a href='admin_news_edit.php?content_id=".$main_page['id']."'>edit main page</a></span>";
	echo "			<span style='margin-left: 15px;'><a href='admin_news_edit.php?content_id=".$template['id']."'>edit template</a></span>";
	echo "		</td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td colspan='2'><hr style='color: #9dca3a;' noshade size='1'></td>";
	echo "	</tr>";
	echo "</table>";

	echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
	echo "	<tr class='text_header'>";
	echo "		<td width='50%' style='color: white'>";
	echo "			Main Page";
	echo "		</td>";
	echo "		<td width='50%' style='color: white'>";
	echo "			Template";
	echo "		</td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td width='50%' valign='top'>";
					Layout::TitleTextContent($main_page);
	echo "		</td>";
	echo "		<td width='50%' valign='top'>";
					Layout::TitleTextContent($template);
	echo "		</td>";
	echo "	</tr>";
	echo "</table>";
?>