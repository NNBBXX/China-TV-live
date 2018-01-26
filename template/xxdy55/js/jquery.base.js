islogin=0;
function checkcookie(){
	if(document.cookie.indexOf('auth=')>=0){
		islogin=1;
		return true;
	}
	return false;
}
checkcookie();


$(function($){
    $.fn.changeList = function(options){
        var defaults = {
                    tag : 'li', // tab name
                    subName : '.utilTabSub', // sub class name
                    eventType : 'click', // event type
                    num : 3,
                    showType : 'show' // show effect type
                },
                opts = $.extend({}, defaults, options),
                that = $(this),
                subUl = that.find(opts.subName),
                subItems = subUl.find('li'),
                size = subItems.length,
                liW = subItems.outerWidth(true),
                ulW = liW * size,
                page = size + 1,
                n = opts.num,
                randNum = 0,
                m = 0;

        if(size > n){
            that.find(opts.tag)[opts.eventType](function() {
                randNum = mathRand(n, size);
                subItems.hide();
                $.each(randNum, function (i, el) {
                    subItems.eq(el).fadeIn(800);
                });
            });
        }
    };
}(jQuery));
function mathRand(bit, max){
    var num = 0,
            arr = [],
            ret = [];
    for(var i=0; i<bit; i++){
        num = Math.floor(Math.random() * max);
        if($.inArray(num, ret) == -1){
            ret.push(num);
        } else {
            i--;
            continue;
        }
    }
    return ret;
}
$(document).ready(function(){
        $('img.loading').lazyload({data_attribute:'original',threshold:5,effect:'fadeIn'});						
		$(window).on('scroll',function(){
		var st = $(document).scrollTop();
		if( st>0 ){
			if( $('#main-container').length != 0  ){
				var w = $(window).width(),mw = $('#main-container').width();
				if( (w-mw)/2 > 70 )
					$('#index-top').css({'left':(w-mw)/2+mw+20});
				else{
					$('#index-top').css({'left':'auto'});
				}
			}
			$('#index-top').fadeIn(function(){
				$(this).removeClass('wmin');
			});
		}else{
			$('#index-top').fadeOut(function(){
				$(this).addClass('wmin');
			});
		}	
	});
	$('#index-top .top').on('click',function(){
		$('html,body').animate({'scrollTop':0},500);
	});
	var prevpage=$("#pre").attr("href"); 
    var nextpage=$("#next").attr("href"); 
    $("body").keydown(function(event){ 
      if(event.keyCode==37 && prevpage!=undefined) location=prevpage; 
      if(event.keyCode==39 && nextpage!=undefined) location=nextpage; 
    }); 
	$(".cancelInput").click(function() {	
		$html = $(this).html();
	    $(".searchPop").hide();	
		 $("html,body").css({
            "overflow-y": "auto"
        });	
	});
	$(".top_channel_btn").click(function(){								 
	$(".top_channel_btn").toggleClass("aChannelShow");

	});	
	
	if($("#story-p").length > 0)
	{
        linheight = $("#story-p li a").length;
		gheight=linheight*3+10;
		if($("#story-p")[0].scrollHeight>120)
		{
			$(".story-pzk").css({'display':'block'});
			$("#story-p").height(gheight);
			$(".story-pzk").click(function(e){
			if($(this).hasClass('ss')){
			$(this).removeClass('ss').addClass('zk').html('展开');
		}else{
			$(this).removeClass('zk').addClass('ss').html('收缩');
		}						
				if($("#story-p").height()>gheight)
				{

					var h = $("#story-p")[0].scrollHeight;
					$("#story-p").height(gheight);
					
				}
				else
				{
					
					var h = $("#story-p")[0].scrollHeight;
					$("#story-p").height(h);
				}
				e.preventDefault(); 
			});
		}
	}
if($("#actorall").length > 0)
	{
		if($("#actorall")[0].scrollHeight>210)
		{
			$("#downzk").css({'display':'block'});
			$("#actorall").height(185);
			$("#downzk").click(function(e){
			if($(this).hasClass('ss')){
			$(this).removeClass('ss').addClass('zk').html('展开全部角色<span>&#xe623;</span>');
		}else{
			$(this).removeClass('zk').addClass('ss').html('收起部分角色<span>&#xe625;</span>');
		}						
				if($("#actorall").height()>185)
				{
					var h = $("#actorall")[0].scrollHeight;
					$("#actorall").height(185);
					
				}
				else
				{
					var h = $("#actorall")[0].scrollHeight;
					$("#actorall").height(h);
				}
				e.preventDefault(); 
			});
		}
	}
if($("#rolemore").length > 0)
	{
		if($("#rolemore")[0].scrollHeight>155)
		{
			$("#rolezk").css({'display':'block'});
			$("#rolemore").height(113);
			$("#rolezk").click(function(e){
			if($(this).hasClass('ss')){
			$(this).removeClass('ss').addClass('zk').html('展开全部角色<span>&#xe623;</span>');
		}else{
			$(this).removeClass('zk').addClass('ss').html('收起部分角色<span>&#xe625;</span>');
		}						
				if($("#rolemore").height()>113)
				{
					var h = $("#rolemore")[0].scrollHeight;
					$("#rolemore").height(113);
					
				}
				else
				{
					var h = $("#rolemore")[0].scrollHeight;
					$("#rolemore").height(h);
				}
				e.preventDefault(); 
			});
		}
	}
if($(".star-data,.special-txt").length > 0)
	{
		if($(".star-data,.special-txt")[0].scrollHeight>130)
		{
			$("#star-infozk,#special-txt").css({'display':'block'});
			$(".star-data,.special-txt").height(105);
			$("#star-infozk,#special-txt").click(function(e){
			if($(this).hasClass('ss')){
			$(this).removeClass('ss').addClass('zk').html('展开更多资料<em>&#xe623;</em>');
		}else{
			$(this).removeClass('zk').addClass('ss').html('收起部分资料<em>&#xe625;</em>');
		}						
				if($(".star-data,.special-txt").height()>105)
				{
					var h = $(".star-data,.special-txt")[0].scrollHeight;
					$(".star-data,.special-txt").height(105);
					
				}
				else
				{
					var h = $(".star-data,.special-txt")[0].scrollHeight;
					$(".star-data,.special-txt").height(h);
				}
				e.preventDefault(); 
			});
		}
	}	
	//内容页面播放列表切换
	$(".play-title a").each(function(j,div){
			$(this).click(function(){
		//$("html,body").animate({scrollTop:$("#"+listid).offset().top}, 500); //我要平滑
		        if ($(this).parent().hasClass("current") ){
					return;
                }
				$(this).parent().nextAll().removeClass("current");
				$(this).parent().prevAll().removeClass("current");
				$(this).parent().addClass("current")
				$('.play-box').hide();
				$('.play-box:eq('+j+')').show();
	});		
	});
//内容播放页面排序
  $('.order a').click(function(){
		if($(this).hasClass('asc')){
			$(this).removeClass('asc').addClass('desc').html('<i class="iconfont">&#xe620;</i>降序');
		}else{
			$(this).removeClass('desc').addClass('asc').html('<i class="iconfont">&#xe61f;</i>升序');
		}
		var a=$('.play-box:eq('+$(this).attr('data')+') .plau-ul-list');
		var b=$('.play-box:eq('+$(this).attr('data')+') .plau-ul-list li');
		a.html(b.get().reverse());
	});

});

// 全站通栏模块切换
function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
		var menu=document.getElementById(name+i);
		var con=document.getElementById("con_"+name+"_"+i);
		menu.className=i==cursel?"current":"";
		con.style.display=i==cursel?"block":"none";
	}
}
//栏目页面周期显示
function weekTab(name,cursel,n){
	for(i=1;i<=n;i++){
		var menu=document.getElementById(name+i);
		var con=document.getElementById("week_"+name+"_"+i);
		menu.className=i==cursel?"current":"";
		con.className=i==cursel?"current":"";
	}
}
