<?php
/* for rewrite or iis rewrite */
if (isset($_SERVER['HTTP_X_ORIGINAL_URL'])) {
	$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_ORIGINAL_URL'];
} else if (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
	$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
}
/* end */

error_reporting(E_ALL^E_WARNING^E_NOTICE);
define('SYS_VERSION', '0.92');
define('SYS_TIMESTART', microtime(true));
define('SYS_REQUEST', isset($_SERVER['REQUEST_URI']));
define('DIR_SEPERATOR', strstr(strtoupper(PHP_OS), 'WIN')?'\\':'/');
define('DIR_ROOT', str_replace('\\','/',dirname(__FILE__)));
define('DIR_LIBARAY', DIR_ROOT . '/library');
define('DIR_CLASSES', DIR_ROOT . '/classes');
define('DIR_COMPILED', DIR_ROOT . '/compiled');
define('DIR_TEMPLATE', DIR_ROOT . '/template');
define('DIR_FUNCTION', DIR_ROOT . '/function');
define('DIR_CONFIGURE', DIR_ROOT . '/configure');
define('SYS_PHPFILE', DIR_ROOT . '/configure/system.php');
define('WWW_ROOT', rtrim(dirname(DIR_ROOT),'/'));
define('IMG_ROOT', dirname(DIR_ROOT) . '/static');

$docroot = rtrim(str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']),'/');
$webroot = trim(substr(WWW_ROOT, strlen($docroot)), '\\/');
define('WEB_ROOT', $webroot ? "/{$webroot}" : '');
$ajax_root = $webroot ? "/{$webroot}" : '';

/* important function */
function __autoload($class_name) {
	$file_name = trim(str_replace('_','/',$class_name),'/').'.class.php';
	$file_path = DIR_LIBARAY. '/' . $file_name;
	if ( file_exists( $file_path ) ) {
		return require_once( $file_path );
	}
	$file_path = DIR_CLASSES. '/' . $file_name;
	if ( file_exists( $file_path ) ) {
		return require_once( $file_path );
	}
	return false;
}

function import($funcpre) {
	$file_path = DIR_FUNCTION. '/' . $funcpre . '.php'; 
	if (file_exists($file_path) ) {
		require_once( $file_path );
	}
}

/* json */
if (!function_exists('json_encode')){function json_encode($v) {return ZendJsonEncoder::encode($v);}}
if (!function_exists('json_decode')){function json_decode($v,$t) {return ZendJsonDecoder::decode($v,$t);}}

/* end json */

/* date_zone */
if(function_exists('date_default_timezone_set')) { date_default_timezone_set('Asia/Shanghai'); }
/* end date_zone */

/* ob_handler */
if(SYS_REQUEST){ ob_start(); }
/* end ob */

/* import */
import('template');
import('common');
//for debuging
function d($mParam, $bExit = 0, $bVarDump = 0)
{

    echo '<hr><pre>';
    ob_start();
    print get_back_trace("\n");
    if (!$bVarDump)
    {
        print_r($mParam);
    }
    else
    {
        var_dump($mParam);
    }
    $sStr = htmlspecialchars(ob_get_contents());
    ob_clean();
    echo $sStr;
    echo '</pre><hr>';
    if ($bExit) exit;
}
function get_back_trace($NL="\n"){
   $dbgTrace = debug_backtrace();
   $dbgMsg = "Trace[";
   foreach($dbgTrace as $dbgIndex => $dbgInfo) {
       if($dbgIndex>0 && isset($dbgInfo['file'])){
        $dbgMsg .= "\t at $dbgIndex  ".$dbgInfo['file']." (line {$dbgInfo['line']}) -> {$dbgInfo['function']}(".count($dbgInfo['args']).")$NL";
       }
   }
   $dbgMsg .= "]".$NL;
   return $dbgMsg;
}
