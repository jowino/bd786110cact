<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

$key = $INI['chinabank']['key'];
$v_oid     = trim($_POST['v_oid']);  // 商户发送的v_oid定单编号   
$v_pmode   = trim($_POST['v_pmode']); // 支付方式（字符串）   
$v_pstatus = trim($_POST['v_pstatus']);   //支付状态 ：20 成功,30 失败
$v_pstring = trim($_POST['v_pstring']);   // 支付结果信息
$v_amount  = trim($_POST['v_amount']);     // 订单实际支付金额
$v_moneytype = trim($_POST['v_moneytype']); //订单实际支付币种    
$remark1   = trim($_POST['remark1' ]);      //备注字段1
$remark2   = trim($_POST['remark2' ]);     //备注字段2
$v_md5str  = trim($_POST['v_md5str' ]);   //拼凑后的MD5校验值  

/* 重新计算md5的值 */
$text = "{$v_oid}{$v_pstatus}{$v_amount}{$v_moneytype}{$key}";
$md5string = strtoupper(md5($text));

/* 判断返回信息，如果支付成功，并且支付结果可信，则做进一步的处理 */
if ($v_md5str == $md5string) {
	if($v_pstatus=="20") {
		list($o_mid, $order_id, $city_id, $_) = explode('-', $v_oid, 4);
		//0
		$order = Table::Fetch('order', $order_id);
		if ( $order['state'] == 'unpay' ) {
			//1
			$table = new Table('order');
			$table->SetPk('id', $order_id);
			$table->pay_id = $v_oid;
			$table->money = $v_amount;
			$table->state = 'pay';
			$flag = $table->update( array('state', 'pay_id', 'money') );

			if ( $flag ) {
				$table = new Table('pay');
				$table->id = $v_oid;
				$table->order_id = $order_id;
				$table->money = $v_amount;
				$table->currency = $v_moneytype;
				$table->bank = mb_convert_encoding($v_pmode,'UTF-8','GBK');
				$table->service = 'chinabank';
				$table->create_time = time();
				$table->insert( array('id', 'order_id', 'money', 'currency', 'service', 'create_time', 'bank') );
			}

			//update team,user,order,flow state//
			ZTeam::BuyOne($order);
		}
		echo "ok";
	} 
}
echo "error";
?>
