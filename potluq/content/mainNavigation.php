<table cellpadding='0' cellspacing='0' border='0'>
	<tr>
		<td>
			<? 
				Layout::NavigationTab('main', '150px', 'Main', 'block'); 
				Layout::NavigationTabOff('main', '150px', 'Main', 'none'); 
			?>
		</td>			
		<td>
			<? 
				Layout::NavigationTab('addressBook', '150px', 'Address&nbsp;Book', 'none'); 
				Layout::NavigationTabOff('addressBook', '150px', 'Address&nbsp;Book', 'block'); 
			?>
		</td>
		<td>
			<? 
				Layout::NavigationTab('profile', '150px', 'Profile', 'none'); 
				Layout::NavigationTabOff('profile', '150px', 'Profile', 'block'); 
			?>
		</td>
	</tr>
</table>