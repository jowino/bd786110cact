<?php
require_once(dirname(__FILE__) . '/app.php');

$path = trim($_SERVER['REQUEST_URI'],'/');
$path = preg_replace('#^(static\/\d+/)#', 'static/', $path);
preg_match('#\.(\w+)$#', $path, $m);
if(!file_exists($path)){header('HTTP/1.0 404 Not Found');die(0);}

$mtime = filemtime($path);
if ( date(DATE_RFC822, $mtime) == @$_SERVER['HTTP_IF_MODIFIED_SINCE']) { 
	header('HTTP/1.1 304 Not Modified'); exit; 
}

$suffix = strtolower($m[1]);
switch($suffix){
	case 'gif': case 'jpeg': case 'jpg': case 'png': case 'ico':
	Header("Content-Type: image/{$suffix};");break;
	case 'js': 
	Header("Content-Type: text/javascript;");break;
	case 'css':
	Header("Content-Type: text/css;");break;
}

header('Content-Length: '.filesize($path));
header('Last-Modified: '.date(DATE_RFC822, filemtime($path)));
header('Expires: '.date(DATE_RFC822, time()+3600*24*365*10));
header('Pragma: public');
header('Cache-Control: max-age=604800');

$fp = fopen($path, 'r');
while($data=fread($fp, 4096)){echo $data;}
fclose($fp);
die(0);
