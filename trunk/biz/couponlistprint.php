<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_partner();
$daytime = strtotime(date('Y-m-d'));
$partner_id = abs(intval($_SESSION['partner_id']));

	$condition = array(
		'partner_id' => $partner_id,
		'consume' => 'N',
		"expire_time >= {$daytime}",
	);
	
	$coupons = DB::LimitQuery('coupon', array(
		'condition' => $condition,
		'coupon' => 'ORDER BY create_time DESC',
	));

include template('coupon_list_print');
