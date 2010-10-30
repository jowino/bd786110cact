<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('access', 'user/index');
}
$like = strval($_GET['like']);
$cs = strval($_GET['cs']);

$usergroup=Table::Fetch('user_group','customer','name');
/* build condition */
//$condition = array();
if ($like) { 
	if(empty($usergroup))
	{
		$condition=array('or'=>array("'user_group_id'!=0","manager='Y'"),"email like '%".mysql_escape_string($like)."%'",);
	}
	else
    {
		$condition=array('or'=>array('and'=>array("user_group_id!=0","user_group_id!=".$usergroup['id']),"manager='Y'"),"email like '%".mysql_escape_string($like)."%'");	
	}
}
else {
	if(empty($usergroup))
	{
		$condition=array('or'=>array("user_group_id!=0","manager='Y'"));
	}
	else {
		$condition=array('or'=>array('and'=>array("user_group_id!=0","user_group_id!=".$usergroup['id']),"manager='Y'"));
	}
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
