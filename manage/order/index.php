<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('access', 'order/index');
}

$t_con = array(
	'begin_time < '.time(),
	'end_time > '.time(),
);

$teams = DB::LimitQuery('team', array('condition'=>$t_con));
$t_id = Utility::GetColumn($teams, 'id');

$condition = array(
	'team_id' => $t_id,
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

include template('manage_order_index');
