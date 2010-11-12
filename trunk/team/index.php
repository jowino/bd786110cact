<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

$daytime = time();
$condition = array( 
	'OR' =>  array( 
		array( 'city_id' => $city['id'], ),
		array( 'city_id' => 0,),
	),
	"begin_time <  {$daytime}",
);

$count = Table::Count('team', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 10);
$teams = DB::LimitQuery('team', array(
	'condition' => $condition,
	'order' => 'ORDER BY begin_time DESC, id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

$pagetitle = 'Recent Deal';
include template('team_index');
