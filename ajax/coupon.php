<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

$action = strval($_GET['action']);
$cid = strval($_GET['id']);
$sec = strval($_GET['secret']);

if ($action == 'dialog') {
	$html = render('ajax_dialog_coupon');
	json($html, 'dialog');
}
else if($action == 'query') {
	$coupon = Table::FetchForce('coupon', $cid);
	$partner = Table::Fetch('partner', $coupon['partner_id']);
	$team = Table::Fetch('team', $coupon['team_id']);
	$e = date('Y-m-d', $team['expire_time']);

	if (!$coupon) { 
		$v[] = "#{$cid}&nbsp;Invalid";
	} else if ( $coupon['consume'] == 'Y' ) {
		$v[] = $INI['system']['couponname'] . 'Invalid';
		$v[] = 'Used on: ' . date('Y-m-d H:i:s', $coupon['consume_time']);
	} else if ( $coupon['expire_time'] < strtotime(date('Y-m-d')) ) {
		$v[] = "#{$cid}&nbsp; has expired";
		$v[] = 'Valid till: ' . date('Y-m-d', $coupon['consume_time']);
	} else {
		$v[] = "#{$cid}&nbsp;valid";
		$v[] = "{$team['title']}";
		$v[] = "Valid till &nbsp;{$e}";
	}
	$v = join('<br/>', $v);
	$d = array(
			'html' => $v,
			'id' => 'coupon-dialog-display-id',
			);
	json($d, 'updater');
}

else if($action == 'consume') {
	$coupon = Table::FetchForce('coupon', $cid);
	$partner = Table::Fetch('partner', $coupon['partner_id']);
	$team = Table::Fetch('team', $coupon['team_id']);

	if (!$coupon) {
		$v[] = "#{$cid}&nbsp;Invalid";
		$v[] = 'Failed';
	}
	else if ($coupon['secret']!=$sec) {
		$v[] = $INI['system']['couponname'] . 'Invalid SN';
		$v[] = 'Failed';
	} else if ( $coupon['expire_time'] < strtotime(date('Y-m-d')) ) {
		$v[] = "#{$cid}&nbsp;is Expired";
		$v[] = 'Valid Till: ' . date('Y-m-d', $coupon['consume_time']);
		$v[] = 'Failed';
	} else if ( $coupon['consume'] == 'Y' ) {
		$v[] = "#{$cid}&nbsp;is Used";
		$v[] = 'Buy at: ' . date('Y-m-d H:i:s', $coupon['consume_time']);
		$v[] = 'Failed';
	} else {
		ZCoupon::Consume($coupon);
		//credit to user'money'
		$tip = ($coupon['credit']>0) ? " Get {$coupon['credit']} dollars rebate" : '';
		$v[] = $INI['system']['couponname'] . 'Valid';
		$v[] = 'Buy at: ' . date('Y-m-d H:i:s', time());
		$v[] = 'Buy successfully' . $tip;
	}
	$v = join('<br/>', $v);
	$d = array(
			'html' => $v,
			'id' => 'coupon-dialog-display-id',
			);
	json($d, 'updater');
}
else if ($action == 'sms') {
	$smskey = Cache::GetStringKey("Coupon:{$cid}-{$login_user_id}");
	$yeah = $cache->Get($smskey);
	if ( $yeah ) { json('SMS is submitted, please hold on for 3-5 minutes'); }
	$coupon = Table::Fetch('coupon', $cid);
	if (!$coupon||!is_login()||$coupon['user_id']!= ZLogin::GetLoginId()) {
		json('illegal download', 'alert');
	}
	else if ( $coupon['consume'] == 'Y' 
			|| $coupon['expire_time'] < strtotime(date('Y-m-d'))) {
		json( $INI['system']['couponname'] . 'invalid already', 'alert');
	}
	else if ( !Utility::IsMobile($login_user['mobile']) ) {
		json('SMS is sent, please check it', 'alert');
	}
	$team = Table::Fetch('team', $coupon['team_id']);
	$content = "Deal: {$team['product']}, {$INI['system']['couponname']}Serial:{$coupon['id']}, Password:{$coupon['secret']}";
	if (true===($code=sms_send($login_user['mobile'], $content))) {
		$cache->Set($smskey, 'yeah', 0, 300);
		json('SMS is sent successfully, please check it', 'alert');
	}
	json("Sending SMS failed, error code: {$code}", 'alert');
}
