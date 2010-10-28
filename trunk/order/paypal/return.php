<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

$_input_charset = 'utf-8';
$partner = $INI['paypal']['mid'];
$security_code = $INI['paypal']['sec'];
$sign_type = 'MD5';
$transport = 'http';


/* very import, this value is add by my phpframewrok */
unset($_GET['param']);  
/* end */

/************
$paypal = new Paypal();
//$paypal->add_field();
$verify_result = $paypal->validate_ipn_get();

$out_trade_no = $_GET['item_number']; //get order number
$total_fee = $_GET['mc_gross'];      // get order price
@list($_, $order_id, $city_id, $_) = explode('-', $out_trade_no, 4);
$currency = $_GET['mc_currency'];
$payment_status = $_GET['payment_status']; // Pending - Completed - Denied - Refunded

if($verify_result) {
	if( $payment_status == 'Completed' || $payment_status == 'Pending') {
		$order = Table::Fetch('order', $order_id);
		if ( $order['state'] == 'unpay' ) {
			//1
			$table = new Table('order');
			$table->SetPk('id', $order_id);
			$table->pay_id = $out_trade_no;
			$table->money = $total_fee;
			$table->state = 'pay';
			$flag = $table->update(array('state', 'pay_id', 'money'));

			if ( $flag ) {
				$table = new Table('pay');
				$table->id = $out_trade_no;
				$table->order_id = $order_id;
				$table->money = $total_fee;
				$table->currency = $currency;
				$table->bank = 'PayPal';
				$table->service = 'paypal';
				$table->create_time = time();
				$table->insert( array('id', 'order_id', 'money', 'currency', 'service', 'create_time', 'bank') );

				//update team,user,order,flow state//
				ZTeam::BuyOne($order);
			}
		}
		Utility::Redirect( WEB_ROOT . "/order/pay.php?id={$order_id}");
	}
	else if ($payment_status == 'Refund') {
	// do nothing 
	}
}


Utility::Redirect( WEB_ROOT . "/order/pay.php?id={$order_id}");
*********/
Utility::Redirect( WEB_ROOT . "/index.php");