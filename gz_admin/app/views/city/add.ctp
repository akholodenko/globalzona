<?
	$options = array();
	foreach($countries as $country)
		$options[$country['Country']['id']] = $country['Country']['name'];

	echo	$form->create('City');
?>
	<table>
		<tr>
			<td>City Name</td>
			<td><? echo $form->input('name', array('label' => '', 'type' => 'text')); ?></td>
		</tr>
		<tr>
			<td>State</td>
			<td><? echo $form->input('state', array('label' => '', 'type' => 'text')); ?></td>
		</tr>
		<tr>
			<td>Country</td>
			<td><? echo $form->select('CountryId', $options, '1'); ?></td>
		</tr>
		<tr>
			<td>Image URL</td>
			<td><? echo $form->input('imgURL', array('label' => '', 'type' => 'text')); ?></td>
		</tr>
	</table>
<?
	echo	$form->end('Add City');
?>