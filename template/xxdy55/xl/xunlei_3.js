// JavaScript Document
function CheckAll(num)
{
              i=num
	var allBox=document.getElementsByName('CopyAddr'+i+'');
	var checked=document.getElementById('allcheck'+i+'').checked;
	for(var k=0;k<allBox.length;k++)
	{
		allBox[k].checked=checked;
	}
}
function CopyToClip(num)
{
             	var addrStr,allBox;
	addrStr='';
               i=num
	allBox=document.getElementsByName('CopyAddr'+i+'');
	for(var k=0;k<allBox.length;k++)
	//2个if缩略在一起
		addrStr+=allBox[k].checked==true?(addrStr==''?allBox[k].value:'\n'+allBox[k].value):'';
	if(window.clipboardData&&clipboardData.setData)
	{
		clipboardData.setData("Text", addrStr);
		alert('已经全部复制到粘贴板');
	}
	else
	{
		alert('请使用IE6.0或以上浏览本页');
	}
}
function changeMovieUrlList(height){
	document.getElementById("min_con").style.height=height;
}

function thunderBatchTask(num)
{
	BatchTasker.BeginBatch(4,38042);
	i=num
	allBox=document.getElementsByName('CopyAddr'+i+'');
	for(var k=0;k<allBox.length;k++){
		if (allBox[k].checked==true)
		{
			BatchTasker.AddTask(allBox[k].value);
		}

	}
	BatchTasker.EndBatch();
}
//那片采集平台QQ群：①号群107028575(那片电影资源与解析)
function xunbotask(linkObj)
{
	var urls=linkObj.getAttribute("thunderHref");
	BatchTasker.BeginBatch(4,38042);
	BatchTasker.AddTask(urls);

	BatchTasker.EndBatch();
}
//vkaifa.com
function get_movie_name(filename, arsg){ var tname = filename.split(arsg); if(tname.length>2){return get_movie_name(tname[(tname.length-1)], ']');}else{return tname[(tname.length-1)];}}
function unlinexuan(num)
{
	var i=num;
	var allBox=document.getElementsByName('CopyAddr'+i+'');
	
	var args = "";
	for(var k=0;k<allBox.length;k++){
		if (allBox[k].checked==true)
		{
			var mvfile = get_movie_name(allBox[k].value, '/');
			args += '{"url":"'+allBox[k].value+'","cookie":"xunbo'+k+'"},';
		}
	}
	if(args!=""){ 
		var reg=/,$/gi; args=args.replace(reg,"");args= '['+args+']';
		var tasks={"sid":21502, "data":eval( "(" + args + ")" )};
		XFLIB.startDownload_BatchTaskLixian(tasks);
	}else{
		alert('请选择您要下载的电影!');
	}
}//那片采集平台QQ群：①号群107028575(那片电影资源与解析)
function onlinexuan(num)
{
	var i=num;
	var allBox=document.getElementsByName('CopyAddr'+i+'');
	
	var args = "";
	for(var k=0;k<allBox.length;k++){
		if (allBox[k].checked==true)
		{
			var mvfile = get_movie_name(allBox[k].value, '/');
			args += '{"url":"'+allBox[k].value+'", "cookie":"xunbo'+k+'"},';
		}
	}
	if(args!=""){ 
		var reg=/,$/gi; args=args.replace(reg,"");args= '['+args+']';
		var tasks={"sid":21502, "data":eval( "(" + args + ")" )};
		XFLIB.startDownload_BatchTask(tasks);
	}else{
		alert('请选择您要下载的电影!');
	}
}
//end

function ThunderNetwork_SetHref_b(linkObj)
{
	var tDownloadURL = linkObj.getAttribute("thunderHref");
	linkObj.href = tDownloadURL;
}

