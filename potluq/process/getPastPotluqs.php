<?
	session_start();
	include "../classes/allClasses.php";

	if(Session::ValidateSession())
	{
		$potluqs = Data::GetOldPotluqsByUserId($_SESSION['USER_id']);
		$potluqCount = count($potluqs);

		Layout::DefaultModuleTop('100%', 'Past Potluqs ('.$potluqCount.')');	
?>
		<div class="moduleText">
			<?
				if($potluqCount > 0)
				{
					for($x = 0; $x < $potluqCount; $x++)
					{
						Layout::Potluq($potluqs[$x]);
					}
				}
				else
				{
					Layout::PotluqBlank();
				}
			?>
		</div>
<?		
		Layout::DefaultModuleBottom();	
	}			
?>