<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('modify', 'partner/edit');
}
$id = abs(intval($_GET['id']));

$partner = Table::Fetch('partner', $id);

if ( $_POST && $id==$_POST['id'] ) {
	$table = new Table('partner', $_POST);
	$table->SetStrip('location', 'other');
	$up_array = array(
			'username', 'title', 'bank_name', 'bank_user', 'bank_no',
			'location', 'other', 'homepage', 'contact', 'mobile', 'phone',
			);

	if ($table->password ) {
		$table->password = ZPartner::GenPassword($table->password);
		$up_array[] = 'password';
	}
	$flag = $table->update( $up_array );
	if ( $flag ) {
		Session::Set('notice', 'Change partner information done!');
		Utility::Redirect( WEB_ROOT . "/manage/partner/edit.php?id={$id}");
	}
	Session::Set('error', 'Change partner information failed!');
	$partner = $_POST;
}

include template('manage_partner_edit');
