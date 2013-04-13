<?
	class LayoutProfile extends Layout
	{
		public static function InstructorProfileSubNavContent ()
		{
			$items = array (
				0 => array("id" => "current", "text" =>"Main"),
				1 => array("id" => "profile_instructor_main", "text" => "Main"),
				2 => array("id" => "profile_instructor_reviews", "text" => "Reviews")
			);
			self::SubNavMenu($items);
		}

		public static function DisplayInstructorProfile ($user)
		{
			echo "<table style='background-color: #eeeeee;padding: 0px 20px 0px 20px;' width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr>";
			echo "		<td width='15%' class='text_reg_b'>Name:</td>";
			echo "		<td width='85%' class='text_reg'>";
			echo "			<div id='profile_name'>".$user['f_name']." ".$user['l_name']."&nbsp;(&nbsp;<a href='#' onClick=\"show_edit_text_field_single('profile_name','".$user['f_name']." ".$user['l_name']."', 'save_update_user_name'); return false;\">edit</a>&nbsp;)</div>";
			echo "		</td>";
			echo "		<td rowspan='6' valign='top'>";
			echo "			<img src='".$user['photo_url']."' style='width: 200px;'>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td class='text_reg_b'>Account&nbsp;Type:</td>";
			echo "		<td class='text_reg'>";
			echo "			<div id='profile_account_type'>".$user['account_type']."</div>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td class='text_reg_b'>Email:</td>";
			echo "		<td class='text_reg'>";
			echo "			<div id='profile_email'>".$user['email']."&nbsp;(&nbsp;<a href='#' onClick=\"show_edit_text_field_single('profile_email','".$user['email']."', 'save_update_user_email'); return false;\">edit</a>&nbsp;)</div>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td class='text_reg_b'>Phone:</td>";
			echo "		<td class='text_reg'>";
			echo "			<div id='profile_phone'>".$user['phone']."&nbsp;(&nbsp;<a href='#' onClick=\"show_edit_text_field_single('profile_phone','".$user['phone']."', 'save_update_user_phone'); return false;\">edit</a>&nbsp;)</div>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td class='text_reg_b' valign='top'>Password:</td>";
			echo "		<td class='text_reg'>";
			echo "			<div id='profile_password'>to change your password, <a href='#' onClick=\"show_edit_password_form('profile_password'); return false;\">click here</a></div>";
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td class='text_reg_b' valign='top'>About:</td>";
			echo "		<td class='text_reg' valign='top'>";
			echo "			<div id='profile_about'>".$user['about']."&nbsp;(&nbsp;<a href='#' onClick=\"show_edit_text_area('profile_about','".rawurlencode($user['about'])."', 'save_update_user_about'); return false;\">edit</a>&nbsp;)</div>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}

		public static function DisplayPasswordChangeForm ($user, $style = "")
		{
			echo "<div style='".$style."'>";
			echo "<form onSubmit=\"submit_change_password(this); return false;\" method='POST'>";
			echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
			echo "	<tr>";
			echo "		<td class='text_reg' width='35%'>old password:</td>";
			echo "		<td align='right'>";
							Form::Password ('old_password', 'old_password', 'form_edit_profile', '', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td class='text_reg'>new password:</td>";
			echo "		<td align='right'>";
							Form::Password ('new_password', 'new_password', 'form_edit_profile', '', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td class='text_reg'>confirm new password:</td>";
			echo "		<td align='right'>";
							Form::Password ('new_password_confirm', 'new_password_confirm', 'form_edit_profile', '', '');
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td class='text_reg'>&nbsp;</td>";
			echo "		<td align='right' class='text_reg' style='padding-top: 10px;'>";
							Form::ButtonSubmit ('new_password_submit', 'new_password_submit', 'form_edit_profile_button', '', 'update password');
			echo "			&nbsp;<a href='#' onClick=\"cancel_update_password('profile_password'); return false;\">cancel</a>";
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
			echo "</form>";
			echo "</div>";
		}
	}
?>