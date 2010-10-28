<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

$action = strval($_GET['action']);
$email = strval($_GET['email']);
$city_id = abs(intval($_GET['city_id']));

if ( $action == 'notice' ) 
{
	$curdaytime = strtotime(date('Y-m-d'));
	$team = current_team($city_id);
	$team['state'] = team_state($team);
	if ( $team['state']!='none' || $team['begin_time']!=$curdaytime) {
		die('-ERR');
	}

	$partner = Table::Fetch('partner', $team['partner_id']);
	$city = Table::Fetch('category', $team['city_id']);
	if ( $team && $city && $partner ) {
		$subscribe = Table::Fetch('subscribe', $email, 'email');
		$subscribe = array(
			'email' => $email,
			'secret' => md5(microtime(true)),
		);
		if ( $subscribe ) {
			mail_subscribe($city, $team, $partner, $subscribe);
		}
	}
	die('+OK');
}
