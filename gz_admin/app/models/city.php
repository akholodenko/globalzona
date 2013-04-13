<?
	class City extends AppModel 
	{
		var $name = 'City';
		var $useTable = 'city';

		var $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'CountryId',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
		);
	}
?>