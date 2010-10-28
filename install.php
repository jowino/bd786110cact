<?php
require_once( dirname(__FILE__) . '/include/application.php');
Session::Init();
$action = strval($_GET['action']);

if (is_get() ) {
	$db = array(
		'host' => 'localhost',
		'user' => 'root',
		'pass' => '',
		'name' => 'my_db',
	);
	die(include template('install_step'));
}
$db = $_POST['db'];
$m = mysql_connect($db['host'], $db['user'], $db['pass']);

if (!is_writable('include/configure') ) {
	Session::Set('error', 'include/configure/ write forbidden');
	Utility::Redirect('install.php');
}

if (!is_writable('include/data/') ) {
	Session::Set('error', 'include/data/ Write Forbidden');
	Utility::Redirect('install.php');
}

if (!is_writable('static/team/') ) {
	Session::Set('error', 'static/team/ Write Forbidden');
	Utility::Redirect('install.php');
}

if (!is_writable('static/user/') ) {
	Session::Set('error', 'static/user/ Write Forbidden');
	Utility::Redirect('install.php');
}

if ( !$m ) {
	Session::Set('error', 'Database setting is not correct');
	Utility::Redirect('install.php');
}

if ( !mysql_select_db($db['name'], $m) 
		&& !mysql_query("CREATE database `{$db['name']}`;", $m) ) {
	Session::Set('error', "Choose Database {$db['name']} Error, is it available?");
	Utility::Redirect('install.php');
}
mysql_select_db($db['name'], $m);

$dir = dirname(__FILE__);
$sql = '';
$f = file('./include/configure/db.sql');
foreach($f AS $l) {
	if ( strpos(trim($l), '--')===0 || strpos(trim($l), '/*') === 0 || !trim($l)) {
		continue;
	}
	$sql .= $l;
}

mysql_query("SET names UTF8;");
$sqls = explode(';', $sql);

foreach($sqls AS $sql) {
	mysql_query($sql, $m);
}

$PHP = array(
	'db' => $db,
);
if ( write_php_file($PHP, SYS_PHPFILE) ) {
	Session::Set('notice', 'Installation is done, for security reason please delete install.php!');
}
Utility::Redirect('index.php');
