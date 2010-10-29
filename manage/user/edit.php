<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('modify', 'user/edit');
}
$id = abs(intval($_GET['id']));
$user = Table::Fetch('user', $id);
$user_groups=DB::LimitQuery('user_group');
$user_group_id=$user['user_group_id'];

if ( $_POST && $id==$_POST['id'] ) {
	$table = new Table('user', $_POST);
	$up_array = array(
			'user_group_id','username', 'realname', 'mobile', 'zipcode', 'address',
			);

	if ($table->password ) {
		$table->password = ZUser::GenPassword($table->password);
		$up_array[] = 'password';
	}
	$flag = $table->update( $up_array );
	if ( $flag ) {
		Session::Set('notice', 'Update user information done.');
		Utility::Redirect( WEB_ROOT . "/manage/user/edit.php?id={$id}");
	}
	Session::Set('error', 'Update user information failed.');
	$user = $_POST;
}

include template('manage_user_edit');
