<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

$id = abs(intval($_GET['id']));
$buyforfriend=$_GET['action'];
$billing=$_GET['billing'];
$fromgift=$_GET['fromgift'];
if ( $_POST&&isset($_POST['login'])) {
	$login_user = ZUser::GetLogin($_POST['email'], $_POST['password']);
	if ( !$login_user ) {
		Session::Set('error', 'Failed in login');
		Utility::Redirect(WEB_ROOT . '/account/login.php');
	} else if ($INI['system']['emailverify'] && $login_user['secret']) {
		Session::Set('unemail', $_POST['email']);
		Utility::Redirect(WEB_ROOT .'/account/verify.php');
	} else {
		Session::Set('user_id', $login_user['id']);
		ZLogin::Remember($login_user);
		$goto = WEB_ROOT.'/team/buy.php?id='.$id;
		if(isset($_POST['gift']))
		 $goto=$goto.'&action=buyforfriend';
		Utility::Redirect($goto);
	}
}
if(is_login()&&!$buyforfriend)
{
	$billing=true;
}
$team = Table::Fetch('team', $id);
if ( $team ) {
	$leader = Table::Fetch('leader', $team['user_id'], 'user_id');
	$leader_user = Table::Fetch('user', $leader['user_id']);
}
else {
	die('404 Not Found');
}

if ( $_POST ) {
	need_login(true);
	$table = new Table('order', $_POST);
	if ( $table->quantity == 0 ) {
		Session::Set('error', 'Can not buy less than 1.');
		Utility::Redirect( WEB_ROOT . "/team/buy.php?id={$team['id']}");
	}
	if(isset($_POST['isgift'])){
		$table->isgift=$_POST['isgift'];
	}
	$table->user_id = $login_user_id;
	$table->team_id = $team['id'];
	$table->city_id = $team['city_id'];
	$table->fare = $team['fare'];
	$table->express = 'N';
	$table->create_time = time();
	$table->credit = 0;
	$table->origin = ($table->quantity * $team['team_price']) + ($team['delivery'] == 'express' ? $team['fare'] : 0);
	
	$insert = array(
			'user_id', 'team_id', 'city_id', 'state', 
			'fare', 'express', 'origin',
			'address', 'zipcode', 'realname', 'mobile', 'quantity',
			'create_time','isgift',
		);
	
	if ($flag = $table->update($insert)) {
		if ($table->id) {
					if(isset($_POST['isgift'])){
				$giftorder=Table::Fetch('order_gift',$table->id,'order_id');
				$ginsert=array('order_id','to','delivery','message','email');
				if($giftorder)
				{
					$_POST['id']=$giftorder['id'];
				}
				$gorder=new Table('order_gift',$_POST);
				$gorder->order_id=$table->id;
				if($_POST['gift']['delivery']=='print')
				{
					$gorder->delivery='print';
				}
				else 
				{
					$gorder->email=$_POST['gift']['delivery']['email_address'];
					$gorder->delivery='email';
				}
				if($giftorder)
				{
					$gorder->Update($ginsert);
				}
				else {
					$gorder->Insert($ginsert);
				}
				$fromgift=true;
				Utility::Redirect(WEB_ROOT. "/team/buy.php?id={$team['id']}&billing=true&fromgift=true");
			}
			Utility::Redirect( WEB_ROOT. "/order/check.php?id={$table->id}");
		}
		Utility::Redirect( WEB_ROOT . "/order/check.php?id={$flag}");
	}
}
if(!isset($buyforfriend)&&!isset($fromgift))
{
	$ex_con = array(
		'user_id' => $login_user_id,
		'team_id' => $team['id'],
		'isgift'=>'N',
		);
	$order = DB::LimitQuery('order', array(
		'condition' => $ex_con,
		'one' => true,
	));
	
	//each user per day per buy
	if (!$order) { 
		$order = array();
		$order['quantity'] = 1;
	} else {
		if ($order['state']!='unpay'||$order['service']=='cash') {
			Session::Set('error', 'Only buy once for each person, you have bought.');
			Utility::Redirect( WEB_ROOT . '/index.php'); 
		}
	}
	//end;
}
else {
		$ex_con = array(
		'user_id' => $login_user_id,
		'team_id' => $team['id'],
		'isgift'=>'Y',
		'state'=>'unpay',
		"service!='cash'",
		);
	$order = DB::LimitQuery('order', array(
		'condition' => $ex_con,
		'one' => true,
	));
	if (!$order) { 
		$order = array();
		$order['quantity'] = 1;
	}
}


$order['origin'] = ($order['quantity'] * $team['team_price']) + ($team['delivery']=='express' ? $team['fare'] : 0);

include template('team_buy');
