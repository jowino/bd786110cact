<?php
/**
 * @author: shwdai@gmail.com
 */
class Cache
{

	private $mCache = null;
	private $gCache = array();
	static private $mInstance = null;

	static public function Instance()
	{
		if ( isset( self::$mInstance) )
			return self::$mInstance;

		return self::$mInstance = new Cache();
	}

	static private function _CreateCacheInstance()
	{
		$ini = Config::Instance('ini'); settype($ini['memcache'],'array');
		if(!class_exists('Memcache')) return new FalseCache();
		$cache_instance = new Memcache();
		foreach( $ini['memcache'] AS $one )
		{
			$server =  (string) $one;
			list($ip, $port, $weight) = explode(':', $server);
			$cache_instance->addServer( $ip
					,$port
					,true
					,$weight
					,1
					,15
					,true
					,array('Cache','FailureCallback')
					);
		}
		return $cache_instance;
	}

	private function __construct()
	{
		$this->mCache = self::_CreateCacheInstance();
	}

	static public function FailureCallback($ip, $port)
	{
		return;
	}

	function Get($key) 
	{
		if (is_array($key)) {
			$v = array();
			foreach($key as $k) {
				$vv = $this->Get($k);
				if ($vv) { 
					$v[$k] = $vv; 
				}
			}
			return $v;
		} else {
			if(isset($this->gCache[$key])) { 
				return $this->gCache[$key];
			}
			$v = $this->mCache->get($key);
			if ($v) { $this->gCache[$key] = $v; }
			return $v;
		}
	}


	function Add($key, $var, $flag=0, $expire=0) {
		@$this->mCache->add($key,$var,$flag,$expire);
		@$this->gCache[$key] = $var;
	}


	function Dec($key, $value=1)
	{
		return @$this->mCache->decrement($key, $value);
	}


	function Inc($key, $value=1)
	{
		return @$this->mCache->increment($key, $value);
	}

	function Replace($key, $var, $flag=0, $expire=0)
	{
		return @$this->mCache->replace($key, $var, $flag, $expire);
	}


	function Set($key, $var, $flag=0, $expire=0) {
		@$this->mCache->set($key, $var, $flag, $expire);
		$this->gCache[$key] = $var;
		return true;
	}

	function Del($key, $timeout=0) {
		if (is_array($key)) {
			foreach ($key as $k) { 
				@$this->mCache->delete($k, $timeout);
				if (isset($this->gCache[$k])) unset($this->gCache[$k]);
			}
		} else {
			@$this->mCache->delete($key, $timeout);
			if (isset($this->gCache[$key])) unset($this->gCache[$k]);
		}
		return true;
	}

	function Flush()
	{
		return @$this->mCache->flush();
	}

	static function GetFunctionKey($callback, $args=array())
	{
		$args = ksort($args);
		$patt = "/(=>)\s*'(\d+)'/";
		$args_string = var_export($args, true);
		$args_string = preg_replace($patt, "\\1\\2", $args_string);
		$key = "[FUNC]:$callback($args_string)";
		return self::GenKey( $key );
	}

	static function GetStringKey($str=null) {
		settype($str, 'array'); $str = var_export($str,true);
		$key = "[STR]:{$str}";
		return self::GenKey( $key );
	}

	static function GetObjectKey($tablename, $id)
	{
		$key = "[OBJ]:$tablename($id)";
		return self::GenKey( $key );
	}

	static function GenKey($key) {
		$hash = dirname(__FILE__);
		return md5( $hash . $key );
	}

	function SetObject($tablename, $one) {
		foreach($one AS $oone) {
			$k = $this->GetObjectKey($tablename, $oone['id']);
			$this->Set($k, $oone);
		}
		return true;
	}

	function GetObject($tablename, $id) {
		$single = is_array($one);
		settype($id, 'array');
		$k = array();
		foreach($id AS $oid) {
			$k[] = $this->GetObjectKey($tablename, $oid);
		}
		$r = Utility::AssColumn($this->Get($k), 'id');
		return $single ? array_pop($r) : $r;
	}

	function ClearObject($tablename, $id) {
		settype($id, 'array');
		foreach($id AS $oid) {
			$key = self::GetObjectKey($tablename, $oid);
			$this->Del($id);
		}
		return true;
	}
}
class FalseCache extends stdClass{public function __call($m, $v){}}
?>
