<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

if ( $_POST ) {
	$login_user = ZUser::GetLogin($_POST['email'], $_POST['password']);
	if ( !$login_user ) {
		Session::Set('error', 'Failed in login');
		Utility::Redirect(WEB_ROOT . '/account/login.php');
	} else if ($INI['system']['emailverify'] && $login_user['secret']) {
		Session::Set('unemail', $_POST['email']);
		Utility::Redirect(WEB_ROOT .'/account/verify.php');
	} else {
		Session::Set('user_id', $login_user['id']);
		ZLogin::Remember($login_user);
		($goto = Session::Get('loginpage', true)) || ($goto = WEB_ROOT.'/index.php');
		Utility::Redirect($goto);
	}
}
$currefer = strval($_GET['r']);
if ($currefer) { Session::Set('loginpage', udecode($currefer)); }
include template('account_login');
