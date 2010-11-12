<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

$id = abs(intval($_GET['id']));

if (!$id || !$team = Table::Fetch('team', $id) ) {
	Utility::Redirect( WEB_ROOT . '/team/index.php');
}

$pagetitle = $team['title'];
//$condition = array( 'team_id > 0', 'length(comment)>0' );
$condition = array( 'team_id='.$id );

//$condition['team_id'] = $id;
/*$myc = array( 'team_id' => $id, 'parent_id' => 0,);
if ( !$parent_id = DB::Exist('topic', $myc) ) {
	$table = new Table('topic');
	$table->user_id = $table->last_user_id = $team['user_id'];
	$table->last_time = $table->create_time = time();
	$table->team_id = $team['id'];
	$table->city_id = $team['city_id'];
	$table->title = $team['title'];
	$table->content = $team['summary'];
	$parent_id = $table->insert(array(
		'user_id', 'last_user_id', 'create_time', 'last_time',
		'team_id', 'city_id', 'title', 'content',
	));
}*/

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
include template('team_ask');
