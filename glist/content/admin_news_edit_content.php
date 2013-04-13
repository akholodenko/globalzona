<?
	if($_GET['content_id'] != "")
	{
		$content = Data::GetContentById($_GET['content_id']);	

		echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
		echo "	<form action='process/process_news_edit.php' method='POST'>";
		echo "	<input type='hidden' name='content_id' value='".$content['id']."'>";
		echo "	<tr class='text_body' style='font-weight: bold'>";
		echo "		<td colspan='2'>Edit Content: ".$content['description']."</td>";
		echo "	</tr>";
		echo "	<tr>";
		echo "		<td colspan='2'><hr style='color: #9dca3a;' noshade size='1'></td>";
		echo "	</tr>";
		echo "	<tr class='text_body'>";
		echo "		<td width='60'>Title:</td>";
		echo "		<td>";
						Form::Input('title', 'title', 'form', 'width: 400px;', stripslashes(urldecode($content['title'])));
		echo "		</td>";
		echo "	</tr>";
		echo "	<tr class='text_body'>";
		echo "		<td valign='top'>Description:</td>";
		echo "		<td>";
						Form::TextArea('text', 'text', 'form', 'width: 400px; height: 200px;', str_replace("<br/>", "\n", stripslashes(urldecode($content['text']))));
		echo "		</td>";
		echo "	</tr>";
		echo "	<tr class='text_body'>";
		echo "		<td>&nbsp;</td>";
		echo "		<td>";
						Form::ButtonSubmit('submitButton', 'submitButton', '', '', 'submit', '');
		echo "			&nbsp;";
		echo "			<a href='admin_news.php'>cancel</a>";
		echo "		</td>";
		echo "	</tr>";
		echo "	</form>";
		echo "</table>";
	}
?>