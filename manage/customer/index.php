<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('access', 'customer/index');
}
$like = strval($_GET['like']);
$cs = strval($_GET['cs']);
$usergroup=Table::Fetch('user_group','customer','name');
/* build condition */
//$condition = array();
if ($like) { 
	if(empty($usergroup))
	{
		$condition=array('user_group_id'=>0,"email like '%".mysql_escape_string($like)."%'",);
	}
	else
    {
		$condition=array('or'=>array('and'=>array('user_group_id'=>0,"email like '%".mysql_escape_string($like)."%'",),'user_group_id'=>$usergroup['id']),"email like '%".mysql_escape_string($like)."%'");	
	}
}
else {
	if(empty($usergroup))
	{
		$condition=array('user_group_id'=>0);
	}
	else {
		$condition=array('or'=>array('and'=>array('user_group_id'=>0,"1=1"),'user_group_id'=>$usergroup['id']));
	}
}
$condition[]="manager='N'";

$count = Table::Count('user', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$users = DB::LimitQuery('user', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

include template('manage_customer_index');
