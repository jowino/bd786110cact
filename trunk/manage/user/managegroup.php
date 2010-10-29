<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('modify', 'user/managegroup');
}
$id = abs(intval($_GET['id']));
if(isset($_GET['id'])&&!$_POST)
{	
	$group = Table::Fetch('user_group', $id);
	$title='Edit User Group';
	$userpermission=unserialize($group['permission']);
	if(isset($userpermission['access']))
	{
		$access=$userpermission['access'];
	}
	else {
		$assess=array();
	}
	if(isset($userpermission['modify']))
	{
		$modify=$userpermission['modify'];
	}
	else {
		$modify=array();
	}
}
$accessignore = array(
			'category/edit',
			'misc/askedit',
			'misc/askremove',
			'partner/create',
			'partner/edit',
			'system/bulletin',
			'system/cache',
			'system/city',
			'system/email',
			'system/index',
			'system/page',
			'system/pay',
			'system/sms',
			'system/template',
			'team/remove',
			'team/create',
			'team/edit',
			'user/managegroup',
			'user/edit'
		);
$modifyignore = array(
			'category/index',
			'coupon/consume',
			'coupon/expire',
			'coupon/index',
			'misc/ask',
			'misc/feedback',
			'misc/index',
			'misc/invite',
			'misc/subscribe',
			'order/index',
			'order/pay',
			'order/unpay',
			'partner/index',
			'system/_city',
			'team/failure',
			'team/index',
			'team/success',
			'team/down',
			'user/index',
			'user/usergroup'
		);
				
	$accesspermissions = array();
	$modifypermissions = array();
		
	$files = glob($_SERVER["DOCUMENT_ROOT"] . '/manage/*/*.php');
		
	foreach ($files as $file) {
		$data = explode('/', dirname($file));
		
		$permission = end($data) . '/' . basename($file, '.php');
			
		if (!in_array($permission, $accessignore)) {
			$accesspermissions[] = $permission;
		}
	if (!in_array($permission, $modifyignore)) {
			$modifypermissions[] = $permission;
		}
	}
		$modifypermissions[]='categoryedit';
		$modifypermissions[]='categoryremove';
		$modifypermissions[]='charityedit';
		$modifypermissions[]='charityremove';
		$modifypermissions[]='groupremove';
		$modifypermissions[]='inviteok';
		$modifypermissions[]='inviteremove';
		$modifypermissions[]='noticesubscribe';
		$modifypermissions[]='ordercash';
		$modifypermissions[]='orderview';
		$modifypermissions[]='partnerremove';
		$modifypermissions[]='teamdetail';
		$modifypermissions[]='teamremove';
		$modifypermissions[]='teamrefund';
		$modifypermissions[]='userview';
		$modifypermissions[]='subscriberemove';
		$modifypermissions[]='usermoney';
												
		
if ( $_POST ) {
	$table = new Table('user_group', $_POST);
	$table->SetStrip('location', 'other');
	$groupArray=array(
		'name',
		'permission',);
	$table->permission=serialize($_POST['permission']);
		if($id==$_POST['id'])
		{
			$table->Update($groupArray);
		}
		else {
			$table->insert($groupArray);
		}
	Utility::Redirect( WEB_ROOT . '/manage/user/usergroup.php');
}
include template('manage_user_managegroup');