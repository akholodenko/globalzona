var hold = false;	//used to hold off from doing MOUSEOUT action for clicked NAV tabs
var autoModalPopUp = false;
var autoModalSubject = "";
var autoModalBody = "";

var current_sub_nav_id = -1;
var current_sub_nav_text = '';

var current_public_profile_user_id = -1;

function nav_on_over (id)
{
	document.getElementById(id).style.display='none';
	document.getElementById(id + '_over').style.display='block';
}

function nav_off_over (id)
{
	document.getElementById(id + '_off').style.display='none';
	document.getElementById(id + '_over').style.display='block';
}

function nav_out (id)
{
	if(!hold)	//when clicked, don't do mouse out
	{
		document.getElementById(id + '_off').style.display='block';
		document.getElementById(id + '_over').style.display='none';
	}
	hold  = false;
}

function nav_click_default (id, loadSide, callBack)
{
	document.getElementById(current_nav_tab_id).style.display='none';
	document.getElementById(current_nav_tab_id + '_over').style.display='none';
	document.getElementById(current_nav_tab_id + '_off').style.display='block';

	document.getElementById(id).style.display='block';
	document.getElementById(id + '_over').style.display='none';
	document.getElementById(id + '_off').style.display='none';

	set_current_data(id);	//set current tab and subnav data

	hold = true;	//don't do MOUSE OUT behavior

	load_DIV_content('content_main', id, '', callBack);	//load content into main panel

	if(loadSide == 'true')
		load_DIV_content('content_side', id + '_side', '');	//load content into side panel
}

function set_current_data (tab_id)
{
	current_nav_tab_id = tab_id;

	//set default subnav data
	//this is needed for INBOX's setting of read/unread status of messages (reloading of messages)
	if(tab_id == 'instructor_inbox_content' || tab_id == 'student_inbox_content')
	{
		current_sub_nav_id = 'subnav_main';
		current_sub_nav_text = 'Main';
	}
}

function load_DIV_content (divID, contentID, params, callBack)
{
	if(!callBack)
		$('#' + divID).load('content/' + contentID + '.php?ajax=true&' + params);
	else
		$('#' + divID).load('content/' + contentID + '.php?ajax=true&' + params, callBack);
}

function load_content_by_class (class_name, contentID, params, callBack)
{
	if(!callBack)
		$('.' + class_name).load('content/' + contentID + '.php?ajax=true&' + params);
	else
		$('.' + class_name).load('content/' + contentID + '.php?ajax=true&' + params, callBack);
}

function highlight_message_row (id)
{
	if(document.getElementById('message_row_' + id).style.backgroundColor == '')
	{
		document.getElementById('message_row_' + id).style.backgroundColor = '#6593d4';
		document.getElementById('message_row_' + id).style.color = '#ffffff';
		document.getElementById('message_link_' + id).style.color = '#ffffff';
		document.getElementById('message_link_' + id).style.textDecoration = 'underline';
	}
	else
	{
		document.getElementById('message_row_' + id).style.backgroundColor = '';
		document.getElementById('message_row_' + id).style.color = '#415E88';
		document.getElementById('message_link_' + id).style.color = '#415E88';
		document.getElementById('message_link_' + id).style.textDecoration = 'none';
	}
}

function set_message_window (subject, body, isAlert)
{
	var alertHTML = '';
	if(isAlert)
	{
		alertHTML = '<div style="float:left"><img src="images/icons/warning.png"></div>';
	}

	$('#message_modal_window_content').html(unescape(unescape(body)) + alertHTML);
	$('#message_modal_window').dialog('option', 'title', unescape(subject));
}

function show_review_feed_details ()
{
	var callBack = function () {		
		sub_nav_click('subnav_profile_instructor_reviews', 'Reviews');
	}
	
	nav_click_default('instructor_profile_content', 'true', callBack);
}

function show_sub_category_results (sub_category_id)
{
	load_DIV_content('content_main', 'view_sub_category_instructors', 'sub_category_id=' + sub_category_id);
}

function show_instructor_public_profile (user_id)
{
	current_public_profile_user_id = user_id;	//set selected instructor's public profile user ide
	load_DIV_content('content_main', 'view_instructor_public_profile', 'user_id=' + user_id);
}

