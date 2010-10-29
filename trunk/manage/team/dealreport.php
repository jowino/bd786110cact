<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('access', 'team/dealreport');
}
$now = time();
$condition = array(
	'system' => 'Y',
	"end_time < $now",
	"now_number >= min_number"
);
if($_POST&&$_POST['city_id']!='')
{
	$city_id=$_POST['city_id'];
	$condition[] = "city_id=".$city_id;
}
$count = Table::Count('team', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$teams = DB::LimitQuery('team', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));
//$cities = Table::Fetch('category', Utility::GetColumn($teams, 'city_id'));
$cities = DB::LimitQuery('category', array(
			'condition' => array( 'zone' => 'city', ),
			));
$cities=Utility::OptionArray($cities, 'id', 'name');


$selector = 'dealreport';
include template('manage_team_dealreport');
