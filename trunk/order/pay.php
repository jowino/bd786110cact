<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_login();

if (is_post()) {
	$order_id = abs(intval($_POST['order_id']));
} else {
	$order_id = $id = abs(intval($_GET['id']));
}
if(!$order_id || !($order = Table::Fetch('order', $order_id))) {
	die('404 Not Found');
}

if (is_post()) {
	$uarray = array( 'service' => strtolower($_POST['paytype']), );
	Table::UpdateCache('order', $order_id, $uarray);
	$order = Table::Fetch('order', $order_id);
	$order['service'] = strtolower($_POST['paytype']);
}

//payed order
if ( $order['state'] == 'pay' ) {  
	if ( is_get() ) {
		$team = Table::Fetch('team', $order['team_id']);
		die(include template('order_pay_success'));		
	} else {
		Utility::Redirect(WEB_ROOT  . "/order/pay.php?id={$order_id}");
	}
}

if(is_post()&&isset($_POST['cod']))
{
	$carray = array( 'remark' => strtolower($_POST['remark']),'service'=>'cash' );
	Table::UpdateCache('order', $order_id, $carray);
	$team = Table::Fetch('team', $order['team_id']);
		die(include template('order_pay_success'));		
}

$team = Table::Fetch('team', $order['team_id']);
$randno = rand(1000,9999);
$total_money = moneyit($order['origin'] - $login_user['money']);
if ($total_money<0) { $total_money = 0; $order['service'] = 'credit'; }

/* credit pay */
if ( $_POST['service'] == 'credit' ) {
	if ( $order['origin'] > $login_user['money'] ) {
		Table::Delete('order', $order_id);
		Utility::Redirect( WEB_ROOT . '/order/index.php');
	}
	Table::UpdateCache('order', $order_id, array(
				'service' => 'credit',
				'money' => 0,
				'state' => 'pay',
				'credit' => $order['origin'],
				));
	$order = Table::FetchForce('order', $order_id);
	ZTeam::BuyOne($order);
	Utility::Redirect( WEB_ROOT . "/order/pay.php?id={$order_id}");
}
elseif ( $order['service'] == 'chinabank' ) {
	/* credit pay */
	$credit = moneyit($order['origin'] - $total_money);
	if ($order['credit']!=$credit) {
		Table::UpdateCache('order', $order_id, array('credit'=>$credit,));
	}
	/* end */

	$v_mid = $INI['chinabank']['mid'];
	$v_url = $INI['system']['wwwprefix']. '/order/chinabank/return.php';
	$key   = $INI['chinabank']['key'];
	$v_oid = "chinabank-{$order['id']}-{$team['city_id']}-{$randno}";
	$v_amount = $total_money;
	$v_moneytype = 'CNY';
	$text = $v_amount.$v_moneytype.$v_oid.$v_mid.$v_url.$key;
	$v_md5info = strtoupper(md5($text));

	include template('order_pay');
}
else if ( $order['service'] == 'alipay' ) {
	
	/* credit pay */
	$credit = moneyit($order['origin'] - $total_money);
	if ($order['credit']!=$credit) {
		Table::UpdateCache('order', $order_id, array('credit'=>$credit,));
	}
	/* end */

	$_input_charset = 'utf-8';
	$service = 'create_direct_pay_by_user';
	$partner = $INI['alipay']['mid'];
	$security_code = $INI['alipay']['sec'];
	$seller_email = $INI['alipay']['acc'];

	$sign_type = 'MD5';
	$out_trade_no = "alipay-{$order['id']}-{$team['city_id']}-{$randno}";

	$return_url = $INI['system']['wwwprefix'] . '/order/alipay/return.php';
	$notify_url = $INI['system']['wwwprefix'] . '/order/alipay/notify.php';
	$show_url =   $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}";

	$subject = preg_replace('/[\r\n\s]+/','',strip_tags($team['title']));
	$body = $show_url;
	$quantity = $order['quantity'];

	$parameter = array(
			"service"         => $service,
			"partner"         => $partner,      
			"return_url"      => $return_url,  
			"notify_url"      => $notify_url, 
			"_input_charset"  => $_input_charset, 
			"subject"         => $subject,  	 
			"body"            => $body,     	
			"out_trade_no"    => $out_trade_no,
			"total_fee"       => $total_money,  
			"payment_type"    => "1",
			"show_url"        => $show_url,
			"seller_email"    => $seller_email,  
			);
	$alipay = new AlipayService($parameter, $security_code, $sign_type);
	$sign = $alipay->Get_Sign();
	include template('order_pay');
}
/* micdim: paypal support */
else if ( $order['service'] == 'paypal') {
	
	/* credit pay */
	$credit = moneyit($order['origin'] - $total_money);
	if ($order['credit']!=$credit) {
		Table::UpdateCache('order', $order_id, array('credit'=>$credit,));
	}
	/* end */

	$_input_charset = 'utf-8';
	//$service = 'create_direct_pay_by_user'; // what does it mean??
	$partner = $INI['paypal']['mid'];
	$security_code = $INI['paypal']['sec'];
	$seller_acc = $INI['paypal']['acc'];

	$sign_type = 'MD5';
	$out_trade_no = "paypal-{$order['id']}-{$team['city_id']}-{$randno}";

	$return_url = $INI['system']['wwwprefix'] . '/order/paypal/return.php';
	$notify_url = $INI['system']['wwwprefix'] . '/order/paypal/notify.php';
	$show_url =   $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}";

	$subject = preg_replace('/[\r\n\s]+/','',strip_tags($team['title']));
	$body = $show_url;
	$quantity = $order['quantity'];


	$paypal = new Paypal();
        $paypal->add_field('business', $seller_acc);
        $paypal->add_field('notify_url', $notify_url );
		$paypal->add_field('return', $return_url );
        //$paypal->add_field('cancel_return', $show_url);
        //$paypal->add_field('transaction_subject', 'Paypal Transaction - test');
		$paypal->add_field('item_name', $subject);
        $paypal->add_field('item_number', $out_trade_no);
		$paypal->add_field('currency_code', $currency);
        $paypal->add_field('amount', $total_money);
        $paypal->add_field('txn_id', $out_trade_no);

	$sign = $paypal->submit_verify();
	include template('order_pay');
}else if ( $order['service'] == 'cash' ) {
	Table::UpdateCache('order', $order_id, array(
				'service' => 'cash',
				'money' => 0,
				'state' => 'unpay',
				'credit' => 0,
				));
	$order = Table::FetchForce('order', $order_id);
	ZTeam::BuyOne($order);
	include template('order_pay');
}
else if ( $order['service'] == 'credit' ) {
	$total_money = $order['origin'];
	die(include template('order_pay'));
} 
else Utility::Redirect( WEB_ROOT. '/index.php');
