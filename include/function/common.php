<?php
/* import other */
import('current');
import('utility');
import('mailer');
import('sms');

function template($tFile) {
	return __template($tFile);
}

function render($tFile, $vs=array()) {
    ob_start();
    foreach($GLOBALS AS $_k=>$_v) {
        ${$_k} = $_v;
    }
	foreach($vs AS $_k=>$_v) {
		${$_k} = $_v;
	}
	include template($tFile);
    return ob_get_clean();
}

$lang_properties = array();
function I($key) { 
    global $lang_properties, $LC;
    if (!$lang_properties) {
        $ini = DIR_ROOT . '/i18n/' . $LC. '/properties.ini';
        $lang_properties = Config::Instance($ini);
    }
    return isset($lang_properties[$key]) ?
        $lang_properties[$key] : $key;
}

function json($data, $type='eval') {
    $type = strtolower($type);
    $allow = array('eval','alert','updater','dialog','mix', 'refresh');
    if (false==in_array($type, $allow))
        return false;
    Output::Json(array( 'data' => $data, 'type' => $type,));
}

function redirect($url=null) {
    header("Location: {$url}");
    exit;
}
function write_php_file($array, $filename=null){
	$v = "<?php\r\n\$INI = ";
	$v .= var_export($array, true);
	$v .=";\r\n?>";
	return file_put_contents($filename, $v);
}

function write_ini_file($array, $filename=null){   
	$ok = null;   
	if ($filename) {
		$s =  ";;;;;;;;;;;;;;;;;;\r\n";
		$s .= ";; SYS_INIFILE\r\n";
		$s .= ";;;;;;;;;;;;;;;;;;\r\n";
	}
	foreach($array as $k=>$v) {   
		if(is_array($v))   { 
			if($k != $ok) {   
				$s  .=  "\r\n[{$k}]\r\n";
				$ok = $k;   
			} 
			$s .= write_ini_file($v);
		}else   {   
			if(trim($v) != $v || strstr($v,"["))
				$v = "\"{$v}\"";   
			$s .=  "$k = \"{$v}\"\r\n";
		} 
	}

	if(!$filename) return $s;   
	return file_put_contents($filename, $s);
}   

function save_config($type='ini') {
	global $INI;
	$q = array(
			'db' => $INI['db'],
			'memcache' => $INI['memcache'], 
			);
	if ( strtoupper($type) == 'INI' ) {
		if (!is_writeable(SYS_INIFILE)) return false;
		return write_ini_file($q, SYS_INIFILE);
	} 
	if ( strtoupper($type) == 'PHP' ) {
		if (!is_writeable(SYS_PHPFILE)) return false;
		return write_php_file($q, SYS_PHPFILE);
	} 
	return false;
}

/* user relative */
function need_login($force=false) {
	if ( isset($_SESSION['user_id']) ) {
		return $_SESSION['user_id'];
	}
	if ( is_get() || $force ) {
		Session::Set('loginpage', $_SERVER['REQUEST_URI']);
	}
	return redirect(WEB_ROOT . '/account/login.php');	
}
function need_post() {
	return is_post() ? true : redirect(WEB_ROOT . '/index.php');
}
function need_manager() {
	return is_manager() ? true : false;//redirect( WEB_ROOT . '/account/login.php');
}
function need_partner() {
	return is_partner() ? true : redirect( WEB_ROOT . '/biz/login.php');
}

function need_auth($b=true, $a=true) {
	if ($b) return true;
	if ($a) json('no permission', 'alert');
	Session::Set('error', 'no permission');
	redirect( WEB_ROOT . '/account/login.php');
}

function is_manager() {
	global $login_user;
	return ($login_user['manager'] == 'Y');
}
function is_partner() {
	return ($_SESSION['partner_id']>0);
}
function is_customer(){
	global $user_group;
	if(isset($user_group))
	{
		if(!array_key_exists('name',$user_group)||strtolower($user_group['name'])=='customer')
		{
			return true;
		}
		return false;
	}
	else {
		return true;
	}
}

function is_newbie(){ return (cookieget('newbie')!='N'); }
function is_get() { return ! is_post(); }
function is_post() {
	return strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
}

function is_login() {
	return isset($_SESSION['user_id']);
}

function cookie_city($city) {
	if($city) { 
		$city_v = uencode("{$city['id']}|{$city['ename']}|{$city['name']}");
		$expire = time() + 365 * 86400;
		cookieset('city', $city_v);
	} else if (!cookieget('city')) {
		$city = get_city();
		if (!$city) return array();
		return cookie_city($city);
	} else {
		$v = explode('|', udecode(cookieget('city')));
		return array( 'id' => $v[0], 'ename' => $v[1], 'name' => $v[2],);
	}
	return $city;
}

