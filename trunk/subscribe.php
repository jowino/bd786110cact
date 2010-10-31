<?php
require_once(dirname(__FILE__) . '/app.php');

$tip = strval($_GET['tip']);

if ( $_POST) {
if ( ! Utility::ValidEmail($_POST['email'], true) ) {
		Session::Set('error', 'Email is not a valid email address');
		Utility::Redirect( WEB_ROOT . '/subscribe.php');
	}
	if($_POST['city_id'])
	{
		ZSubscribe::Create($_POST['email'], $_POST['city_id']);
		if($city['id']!=$_POST['city_id'])
		{
			$updatecity=Table::Fetch('category',$_POST['city_id']);
			cookie_city($updatecity);
			$city=$updatecity;
		}
	}
	else
	ZSubscribe::Create($_POST['email'], $city['id']);

	die(include template('subscribe_success'));
}

include template('subscribe');
