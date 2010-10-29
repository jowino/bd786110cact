<?php
require_once(dirname(__FILE__). '/include/application.php');

/* process currefer*/
$currefer = uencode(strval($_SERVER['REQUEST_URI']));

/* session,cache,configure register */
Session::Init();
$INI = ZSystem::GetINI();
$cache = Cache::Instance();
$AJAX = ('XMLHttpRequest' == @$_SERVER['HTTP_X_REQUESTED_WITH']);
if (false==$AJAX) { 
    header('Content-Type: text/html; charset=UTF-8;'); 
} else {
    header("Cache-Control: no-store, no-cache, must-revalidate");
}

/* biz logic */
$currency = $INI['system']['currency'];
$login_user_id = ZLogin::GetLoginId();
$login_user = Table::Fetch('user', $login_user_id);
if($login_user_id)
{
	$user_group=DB::GetDbRowById('user_group',$login_user['user_group_id']);
	$login_user['permission']=$user_group['permission'];
}
 $cities = Utility::OptionArray(Table::Fetch('category', array_keys($INI['hotcity']), 'ename'), 'id', 'name'); 
$city = cookie_city(null);
if($script_name==__FILE__){Utility::Redirect( WEB_ROOT . '/index.php');}
