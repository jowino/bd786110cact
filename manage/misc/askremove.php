<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('modify', 'misc/askremove');
}
$id = abs(intval($_GET['id']));
Table::Delete('ask', $id);
Session::Set('notice', "Delete question({$id})successfully");
Utility::Redirect(udecode($_GET['r']));
