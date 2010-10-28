<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

$_input_charset = 'utf-8';
$partner = $INI['paypal']['mid'];
$security_code = $INI['paypal']['sec'];
$sign_type = 'MD5';
$transport = 'http';


$paypal = new Paypal();
//$paypal->add_field();
$verify_result = $paypal->validate_ipn();

$out_trade_no = $_POST['item_number']; 
//$total_fee = $_POST['amount'];
@list($_, $order_id, $city_id, $_) = explode('-', $out_trade_no, 4);
$payment_status = $_POST['payment_status']; // Pending - Completed - Denied - Refunded
$total_fee = $_POST['mc_gross'];
$currency = $_POST['mc_currency'];
//	$total = $paypal->ipn_data["mc_gross"];
// already get verified, update local data.
if($verify_result) {  
//    $total    = $_POST['amount'];   
	if( $payment_status == 'Completed' || $payment_status == 'Pending') {
		$order = Table::Fetch('order', $order_id);
		if ( $order['state'] == 'unpay' ) {
			//1
			$table = new Table('order');
			$table->SetPk('id', $order_id);
			$table->pay_id = $out_trade_no;
			$table->money = $total_fee;
			$table->state = 'pay';
			$flag = $table->update( array('state', 'pay_id', 'money') );

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
		echo "success";
	}
	// Refunded 
	else if( $payment_status == 'Refunded') {
	// do not refund money from paypal here
	// manually refund team buy money to user's account only
	}	
}
echo "fail";
