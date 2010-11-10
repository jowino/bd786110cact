<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_login();
$condition = array( 'user_id' => $login_user_id,);
$selector = strval($_GET['s']);

if ( $selector == 'index' ) {
}
else if ( $selector == 'unpay' ) {
	$condition['state'] = 'unpay';
}
else if ( $selector == 'pay' ) {
	$condition['state'] = 'pay';
}

$count = Table::Count('team', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 5);
$orders = DB::LimitQuery('order', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

$team_ids = Utility::GetColumn($orders, 'team_id');
$teams = Table::Fetch('team', $team_ids);


include template('order_index');
