<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

$id = abs(intval($_GET['id']));

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
			'create_time',
		);
	
	if ($flag = $table->update($insert)) {
		if ($table->id) Utility::Redirect( WEB_ROOT. "/order/check.php?id={$table->id}");
		Utility::Redirect( WEB_ROOT . "/order/check.php?id={$flag}");
	}
}

$ex_con = array(
		'user_id' => $login_user_id,
		'team_id' => $team['id'],
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
	if ($order['state']!='unpay') {
		Session::Set('error', 'Only buy once for each person, you have bought.');
		Utility::Redirect( WEB_ROOT . '/index.php'); 
	}
}
//end;

$order['origin'] = ($order['quantity'] * $team['team_price']) + ($team['delivery']=='express' ? $team['fare'] : 0);

include template('team_buy');
