<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('access', 'category/index');
}
$condition = array();

($zone = strval($_GET['zone'])) || ($zone = 'city');
if ( $zone ) { $condition['zone'] = $zone; }

$cates = get_zones();

$count = Table::Count('category', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$categories = DB::LimitQuery('category', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

include template('manage_category_index');