function show_calendar_feed_details ()
{
	var callBack = function () {		
		//sub_nav_click('subnav_profile_instructor_reviews', 'Reviews');
	}
	
	nav_click_default('instructor_calendar_content', 'true', callBack);
}

function show_sub_categories (category_id)
{
	$('#sub_category_container').css('display', 'none')
	
	var callBack = function () {
		$('#sub_category_container').insertAfter('#category_link_' + category_id);
		$('#sub_category_container').slideDown('slow');
	}

	load_DIV_content('sub_category_container', 'view_sub_categories', 'category_id=' + category_id, callBack);

	
}

function show_message_window (subject, body)
{
	set_message_window(subject, body, false);
	$('#message_modal_window').dialog('open');
}

//function show_new_message_window

function highlight_message_pop_up_nav_item_OVER (id)
{
	document.getElementById('message_pop_up_nav_' + id).style.backgroundColor = '#6593d4';
	document.getElementById('message_pop_up_nav_' + id).style.color = '#ffffff';
	document.getElementById('message_pop_up_nav_' + id).style.cursor = 'pointer';
}


function highlight_message_pop_up_nav_item_OUT (id)
{
	document.getElementById('message_pop_up_nav_' + id).style.backgroundColor = '#ffffff';
	document.getElementById('message_pop_up_nav_' + id).style.color = '#415E88';
	document.getElementById('message_pop_up_nav_' + id).style.cursor = 'auto';
}

function message_pop_up_nav_item_CLICK (id, message_id)
{
	//alert('clicked ' + id);
	if(id == 1)	//reply
	{
		set_message_window ('Re: ' + $('#message_modal_window').dialog('option', 'title'), '', false);
		load_DIV_content('message_modal_window_content', 'view_message_reply_form', 'message_id=' + message_id);
	}
	else if(id == 4)	//send
	{
		load_DIV_content('message_modal_window_content', 'view_message_send', 'message_id=' + message_id + '&subject=' + 'test' + '&body=' + 'bodytest');
		//$('#message_modal_window').dialog('option', 'buttons', { "Ok": function() { $(this).dialog("close"); } });
	}
	else if(id == 5)	//discard
	{
		var answer = confirm("Discard message?")
		
		if(answer)
			$('#message_modal_window').dialog('close');
	}
}

function message_pop_up_nav_SEND_CLICK (user_id, subject, body)
{
	//load_DIV_content('message_modal_window_content', 'view_message_send', 'user_id=' + user_id + '&subject=' + escape(subject) + '&body=' + escape(body));
	$.post("process/send_message.php", { to_user_id: user_id, subject: subject, body: escape(nl2br(body)) }, function () {
		$('#message_modal_window').dialog('close');
		alert('message sent');
	} );
}

function sub_nav_highlight (id)
{
	if($('#' + id).css('text-decoration') == 'underline')
	{
		$('#' + id).css('text-decoration','none');
	}
	else
	{
		$('#' + id).css('text-decoration','underline');
		$('#' + id).css('cursor','pointer');
	}
}

function sub_nav_click (id, text)
{
	current_sub_nav_id = id;
	current_sub_nav_text = text;

	$('#subnav_current').html(text);

	if(id == 'subnav_sent')
	{
		load_DIV_content ('container_messages', 'view_messages_sent', '');
		load_DIV_content ('content_side', 'messages_sent_side', '');	//load content into side panel
	}
	else if(id == 'subnav_main')
	{
		load_DIV_content ('container_messages', 'view_messages_main', '');
		load_DIV_content ('content_side', 'messages_main_side', '');	//load content into side panel
	}
	else if(id == 'subnav_trash')
	{
		load_DIV_content ('container_messages', 'view_messages_trash', '');
		load_DIV_content ('content_side', 'messages_trash_side', '');	//load content into side panel
	}
	else if(id == 'subnav_home_address_book')
	{
		load_DIV_content ('container_home', 'view_address_book', '');
		load_DIV_content ('content_side', 'address_book_side', '');	//load content into side panel
	}
	else if(id == 'subnav_home_instructor')
	{
		load_DIV_content ('container_home', 'view_home_instructor', '');
		load_DIV_content ('content_side', 'instructor_home_content_side', '');	//load content into side panel
	}
	else if(id == 'subnav_profile_instructor_main')
	{
		load_DIV_content ('container_profile', 'view_profile_instructor_main', '');
		load_DIV_content ('content_side', 'instructor_profile_content_side', '');
	}
	else if(id == 'subnav_profile_instructor_reviews')
	{
		load_DIV_content ('container_profile', 'view_profile_instructor_reviews', '');
		load_DIV_content ('content_side', 'reviews_side', '');	//load content into side panel
	}
	else if(id == 'subnav_instructor_directory')
	{
		nav_click_default('view_index_content', 'false');
		//load_DIV_content ('container_profile', 'view_profile_instructor_reviews', '');
		//load_DIV_content ('content_side', 'reviews_side', '');	//load content into side panel
	}
	else if(id == 'subnav_instructor_public_profile_main')
	{
		//load_DIV_content ('container_profile', 'view_profile_instructor_reviews', '');
		show_instructor_public_profile(current_public_profile_user_id);
	}
	else if(id == 'subnav_instructor_public_profile_reviews')
	{
		load_DIV_content ('container_public_profile', 'view_profile_instructor_reviews', '');
		//show_instructor_public_profile(current_public_profile_user_id);
	}
}

