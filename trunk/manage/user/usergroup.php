<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('access', 'user/usergroup');
}
$cs = strval($_GET['cs']);


$count = Table::Count('user_group');
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$groups = DB::LimitQuery('user_group', array(
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

include template('manage_user_usergroup');
