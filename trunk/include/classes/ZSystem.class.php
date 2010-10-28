<?php
class ZSystem
{
	static public function GetINI() {
		$INI = Config::Instance('php');
		$SYS = Table::Fetch('system', 1);
		$SYS = Utility::ExtraDecode($SYS['value']);
		$INI = Config::MergeINI($INI, $SYS);
		return self::BuildINI($INI);
	}

	static private function BuildINI($ini) {
		$host = $_SERVER['HTTP_HOST'];
		$ini['system']['wwwprefix'] = "http://{$host}" . WEB_ROOT;
		$ini['system']['imgprefix'] = "http://{$host}" . WEB_ROOT;
		if(!$ini['system']['sitename']) {
			$ini['system']['sitename'] = 'Welcom to Great System Demo';
		}
		if(!$ini['system']['abbreviation']) {
			$ini['system']['abbreviation'] = 'Coupon';
		}
		if(!$ini['system']['couponname']) {
			$ini['system']['couponname'] = 'Coupon';
		}
		if(!$ini['system']['currency']) {
			$ini['system']['currency'] = '$';
		}
		return $ini;
	}
}
