<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_partner();
$partner_id = abs(intval($_SESSION['partner_id']));
$action = strval($_GET['action']);
$id = $order_id = abs(intval($_GET['id']));
$team = Table::Fetch('team', $id);
need_auth($team['partner_id']==$partner_id);

if ( 'teamdetail' == $action) {
	$partner = Table::Fetch('partner', $team['partner_id']);
	$nowcount = Table::Count('order', array(
		'state' => 'pay',
		'team_id' => $id,
	));
	$onlinepay = Table::Count('order', array(
		'state' => 'pay',
		'team_id' => $id,
	), 'money');
	$creditpay = Table::Count('order', array(
		'state' => 'pay',
		'team_id' => $id,
	), 'credit');
	$team['state'] = team_state($team);
	$html = render('ajax_dialog_teamdetail');
	json($html, 'dialog');
}
