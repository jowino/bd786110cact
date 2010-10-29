<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

if(!need_manager())
{
	need_permission('modify', 'system/page');
}
$pages = array(
	'help_tour' => 'Tour ' . $INI['system']['abbreviation'],
	'help_faqs' => 'FAQ',
	'help_zuitu' => 'What is ' . $INI['system']['abbreviation'],
	'help_api' => 'Develope API',
	'about_contact' => 'Contact',
	'about_us' => 'About ' . $INI['system']['abbreviation'],
	'about_job' => 'Job',
	'about_terms' => 'Terms&Conditions',
	'about_privacy' => 'Privacy',
);

$id = strval($_GET['id']);
$n = Table::Fetch('page', $id);

if ( $_POST ) {
	$table = new Table('page', $_POST);
	$table->SetStrip('value');
	if ( $n ) {
		$table->SetPk('id', $id);
		$table->update( array('id', 'value') );
	} else {
		$table->insert( array('id', 'value') );
	}
}

$value = $n['value'];
include template('manage_system_page');
