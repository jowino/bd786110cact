<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_login();
$daytime = strtotime(date('Y-m-d'));
if(!$_POST)
{
	$condition = array(
		'user_id' => $login_user_id,
		'consume' => 'N',
		"expire_time >= {$daytime}",
	);
	
	$usercoupons = DB::LimitQuery('coupon', array(
		'condition' => $condition,
		'coupon' => 'ORDER BY create_time DESC',
	));
	$couponids=Utility::GetColumn($usercoupons,'id');
	$couponid=$_GET['id'];
	if(in_array($couponid,$couponids))
	{
		$sql='SELECT c.id, c.secret, c.expire_time,p.title,p.contact,p.location,u.username,u.email,u.realname,u.mobile
						FROM  `coupon` c, partner p,user u
						WHERE c.partner_id = p.id and c.user_id=u.id and c.id='.$couponid;
				$coupons[]=DB::GetQueryResult($sql);
	}
}
else {
	$ids=$_POST['print'];
	foreach ($ids as $key=>$val)
	{
		$couponids[]=$val;
	}
	$sql='SELECT c.id, c.secret, c.expire_time,p.title,p.contact,p.location,u.username,u.email,u.realname,u.mobile
						FROM  `coupon` c, partner p,user u
						WHERE c.partner_id = p.id and c.user_id=u.id and c.id in('.join($couponids, ',').')';
				$coupons=DB::GetQueryResult($sql,false);
}

include template('coupon_print');
