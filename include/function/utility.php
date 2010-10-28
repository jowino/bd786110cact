<?php
function get_city($ip=null) {
	global $INI;
	$hotcity_keys = array_keys($INI['hotcity']);
	$cities = DB::LimitQuery('category', array( 
				'condition' => array(
					'zone' => 'city',
					),
				'cache'=>2592000,
				));
	$ip = ($ip) ? $ip : Utility::GetRemoteIP();
	$url = "http://open.baidu.com/ipsearch/s?wd={$ip}&tn=baiduip";
	$res = mb_convert_encoding(Utility::HttpRequest($url), 'UTF-8', 'GBK');
	$city = array();
	if ( preg_match('#来自：<b>(.+)</b>#Ui', $res, $m) ) {
		foreach( $cities AS $one ) {
			if ( FALSE !== strpos($m[1], $one['name']) ) {
				$city = $one;
				break;
			}
		}
	}
	if (!in_array($city['ename'], $hotcity_keys)) {
		return DB::LimitQuery('category', array(
			'condition' => array(
				'zone' => 'city',
				'ename' => $hotcity_keys[0],
			),
			'one' => true,
		));
	}
	return $city;
}
