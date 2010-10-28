<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
$like = strval($_GET['like']);
$cs = strval($_GET['cs']);

/* build condition */
$condition = array();
if ($like) { 
	$condition[] = "email like '%".mysql_escape_string($like)."%'";
}

$count = Table::Count('user', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$users = DB::LimitQuery('user', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

include template('manage_user_index');
