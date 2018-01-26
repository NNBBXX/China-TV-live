var uid = MacPlayer.PlayUrl;
if(uid.indexOf('http') > -1){
	//url
	MacPlayer.Html = '<iframe width="100%" height="'+MacPlayer.Height+'" src="http://jiexi.cx/5qiyi/ic.php?url='+uid+'" frameborder="0" border="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>';
	MacPlayer.Show();
}else{
	//id
	MacPlayer.Html = '<iframe border="0" src="http://moon.z66.pw/pptv.php?url='+MacPlayer.PlayUrl+'&type=pptv" width="100%" height="'+MacPlayer.Height+'" marginWidth="0" frameSpacing="0" marginHeight="0" frameBorder="0" scrolling="no" vspale="0" noResize></iframe>';
MacPlayer.Show();
}