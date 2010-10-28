<?php
function current_frontend() {
	global $INI;
	$a = array(
			'/index.php' => 'Todays Deal',
			'/team/index.php' => 'Recent Deals',
			'/help/tour.php' => 'How ' . $INI['system']['abbreviation'] . ' Works',
			'/subscribe.php' => 'Subscribe',
			);
	$r = $_SERVER['REQUEST_URI'];
	if (preg_match('#/team#',$r)) $l = '/team/index.php';
	elseif (preg_match('#/help#',$r)) $l = '/help/tour.php';
	elseif (preg_match('#/subscribe#',$r)) $l = '/subscribe.php';
	else $l = '/index.php';
	return current_link($l, $a);
}

function current_backend() {
	global $INI;
	$a = array(
			'/manage/misc/index.php' => 'Home',
			'/manage/team/index.php' => 'Deal',
			'/manage/order/index.php' => 'Order',
			'/manage/coupon/index.php' => $INI['system']['couponname'],
			'/manage/user/index.php' => 'User',
			'/manage/partner/index.php' => 'Partner',
			'/manage/category/index.php' => 'Category',
			'/manage/system/index.php' => 'System',
			);
	$r = $_SERVER['REQUEST_URI'];
	if (preg_match('#/manage/team#',$r)) $l = '/manage/team/index.php';
	elseif (preg_match('#/manage/order#',$r)) $l = '/manage/order/index.php';
	elseif (preg_match('#/manage/coupon#',$r)) $l = '/manage/coupon/index.php';
	elseif (preg_match('#/manage/category#',$r)) $l = '/manage/category/index.php';
	elseif (preg_match('#/manage/partner#',$r)) $l = '/manage/partner/index.php';
	elseif (preg_match('#/manage/user#',$r)) $l = '/manage/user/index.php';
	elseif (preg_match('#/manage/system#',$r)) $l = '/manage/system/index.php';
	else $l = '/manage/misc/index.php';
	return current_link($l, $a);
}

function current_biz() {
	global $INI;
	$a = array(
			'/biz/index.php' => 'Home',
			'/biz/settings.php' => 'Partner',
			'/biz/coupon.php' => $INI['system']['couponname'] . 'List',
			);
	$r = $_SERVER['REQUEST_URI'];
	if (preg_match('#/biz/coupon#',$r)) $l = '/biz/coupon.php';
	elseif (preg_match('#/biz/settings#',$r)) $l = '/biz/settings.php';
	else $l = '/biz/index.php';
	return current_link($l, $a);
}


function current_city($cename, $citys) {
	$link = "/city.php?ename={$cename}";
	$links = array();
	foreach($citys AS $ename=>$name) {
		if ($ename==$cename) continue;
		$links["/city.php?ename={$ename}"] = $name;
	}
	return current_link($link, $links);
}

function current_coupon_sub($selector='index') {
	$selector = $selector ? $selector : 'index';
	$a = array(
		'/coupon/index.php' => 'not used',
		'/coupon/consume.php' => 'used',
		'/coupon/expire.php' => 'expired',
	);
	$l = "/coupon/{$selector}.php";
	return current_link($l, $a);
}

function current_account($selector='/account/settings.php') {
	global $INI;
	$a = array(
		'/order/index.php' => 'My Order',
		'/coupon/index.php' => 'My ' . $INI['system']['couponname'],
		'/credit/index.php' => 'Balance',
		'/account/settings.php' => 'Account Setting',
	);
	return current_link($selector, $a, true);
}

function current_about($selector='us') {
	global $INI;
	$a = array(
		'/about/us.php' => 'About ' . $INI['system']['abbreviation'],
		'/about/contact.php' => 'Contact',
		'/about/job.php' => 'Job Opportunity',
		'/about/privacy.php' => 'Privacy',
		'/about/terms.php' => 'Terms & Conditions',
	);
	$l = "/about/{$selector}.php";
	return current_link($l, $a, true);
}

