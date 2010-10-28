<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_partner();
$id = abs(intval($_GET['id']));

$partner_id = abs(intval($_SESSION['partner_id']));
$login_partner = Table::Fetch('partner', $partner_id);

$team = Table::Fetch('team', $id);
if($team['partner_id'] != $partner_id) {
	Session::Set('error', 'No data access premission');
	Utility::Redirect( WEB_ROOT  . '/biz/index.php');
}

if ( $team['delivery']=='express' ) {
	$oc = array('state' => 'pay');
	$orders = DB::LimitQuery('order', array('condition'=>$oc));
	$xls[] = "Name\tTel\tAddr";
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

	$xls[] = "Name\tTel\t{$INI['system']['couponname']}Serial\t{$INI['system']['couponname']}Password";
	foreach($coupons As $o) {
		$u = $users[$o['user_id']];
		$xls[] = "{$u['email']}\t'{$u['mobile']}\t'{$o['id']}\t{$o['secret']}";
	}
	$xls = join("\n", $xls);
	header('Content-Disposition: attachment; filename="team'.$id.'.xls"');
	die(mb_convert_encoding($xls,'GBK','UTF-8'));
}
