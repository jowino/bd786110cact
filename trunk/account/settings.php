<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_login();
if ( $_POST ) {
	$table = new Table('user', $_POST);
	$table->SetPk('id', $login_user_id);
	$update = array(
		'username', 'realname', 'zipcode', 'address', 'mobile', 'avatar',
	);
	if ( $table->password == $table->password2 && $table->password ) {
		$update[] = 'password';
		$table->password = ZUser::GenPassword($table->password);
	}
	$table->avatar=upload_image('upload_image',$login_user['avatar'],'user');
	$table->update($update);
	Utility::Redirect( WEB_ROOT . '/account/settings.php ');
}
include template('account_settings');
