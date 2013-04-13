<?
	class UI 
	{
		public static function FormFieldYearDropDown ()
		{
			$years = Data::GetYears();
			
			echo "<select id='form_input_year' class='form_select'>";
			echo "<option value='0'>Year</option>";
			
			for($x = 0; $x < count($years); $x++)
			{
				echo "<option>".$years[$x]['year']."</option>";
			}
			/*
			for($x = 2011; $x >= 2000; $x--)			
			{
				echo "<option>".$x."</option>";	
			}
			*/
			
			echo "</select>";
		}
		
		public static function FormFieldMakeDropDown ()
		{
			//$makes = Data::GetCarMakes();
			
			echo "<select id='form_input_make' class='form_select'>";
			echo "	<option value='0'>Make</option>";	
			/*
			for($x = 0; $x < count($makes); $x++)			
			{
				echo "<option value='".$makes[$x]['id']."'>".$makes[$x]['name']."</option>";	
			}
			*/
			echo "</select>";
		}
		
		public static function FormFieldModelDropDown ()
		{
			echo "<select id='form_input_model' class='form_select'>";
			echo "<option value='0'>Model</option>";			
			echo "</select>";
		}
		
		public static function FormFieldProblemTypeDropDown ()
		{
			$problem_types = Data::GetCarProblemTypes();
			
			echo "<select id='form_input_problem_type' class='form_select'>";
			echo "<option value='0'>Problem Type</option>";	
			
			for($x = 0; $x < count($problem_types); $x++)			
			{
				echo "<option value='".$problem_types[$x]['id']."'>".$problem_types[$x]['name']."</option>";	
			}

			echo "</select>";
		}
		
		public static function FormFieldProblemDropDown ()
		{
			echo "<select id='form_input_problem' class='form_select'>";
			echo "<option value='0'>Problem</option>";			
			echo "</select>";
		}
		
		public static function FormFieldZip ()
		{
			echo "<input type='number' id='form_input_zip' name='form_input_zip' class='form_select' value='Zipcode' maxlength='5'>";
		}
	}
?>