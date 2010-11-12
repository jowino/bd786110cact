<?php
function mail_sign($user) {
	global $INI;
	if ( empty($user) ) return true;
	$from = $INI['mail']['from'];
	$to = $user['email'];

	$vars = array( 'user' => $user,);
	$message = render('mail_sign_verify', $vars);
	$subject = 'Your Moosavings registration';
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
	$mesasge = mb_convert_encoding($mesage,'UTF-8');
	$options = array(
		'contentType' => 'text/html',
		'encoding' => 'UTF-8',
	);
	$from = $INI['mail']['from'];
	$to = $subscribe['email'];
	$subject ="Today¡¯s amazing moosaving ¨C moove fast and grab it!";

	if ($INI['mail']['mail']=='mail') {
		Mailer::SendMail($from, $to, $subject, $message, $options);
	} else {
		Mailer::SmtpMail($from, $to, $subject, $message, $options);
	}
}

function mail_purchase($city, $team, $partner,$order, $subscribe) 
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
		'order'=>$order,
		'help_email' => $INI['subscribe']['helpemail'],
		'help_mobile' => $INI['subscribe']['helpphone'],
		'notice_email' => $INI['mail']['reply'],
	);
	$message = render('mail_order_info', $vars);
	$mesasge = mb_convert_encoding($message,'UTF-8');
	$options = array(
		'contentType' => 'text/html',
		'encoding' => 'UTF-8',
	);
	$from = $INI['mail']['from'];
	$to = $subscribe['email'];
	$subject = $INI['system']['sitename'] . ": Your Order Details";

	if ($INI['mail']['mail']=='mail') {
		Mailer::SendMail($from, $to, $subject, $message, $options);
	} else {
		Mailer::SmtpMail($from, $to, $subject, $message, $options);
	}
}

function mail_coupon( $team, $partner,$order, $user,$coupon) 
{
	global $INI;
	$week = array('S','M','T','W','T','F','S');
	$today = date('m.d.Y') . $week[date('w')];
	$vars = array(
		'today' => $today,
		'team' => $team,
		'city' => $city,
		'user' => $user,
		'partner' => $partner,
		'order'=>$order,
		'coupon'=>$coupon,
		'help_email' => $INI['subscribe']['helpemail'],
		'help_mobile' => $INI['subscribe']['helpphone'],
		'notice_email' => $INI['mail']['reply'],
	);
	$message = render('mail_coupon_info', $vars);
	$mesasge = mb_convert_encoding($mesage, 'GBK', 'UTF-8');
	$options = array(
		'contentType' => 'text/html',
		'encoding' => 'GBK',
	);
	$from = $INI['mail']['from'];
	$to = $user['email'];
	$subject = $INI['system']['sitename'] . ": Your Coupon Details";
	if($order['isgift']=='Y')
	{
		$gift=Table::Fetch('order_gift',$order['id'],'order_id');
		if($gift['delivery']=="email")
		{
			$to=$gift['email'];
			$subject="(Your gift from".$order['realname'].")".$subject;
		}
	}
	
	$content=createpdf(render('mail_coupon_pdf',$vars));
	if ($INI['mail']['mail']=='mail') {
		Mailer::SendMail($from, $to, $subject, $message, $options);
	} else {
		Mailer::SmtpMail($from, $to, $subject, $message, $options,null,$content);
	}
}

function  createpdf($content)
{
	$dir=realpath(dirname(dirname(dirname(__FILE__))));
	require_once ($dir.'/dompdf/dompdf_config.inc.php');
	//$newTemp=tempnam($dir.'/tmp/', 'coupon_');
	$dompdf=new DOMPDF();
	$dompdf->load_html($content);
	$dompdf->render();
	file_put_contents($newTemp,$dompdf->output());
	return $dompdf->output();
	//return $newTemp;
}

function mail_nottipped($team) 
{
	global $INI;
	$c = array(
			'team_id' => $team['id'],
		);
	$os = DB::LimitQuery('order', array(
		'condition' => $c,
			));
	foreach ($os as $order)
	{
		$user=Table::Fetch('user',$order['user_id']);
		$vars = array(
		'user' => $user,
	);
	$message = render('mail_order_nottipped', $vars);
	$mesasge = mb_convert_encoding($mesage,'UTF-8');
	$options = array(
		'contentType' => 'text/html',
		'encoding' => 'UTF-8',
	);
	$from = $INI['mail']['from'];
	$to = $user['email'];
	$subject = 'Information about your Moosavings deal';

	if ($INI['mail']['mail']=='mail') {
		Mailer::SendMail($from, $to, $subject, $message, $options);
	} else {
		Mailer::SmtpMail($from, $to, $subject, $message, $options);
	}
	}
}
function mail_tipped($team,$order,$user) 
{
	global $INI;
		$vars = array(
		'user' => $user,
		'team'=>$team,
		'order'=>$order,
	);
	$message = render('mail_order_tipped', $vars);
	$mesasge = mb_convert_encoding($mesage,'UTF-8');
	$options = array(
		'contentType' => 'text/html',
		'encoding' => 'UTF-8',
	);
	$from = $INI['mail']['from'];
	$to = $user['email'];
	$subject = 'Congratulations! Your Moosaving deal has tipped ';

	if ($INI['mail']['mail']=='mail') {
		Mailer::SendMail($from, $to, $subject, $message, $options);
	} else {
		Mailer::SmtpMail($from, $to, $subject, $message, $options);
	}
	
}
