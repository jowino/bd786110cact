<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager(true))
{
	need_permission('modify', 'team/create');
}

if ($_POST) {
	$team = $_POST;
	$insert = array(
		'title', 'market_price', 'team_price', 'end_time', 'begin_time', 'expire_time', 'min_number', 'max_number', 'summary', 'notice',
		'product', 'image', 'detail', 'userreview', 'systemreview', 'image1', 'image2', 'flv',
		'mobile', 'address', 'fare', 'express', 'delivery', 'credit',
		'user_id', 'state', 'city_id', 'group_id', 'partner_id',
		);
	$team['user_id'] = $login_user_id;
	$team['state'] = 'none';
	$team['begin_time'] = strtotime($team['begin_time']);
	$team['end_time'] = strtotime($team['end_time']);
	$team['expire_time'] = strtotime($team['expire_time']);
	$team['image'] = upload_image('upload_image', null, 'team');
	$team['image1'] = upload_image('upload_image1', null, 'team',380);
	$team['image2'] = upload_image('upload_image2', null, 'team',380);
	$table = new Table('team', $team);
	$table->SetStrip('summary', 'detail', 'systemreview', 'notice');
	if ( $team_id = $table->insert($insert) ) {
		if($team['charity_id']!=0)
		{
			$dealcharity['charity_id']=$team['charity_id'];
			$dealcharity['value']=str_replace('%', '',$team['value']);
			$dealcharity['deal_id']=$team_id;
			$dcTable=new Table('deals_charity',$dealcharity);
			$dealinsert=array('charity_id','value','deal_id',);
			$dcTable->insert($dealinsert);
		}
		Utility::Redirect( WEB_ROOT . "/manage/team/index.php");
	}
}
else {
	$profile = Table::Fetch('leader', $login_user_id, 'user_id');
	//1
	$team = array();
	$team['user_id'] = $login_user_id;
	$team['begin_time'] = strtotime('+1 days');
	$team['end_time'] = strtotime('+2 days'); 
	$team['expire_time'] = strtotime('+3 months +1 days');
	$team['min_number'] = 10;
	$team['per_number'] = 1;
	$team['market_price'] = 1;
	$team['team_price'] = 1;
	//3
	$team['delivery'] = 'coupon';
	$team['address'] = $profile['address'];
	$team['mobile'] = $profile['mobile'];
	$team['fare'] = 5;
}

$groups = DB::LimitQuery('category', array(
			'condition' => array( 'zone' => 'group', ),
			));
$groups = Utility::OptionArray($groups, 'id', 'name');

$cities = DB::LimitQuery('category', array(
			'condition' => array( 'zone' => 'city', ),
			));
$cities = Utility::OptionArray($cities, 'id', 'name');

$partners = DB::LimitQuery('partner', array(
			'order' => 'ORDER BY id DESC',
			));
$partners = Utility::OptionArray($partners, 'id', 'title');
$charities = DB::LimitQuery('charity',array(
			  'order'=>'ORDER BY id DESC',
				));
$charities = Utility::OptionArray($charities,'id','name');
array_unshift($charities,"--Select--");
include template('manage_team_create');
