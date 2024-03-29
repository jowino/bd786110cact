<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_login();
$action = strval($_GET['action']);
$id = $team_id = abs(intval($_GET['id']));
$team = Table::Fetch('team', $team_id);

if ( $action == 'remove' && $team['user_id'] == $login_user_id ) {
	DB::DelTableRow('team', array('id' => $team_id));
	json("jQuery('#team-list-id-{$team_id}').remove();", 'eval');
}
else if ( $action == 'delay' && $team['user_id'] != $login_user_id ) {
	if ( ! in_array($team['state'], array('none')) ) {
		Table::UpdateCache('team', $team_id, array(
			'end_time' => array('`end_time` + 86400'),
		));
		json('location.reload();', 'eval');
	} else {
		json('Deal is over, can not extend', 'alert');		
	}
}
else if ( $action == 'ask' ) {
	$content = trim($_POST['content']);
	if ( $content ) {
		$table = new Table('ask', $_POST);
		$table->user_id = $login_user_id;
		$table->team_id = $team['id'];
		$table->city_id = $team['city_id'];
		$table->create_time = time();
		$table->insert(array('user_id','team_id','city_id','content','create_time'));
	}
	Utility::Redirect( WEB_ROOT . '/team/ask.php?id='.$team['id']);
	//redirect('/team/ask.php?id='.$team['id']);
}

json(0);
?>
