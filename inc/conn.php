<?php
@session_start();
@header('Content-Type:text/html;Charset=utf-8');
@date_default_timezone_set('Etc/GMT-8');

define('MAC_ROOT', substr(__FILE__, 0, -13));
require(MAC_ROOT.'/inc/config/config.php');
require(MAC_ROOT.'/inc/config/cache.php');
require(MAC_ROOT.'/inc/common/class.php');
require(MAC_ROOT.'/inc/common/function.php');
require(MAC_ROOT.'/inc/common/template.php');
require(MAC_ROOT."/inc/common/template_diy.php");

@ini_set('display_errors','On');
@error_reporting(7);
@set_error_handler('my_error_handler');
@ob_start();

define('MAC_STARTTIME',execTime());
define('MAC_URL','http://www.maccms.com/');
define('MAC_NAME','Æ»¹ûCMS');
define('MAC_PATH', $MAC['site']['installdir']);

$TMP_ISWAP = 0;
$TMP_TEMPLATEDIR = $MAC['site']['templatedir'];
$TMP_HTMLDIR = $MAC['site']['htmldir'];

if($MAC['site']['mobstatus']==1){
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|meizu|cldc|midp|iphone|wap|mobile|android)/i";
	if ((preg_match($uachar, $ua))) {
		
        $TMP_ISWAP = 1;
        $TMP_TEMPLATEDIR = $MAC['site']['mobtemplatedir'];
        $TMP_HTMLDIR = $MAC['site']['mobhtmldir'];
	}
}

define('MAC_MOB', $TMP_ISWAP);
define('MAC_ROOT_TEMPLATE', MAC_ROOT.'/template/'.$TMP_TEMPLATEDIR.'/'. $TMP_HTMLDIR .'/');
define('MAC_PATH_TEMPLATE', MAC_PATH.'template/'.$TMP_TEMPLATEDIR.'/');
define('MAC_PATH_TPL', MAC_PATH_TEMPLATE. $TMP_HTMLDIR  .'/');
define('MAC_PATH_ADS', MAC_PATH_TEMPLATE.$MAC['site']['adsdir'] .'/');
?>