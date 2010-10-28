<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

($secret = strval($_GET['code'])) || ($secret=strval($_GET['email']));

if (empty($secret)) {
	die(include template('account_verify'));	
}
else if ( strpos($secret, '@') ) {
	Session::Set('unemail', $secret);
	mail_sign_email($secret);
	Utility::Redirect( WEB_ROOT . '/account/verify.php');
}

$user = Table::Fetch('user', $secret, 'secret');
if ( $user ) {
	Table::UpdateCache('user', $user['id'], array(
		'secret' => '',
	));
	Session::Set('notice', 'Congratualations! You account is verified by Email');
	ZLogin::Login($user['id']);
}

Utility::Redirect( WEB_ROOT . '/index.php');
