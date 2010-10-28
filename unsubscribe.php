<?php
require_once(dirname(__FILE__) . '/app.php');

$code = strval($_GET['code']);
$subscribe = Table::Fetch('subscribe', $code, 'secret');
if ($subscribe) {
	ZSubscribe::Unsubscribe($subscribe);
	Session::Set('notice', 'Unsubscribed, you will not get the daily deal information.');
}
Utility::Redirect( WEB_ROOT  . '/subscribe.php');