function current_help($selector='faqs') {
	global $INI;
	$a = array(
		'/help/tour.php' => 'Tour ' . $INI['system']['abbreviation'],
		'/help/faqs.php' => 'FAQs',
		'/help/what.php' => 'What is ' . $INI['system']['abbreviation'],
		'/help/api.php' => 'API',
	);
	$l = "/help/{$selector}.php";
	return current_link($l, $a, true);
}

function current_order_index($selector='index') {
	$selector = $selector ? $selector : 'index';
	$a = array(
		'/order/index.php?s=index' => 'all',
		'/order/index.php?s=unpay' => 'unpaid',
		'/order/index.php?s=pay' => 'paid',
	);
	$l = "/order/index.php?s={$selector}";
	return current_link($l, $a);
}

function current_link($link, $links, $span=false) {
	$html = '';
	$span = $span ? '<span></span>' : '';
	foreach($links AS $l=>$n) {
		if (trim($l,'/')==trim($link,'/')) {
			$html .= "<li class=\"current\"><a href=\"{$l}\">{$n}</a>{$span}</li>";
		}
		else $html .= "<li><a href=\"{$l}\">{$n}</a>{$span}</li>";
	}
	return $html;
}

/* manage current */
function mcurrent_misc($selector=null) {
	$a = array(
		'/manage/misc/index.php' => 'Home',
		'/manage/misc/ask.php' => 'Q & A',
		'/manage/misc/feedback.php' => 'Feedback',
		'/manage/misc/subscribe.php' => 'Subscribe',
		'/manage/misc/invite.php' => 'Invite Rebate',
	);
	$l = "/manage/misc/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_order($selector=null) {
	$a = array(
		'/manage/order/index.php' => 'Current Order',
		'/manage/order/pay.php' => 'Paid Order',
		'/manage/order/unpay.php' => 'Unpaid Order',
	);
	$l = "/manage/order/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_user($selector=null) {
	$a = array(
		'/manage/user/index.php' => 'User List',
	);
	$l = "/manage/user/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_team($selector=null) {
	$a = array(
		'/manage/team/index.php' => 'Current Deal',
		'/manage/team/success.php' => 'Good Deal',
		'/manage/team/failure.php' => 'Failed Deal',
		'/manage/team/create.php' => 'New Deal',
	);
	$l = "/manage/team/{$selector}.php";
	return current_link($l,$a,true);
}

function mcurrent_feedback($selector=null) {
	$a = array(
		'/manage/feedback/index.php' => 'View all',
	);
	$l = "/manage/feedback/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_coupon($selector=null) {
	$a = array(
		'/manage/coupon/index.php' => 'Not used',
		'/manage/coupon/consume.php' => 'Used',
		'/manage/coupon/expire.php' => 'Expired',
	);
	$l = "/manage/coupon/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_category($selector=null) {
	$zones = get_zones();
	$a = array();
	foreach( $zones AS $z=>$o ) {
		$a['/manage/category/index.php?zone='.$z] = $o;
	}
	$l = "/manage/category/index.php?zone={$selector}";
	return current_link($l,$a,true);
}
function mcurrent_partner($selector=null) {
	$a = array(
		'/manage/partner/index.php' => 'Partner List',
		'/manage/partner/create.php' => 'New Partner',
	);
	$l = "/manage/partner/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_system($selector=null) {
	$a = array(
		'/manage/system/index.php' => 'Basic',
		'/manage/system/bulletin.php' => 'Announce',
		'/manage/system/pay.php' => 'Payment',
		'/manage/system/email.php' => 'Email',
		'/manage/system/sms.php' => 'SMS',
		'/manage/system/city.php' => 'City',
		'/manage/system/page.php' => 'Page',
		'/manage/system/cache.php' => 'Cache',
		'/manage/system/template.php' => 'Template',
	);
	$l = "/manage/system/{$selector}.php";
	return current_link($l,$a,true);
}
