<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

$_input_charset = 'utf-8';
$partner = $INI['alipay']['mid'];
$security_code = $INI['alipay']['sec'];
$sign_type = 'MD5';
$transport = 'http';

$alipay = new AlipayNotify($partner, $security_code, $sign_type, $_input_charset, $transport);
$verify_result = $alipay->notify_verify();

$out_trade_no = $_POST['out_trade_no']; 
$total_fee = $_POST['total_fee'];
@list($_, $order_id, $city_id, $_) = explode('-', $out_trade_no, 4);

if($verify_result) {  
    $total    = $_POST['total_fee'];   
	if($_POST['trade_status'] == 'TRADE_FINISHED' ||$_POST['trade_status'] == 'TRADE_SUCCESS') {
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
				$table->currency = 'CNY';
				$table->bank = '支付宝';
				$table->service = 'alipay';
				$table->create_time = time();
				$table->insert( array('id', 'order_id', 'money', 'currency', 'service', 'create_time', 'bank') );

				//update team,user,order,flow state//
				ZTeam::BuyOne($order);
			}
		}
		echo "success";
	}	
}
echo "fail";
