<?php
/**
 * @author: shwdai@gmail.com
 */
class Session
{
	static private $_begin = 0;
	static private $_instance = null;
	static private $_debug = false;

	static public function Init($debug=false)
	{
		self::$_instance = new Session();
		self::$_debug = $debug;
		session_start();
	}

	static public function Set($name, $v) 
	{
		$_SESSION[$name] = $v;
	}

	static public function Get($name, $once=false)
	{
		$v = null;
		if ( isset($_SESSION[$name]) )
		{
			$v = $_SESSION[$name];
			if ( $once ) unset( $_SESSION[$name] );
		}
		return $v;
	}

	function __construct()
	{
		self::$_begin = microtime(true);
	}

	function __destruct()
	{
		global $AJAX, $INI;
		if (self::$_debug&&!$AJAX) { echo 'Generation Cost: '.(microtime(true)-self::$_begin).'s'; }
		$c = ob_get_clean();
		$c = preg_replace('#href="/#i', 'href="'.WEB_ROOT.'/', $c);
		$c = preg_replace('#src="/#i', 'src="'.WEB_ROOT.'/', $c);
		$c = preg_replace('#action="/#i', 'action="'.WEB_ROOT.'/', $c);

		/* theme */
		if($INI['system']['theme'] && file_exists( DIR_ROOT . '/static/theme/'.$INI['system']['theme'])){ 
			$c = preg_replace('#/static/css/#', "/static/theme/{$INI['system']['theme']}/css/", $c);
			$c = preg_replace('#/static/img/#', "/static/theme/{$INI['system']['theme']}/img/", $c);
		}
		/* end theme */
		
		$this->__out($c);
	}

	function __out($data) {
		$HTTP_ACCEPT_ENCODING = $_SERVER["HTTP_ACCEPT_ENCODING"]; 
		if( strpos($HTTP_ACCEPT_ENCODING, 'x-gzip') !== false ) 
			$encoding = 'x-gzip'; 
		else if( strpos($HTTP_ACCEPT_ENCODING,'gzip') !== false ) 
			$encoding = 'gzip'; 
		else $encoding == false;
		if (function_exists('gzencode')&&$encoding) {
			$data = gzencode($data, 9);
			header("Content-Encoding: {$encoding}"); 
		}
		$length = strlen($data);
		header("Content-Length: {$length}");
		die($data);
	}
}
?>
