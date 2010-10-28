<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
$id = abs(intval($_REQUEST['id']));
$category = Table::Fetch('category', $id);
$table = new Table('category', $_POST);
$table->letter = strtoupper($table->letter);
$uarray = array( 'zone', 'ename', 'letter', 'name', 'czone'); 

if (!$_POST['name'] || !$_POST['ename'] || !$_POST['letter']) {
	Session::Set('error', 'Can not leave blank for Full Name, Short Name and First Letter');
	Utility::Redirect(null);
}

if ( $category ) {
	if ( $flag = $table->update( $uarray ) ) {
		Session::Set('notice', 'Edit category done');
	} else {
		Session::Set('error', 'Edit category failed');
	}
} else {
	if ( $flag = $table->insert( $uarray ) ) {
		Session::Set('notice', 'Create new category done');
	} else {
		Session::Set('error', 'Create new cagegory failed');
	}
}

Utility::Redirect(null);
