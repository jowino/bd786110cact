<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_login();
$daytime = strtotime(date('Y-m-d'));
$condition = array(
	'user_id' => $login_user_id,
	'consume' => 'N',
	"expire_time >= {$daytime}",
);

$count = Table::Count('coupon', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 10);
$coupons = DB::LimitQuery('coupon', array(
	'condition' => $condition,
	'coupon' => 'ORDER BY create_time DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

$team_ids = Utility::GetColumn($coupons, 'team_id');
$teams = Table::Fetch('team', $team_ids);

include template('coupon_index');
