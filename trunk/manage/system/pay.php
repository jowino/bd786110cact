<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('modify', 'system/pay');
}

$system = Table::Fetch('system', 1);

if ($_POST) {
	unset($_POST['commit']);
	$INI = Config::MergeINI($INI, $_POST);
	unset($INI['db']);
	unset($INI['sn']);

	$value = Utility::ExtraEncode($INI);
	$table = new Table('system', array('value'=>$value));
	if ( $system ) $table->SetPK('id', 1);
	$flag = $table->update(array( 'value'));

	Session::Set('notice', 'Update information done.');
	Utility::Redirect( WEB_ROOT . '/manage/system/pay.php');	
}

include template('manage_system_pay');
