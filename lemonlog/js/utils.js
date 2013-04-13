function Utils () {}

Utils.updateMakeFormValues = function (event)
{
	Utils.clearFormSelect("form_input_make");
	Utils.clearFormSelect("form_input_model");
	
	//get models for specific make by year
	if($('#form_input_year').val() > 0)
	{
		$.get('api.php?f=3&year=' + $('#form_input_year').val(), function(data) {		  	
		  	for(var i in data)
			{
			    $('#form_input_make').append("<option value='" + data[i].make_id + "'>" + data[i].name + "</option>");
			}
		}, "json");
	}
}

Utils.updateModelFormValues = function (event)
{
	Utils.clearFormSelect("form_input_model");
	
	//get models for specific year/make :: only if both are available
	if($('#form_input_year').val() > 0 && $('#form_input_make').val() > 0)
	{
		$.get('api.php?f=1&year=' + $('#form_input_year').val() + '&make_id=' + $('#form_input_make').val(), function(data) {		  	
		  	for(var i in data)
			{
			    $('#form_input_model').append("<option value='" + data[i].model_id + "'>" + data[i].name + "</option>");
			}
		}, "json");
	}
}

Utils.updateProblemFormValues = function (event)
{
	Utils.clearFormSelect("form_input_problem");
	
	if($('#form_input_problem_type').val() > 0)
	{
		$.get('api.php?f=2&problem_type_id=' + $('#form_input_problem_type').val(), function(data) {		  	
		  	for(var i in data)
			{
			    $('#form_input_problem').append("<option value='" + data[i].problem_id + "'>" + data[i].name + "</option>");
			}
		}, "json");
	}
}

Utils.clearFormSelect = function (id)
{
  	var elSel = document.getElementById(id);
	var i;
	
  	for (i = elSel.length - 1; i >= 1; i--) 
  	{
		elSel.remove(i);
  	}
}

Utils.submitForm = function (event)
{
	if(Utils.validateForm())
	{
		$('#loader').show();
		
		var year = $('#form_input_year').val();
		var make_id = $('#form_input_make').val();
		var model_id = $('#form_input_model').val();
		var problem_type_id = $('#form_input_problem_type').val();
		var problem_id = $('#form_input_problem').val();
		var zipcode = $('#form_input_zip').val();
		
		$('#main').load("content/submit.php?year=" + year + "&make_id=" + make_id + "&model_id=" + model_id + "&problem_type_id=" + problem_type_id + "&problem_id=" + problem_id + "&zipcode=" + zipcode, function (event) {
			$('#loader').hide();
		});
	}
	
	event.preventDefault();
}

Utils.validateForm = function () 
{
	if($('#form_input_year').val() == 0 || $('#form_input_year').val() == '')
	{
		alert('Select Year');
		$('#form_input_year').focus();
		return false;
	}
	else if($('#form_input_make').val() == 0 || $('#form_input_make').val() == '')
	{
		alert('Select Car Make');
		$('#form_input_make').focus();
		return false;
	}
	else if($('#form_input_model').val() == 0 || $('#form_input_model').val() == '')
	{
		alert('Select Car Model');
		$('#form_input_model').focus();
		return false;
	}
	else if($('#form_input_problem_type').val() == 0 || $('#form_input_problem_type').val() == '')
	{
		alert('Select Car Problem Type');
		$('#form_input_problem_type').focus();
		return false;
	}
	else if($('#form_input_problem').val() == 0 || $('#form_input_problem').val() == '')
	{
		alert('Select Car Problem');
		$('#form_input_problem').focus();
		return false;
	}
	else if($('#form_input_zip').val().length < 5 || $('#form_input_zip').val() == 'Zipcode')
	{
		alert('Enter Zipcode');
		$('#form_input_zip').focus();
		return false;
	}

	return true;
}

Utils.showLog = function (event)
{
	$('#loader').show();
	
	$('#main').load("content/log.php", function (event) {
		$('#loader').hide();
		window.scrollTo(0,1);
	});
	
	event.preventDefault();
}

Utils.showCheckIn = function (event)
{
	$('#loader').show();

	
	$('#main').load("content/form.php", function (event) {
		$('#loader').hide();
		window.scrollTo(0,1);
	});
	
	event.preventDefault();
}