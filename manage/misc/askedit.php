<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('modify', 'misc/askedit');
}
$id = abs(intval($_GET['id']));
$ask = Table::Fetch('ask', $id);
if (!$ask) {
	Utility::Redirect( WEB_ROOT . '/manage/misc/ask.php');
}

if ($_POST && $id == $_POST['id'] ) {
	$table = new Table('ask', $_POST);
	$table->update( array('comment', 'content') );
	Utility::Redirect(udecode($_GET['r']));
}

$team = Table::Fetch('team', $ask['team_id']);
$user = Table::Fetch('user', $ask['user_id']);
include template('manage_misc_askedit');
