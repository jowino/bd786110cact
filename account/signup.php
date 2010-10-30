<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

if ( $_POST ) {
	$u = array();
	$u['username'] = $_POST['username'];
	$u['password'] = $_POST['password'];
	$u['email'] = $_POST['email'];
	if ( $_POST['subscribe'] ) { 
		ZSubscribe::Create($_POST['email'], $city['id']); 
	}
	if ( ! Utility::ValidEmail($_POST['email'], true) ) {
		Session::Set('error', 'Email is not a valid email address');
		Utility::Redirect( WEB_ROOT . '/account/signup.php');
	}
	if ($_POST['password2']==$_POST['password'] && $_POST['password']) {
		if ( $INI['system']['emailverify'] ) { 
			$u['enable'] = 'N'; 
		}
		$usergroup=Table::Fetch('user_group','customer','name');
		if (!empty($usergroup)){
			$u['user_group_id']=$usergroup['id'];
		}
		if ( $user_id = ZUser::Create($u) ) {
			if ( $INI['system']['emailverify'] ) {
				mail_sign_id($user_id);
				Session::Set('unemail', $_POST['email']);
				Utility::Redirect( WEB_ROOT . '/account/verify.php');
			} else {
				ZLogin::Login($user_id);
				Utility::Redirect( WEB_ROOT . '/index.php');
			}
		} else {
			$au = Table::Fetch('user', $_POST['email'], 'email');
			if ( $au ) {
				Session::Set('error', 'Failed, Email has registerred ');
			} else {
				Session::Set('error', 'Failed, username has  been taken');
			}
		}
	} else {
		Session::Set('error', 'Register failed, check your password please');
	}
}

include template('account_signup');
