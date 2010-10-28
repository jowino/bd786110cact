<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();

$condition = array(
	'state' => 'unpay',
);
$uemail = strval($_GET['uemail']);
if ($uemail) {
	$uuser = Table::Fetch('user', $uemail, 'email');
	if($uuser) $condition['user_id'] = $uuser['id'];
	else $uemail = null;
}

$count = Table::Count('order', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$orders = DB::LimitQuery('order', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

$pay_ids = Utility::GetColumn($orders, 'pay_id');
$pays = Table::Fetch('pay', $pay_ids);

$user_ids = Utility::GetColumn($orders, 'user_id');
$users = Table::Fetch('user', $user_ids);

$team_ids = Utility::GetColumn($orders, 'team_id');
$teams = Table::Fetch('team', $team_ids);

include template('manage_order_unpay');
