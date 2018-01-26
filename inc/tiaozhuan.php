<?php

$url = $_GET['url'];

?>

<!DOCTYPE HTML> 
<html lang="en"> 
<head> 
<meta charset="utf-8"/> 
<title>请使用浏览器打开</title> 
<script src="/js/jquery-1.4.4.min.js"></script>
<style type="text/css">
*{ margin:0; padding:0;}
.ipad{}
</style>
</head> 
<body> 
<img src="" width="100%" height="100%" id="show_tishi">
<script type="text/javascript">
$(document).ready(function() {
	var ua = window.navigator.userAgent.toLowerCase(); 
    var u = navigator.userAgent, app = navigator.appVersion;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
	if(ua.match(/MicroMessenger/i) == 'micromessenger'){
	if(isiOS){
		$("#show_tishi").attr("src","/images/1.png")
		}else{
			$("#show_tishi").attr("src","/images/2.png")
			}
	return false;
	}else{
		window.location.href='<?php echo $url;?>';
		}
});

</script> 
</body> 
</html>