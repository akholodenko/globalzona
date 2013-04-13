<?
	$options = array();
	foreach($cities as $city)
		$options[$city['City']['id']] = $city['City']['name'].', '.$city['City']['state'];

	echo	$form->create('Venue');
?>
	<table>
		<tr>
			<td>Venue Name</td>
			<td><? echo $form->input('name', array('label' => '', 'type' => 'text')); ?></td>
		</tr>
		<tr>
			<td>Street Address</td>
			<td><? echo $form->input('address', array('label' => '', 'type' => 'text')); ?></td>
		</tr>
		<tr>
			<td>City</td>
			<td><? echo $form->select('cityId', $options); ?></td>
		</tr>
		<tr>
			<td>Image URL</td>
			<td><? echo $form->input('imgURL', array('label' => '', 'type' => 'text')); ?></td>
		</tr>
		<tr>
			<td valign='top'>Description</td>
			<td><? echo $form->input('text', array('label' => '')); ?></td>
		</tr>
		<tr>
			<td>Website URL</td>
			<td><? echo $form->input('website', array('label' => '', 'type' => 'text')); ?></td>
		</tr>
	</table>
	<!--
	echo '<div>';
	echo	$form->create('Venue');
	echo	$form->input('name', array('label' => '', 'type' => 'text'));
	echo	$form->input('address', array('label' => '', 'type' => 'text'));
	echo	$form->select('cityId', $options);
	echo	$form->input('imgURL', array('label' => '', 'type' => 'text'));
	echo	$form->input('text', array('label' => ''));
	echo	$form->input('website', array('label' => '', 'type' => 'text'));
	echo	$form->end('Add Venue');
	echo '</div>';
	-->
<?
	echo	$form->end('Add Venue');
?>