<?
	if(!$in_page)
	{
		include ("../classes/ui.class.php");
		include ("../classes/database.class.php");
		include ("../classes/data.class.php");
	}
?>

<div class='subtitle'>Check-in with car trouble | <a id='link_log' href='#'>The Log</a></div>
<div id='form_container'>
	<form id='data_form'>					
	<?
		UI::FormFieldYearDropDown();
		UI::FormFieldMakeDropDown();
		UI::FormFieldModelDropDown();
		UI::FormFieldProblemTypeDropDown();
		UI::FormFieldProblemDropDown();
		UI::FormFieldZip();
	?>
		<input id='form_submit' type='submit' class='form_submit' />
	</form>
</div>
<!--<div class='subtitle'>Why should I?</div>-->