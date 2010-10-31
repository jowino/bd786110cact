<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager(true))
{
	need_permission('modify', 'team/edit');
}
$id = abs(intval($_GET['id']));
if (!$id || !$team = Table::Fetch('team', $id)) {
	Utility::Redirect( WEB_ROOT . '/team/create.php');
}

if ($_POST) {
	$insert = array(
		'title', 'market_price', 'team_price', 'end_time', 'begin_time', 'expire_time', 'min_number', 'max_number', 'summary', 'notice', 'per_number',
		'product', 'image',  'detail', 'userreview', 'systemreview', 'image1', 'image2', 'flv',
		'delivery', 'mobile', 'address', 'fare', 'express', 'credit',
		'user_id', 'city_id', 'group_id', 'partner_id',
		);
	$table = new Table('team', $_POST);
	$table->SetStrip('summary', 'detail', 'systemreview', 'notice');
	$table->begin_time = strtotime($_POST['begin_time']);
	$table->end_time = strtotime($_POST['end_time']);
	$table->expire_time = strtotime($_POST['expire_time']);
	$table->image = upload_image('upload_image', $team['image'], 'team');
	$table->image1 = upload_image('upload_image1',$team['image1'],'team',380);
	$table->image2 = upload_image('upload_image2',$team['image2'],'team',380);

	$error_tip = array();
	if ( !$error_tip)  {
		if ( $table->update($insert) ) {
		if($_POST['charity_id']!=0)
		{
			if($_POST['deal_charity_id']!="")
				$dealcharity['id']=$_POST['deal_charity_id'];
			$dealcharity['charity_id']=$_POST['charity_id'];
			$dealcharity['value']=str_replace('%', '',$_POST['charityvalue']);
			$dealcharity['deal_id']=$_POST['id'];
			$dcTable=new Table('deals_charity',$dealcharity);
			$dealinsert=array('charity_id','value','deal_id',);
			$dcTable->update($dealinsert);
		}
			//Utility::Redirect( WEB_ROOT. "/manage/team/edit.php?id={$team['id']}");
		} else {
			Session::Set('error', 'Modify team information failed, check your system setting please.');
		}
	}
}
$charity=Table::Fetch('deals_charity',$id,'deal_id');
if($charity)
{
	$charityvalue=$charity['value'].'%';
}
$groups = DB::LimitQuery('category', array(
			'condition' => array( 'zone' => 'group', ),
			));
$groups = Utility::OptionArray($groups, 'id', 'name');

$partners = DB::LimitQuery('partner', array(
			'order' => 'ORDER BY id DESC',
			));
$partners = Utility::OptionArray($partners, 'id', 'title');
$charities = DB::LimitQuery('charity',array(
			  'order'=>'ORDER BY id DESC',
				));
$charities = Utility::OptionArray($charities,'id','name');
array_unshift($charities,"--Select--");
include template('manage_team_edit');
