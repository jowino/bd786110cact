<?php
require_once(dirname(__FILE__) . '/app.php');

$tip = strval($_GET['tip']);

if ( $_POST ) {
	ZSubscribe::Create($_POST['email'], $_POST['city_id']);
	if($city['id']!=$_POST['city_id'])
	{
		$updatecity=Table::Fetch('category',$_POST['city_id']);
		cookie_city($updatecity);
		$city=$updatecity;
	}
	die(include template('subscribe_success'));
}

include template('subscribe');
