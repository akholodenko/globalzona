<?
	class Venue extends AppModel 
	{
		var $name = 'Venue';
		var $useTable = 'venue';

		var $belongsTo = array(
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'cityId',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
		);
	}
?>