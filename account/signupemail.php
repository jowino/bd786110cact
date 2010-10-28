<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');
if ( $_POST ) {
	if ( ! Utility::ValidEmail($_POST['email'], true) ) {
		Session::Set('error', 'Email is not a valid email address');
		Utility::Redirect( WEB_ROOT . '/account/signupemail.php');
	}



	$user_details = $_SESSION['FB_USER_LOGIN'];
	unset($_SESSION['FB_USER_LOGIN']);
	if($user_details) {
		$user_details['email'] = $_POST['email'];
		$user_details['username'] = $_POST['username'];
		$user_details['password'] = $_POST['password'];
		if($user_id = ZUser::Create($user_details)) {
			ZLogin::Login($user_id);
			Utility::Redirect( WEB_ROOT . '/index.php');
		}
	}	
}

include template('signupemail');

?>

