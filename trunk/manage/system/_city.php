<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();

$system = Table::Fetch('system', 1);

if ($_POST) {
	unset($_POST['commit']);
	/* hot city convert */
	$cityname = preg_split('/[\s,]+/', $_POST['hotcity'], -1, PREG_SPLIT_NO_EMPTY);
	$hotcity = array();
	foreach( $cityname AS $one ) {
		$city = DB::LimitQuery('category', array(
					'condition' => array(
						'zone' => 'city',
						'name' => $one,
						),
					'one' => 'true',
					));
		if ( $city ) {
			$hotcity[$city['ename']] = $city['name'];
		}
	}
	if (!$hotcity) $hotcity = array('sg' => 'Singapore');

	/* merget */
	$_POST['hotcity'] = $hotcity;
	$INI = Config::MergeINI($INI, $_POST);
	unset($INI['db']);
	unset($INI['sn']);
	/* end */

	$value = Utility::ExtraEncode($INI);
	$table = new Table('system', array('value'=>$value));
	if ( $system ) $table->SetPK('id', 1);
	$flag = $table->update(array( 'value'));

	Session::Set('notice', 'Update information done.');
	Utility::Redirect( WEB_ROOT . '/manage/system/city.php');	
}

$hotcity = array_values($INI['hotcity']);
$hotcity = join(', ', $hotcity);
include template('manage_system_city');
