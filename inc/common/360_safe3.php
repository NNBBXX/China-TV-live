<?php
function arr_foreach($arr)
{
	static $str;
	if (!is_array($arr)) { return $arr;	}
	foreach ($arr as $key => $val ) {
		if (is_array($val)) { arr_foreach($val); } else { $str[] = $val; }
	}
	return implode($str);
}

function StopAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq)
{
	$errmsg = "<div style=\"position:fixed;top:0px;width:100%;height:100%;background-color:white;color:green;font-weight:bold;border-bottom:5px solid #999;\"><br>您的提交带有不合法参数,谢谢合作!<br>操作IP: ".$_SERVER["REMOTE_ADDR"]."<br>操作时间: ".strftime("%Y-%m-%d %H:%M:%S")."<br>操作页面:".$_SERVER["PHP_SELF"]."<br>提交方式: ".$_SERVER["REQUEST_METHOD"]."</div>";
	$StrFiltValue=arr_foreach($StrFiltValue);
	$StrFiltValue=urldecode($StrFiltValue);
	
	if(preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1){
		print $errmsg;
		exit();
	}
	if(preg_match("/".$ArrFiltReq."/is",$StrFiltKey)==1){
		print $errmsg;
		exit();
	}
}
function chkSql($s)
{
	global $getfilter;
	if(empty($s)){
		return "";
	}
	$d=$s;
	while(true){
		$s = urldecode($d);
		if($s==$d){
			break;
		}
		$d = $s;
	}
	StopAttack(1,$s,$getfilter);
	return htmlEncode($s);
}
function slog($logs)
{
	$ymd = date('Y-m-d-H');
	$now = date('Y-m-d H:i:s');
	$toppath = MAC_ROOT ."/log/$ymd.txt";
	$ts = @fopen($toppath,"a+");
	@fputs($ts, $now .' '. $logs ."\r\n");
	@fclose($ts);
}

$referer=empty($_SERVER['HTTP_REFERER']) ? array() : array($_SERVER['HTTP_REFERER']);

//get拦截规则
$getfilter = "\\<.+javascript:window\\[.{1}\\\\x|<.*=(&#\\d+?;?)+?>|<.*(data|src)=data:text\\/html.*>|\\b(alert\\(|be\\(|eval\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\(.*\)|sleep\s*?\(.*\)|load_file\s*?\\()|<[a-z]+?\\b[^>]*?\\bon([a-z]{4,})\s*?=|^\\+\\/v(8|9)|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT(\\(.+\\)|\\s+?.+?)|UPDATE(\\(.+\\)|\\s+?.+?)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?)FROM(\\(.+\\)|\\s+?.+?)|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)|UNION([\s\S]*?)SELECT|_get|_post|_request|_cookie|eval|assert|base64_decode|file_get_contents|pack|gzuncompress|preg_replace|\\{if|:php";
//post拦截规则
$postfilter = "<.*=(&#\\d+?;?)+?>|<.*data=data:text\\/html.*>|\\b(alert\\(|be\\(|eval\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\(.*\)|sleep\s*?\(.*\)|load_file\s*?\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover|eval)\\b|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT(\\(.+\\)|\\s+?.+?)|UPDATE(\\(.+\\)|\\s+?.+?)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?)FROM(\\(.+\\)|\\s+?.+?)|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)|UNION([\s\S]*?)SELECT|_get|_post|_request|_cookie|eval|assert|base64_decode|file_get_contents|pack|gzuncompress|preg_replace|\\{if|:php";
//cookie拦截规则
$cookiefilter = "benchmark\s*?\(.*\)|sleep\s*?\(.*\)|be\\(|eval\\(|load_file\s*?\\(|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT(\\(.+\\)|\\s+?.+?)|UPDATE(\\(.+\\)|\\s+?.+?)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?)FROM(\\(.+\\)|\\s+?.+?)|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)|UNION([\s\S]*?)SELECT|_get|_post|_request|eval|assert|base64_decode|file_get_contents|pack|gzuncompress|preg_replace|\\{if|:php";


//访问日志记录
//foreach($_GET as $k=>$v){ $getData .= $k.'='.$v.'&'; }
//foreach($_POST as $k=>$v){ $postData .= $k.'='.$v.'&'; }
//$log = $_SERVER['PHP_SELF'] . '---get:' .$getData .'---post:' . $postData ;
//slog($log);


foreach($_GET as $key=>$value){
	StopAttack($key,$value,$getfilter);
}
foreach($_POST as $key=>$value){
	StopAttack($key,$value,$postfilter);
}
foreach($_COOKIE as $key=>$value){
	StopAttack($key,$value,$cookiefilter);
}
foreach($referer as $key=>$value){
	StopAttack($key,$value,$postfilter);
}

?>