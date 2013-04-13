<table width="93%" border="0" cellspacing="3" cellpadding="10">
    <tr> 
    	<td bgcolor="#333333" class="text" align="justify">
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
			<? /*
				if ($_POST['xyz'] > -1) include "login.contentMain.delete.php";	//delete and show confirm message
				else 
				{*/
					$confirmLogin = false;
					if ($_POST['login'] == "true" && $_GET['eventId'] != "") $confirmLogin = confirmIdentity($_GET['eventId'], $_POST['emailLog'], $_POST['passwordLog']);

					if ($_GET['confirm'] == "true")	include "login.contentMain.update.php";	//show event-confirmed text and update event info in database (after user confirms update)
					else if (!$confirmLogin) include "login.contentMain.form.php";	//show login form
					else if ($confirmLogin && $_POST['xyz'] > -1) include "login.contentMain.delete.php";	//delete and show confirm message
					else if ($confirmLogin) include "login.contentMain.identityConfirmed.php"; //show event form with pre-popped fields 
				//} ?>
				<tr class="nav" bgcolor="#777777"><td colspan="2" valign="top" align="right">&nbsp;</td></tr>				 			 
			 </table>
		</td>
	</tr>
</table>