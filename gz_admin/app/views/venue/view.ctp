<table width='100%' border='0' cellspacing='0' cellpadding='0'>
	<tr>
		<td style='width: 200px; vertical-align: top;'>
			<div id='venues_view_image'>
				<? echo $html->image($venue['Venue']['imgURL'], array('width' => '200px')); ?>
			</div>
		</td>
		<td style='vertical-align: top;'>
			<div id='venues_view_title'>
				<? echo $venue['Venue']['name']; ?>
				<span id='venues_view_edit_link'>
					(<? echo $html->link('edit', '/venues/edit/'.$venue['Venue']['id']); ?>)
				</span>
			</div>
			<div id='venues_view_address'>
				<? echo $venue['Venue']['address'].', '.$venue['City']['name'].', '.$venue['City']['state']; ?>
			</div>
			<div id='venues_view_website'>
				<? echo $html->link($venue['Venue']['website'], $venue['Venue']['website'], array('target'=>'_blank')); ?>
			</div>
			<div id='venues_view_text'>
				<? echo urldecode($venue['Venue']['text']); ?>
			</div>
		</td>
	</tr>
</table>