<?
	include "mp.php";
	
	$api_key = 'fc08aa327a82c1cafd64a125e96be047';
	$api_secret = 'your secret';

 $mp = new Mixpanel($api_key, $api_secret);
 $data = $mp->request(array('events', 'properties'), array(
     'event' => 'link_one',
     'name' => 'position',
     'type' => 'unique',
     'unit' => 'day',
     'interval' => '20',
     'limit' => '20'
 ));
 
 var_dump($data);
?>