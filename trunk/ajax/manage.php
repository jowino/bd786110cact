<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_manager();

$action = strval($_GET['action']);
$id = abs(intval($_GET['id']));

if ( 'orderrefund' == $action) {
	$order = Table::Fetch('order', $id);
	ZFlow::CreateFromRefund($order);
	Session::Set('notice', 'Refund successfully');
	json(null, 'refresh');
}
else if ( 'ordercash' == $action ) {
	$order = Table::Fetch('order', $id);
	ZOrder::CashIt($order);
	$user = Table::Fetch('user', $order['user_id']);
	Session::Set('notice', "Cash payment OK. User: {$user['email']}");
	json(null, 'refresh');
}
else if ( 'teamdetail' == $action) {
	$team = Table::Fetch('team', $id);
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
	$subcount = Table::Count('subscribe', array( 
				'city_id' => $team['city_id'],
				));
	$html = render('ajax_dialog_teamdetail');
	json($html, 'dialog');
}
else if ( 'teamremove' == $action) {
	$team = Table::Fetch('team', $id);
	$team['state'] = team_state($team);
	if ( $team['state'] != 'none' || $team['now_number']>0 ) {
		json('This deal is over or has buyers, can not delete it', 'alert');
	}
	Table::Delete('team', $id);
	Table::Delete('order', $id, 'team_id');
	Session::Set('notice', "Deal {$id} is deleted successfully!");
	json(null, 'refresh');
}
else if ( 'teamrefund' == $action) {
	$team = Table::Fetch('team', $id);
	$c = array(
		'team_id' => $id,
		'state' => 'pay',
	);
	$os = DB::LimitQuery('order', array('condition'=>$c,));
	foreach($os AS $o) ZFlow::CreateFromRefund($o);
	Table::UpdateCache('team', $id, array('state'=>'refund'));
	Session::Set('notice', "Deal's serial number: {$id} refund successfully");
	json(null, 'refresh');
}
else if ( 'userview' == $action) {
	$user = Table::Fetch('user', $id);
	$html = render('ajax_dialog_user');
	json($html, 'dialog');
}
else if ( 'usermoney' == $action) {
	$user = Table::Fetch('user', $id);
	$money = abs(intval($_GET['money']));
	if (!$money) { json('Topup value should be positive.', 'alert'); }
	if ( ZFlow::CreateFromStore($id, $money) ) {
		json(array(
			array('data' => "Topup {$money} dollars", 'type'=>'alert'),
			array('data' => null, 'type'=>'refresh'),
		), 'mix');
	}
	json('Topup OK.', 'alert'); 
}
else if ( 'orderview' == $action) {
	$order = Table::Fetch('order', $id);
	$user = Table::Fetch('user', $order['user_id']);
	$team = Table::Fetch('team', $order['team_id']);
	$payservice = array(
		'alipay' => 'Alipay',
		'chinabank' => 'ChinaBank',
		'credit' => 'Credit',
		'cash' => 'Cash',
		'paypal' => 'PayPal',
	);
	$paystate = array(
		'unpay' => '<font color="green">Unpaid</font>',
		'pay' => '<font color="red">Paid</font>',
	);
	$html = render('ajax_dialog_orderview');
	json($html, 'dialog');
}
else if ( 'inviteok' == $action ) {
	need_auth(is_manager());
	$invite = Table::Fetch('invite', $id);
	if (!$invite || $invite['pay']!='N') {
		json('Illeggal operation', 'alert');
	}
	Table::UpdateCache('invite', $id, array('pay' => 'Y'));
	$invite = Table::FetchForce('invite', $id);
	ZFlow::CreateFromInvite($invite);
	Session::Set('notice', 'Invitation rebate operation is done');
	json(null, 'refresh');
}
else if ( 'inviteremove' == $action ) {
	need_auth(is_manager());
	Table::Delete('invite', $id);
	Session::Set('notice', 'Illegal invitations deleted!');
	json(null, 'refresh');
}
else if ( 'subscriberemove' == $action ) {
	$subscribe = Table::Fetch('subscribe', $id);
	if ($subscribe) {
		ZSubscribe::Unsubscribe($subscribe);
		Session::Set('notice', "Email: {$subscribe['email']} unsubscribed successfully");
	}
	json(null, 'refresh');
}
else if ( 'partnerremove' == $action ) {
	$partner = Table::Fetch('partner', $id);
	$count = Table::Count('team', array('partner_id' => $id) );
	if ($partner && $count==0) {
		Table::Delete('partner', $id);
		Session::Set('notice', "Partner {$id} deleted");
		json(null, 'refresh');
	}
	if ( $count > 0 ) {
		json('Partner has deal, cannot delete', 'alert'); 
	}
	json('Partner delete error.', 'alert'); 
}
else if ( 'noticesubscribe' == $action ) {
	$nid = abs(intval($_GET['nid']));
	$now = time();
	$team = Table::Fetch('team', $id);
	$partner = Table::Fetch('partner', $team['partner_id']);
	$city = Table::Fetch('category', $team['city_id']);
	$condition = array( 'city_id' => $team['city_id'], );
	$subs = DB::LimitQuery('subscribe', array(
				'condition' => $condition,
				'order' => 'ORDER BY id ASC',
				'offset' => $nid,
				'size' => 1,
				));
	if ( $subs ) {
		foreach($subs AS $one) {
			$nid++;
			try {
				ob_start();
				mail_subscribe($city, $team, $partner, $one);
				$v = ob_get_clean();
				if ($v) throw new Exception($v);
			}catch(Exception $e) { json($e->getMessage(), 'alert'); }
			$cost = time() - $now;
			if ( $cost >= 20 ) {
				json("X.misc.noticenext({$id},{$nid});", 'eval');
			}
		}
		json("X.misc.noticenext({$id},{$nid});", 'eval');
	} else {
		json('Subscribed Email is sent.', 'alert');
	}
}
elseif ( 'categoryedit' == $action ) {
	if ($id) {
		$category = Table::Fetch('category', $id);
		if (!$category) json('No Data', 'alert');
		$zone = $category['zone'];
	} else {
		$zone = strval($_GET['zone']);
	}
	if ( !$zone ) json('Make sure your catergory', 'alert');
	$zone = get_zones($zone);

	$html = render('ajax_dialog_categoryedit');
	json($html, 'dialog');
}
elseif ( 'categoryremove' == $action ) {
	$category = Table::Fetch('category', $id);
	if (!$category) json('No Category', 'alert');
	if ($category['zone'] == 'city') {
		$tcount = Table::Count('team', array('city_id' => $id));
		if ($tcount ) json('Deals in this category', 'alert');
	}
	elseif ($category['zone'] == 'group') {
		$tcount = Table::Count('team', array('group_id' => $id));
		if ($tcount ) json('Deals in this category', 'alert');
	}
	Table::Delete('category', $id);
	Session::Set('notice', 'Delete OK');
	json(null, 'refresh');
}
