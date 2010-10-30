<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

$id = abs(intval($_GET['id']));
$order = Table::Fetch('order', $id);
if (!$order) { die('404 Not Found'); }
$team = Table::Fetch('team', $order['team_id']);
$team['state'] = team_state($team);

if ( $team['state'] != 'none' ) {
	Utility::Redirect( WEB_ROOT . "/team.php?id={$id}");
}

if ( $order['state'] == 'unpay' ) {
	
	if($INI['paypal'] && $order['service']=='paypal') {
		$ordercheck['paypal'] = 'checked';
	}
	else if($INI['alipay'] && $order['service']=='alipay') {
		$ordercheck['alipay'] = 'checked';
	}
	else if($INI['chinabank'] && $order['service']=='chinabank') {
		$ordercheck['chinabank'] = 'checked';
	}
	else if($INI['paypal']) {
		$ordercheck['paypal'] = 'checked';
	}	
	else if($INI['alipay']) {
		$ordercheck['alipay'] = 'checked';
	}
	else if($INI['chinabank']) {
		$ordercheck['chinabank'] = 'checked';
	}
	
	die(include template('order_check'));
}

Utility::Redirect( WEB_ROOT . "/order/view.php?id={$id}");