function cookieset($k, $v, $expire=0) {
	if ($expire==0) {
		$expire = time() + 365 * 86400;
	} else {
		$expire += time();
	}
	setCookie($k, $v, $expire, '/');
}

function cookieget($k) {
	return strval($_COOKIE[$k]);
}

function moneyit($k) {
	return rtrim(rtrim(sprintf('%.2f',$k), '0'), '.');
}

function debug($v, $e=false) {
	global $login_user_id;
	if ($login_user_id==100000) {
		echo "<pre>";
		var_dump( $v);
		if($e) exit;
	}
}

function getparam($index=0, $default=0) {
	if (is_numeric($default)) {
		$v = abs(intval($_GET['param'][$index]));
	} else $v = strval($_GET['param'][$index]);
	return $v ? $v : $default;
}
function getpage() {
	$c = abs(intval($_GET['page']));
	return $c ? $c : 1;
}
function pagestring($count, $pagesize) {
	$p = new Pager($count, $pagesize, 'page');
	return array($pagesize, $p->offset, $p->genBasic());
}

function uencode($u) {
	return base64_encode(urlEncode($u));
}
function udecode($u) {
	return urlDecode(base64_decode($u));
}

/* share link */
/* facebook @Harry */
function share_facebook($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'u' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}",
				't' => $team['title'],
				);
	}
	else {
		$query = array(
				'u' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}",
				't' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}

	$query = http_build_query($query);
	return 'http://www.facebook.com/sharer.php?'.$query;
}

/* twitter @Harry */
function share_twitter($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'status' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}" . ' ' . $team['title'],
				);
	}
	else {
		$query = array(
				'status' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}" . ' ' . $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}

	$query = http_build_query($query);
	return 'http://twitter.com/?'.$query;
}



function share_renren($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'link' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}",
				'title' => $team['title'],
				);
	}
	else {
		$query = array(
				'link' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}",
				'title' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}

	$query = http_build_query($query);
	return 'http://share.renren.com/share/buttonshare.do?'.$query;
}

function share_kaixin($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'rurl' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}",
				'rtitle' => $team['title'],
				'rcontent' => strip_tags($team['summary']),
				);
	}
	else {
		$query = array(
				'rurl' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}",
				'rtitle' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				'rcontent' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}
	$query = http_build_query($query);
	return 'http://www.kaixin001.com/repaste/share.php?'.$query;
}

function share_douban($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'url' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}",
				'title' => $team['title'],
				);
	}
	else {
		$query = array(
				'url' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}",
				'title' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}
	$query = http_build_query($query);
	return 'http://www.douban.com/recommend/?'.$query;
}

function share_sina($team) {
	global $login_user_id;
	global $INI;
	if ($team)  {
		$query = array(
				'url' => $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}",
				'title' => $team['title'],
				);
	}
	else {
		$query = array(
				'url' => $INI['system']['wwwprefix'] . "/r.php?r={$login_user_id}",
				'title' => $INI['system']['sitename'] . '(' .$INI['system']['wwwprefix']. ')',
				);
	}
	$query = http_build_query($query);
	return 'http://v.t.sina.com.cn/share/share.php?'.$query;
}

function share_mail($team) {
	global $login_user_id;
	global $INI;
	if (!$team) {
		$team = array(
				'title' => $INI['system']['sitename'] . '(' . $INI['system']['wwwprefix'] . ')',
				);
	}
	$pre[] = "Got a good webiste - {$INI['system']['sitename']}, they organise a great team-buy deal everyday, worth to check!";
	if ( $team['id'] ) {
		$pre[] = "Today's Deal: {$team['title']}";
		$pre[] = "Your must interest: ";
		$pre[] = $INI['system']['wwwprefix'] . "/team.php?id={$team['id']}&r={$login_user_id}";
		$pre = mb_convert_encoding(join("\n\n", $pre), 'GBK', 'UTF-8');
		$sub = "Are you interested in: {$team['title']}";
	} else {
		$sub = $pre[] = $team['title'];
	}
	$sub = mb_convert_encoding($sub, 'GBK', 'UTF-8');
	$query = array( 'subject' => $sub, 'body' => $pre, );
	$query = http_build_query($query);
	return 'mailto:?'.$query;
}

function domainit($url) {
	preg_match('#//([^/]+)#', $url, $m);
	return $m[1];
}

// that the recursive feature on mkdir() is broken with PHP 5.0.4 for
function RecursiveMkdir($path) {
	if (!file_exists($path)) {
		RecursiveMkdir(dirname($path));
		@mkdir($path, 0777);
	}
}

