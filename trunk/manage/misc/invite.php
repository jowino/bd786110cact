<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('access', 'misc/invite');
}

$memail = strval($_GET['memail']);
$oemail = strval($_GET['oemail']);

$condition = array(
	'credit > 0',
	'pay' => 'N',
);
if ($memail) {
	$muser = Table::Fetch('user', $memail, 'email');
	if ($muser) $condition['user_id'] = $muser['id'];
}
if ($oemail) {
	$ouser = Table::Fetch('user', $oemail, 'email');
	if ($ouser) $condition['other_user_id'] = $ouser['id'];
}

$count = Table::Count('invite', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$invites = DB::LimitQuery('invite', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));

$team_ids = Utility::GetColumn($invites, 'team_id');
$teams = Table::Fetch('team', $team_ids);

$user_ids = Utility::GetColumn($invites, 'user_id');
$user_ido = Utility::GetColumn($invites, 'other_user_id');
$user_ids = array_merge($user_ids, $user_ido);
$users = Table::Fetch('user', $user_ids);

include template('manage_misc_invite');
