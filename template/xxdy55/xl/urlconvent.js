

function urlconvert(oldurl,flag){
  oldurl=trimString(oldurl);
  
  if (oldurl==''){
	  alert('请输入URL地址!');
	  return false;
  }else if(/thunder:\/\//i.test(oldurl)){
      newurl=Thunderdecode(oldurl);
  }else if(/flashget:\/\//i.test(oldurl)){
      newurl=Flashgetdecode(oldurl);
  }else if(/qqdl:\/\//i.test(oldurl)){
      newurl=qqdecode(oldurl);
  }else if(/fs2you:\/\//i.test(oldurl)){
      newurl=FS2Decode(oldurl);
  }else{
	   newurl=oldurl;
	   //alert('这个地址貌似不是迅雷,快车,旋风,FS2任何一种的下载地址!');
	   //return false;
  }
  
  //那片采集平台QQ群：①号群107028575(那片电影资源与解析)
  
  thunderurl=ThunderEncode(newurl);
  flashgeturl=flashetencode(newurl);
  qqurl=qqencode(newurl);
  
  if(flag=="xl"){
  	  return thunderurl;
  }
  else if(flag=="fl"){
  	  return flashgeturl;
  }
  else if(flag=="qq"){
  	  return qqurl;
  }
  else if(flag=="ys"){
	  newurl=decodeURIComponent(newurl);
	  newurl = encodeURIComponent(newurl);
  	  return newurl;
  }
}

function ConvertURL2FG(url,fUrl,uid)
	{	
		try{
			FlashgetDown(url,uid);
		}catch(e){location.href = fUrl;}
}
function Flashget_SetHref(obj,uid){obj.href = obj.fg;}
 function   trimString(str)   
  {   
  var   re;   
  var   newstr;   
  re   =   new   RegExp("^(\\s)*");   
  re2   =   new   RegExp("(\\s)*$");   
  newstr   =   str.replace(re,"");   
  newstr   =   newstr.replace(re2,"");   
    
  return   newstr;   
}  //那片采集平台QQ群：①号群107028575(那片电影资源与解析) 
function qqencode(url){
   url='qqdl://'+encode64(url);
   return url;
}
function flashetencode(url){
   url='Flashget://'+encode64('[FLASHGET]'+url+'[FLASHGET]')+'&1926';
   return url;
}
 function ThunderEncode(t_url) {
	var thunderPrefix = "AA";
	var thunderPosix = "ZZ";
	var thunderTitle = "thunder://";
	var tem_t_url = t_url;
	var thunderUrl = thunderTitle + encode64(thunderPrefix + tem_t_url + thunderPosix);
	return thunderUrl;
}

function Thunderdecode(url) {
	 url=url.replace('thunder://','');
     thunderUrl=decode64(url);
	 thunderUrl=thunderUrl.substr(2,thunderUrl.length-4);
	 return thunderUrl;
}

function Flashgetdecode(url){
    url=url.replace('Flashget://','');
	if (url.indexOf('&')!=-1)
	{
		url=url.substr(0,url.indexOf('&'));	 
	}
	url=decode64(url);
	flashgeturl=url.replace('[FLASHGET]','');
	flashgeturl=flashgeturl.replace('[FLASHGET]','');
	 
	return flashgeturl;
}
function  qqdecode(url){
	url=url.replace('qqdl://','');
    qqurl=decode64(url);
    return qqurl;
}
//那片采集平台QQ群：①号群107028575(那片电影资源与解析)

//FS2地址
function  FS2Decode(url){
    url=url.replace('fs2you://','');
    fs2url=decode64(url).split("|")[0];
    fs2url="http://"+fs2url;
    return fs2url;
}


