<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('access', 'charity/charity');
}

$condition = array();

$count = Table::Count('charity', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$charities = DB::LimitQuery('charity', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

include template('manage_system_charity');
