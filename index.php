<?php
/*
 *『源码』网销旗航商城
 * 官方网站  wxqhsc.cn
 * @version    3.0
 * @since      1.0
 * QQ          813396838
 * 永久售后更新程序：shop108096921.taobao.com
 */ 
	if(!file_exists('inc/qq813396838.lock')) { echo '<script>location.href=\'install.php\';</script>';exit; }
	define('MAC_MODULE','home');
	require('inc/conn.php');
	require(MAC_ROOT.'/inc/common/360_safe3.php');
    $m = be('get','m');
    if(strpos($m,'.')){ $m = substr($m,0,strpos($m,'.')); }
    $par = explode('-',$m);
    $parlen = count($par);
    $ac = $par[0];
    
    if(empty($ac)){ $ac='vod'; $method='index'; }
    
    $colnum = array('id','pg','year','typeid','class','classid','src','num','aid','vid');
    if($parlen>=2){
    	$method = $par[1];
    	 for($i=2;$i<$parlen;$i+=2){
            $tpl->P[trim($par[$i])] = in_array($par[$i],$colnum) ? intval($par[$i+1]) : chkSql(urldecode(trim($par[$i+1])));
        }
    }
    if($tpl->P['pg']<1){ $tpl->P['pg']=1; }
    if(!empty($tpl->P['cp'])){ $tpl->P['cp']=''; }
    unset($colnum);
    $tpl->initData();
    $acs = array('vod','art','map','user','gbook','comment','label');
    if(in_array($ac,$acs)){
    	$tpl->P['module'] = $ac;
    	include MAC_ROOT.'/inc/module/'.$ac.'.php';
    }
    else{
    	showErr('System','未找到指定系统模块');
    }
    unset($par);
    unset($acs);
    $tpl->ifex();
    if(!empty($tpl->P['cp'])){ setPageCache($tpl->P['cp'],$tpl->P['cn'],$tpl->H); }
	$tpl->run();
	echo $tpl->H;
?>