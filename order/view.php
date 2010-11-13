<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_login();
$order_id = $id = strval(intval($_GET['id']));
if(!$order_id || !($order = Table::Fetch('order', $order_id))) {
	die('404 Not Found');
}
if ( $order['user_id'] != $login_user['id']) {
	Utility::Redirect( WEB_ROOT . "/team.php?id={$order['team_id']}");
}
if ( $order['state']=='unpay'&&$order['service']!='cash') {
	Utility::Redirect( WEB_ROOT . "/team.php?id={$order['team_id']}");
}

$team = Table::FetchForce('team', $order['team_id']);
$partner = Table::Fetch('partner', $order['partner_id']);
$express = ($team['delivery']=='express');

if ( $team['delivery'] == 'coupon' ) {
	$cc = array(
			'user_id' => $login_user['id'],
			'team_id' => $order['team_id'],
			);
	$coupons = DB::LimitQuery('coupon', array(
				'condition' => $cc,
				));
}
//mail_coupon($team, $partner, $order, $login_user, $coupons[0]);
//mail_tipped($team, $order, $login_user);
include template('order_view');
