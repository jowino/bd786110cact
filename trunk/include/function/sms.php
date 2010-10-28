<?php
function sms_send($phone, $content) {
	global $INI;
	$content = mb_substr($content, 0, 70, 'UTF-8');
	if (mb_strlen($content) < 20) {
		return;
	}
	/*
	$user = $INI['sms']['user']; $pass = strtolower(md5($INI['sms']['pass']));
	$content = urlEncode($content);
	$api = "http://notice.zuitu.com/sms?user={$user}&pass={$pass}&phones={$phone}&content={$content}";
	$res = Utility::HttpRequest($api);
	return trim(strval($res))==='0' ? true : strval($res);
	*/
	/* not support yet */
	return;
}
?>
