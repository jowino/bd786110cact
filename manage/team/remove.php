<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
$id = abs(intval($_GET['id']));
$team = Table::Fetch('team', $id);
$order = Table::Fetch('order', $id, 'team_id');
if ( $order ) {
	Session::Set('notice', "Delete ({$id}) record failed, record has order.");
} else {
	Table::Delete('team', $id);
	Session::Set('notice', "Delete ({$id}) record is done.");
}
Utility::Redirect(udecode($_GET['r']));
