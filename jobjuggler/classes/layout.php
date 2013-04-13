<?

class Layout
{
	static public function DefaultPage ($template_header, $template_main, $template_footer)
	{
		include(Constants::FILE_PATH_TEMPLATE_DEFAULT);
	}
	
	static public function LoginForm ($class)
	{
		echo "<div id='login_form_container' class='".$class."'>";
		echo "	<div id='login_form_subcontainer'>";
		echo "		<label id='label_username'>username:</label>";
					Form::Input('username', 'username', 'formfield');

		echo "		<label id='label_password'>password:</label>";
					Form::Password('password', 'password', 'formfield');
					
					$usernameJSObject = "$('#username').val()";
					$passwordJSObject = "$('#password').val()";
					Form::Button('submitLogin', 'submitLogin', 'login', 'formbutton', '', 'onClick="AJAX.login('.$usernameJSObject.','.$passwordJSObject.');"');
		echo "	</div>";
		echo "</div>";
	}
	
}

?>