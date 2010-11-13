<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_login();
$daytime = strtotime(date('Y-m-d'));
$condition = array(
	'user_id' => $login_user_id,
	'state' => 'pay',
);

$count = Table::Count('gift_card', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 10);
$gift_cards = DB::LimitQuery('gift_card', array(
	'condition' => $condition,
	'coupon' => 'ORDER BY create_time DESC',
	'size' => $pagesize,
	'offset' => $offset,
));



include template('my_giftcard_index');