function highlight_address_book_row (id)
{
	if(document.getElementById('address_book_row_' + id).style.backgroundColor == '')
	{
		document.getElementById('address_book_row_' + id).style.backgroundColor = '#6593d4';
		document.getElementById('address_book_row_' + id).style.color = '#ffffff';
		document.getElementById('address_book_link_' + id).style.color = '#ffffff';
		document.getElementById('address_book_link_' + id).style.textDecoration = 'underline';
	}
	else
	{
		document.getElementById('address_book_row_' + id).style.backgroundColor = '';
		document.getElementById('address_book_row_' + id).style.color = '#415E88';
		document.getElementById('address_book_link_' + id).style.color = '#415E88';
		document.getElementById('address_book_link_' + id).style.textDecoration = 'none';
	}
}

function highlight_directory_result_row (id)
{
	if(document.getElementById('directory_result_row_' + id).style.backgroundColor == '')
	{
		document.getElementById('directory_result_row_' + id).style.backgroundColor = '#6593d4';
		document.getElementById('directory_result_row_' + id).style.color = '#ffffff';
		document.getElementById('directory_result_link_' + id).style.color = '#ffffff';
		document.getElementById('directory_result_link_' + id).style.textDecoration = 'underline';
	}
	else
	{
		document.getElementById('directory_result_row_' + id).style.backgroundColor = '';
		document.getElementById('directory_result_row_' + id).style.color = '#415E88';
		document.getElementById('directory_result_link_' + id).style.color = '#415E88';
		document.getElementById('directory_result_link_' + id).style.textDecoration = 'none';
	}
}

//shows editable textfield for value of profile that user wants to update
function show_edit_text_field_single (id, text, save_function)
{
	var text_field = '<input type="text" id="update_' + id + '" class="form_edit_profile"/>' + save_link(id, save_function);
	$('#' + id).html(text_field);
	$('#update_' + id).val(unescape(text));	//set value of text field
	$('#update_' + id).focus();	//focus cursor on newly displayed editable textfield
}

//shows editable password textfield for value of profile that user wants to update
function show_edit_password_form (id)
{
	var callBack = function () {$('#old_password').focus();};
	load_DIV_content(id, 'view_password_change_form', '', callBack);
}

function cancel_update_password (id)
{
//to change your password, <a href='#' onClick=\"show_edit_password_form('profile_password'); return false;\">click here</a>
	var password_text = "to change your password, <a href='#' onClick=\"show_edit_password_form('profile_password'); return false;\">click here</a>";
	$('#' + id).html(password_text);
}

//shows editable textarea for value of profile that user wants to update
function show_edit_text_area (id, text, save_function)
{
	var text_area = '<textarea id="update_' + id + '" class="form_edit_profile_textarea">' + br2nl(unescape(text)) + '</textarea>' + save_link(id, save_function);
	$('#' + id).html(text_area);
	$('#update_' + id).focus();	//focus cursor on newly displayed editable textarea
}

function show_edit_password (id, save_function)
{
}

//returns html for 'save' link for profile update
function save_link (id, save_function)
{
	return '&nbsp;<a href="#" onClick=\"' + save_function + '(\'' + id + '\', document.getElementById(\'update_' + id + '\').value); return false;\">save</a>'
}

