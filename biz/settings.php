<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');

need_partner();
$partner_id = abs(intval($_SESSION['partner_id']));
$login_partner = $partner = Table::Fetch('partner', $partner_id);

if ( $_POST ) {
	$table = new Table('partner', $_POST);
	$table->SetStrip('location', 'other');
	$table->SetPk('id', $partner_id);
	$flag = $table->update(array(
		'title', 'bank_name', 'bank_user', 'bank_no',
		'location', 'other', 'homepage', 'contact', 'mobile', 'phone',
	));

	if ( $table->password == $table->password2 && $table->password ) {
		$update[] = 'password';
		$table->password = ZPartner::GenPassword($table->password);
	}

	if ( $flag ) {
		Session::Set('notice', 'Change partner information OK');
		Utility::Redirect( WEB_ROOT . "/biz/settings.php");
	}
	Session::Set('error', 'Change partner information failed');
	$partner = $_POST;
}

include template('biz_settings');
