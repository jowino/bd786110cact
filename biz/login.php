<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

if ( $_POST ) {
	$login_partner = ZPartner::GetLogin($_POST['username'], $_POST['password']);
	if ( !$login_partner ) {
		Session::Set('error', 'Username and password are not matched!');
		Utility::Redirect( WEB_ROOT . '/biz/login.php');
	} else {
		Session::Set('partner_id', $login_partner['id']);
		Utility::Redirect( WEB_ROOT . '/biz/index.php');
	}
}

include template('biz_login');
