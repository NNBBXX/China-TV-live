var mac_flag=1;         //播放器版本
var mac_second=5;       //播放前预加载广告时间 1000表示1秒
var mac_width=0;      //播放器宽度0自适应
var mac_height=220;     //播放器高度
var mac_widthmob=0;      //手机播放器宽度0自适应
var mac_heightmob=220;     //手机播放器高度
var mac_widthpop=220;   //弹窗窗口宽度
var mac_heightpop=220;  //弹窗窗口高度
var mac_showtop=0;     //美化版播放器是否显示头部
var mac_showlist=0;     //美化版播放器是否显示列表
var mac_autofull=1;     //是否自动全屏,0否,1是
var mac_buffer="buffer.html";     //缓冲广告地址
var mac_prestrain="prestrain.html";  //预加载提示地址
var mac_colors="000000;background:url(images/bg.gif),F6F6F6,F6F6F6,333333,666666,FFFFF,FF0000,2c2c2c,ffffff,a3a3a3,2c2c2c,adadad,adadad,48486c,fcfcfc";   //背景色，文字颜色，链接颜色，分组标题背景色，分组标题颜色，当前分组标题颜色，当前集数颜色，集数列表滚动条凸出部分的颜色，滚动条上下按钮上三角箭头的颜色，滚动条的背景颜色，滚动条空白部分的颜色，滚动条立体滚动条阴影的颜色 ，滚动条亮边的颜色，滚动条强阴影的颜色，滚动条的基本颜色
var mac_show={},mac_show_server={}; //播放器名称,服务器组地址
//缓存开始
mac_show["mp4"]="mp4";mac_show["ckplayer"]="ckplayre";mac_show["ckm3u8"]="ckm3u8";mac_show["zhibo"]="TTV";mac_show["dy"]="HD";mac_show["mzb"]="MZB";mac_show["tv"]="MTV";mac_show["xxdy55"]="LTV";mac_show["ltv"]="ZTV";mac_show_server["webplay"]="maccmsc.com";
//缓存结束