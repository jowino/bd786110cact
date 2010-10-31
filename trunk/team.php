<?php
require_once(dirname(__FILE__) . '/app.php');

$id = abs(intval($_GET['id']));
if (!$id || !$team = Table::FetchForce('team', $id) ) {
	Utility::Redirect( WEB_ROOT . '/team/index.php');
}

/* refer */
if (abs(intval($_GET['r']))) { 
	if($_rid) cookieset('_rid', abs(intval($_GET['r'])));
	Utility::Redirect( WEB_ROOT . "/team.php?id={$id}");
}
$city = Table::Fetch('category', $team['city_id']);

$pagetitle = $team['title'];

$discount_price = $team['market_price'] - $team['team_price'];
$discount_rate = $team['team_price']/$team['market_price']*100;

$left = array();
$now = time();
$diff_time = $left_time = $team['end_time']-$now;
$left_hour = floor($left_time/3600);
$left_time = $left_time % 3600;
$left_minute = floor($left_time/60);
$left_time = $left_time % 60;

/* progress bar size */
$bar_size = ceil(190*($team['now_number']/$team['min_number']));
$bar_offset = ceil(5*($team['now_number']/$team['min_number']));

$partner = Table::Fetch('partner', $team['partner_id']);
  //view counter
	  if(!$_SESSION['counter'])
	  {
	   $query='update team set count=count+1 where id='.$team['id'];
	   $result=DB::Query($query);
	   if($result)
	   {
	    $_SESSION['counter']=true;
	   }
	  }
/* other teams */
if ( abs(intval($INI['system']['sideteam'])) ) {
	$oc = array( 
			'city_id' => $city['id'], 
			"id <> {$id}",
			"end_time > ".time(),
			);
	$others = DB::LimitQuery('team', array(
				'condition' => $oc,
				'order' => 'ORDER BY id DESC',
				'size' => abs(intval($INI['system']['sideteam'])),
				));
}

$team['state'] = team_state($team);

/* your order */
if ($login_user_id && $team['state'] == 'none' ) {
	$order = DB::LimitQuery('order', array(
		'condition' => array(
			'team_id' => $id,
			'user_id' => $login_user_id,
			'state' => 'unpay',
			"service!='cash'"
		),
		'one' => true,
	));
}
/* end order */

	/*$charitycondition = array( 
			'd.charity_id'=>'d.charity_id',
			'd.deal_id' => $id, 
			);*/
			$sql='SELECT c.name, d.deal_id, c.image
					FROM  `charity` c, deals_charity d
					WHERE c.id = d.charity_id and d.deal_id='.$id;
			$charities=DB::GetQueryResult($sql,false);
	/*$charities = DB::LimitQuery('deals_charity d,charity,c', array(
				'condition' => $charitycondition,
				'order' => 'ORDER BY c.id DESC',
				'select' => 'c.name,c.image',
				));*/
$condition = array( 'team_id='.$id );

/*pageit*/
$count = Table::Count('ask', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 10);
$asks = DB::LimitQuery('ask', array(
			'condition' => $condition,
			'order' => 'ORDER BY id DESC',
			'size' => $pagesize,
			'offset' => $offset,
			));
/*endpage*/

$user_ids = Utility::GetColumn($asks, 'user_id');
$users = Table::Fetch('user', $user_ids);

include template('team_view');
