<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');
if(!need_manager())
{
	need_permission('modify', 'charityedit');
}
if($_POST)
{
	$temp=$_POST;
	$temp['image'] = upload_image('upload_image', null, 'charity');
	$id = abs(intval($_REQUEST['id']));
	$charity = Table::Fetch('charity', $id);
	$table = new Table('charity', $temp);
	$table->letter = strtoupper($table->letter);
	$uarray = array( 'name', 'description', 'image'); 
	
	if (!$_POST['name']) {
		Session::Set('error', 'Can not leave blank for Name');
		Utility::Redirect(null);
	}
	
	if ( $charity ) {
		if ( $flag = $table->update( $uarray ) ) {
			Session::Set('notice', 'Edit charity done');
		} else {
			Session::Set('error', 'Edit charity failed');
		}
	} else {
		if ( $flag = $table->insert( $uarray ) ) {
			Session::Set('notice', 'Create new charity done');
		} else {
			Session::Set('error', 'Create new charity failed');
		}
	}
	
	Utility::Redirect(null);
}