<?php
function mail_sign($user) {
	global $INI;
	if ( empty($user) ) return true;
	$from = $INI['mail']['from'];
	$to = $user['email'];

	$vars = array( 'user' => $user,);
	$message = render('mail_sign_verify', $vars);
	$subject = 'Thank you for your '.$INI['system']['sitename'].', please verify this Email';
	$options = array(
		'contentType' => 'text/plain',
	);
	if ($INI['mail']['mail']=='mail') {
		Mailer::SendMail($from, $to, $subject, $message, $options);
	} else {
		Mailer::SmtpMail($from, $to, $subject, $message, $options);
	}
}

function mail_sign_id($id) {
	$user = Table::Fetch('user', $id);
	mail_sign($user);
}

function mail_sign_email($email) {
	$user = Table::Fetch('user', $email, 'email');
	mail_sign($user);
}

function mail_repass($user) {
	global $INI;
	if ( empty($user) ) return true;
	$from = $INI['mail']['from'];
	$to = $user['email'];

	$vars = array( 'user' => $user,);
	$message = render('mail_repass', $vars);
	$subject = $INI['system']['sitename'] . ' Reset Password';
	$options = array(
		'contentType' => 'text/plain',
	);
	if ($INI['mail']['mail']=='mail') {
		Mailer::SendMail($from, $to, $subject, $message, $options);
	} else {
		Mailer::SmtpMail($from, $to, $subject, $message, $options);
	}
}

function mail_subscribe($city, $team, $partner, $subscribe) 
{
	global $INI;
	$week = array('S','M','T','W','T','F','S');
	$today = date('m.d.Y') . $week[date('w')];
	$vars = array(
		'today' => $today,
		'team' => $team,
		'city' => $city,
		'subscribe' => $subscribe,
		'partner' => $partner,
		'help_email' => $INI['subscribe']['helpemail'],
		'help_mobile' => $INI['subscribe']['helpphone'],
		'notice_email' => $INI['mail']['reply'],
	);
	$message = render('mail_subscribe_team', $vars);
	$mesasge = mb_convert_encoding($mesage, 'GBK', 'UTF-8');
	$options = array(
		'contentType' => 'text/html',
		'encoding' => 'GBK',
	);
	$from = $INI['mail']['from'];
	$to = $subscribe['email'];
	$subject = $INI['system']['sitename'] . "Today's Deal: {$team['title']}";

	if ($INI['mail']['mail']=='mail') {
		Mailer::SendMail($from, $to, $subject, $message, $options);
	} else {
		Mailer::SmtpMail($from, $to, $subject, $message, $options);
	}
}
