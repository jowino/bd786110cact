<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if ( $_POST ) {
	need_login(true);
	$gift_card = Table::Fetch('gift_card',$_POST['code'],'code');
	if ( !$gift_card||$gift_card['status']=='used' ) {
		Session::Set('error', 'Gift code is not valid.');
		Utility::Redirect( $_SERVER['HTTP_REFERER']);
	}
	$money = $gift_card['amount'];
	
	if ( ZFlow::CreateFromStore($login_user_id, $money) )
	{
		$table=new Table('gift_card',$gift_card);
		$update_array=array('redeem_time','status',);
		$table->redeem_time=time();
		$table->status='used';
		$flag = $table->update( $update_array );
		Session::Set('notice', 'Your account is updated.');
		Utility::Redirect( $_SERVER['HTTP_REFERER']);
	}
}

