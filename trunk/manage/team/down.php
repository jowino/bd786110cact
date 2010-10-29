<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('access', 'team/down');
}
$id = abs(intval($_GET['id']));
$team = Table::Fetch('team', $id);

if ( $team['delivery']=='express' ) {
	$oc = array('state' => 'pay');
	$orders = DB::LimitQuery('order', array('condition'=>$oc));
	$xls[] = "User\tTel\tAddr";
	foreach($orders As $o) {
		$xls[] = "{$o['realname']}\t'{$o['mobile']}\t{$o['address']}";
	}
	$xls = join("\n", $xls);
	header('Content-Disposition: attachment; filename="team'.$id.'.xls"');
	die(mb_convert_encoding($xls,'GBK','UTF-8'));
}
else {
	$cc = array(
		'team_id' => $id,
		);
	$coupons = DB::LimitQuery('coupon', array('condition'=>$cc));
	$users = Table::Fetch('user', Utility::GetColumn($coupons, 'user_id'));

	$xls[] = "User\tContact\t{$INI['system']['couponname']} Serial\t{$INI['system']['couponname']} Password";
	foreach($coupons As $o) {
		$u = $users[$o['user_id']];
		$xls[] = "{$u['email']}\t'{$u['mobile']}\t'{$o['id']}\t{$o['secret']}";
	}
	$xls = join("\n", $xls);
	header('Content-Disposition: attachment; filename="team'.$id.'.xls"');
	die(mb_convert_encoding($xls,'GBK','UTF-8'));
}
