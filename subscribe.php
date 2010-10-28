<?php
require_once(dirname(__FILE__) . '/app.php');

$tip = strval($_GET['tip']);

if ( $_POST ) {
	ZSubscribe::Create($_POST['email'], $city['id']);
	die(include template('subscribe_success'));
}

include template('subscribe');
