$(document).ready(function()
{
	$('#form_input_year').live("change", Utils.updateMakeFormValues);
	$('#form_input_make').live("change", Utils.updateModelFormValues);
	$('#form_input_problem_type').live("change", Utils.updateProblemFormValues);
	
	$('#form_input_zip').live("focusin",function(){
		if($(this).val().length > 0)
			$(this).val("");
	});
	
	$('#form_input_zip').live("focusout",function(){
		if($(this).val().length == 0)
			$(this).val("Zipcode");
	});
	
	$('#data_form').live("submit", Utils.submitForm);
	
	$('#link_log').live("click", Utils.showLog);
	$('#link_check_in').live("click", Utils.showCheckIn);
});
