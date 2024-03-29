<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('modify', 'system/cache');
}

$system = Table::Fetch('system', 1);

if ($_POST) {
	unset($_POST['commit']);
	$INI = Config::MergeINI($INI, $_POST);
	if ( !save_config('php') ) {
		Session::Set('notice', 'Failed to save, '.SYS_PHPFILE.' is not writable');
	} else {
		unset($INI['db']);
		unset($INI['sn']);
		$value = Utility::ExtraEncode($INI);
		$table = new Table('system', array('value'=>$value));
		if ( $system ) $table->SetPK('id', 1);
		$flag = $table->update(array( 'value'));
		Session::Set('notice', 'Update information is done.');
	}
	Utility::Redirect( WEB_ROOT . '/manage/system/cache.php');	
}

include template('manage_system_cache');