//returns html for 'edit' link for profile update
function edit_link (id, edit_function, text, save_function)
{
	return '&nbsp;(&nbsp;<a href="#" onClick=\"' + edit_function + '(\'' + id + '\', \'' + escape(text) + '\', \'' + save_function + '\'); return false;\">edit</a>&nbsp;)';
}

function save_update_user_name (id, name)
{
	var name_array = name.split(" ");
	var f_name = name_array[0];
	var l_name = name_array[1];

	//store updated name
	$.post("process/update_user_name.php", { f_name: f_name, l_name: l_name } );


	//show newly-updated static data w/edit link
	var text = f_name + ' ' + l_name;
	var text_edit_link = edit_link(id, 'show_edit_text_field_single', f_name + ' ' + l_name, 'save_update_user_name'); 

	$('#' + id).html(text + text_edit_link);
}

function save_update_user_email (id, email)
{
	//TODO: validate email

	//store updated email
	$.post("process/update_user_email.php", { email: email } );

	//show newly-updated static data w/edit link
	var text = email;
	var text_edit_link = edit_link(id, 'show_edit_text_field_single', email, 'save_update_user_email');

	$('#' + id).html(text + text_edit_link);
}

function save_update_user_phone (id, phone)
{
	//TODO: validate phone

	//store phone	
	$.post("process/update_user_phone.php", { phone: phone } );

	//show newly-updated static data w/edit link
	var text = phone;
	var text_edit_link = edit_link(id, 'show_edit_text_field_single', phone, 'save_update_user_phone');

	$('#' + id).html(text + text_edit_link);
}

function save_update_user_about (id, about)
{
	//TODO: store about

	//show newly-updated static data w/edit link
	var text = nl2br(about);
	var text_edit_link = edit_link(id, 'show_edit_text_area', about, 'save_update_user_about');

	$('#' + id).html(text + text_edit_link);
}

function text_field_clear_default (field, default_text)
{
	if(field.value == default_text)
		field.value = '';
}

function br2nl (text)
{
    return text.replace(/<br\s*\/?>/mg,"\n");
}

function nl2br(text)
{
	var re_nlchar; 
	text = escape(text);
	if(text.indexOf('%0D%0A') > -1)
		re_nlchar = /%0D%0A/g ;
	else if(text.indexOf('%0A') > -1)
		re_nlchar = /%0A/g ;
	else if(text.indexOf('%0D') > -1)
		re_nlchar = /%0D/g ;

	return unescape( text.replace(re_nlchar,'<br>') );
}

function mark_message_as_read (message_id, current_status_id)
{

	$.post("process/update_message_read_status.php", { message_id: message_id, message_read_status_id: '2' }, function () {		
		sub_nav_click (current_sub_nav_id, current_sub_nav_text);	//reload message window
		update_inbox_unread_message_count();	//update message count in the navigation tab
	});
}

function mark_message_as_unread (message_id, current_status_id)
{

	$.post("process/update_message_read_status.php", { message_id: message_id, message_read_status_id: '1' }, function () {
		sub_nav_click (current_sub_nav_id, current_sub_nav_text);	//reload list of messages with updated unread status
		update_inbox_unread_message_count();	//update message count in the navigation tab
		$('#message_modal_window').dialog('close');	//close message window
	});
}

function update_inbox_unread_message_count ()
{
	load_content_by_class('nav_inbox_message_count_class', 'view_inbox_unread_message_count', '');
}

function move_message_to_trash (message_id)
{
	var answer = confirm("Move message to trash?")
		
	if(answer)
	{
		$.post("process/move_message_to_trash.php", { message_id: message_id }, function () {
			sub_nav_click (current_sub_nav_id, current_sub_nav_text);	//reload list of messages with updated unread status
			$('#message_modal_window').dialog('close');	//close message window
		});
	}
}


function delete_message (message_id)
{
	var answer = confirm("Permenantly delete message?")
		
	if(answer)
	{
		$.post("process/delete_message.php", { message_id: message_id }, function () {
			sub_nav_click (current_sub_nav_id, current_sub_nav_text);	//reload list of messages with updated unread status
		});
	}
}

function submit_change_password (form)
{

}