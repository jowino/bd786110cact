<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');
need_login();

	if($INI['paypal'] && $order['service']=='paypal') {
		$ordercheck['paypal'] = 'checked';
	}
	else if($INI['alipay'] && $order['service']=='alipay') {
		$ordercheck['alipay'] = 'checked';
	}
	else if($INI['chinabank'] && $order['service']=='chinabank') {
		$ordercheck['chinabank'] = 'checked';
	}
	else if($INI['paypal']) {
		$ordercheck['paypal'] = 'checked';
	}	
	else if($INI['alipay']) {
		$ordercheck['alipay'] = 'checked';
	}
	else if($INI['chinabank']) {
		$ordercheck['chinabank'] = 'checked';
	}

include template("gift_cards_index");
