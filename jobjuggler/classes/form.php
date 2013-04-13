<?
	class Form
	{
		static function Input ($id, $name, $class, $style = "", $js = "")
		{
			echo "<input type='text' id='".$id."' name='".$name."' class='".$class."' ".$js." />";
		}
		
		static function Password ($id, $name, $class, $style = "", $js = "")
		{
			echo "<input type='password' id='".$id."' name='".$name."' class='".$class."' ".$js." />";
		}
		
		static function Button ($id, $name, $text, $class, $style = "", $js = "")
		{
			echo "<input type='button' id='".$id."' name='".$name."' class='".$class."' ".$js." value='".$text."' />";
		}
		
		static function SelectDropDown ($id, $name, $data, $class, $style = "", $js = "", $default = "")
		{
			echo "<select id='".$id."' name='".$name."' class='".$class."' style='".$style."' ".$js.">";
			
			for($x = 0; $x < count($data); $x++)
			{
				$selected = "";
				if($default == $data[$x]['id'])
					$selected = "SELECTED";
				
				echo "<option value='".$data[$x]['id']."' ".$selected.">".$data[$x]['value']."</option>";
			}
			
			echo "</select>";
		}
	}
?>