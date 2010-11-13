<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_login();
if (is_post()&&isset($_POST['giftpay'])) {
	if (!$_POST['from'] || !$_POST['to'] || !$_POST['amount']) {
		Session::Set('error', 'Please do not submit it untill finished.');
	}
	$table = new Table('gift_card', $_POST);
	$table->code = Utility::GenSecret(8,'mix');
	$table->email=$_POST['gift_card']['delivery']['email_address'];
	$table->create_time = time();
	$table->user_id=$login_user_id;
	$order_id=$table->Insert(array(
		'user_id','from', 'to', 'message', 'amount','code','email', 'create_time','paytype',
	));

if(!$order_id || !($order = Table::Fetch('gift_card', $order_id))) {
	die('404 Not Found');
}
$randno = rand(1000,9999);
$total_money = moneyit($order['amount']);
/* micdim: paypal support */
if ( $order['paytype'] == 'paypal') {
	
	/* credit pay 
	$credit = moneyit($order['origin'] - $total_money);
	if ($order['credit']!=$credit) {
		Table::UpdateCache('order', $order_id, array('credit'=>$credit,));
	}
	 end */

	$_input_charset = 'utf-8';
	//$service = 'create_direct_pay_by_user'; // what does it mean??
	$partner = $INI['paypal']['mid'];
	$security_code = $INI['paypal']['sec'];
	$seller_acc = $INI['paypal']['acc'];

	$sign_type = 'MD5';
	$out_trade_no = "paypal-{$order['id']}-{$randno}";

	$return_url = $INI['system']['wwwprefix'] . '/order/paypal/return.php';
	$notify_url = $INI['system']['wwwprefix'] . '/order/paypal/giftnotify.php';
	$show_url =   $INI['system']['wwwprefix'] . "/gift_cards/index.php";

	$subject = preg_replace('/[\r\n\s]+/','',strip_tags('Gift_Card'));
	$body = $show_url;
	$quantity = 1;


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
	include template('gift_pay');
}
else if ( $order['paytype'] == 'cash' ) {
	include template('gift_pay');
}else if ($order['paytype'] == 'migs'){	$mid = $INI['migs']['mid'];	$version = $INI['migs']['ver'];	$type = $INI['migs']['type'];	$accesscode = $INI['migs']['acc'];	$ref = $INI['migs']['ref'];	$locale = $INI['migs']['loc'];	$returnURL = $INI['migs']['url'];		include template('gift_pay');}

else Utility::Redirect( WEB_ROOT. '/index.php');
	}
elseif ($_POST&&isset($_POST['cod']))
{
	$carray = array( 'remark' => strtolower($_POST['remark']),'paytype'=>'cash','state'=>'unpay' );
	Table::UpdateCache('gift_card', $_POST['order_id'], $carray);
	$team = Table::Fetch('team', $order['team_id']);
		die(include template('gift_pay_success'));	
}
else {
if (is_post()) {
	$order_id = abs(intval($_POST['order_id']));
} else {
	$order_id = $id = abs(intval($_GET['id']));
}
if(!$order_id || !($order = Table::Fetch('gift_card', $order_id))) {
	die('404 Not Found');
}
if ( $order['state'] == 'pay' ) {  
	if ( is_get() ) {
		$team = Table::Fetch('team', $order['team_id']);
		die(include template('gift_pay_success'));		
	} else {
		Utility::Redirect(WEB_ROOT  . "/gift_cards/index.php");
	}
}
}