function upload_image($inputname, $image=null, $type='team', $width=440) {
	$year = date('Y'); $day = date('md'); $n = time().rand(1000,9999).'.jpg';
	$z = $_FILES[$inputname];
	if ($z && strpos($z['type'], 'image')===0 && $z['error']==0) {
		if (!$image) { 
			RecursiveMkdir( IMG_ROOT . '/' . "{$type}/{$year}/{$day}" );
			$image = "{$type}/{$year}/{$day}/{$n}";
			$path = IMG_ROOT . '/' . $image;
		} else {
			RecursiveMkdir( dirname(IMG_ROOT .'/' .$image) );
			$path = IMG_ROOT . '/' .$image;
		}
		if ($type=='user') {
			Image::Convert($z['tmp_name'], $path, 48, 48, Image::MODE_CUT);
		} 
		else if($type=='team') {
			Image::Convert($z['tmp_name'], $path, $width,0,Image::MODE_SCALE);
		}
		else if($type=='charity'){
			Image::convert($z['tmp_name'],$path,0,0,Image::MODE_SCALE);
		}
		return $image;
	} 
	return $image;
}

function user_image($image=null) {
	global $INI;
	if (!$image) { 
		return $INI['system']['imgprefix'] . '/static/img/user-no-avatar.gif';
	}
	return $INI['system']['imgprefix'] . '/static/' .$image;
}

function team_image($image=null) {
	global $INI;
	if (!$image) return null;
	return $INI['system']['imgprefix'] . '/static/' .$image;
}

function userreview($content) {
	$line = preg_split("/[\n\r]+/", $content, -1, PREG_SPLIT_NO_EMPTY);
	$r = '<ul>';
	foreach($line AS $one) {
		$c = explode('|', htmlspecialchars($one));
		$c[2] = $c[2] ? $c[2] : '/';
		$r .= "<li>{$c[0]}<span>--<a href=\"{$c[2]}\" target=\"_blank\">{$c[1]}</a>";
		$r .= ($c[3] ? "({$c[3]})":'') . "</span></li>\n";
	}
	return $r.'</ul>';
}

function team_state(&$team) {
	if ($team['max_number']>0&&$team['now_number']>=$team['max_number']){
		if($team['close_time']==0) $team['close_time']=$team['end_time'];
		return $team['state'] = 'soldout';
	}
	else if ( $team['end_time'] <= time() ) {
		$team['close_time'] = $team['end_time'];
		if ( $team['now_number'] < $team['min_number'] )
		{
			$team['state'] = 'failure';
			$table = new Table('team', $team);
			$table->update(array( 'close_time', 'state',));
			return $team['state'] = 'failure';
		}
		return $team['state'] = 'success';
	}
	return $team['state'] = 'none';
}

function current_team($city_id=0) {
	$today = strtotime(date('Y-m-d'));
	$cond = array(
		'city_id' => $city_id,
		'state' => array('none', 'success', 'soldout'),
		"begin_time = {$today}",
		"end_time > {$today}",
	);
	$team = DB::LimitQuery('team', array(
		'condition' => $cond,
		'one' => true,
		'order' => 'ORDER BY begin_time DESC',
	));
	if (!$team) {
		$cond = array(
				'city_id' => $city_id, 
				'state' => array('none', 'success', 'soldout'),
				);
		$team = DB::LimitQuery('team', array(
					'condition' => $cond,
					'one' => true,
					'order' => 'ORDER BY begin_time DESC',
					));
	}
	return $team;
}

function state_explain($state='none', $error='false') {
	$state = strtolower($state);
	switch($state) {
		case 'none': return 'is tipped';
		case 'soldout': return 'is soldout';
		case 'failure': if($error) return 'This deal is failed';
		default: return 'is over';
	}
}

function get_zones($zone=null) {
	$zones = array(
		'city' => 'City',
		'group' => 'Deals category',
		'public' => 'Bulletin',
		'grade' => 'User grade',
	);
	if ( !$zone ) return $zones;
	if (!in_array($zone, array_keys($zones))) {
		$zone = 'city';
	}
	return array($zone, $zones[$zone]);
}

 function hasPermission($key, $value) {
 	global $login_user;
 	$permissions=unserialize($login_user['permission']);
    if (isset($permissions[$key])) {
	  	return in_array($value, $permissions[$key]);
	} else {
	  	return FALSE;
	}
  }
  
  function need_permission($action,$target) {
	return hasPermission($action, $target) ? true : redirect( '/manage/permission.php?action='.$action);
}
 function check_permission($action,$target) {
	return hasPermission($action, $target) ? true :false;
}