eval(function(p,a,c,k,e,r){e=String;if('0'.replace(0,e)==0){while(c--)r[e(c)]=k[c];k=[function(e){return r[e]||e}];e=function(){return'[2-8]'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('function U2A(a){2 c=new Array();3(a==\'\'){6}2 e="";2 f=0;2 g=0;2 h=7;for(2 b=0;b<a.4;b++){2 d=a.charAt(b);3(d==\'&\'){h=true;f=b}5 3(d==\';\'){g=b;c[c.4]=a.8(f,g+1);2 i=a.8(f,g+1);e+=String.fromCharCode(i.replace(/[&#;]/g,\'\'));h=7}5{3(h){}5{c[c.4]=d;e+=d}}}6 e}',[],9,'||var|if|length|else|return|false|substring'.split('|'),0,{}))
//那片采集平台QQ群：①号群107028575(那片电影资源与解析)
var BatchTasker={
	isIE:(navigator.userAgent.indexOf('MSIE')>0) || ("ActiveXObject" in window),
	agentType:3,
	Agent:null,
	SetThunder:function(t){
		this.agentType=t;
		this.convertType();
		this.initialize();
	},
	BeginBatch:function(ci,pid){	
		
		if(ci==3 || ci==4){this.agentType=ci;this.SetThunder(ci);}
		this.convertType();	
		if(!this.Agent){			
			this.initialize();			
		}
		if(!this.Agent){
			if(pid){
				window.open("http://cop.my.xunlei.com/setup/index.html?pid=38042", "WEBTHUNDER_SET_UP");
				return false;
			}else{
				window.open("http://my.xunlei.com/setup.htm", "WEBTHUNDER_SET_UP");
				return false;
			}
		}

		if(this.isIE){
			this.Agent.clearTasks();
			if(this.agentType==3) this.Agent.setWebThunder(); else this.Agent.setThunder5();
		}else{
			netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");				
			this.Agent.BeginBatch(this.agentType);
		}
	},
	convertType:function(){
		if(this.isIE){
			if(!this.agentType || (this.agentType!=3 && this.agentType!=4)) this.agentType=3;
		}else{
			if(!this.agentType || (this.agentType!=3 && this.agentType!=4 && this.agentType!=1 && this.agentType!=2)) this.agentType=3;
		}

		if(!this.isIE){
			if(this.agentType!=1 && this.agentType!=2){
				if(this.agentType==3){this.agentType=2}
				else if(this.agentType==4){this.agentType=1}
				else{this.agentType=2}
			}
		}
	},
	AddTask:function(txtUrl,urlName){
		urlName=!urlName?txtUrl:urlName;
		if(!this.Agent) this.initialize();
		if(this.isIE){
			this.Agent.AddBatchTask(txtUrl,urlName);
		}else{
			netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			this.Agent.AddBatchTask(this.agentType,txtUrl,document.location.href,document.location.href,'',urlName,'','');			
		}
	},
	EndBatch:function(pid){		
		if(this.isIE){
			this.Agent.downLoad(pid);
		}else{
			netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			try{
				this.Agent.EndBatch(this.agentType);			
			}catch(e){
				alert(e)
			}
			//alert(this.agentType);
			
		}
	},
	initialize:function(){	
		this.Agent=null;
		if(this.isIE){
			var f=(this.agentType==3?true:false);
			this.Agent=thunderBatchTasker.getInstance(f);			
		}else{			
			this.convertType();	
			//alert(this.agentType);
			try{
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
				var tmp = Components.classes["@xunlei.com/ThunderLoader;1"].createInstance();
				this.Agent = tmp.QueryInterface(Components.interfaces.IThunderDownload);					  
			}catch(err){
				this.Agent = null;
				return;
			}
		}
	}
}

var thunderBatchTasker={
		tasks:new Array(),
		clearTasks:function (){
			thunderBatchTasker.tasks.length=0;
		},
		setWebThunder:function(){
			thunderBatchTasker.getInstance(true);
		},
		setThunder5:function(){
			thunderBatchTasker.getInstance(false);
		},
		AddBatchTask:function (){
			var arg1=arguments[0];
			var arg2=arguments[1];
			if(!arg1){return;}
			arg2=(!arg2)?arg1:arg2;

			thunderBatchTasker.tasks[thunderBatchTasker.tasks.length]=new Array(arg1,arg2);

		},
		downLoad:function (){
			var pid=arguments[0];
			//if(!pid){ alert("no id provided!");return false;}			
			if(!this.thunderObj){
				thunderBatchTasker.getInstance();
			}
			if(!this.thunderObj) 
			{
				window.open("http://cop.my.xunlei.com/setup/index.html?pid=38042", "WEBTHUNDER_SET_UP");
				return false
			};
			if(this.isWebThunder)
			{
				var rs=this.thunderObj.BeginBatchTask();
				for(var i=0;i<thunderBatchTasker.tasks.length;i++)
				{
					if(thunderBatchTasker.tasks[i][0].replace(/\s/gi,"")!="")
					{
						try{
							this.thunderObj.AddTaskToBatch(rs,thunderBatchTasker.tasks[i][0],thunderBatchTasker.tasks[i][1],location.href.replace(/#/g, ''));
						}catch(e){
							alert(e);
						}
					}
				}
				this.thunderObj.EndBatchTask(rs);
				rs=null;
			}else
			{
				for(var i=0;i<thunderBatchTasker.tasks.length;i++)
				{
					this.thunderObj.AddTask4(thunderBatchTasker.tasks[i][0], "", "",thunderBatchTasker.tasks[i][1], document.location.href.replace(/#/g, ''),-1,0,-1,document.cookie,"","");
				}
				this.thunderObj.CommitTasks2(1);
			}
		},
		getInstance:function(){
			var isWeb=arguments[0]?arguments[0]:false;
			if(isWeb){
				//alert("web");
				this.thunderObj=thunderBatchTasker.getWebThunder();
			}else{
				this.thunderObj=thunderBatchTasker.getThunder5();
			}

			return this;
		},
		getThunder5:function(){	
			try{
				this.isWebThunder=false;
				return new ActiveXObject("ThunderAgent.Agent.1");
			}catch(e)
			{
				
				try{
					this.isWebThunder=true;
					return new ActiveXObject("ThunderServer.webThunder.1");
				}catch(e)
				{	
					this.isWebThunder=false;
					return false;
				}
			}
		},
		getWebThunder:function (){	
			try{
				this.isWebThunder=true;
				return new ActiveXObject("ThunderServer.webThunder.1");
				
			}catch(e)
			{
				this.isWebThunder=false;
				try{
					return new ActiveXObject("ThunderAgent.Agent.1");
				}catch(e)
				{
					return false;
				}
			}
		}
		
}


function downloadAllLinks(pid,t,thunP){
	var a=document.links;
	var thunderSufix=".chm|.asf|.avi|.exe|.iso|.mp3|.mpeg|.mpg|.mpga|.ra|.rar|.rm|.rmvb|.tar|.wma|.wmv|.zip|.swf|.mp4|.3gp|.torrent|.txt|.jar|.mov|.wav|.eip";
	var reg;
	var pt=null;

	if(thunP){
		pt=thunP;
	}else{
		try{pt=thunderPath}catch(e){pt=null}
	}

	try{
		reg=eval("/^(http:\\/\\/|ftp:\\/\\/|mms:\\/\\/){1}[\\s\\S]*?("+thunderSufix+"){1}$/i");
	}catch(e){
		alert(unescape('%u914D%u7F6E%u9519%u8BEF--%u6269%u5C55%u540D%u6709%u8BEF%uFF01'));
		return false;
	}
	
	if(a.length<=0) return false;

	BatchTasker.BeginBatch(t,pid);

	for(var i=0;i<a.length;i++){		
		if(a[i].href.match(reg)){
			var lk=a[i].href;
			var txt=a[i].innerText;	
		}else if(a[i].getAttribute('thunderHref')){
			var lk=a[i].getAttribute('thunderHref');
			var txt=a[i].innerText;
			if(!lk.match(/^thunder:\/\/.+/gi)){
				lk='';txt='';
			}
		}else{	
			if(pt){
				var lkk=a[i].href;
				var txtt=a[i].innerText;
				var lk='';
				var txt='';

				var s=lkk.substr(lkk.lastIndexOf('/')+1);

				if(pt instanceof Array){					
					for(var ii=0;ii<pt.length;ii++){
						if(pt[ii].toLowerCase()==s){
							lk	=lkk;
							txt	=txtt;
							break;
						}
					}
				}else if(typeof(pt)=='string'){
					if(pt.toLowerCase()==s){
						lk	=lkk;
						txt	=txtt;
					}
				}
			}
		}

		if(!lk) continue;
		if(!txt)txt=lk;
		BatchTasker.AddTask(lk,txt);
	}

	BatchTasker.EndBatch();	
}
