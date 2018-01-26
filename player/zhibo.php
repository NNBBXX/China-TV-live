<?php
$url = $_GET['url']; 
?>

<!DOCTYPE html>
<html>
<head>
<meta name="publisher" content="">
<title>秀秀最新电影直播技术提供</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="http://libs.baidu.com/jquerymobile/1.3.0/jquery.mobile-1.3.0.min.css" />
<link rel="stylesheet" href="http://xxdy33.hkk.hk/zhbo/weixin.css" />
<script src="http://xxdy33.hkk.hk/zhbo/key.js"></script>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://libs.baidu.com/jquerymobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
 </head>

<body onload="getLiveKey('<?php echo $url ?>')">
<div data-role="page">
  <div id="msg"> </div>
<div class="headerNfooter" data-role="header" data-theme="f" data-position="fixed">

</div>
<div align="center">
</div>
<div data-role="content">
   
<center>

<video autoplay="" id="ikdsPlayer" width="100%" height="220px" controls="" src="<?php echo $url ?>"></video>

</center>

  
  </div>

<div align="center">

</div>
  <!-- /content -->
  <!-- /footer --> 
</div>
<!-- /page -->
</body>

<script src="http://js-10063108.cos.myqcloud.com/dibuguanggao.js"></script>

<span style="display:none">
</span>
</html>