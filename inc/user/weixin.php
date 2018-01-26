<?php
require('inc/user/'.$vid.'/config.php');
$token=$GLOBALS['MACW']['site']['token'];
header("Content-type: text/html; charset=utf-8");
define("TOKEN", $token);

$wechatObj = new wechatCallbackapi();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

class wechatCallbackapi
{

    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            switch ($RX_TYPE)
            {
                case "text":
                    $resultStr = $this->receiveText($postObj);
                    break;
                case "image":
                    $resultStr = $this->receiveImage($postObj);
                    break;
                case "location":
                    $resultStr = $this->receiveLocation($postObj);
                    break;
                case "voice":
                    $resultStr = $this->receiveVoice($postObj);
                    break;
                case "video":
                    $resultStr = $this->receiveVideo($postObj);
                    break;
                case "link":
                    $resultStr = $this->receiveLink($postObj);
                    break;
                case "event":
                    $resultStr = $this->receiveEvent($postObj);
                    break;
                default:
                    $resultStr = "unknow msg type: ".$RX_TYPE;
                    break;
            }
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }

    private function receiveLink($object)
    {
        $funcFlag = 0;
        $contentStr = "你发送的是链接已收到，请等待处理";
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }

 private function receiveText($object)
    {

        $funcFlag = 0;
        $content = trim($object->Content);
        $dbip=$GLOBALS['MAC']['db']['server'];
        $dbname=$GLOBALS['MAC']['db']['name'];
        $dbuser=$GLOBALS['MAC']['db']['user'];
        $dbpass=$GLOBALS['MAC']['db']['pass'];
        $dbtabl=$GLOBALS['MAC']['db']['tablepre'];
        $sousuo=$GLOBALS['MAC']['site']['sousuo'];	
	    $wid = $GLOBALS['MACW']['site']['id'];
	    $notalk = $GLOBALS['MACW']['site']['notalk'];	
	    $token = $GLOBALS['MACW']['site']['token'];	
	    $wzyd = $GLOBALS['MACW']['site']['wzyc'];		
	    $wzyi = $GLOBALS['MACW']['site']['wzyi'];
	    $wzyl = $GLOBALS['MACW']['site']['wzyl'];
	    $gjcan = $GLOBALS['MACW']['site']['gjcan'];
	    $gjcac = $GLOBALS['MACW']['site']['gjcac'];
	    $gjcad = $GLOBALS['MACW']['site']['gjcad'];		
	    $gjcai = $GLOBALS['MACW']['site']['gjcai'];
	    $gjcal = $GLOBALS['MACW']['site']['gjcal'];
	    $gjcbn = $GLOBALS['MACW']['site']['gjcbn'];
	    $gjcbc = $GLOBALS['MACW']['site']['gjcbc'];
	    $gjcbd = $GLOBALS['MACW']['site']['gjcbd'];		
	    $gjcbi = $GLOBALS['MACW']['site']['gjcbi'];
	    $gjcbl = $GLOBALS['MACW']['site']['gjcbl'];
	    $gjccn = $GLOBALS['MACW']['site']['gjccn'];
	    $gjccc = $GLOBALS['MACW']['site']['gjccc'];
	    $gjccd = $GLOBALS['MACW']['site']['gjccd'];		
	    $gjcci = $GLOBALS['MACW']['site']['gjcci'];
	    $gjccl = $GLOBALS['MACW']['site']['gjccl'];
	    $gjcdn = $GLOBALS['MACW']['site']['gjcdn'];
	    $gjcdc = $GLOBALS['MACW']['site']['gjcdc'];
	    $gjcdd = $GLOBALS['MACW']['site']['gjcdd'];		
	    $gjcdi = $GLOBALS['MACW']['site']['gjcdi'];
	    $gjcdl = $GLOBALS['MACW']['site']['gjcdl'];
	    $dyn = $GLOBALS['MACW']['site']['dyn'];
	    $dyc = $GLOBALS['MACW']['site']['dyc'];		
	    $xsn = $GLOBALS['MACW']['site']['xsn'];
	    $xsc = $GLOBALS['MACW']['site']['xsc'];		
	    $udn = $GLOBALS['MACW']['site']['udn'];
	    $udc = $GLOBALS['MACW']['site']['udc'];		
	    $udl = $GLOBALS['MACW']['site']['udl'];
	    $udcn = $GLOBALS['MACW']['site']['udcn'];
        if($udcn==''||$udcn<=0) $udcn = 0;
        if($udcn>=8) $udcn = 8;
        if(is_file('inc/user/'.$wid.'/zidingyi.php')){
		   $zidingyi = "1";
        }else{
	       $zidingyi = "0";
        }
     if  ($gjcac<>'' && strstr($content, $gjcac)){
		 $content = array();
         $content[]= array("Title"=>$gjcad, "Description"=>"", "PicUrl"=>$gjcai, "Url" =>$gjcal);

}elseif  ($gjcbc<>'' && strstr($content, $gjcbc)){
		 $content = array();
         $content[]= array("Title"=>$gjcbd, "Description"=>"", "PicUrl"=>$gjcbi, "Url" =>$gjcbl);

}elseif  ($gjccc<>'' && strstr($content, $gjccc)){
		 $content = array();
         $content[]= array("Title"=>$gjccd, "Description"=>"", "PicUrl"=>$gjcci, "Url" =>$gjccl);

}elseif  ($gjcdc<>'' && strstr($content, $gjcdc)){
		 $content = array();
         $content[]= array("Title"=>$gjcdd, "Description"=>"", "PicUrl"=>$gjcdi, "Url" =>$gjcdl);

}elseif  ($dyn<>'' && strstr($content, $dyc)){
         $content = str_replace("：", "", $content);
         $content = str_replace(":", "", $content);
         $content = str_replace("+", "", $content);
         $content = str_replace(" ", "", $content);
         $content = str_replace($dyc, "", $content);
	     if  ($zidingyi == "1" && $dyc==$udc) $m=8-$udcn;
         $con = mysql_connect($dbip,$dbuser,$dbpass);
         mysql_select_db($dbname, $con);
		 $result = mysql_query("select * from ".$dbtabl."vod where d_name like '%$content%' and d_type=89");
         $content1 = array();
         $i=0;
		 if(!isset($m)) $m='7';
         while($row = mysql_fetch_array($result))
              {
               $url="http://".$sousuo."/?m=vod-detail-id-{$row['d_id']}.html";
			   if(strstr($row['d_pic'], "http")){$pic=$row['d_pic'];}
			   else{$pic="http://".$sousuo."/".$row['d_pic'];}
               $content1[$i] = array("Title"=>$row['d_name'], "Description"=>"", "PicUrl"=>$pic, "Url" =>$url);
               $i=$i+1;
               if($i==$m)
               break;
               }
		 mysql_close($con);
	     if  ($zidingyi == "1" && $dyc==$udc && $m>0){
			 include('inc/user/'.$wid.'/zidingyi.php');
             $content = array_merge($content0, $content1);

		 }else{
             $content = $content1;
		 }

}elseif  ($xsn<>'' && strstr($content, $xsc)){
         $content = str_replace("：", "", $content);
         $content = str_replace(":", "", $content);
         $content = str_replace("+", "", $content);
         $content = str_replace(" ", "", $content);
         $content = str_replace($xsc, "", $content);
	     if  ($zidingyi=="1" && $xsc==$udc) $m=8-$udcn;
	     include('xiaoshuo.php');
	     if  ($zidingyi=="1" && $xsc==$udc && $m>0){
			 include('inc/user/'.$wid.'/zidingyi.php');
             $content = array_merge($content0, $content1);

		 }else{
             $content = $content1;
		 }
}elseif  ($udn<>'' && strstr($content, $udc)){
	     include('inc/user/'.$wid.'/zidingyi.php');
             $content = $content0;
}elseif  ($content=="导航"){
         $content = array();
         $content[0] = array("Title"=>"已开通的指令如下：", "Description"=>"", "PicUrl"=>"", "Url" =>"");
         if($gjcan<>'') $content[$gjcan] = array("Title"=>$gjcac."指令,输入:".$gjcac, "Description"=>"", "PicUrl"=>"", "Url" =>"");
         if($gjcbn<>'') $content[$gjcbn] = array("Title"=>$gjcbc."指令,输入:".$gjcbc, "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($gjccn<>'') $content[$gjccn] = array("Title"=>$gjccc."指令,输入:".$gjccc, "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($gjcdn<>'') $content[$gjcdn] = array("Title"=>$gjcdc."指令,输入:".$gjcdc, "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($dyn<>'')  $content[$dyn] = array("Title"=>$dyc."指令,输入:".$dyc."+关键词", "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($xsn<>'')  $content[$xsn] = array("Title"=>$xsc."指令,输入:".$xsc."+关键词", "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($udn<>'' && $udc!==$xsc && $udc!==$dyc&& $udc!==$gjcan&& $udc!==$gjcbn&& $udc!==$gjccn&& $udc!==$gjcdn) $content[$udn] = array("Title"=>$udc."指令,输入:".$udc."+关键词", "Description"=>"", "PicUrl"=>"", "Url" =>"");


}else    {
         if($notalk<>''&& strstr($notalk, "导航")){
			 $notalk = str_replace("导航", "", $notalk);
			 $notalk = str_replace("+", "", $notalk);
         $content = array();
         $content[0] = array("Title"=>$notalk."\n已开通的指令如下：", "Description"=>"", "PicUrl"=>"", "Url" =>"");
         if($gjcan<>'') $content[$gjcan] = array("Title"=>$gjcac."指令,输入:".$gjcac, "Description"=>"", "PicUrl"=>"", "Url" =>"");
         if($gjcbn<>'') $content[$gjcbn] = array("Title"=>$gjcbc."指令,输入:".$gjcbc, "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($gjccn<>'') $content[$gjccn] = array("Title"=>$gjccc."指令,输入:".$gjccc, "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($gjcdn<>'') $content[$gjcdn] = array("Title"=>$gjcdc."指令,输入:".$gjcdc, "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($dyn<>'')  $content[$dyn] = array("Title"=>$dyc."指令,输入:".$dyc."+关键词", "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($xsn<>'')  $content[$xsn] = array("Title"=>$xsc."指令,输入:".$xsc."+关键词", "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($udn<>'' && $udc!==$xsc && $udc!==$dyc&& $udc!==$gjcan&& $udc!==$gjcbn&& $udc!==$gjccn&& $udc!==$gjcdn) $content[$udn] = array("Title"=>$udc."指令,输入:".$udc."+关键词", "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 }elseif($notalk<>''){
         $content = array();
         $content[0] = array("Title"=>$notalk, "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 }else{
            echo '';		 
		 }
}
if(!$content){
      $content = array();
      $content[] = array("Title"=>"输入指令错误或未找到本资源", "Description"=>"", "PicUrl"=>"", "Url" =>"");
      $content[] = array("Title"=>"更多好玩的东西", "Description"=>"", "PicUrl"=>"", "Url" =>"http://www.avziliao.com/ad.php");
			}

if(is_array($content)){
             if (isset($content[0])){
             $result = $this->transmitNews($object, $content, $funcFlag);  }
             else{
			 $result = $this->transmitText($object, $content, $funcFlag);}
						      }


return $result;
    }

     private function receiveEvent($object)
    {

	    $gzd = $GLOBALS['MACW']['site']['gzd'];		
	    $gzi = $GLOBALS['MACW']['site']['gzi'];
	    $gzl = $GLOBALS['MACW']['site']['gzl'];
	    $gjcan = $GLOBALS['MACW']['site']['gjcan'];
	    $gjcac = $GLOBALS['MACW']['site']['gjcac'];
	    $gjcad = $GLOBALS['MACW']['site']['gjcad'];		
	    $gjcai = $GLOBALS['MACW']['site']['gjcai'];
	    $gjcal = $GLOBALS['MACW']['site']['gjcal'];
	    $gjcbn = $GLOBALS['MACW']['site']['gjcbn'];
	    $gjcbc = $GLOBALS['MACW']['site']['gjcbc'];
	    $gjcbd = $GLOBALS['MACW']['site']['gjcbd'];		
	    $gjcbi = $GLOBALS['MACW']['site']['gjcbi'];
	    $gjcbl = $GLOBALS['MACW']['site']['gjcbl'];
	    $gjccn = $GLOBALS['MACW']['site']['gjccn'];
	    $gjccc = $GLOBALS['MACW']['site']['gjccc'];
	    $gjccd = $GLOBALS['MACW']['site']['gjccd'];		
	    $gjcci = $GLOBALS['MACW']['site']['gjcci'];
	    $gjccl = $GLOBALS['MACW']['site']['gjccl'];
	    $gjcdn = $GLOBALS['MACW']['site']['gjcdn'];
	    $gjcdc = $GLOBALS['MACW']['site']['gjcdc'];
	    $gjcdd = $GLOBALS['MACW']['site']['gjcdd'];		
	    $gjcdi = $GLOBALS['MACW']['site']['gjcdi'];
	    $gjcdl = $GLOBALS['MACW']['site']['gjcdl'];
	    $dyn = $GLOBALS['MACW']['site']['dyn'];
	    $dyc = $GLOBALS['MACW']['site']['dyc'];		
	    $xsn = $GLOBALS['MACW']['site']['xsn'];
	    $xsc = $GLOBALS['MACW']['site']['xsc'];		
	    $udn = $GLOBALS['MACW']['site']['udn'];
	    $udc = $GLOBALS['MACW']['site']['udc'];		
	    $udl = $GLOBALS['MACW']['site']['udl'];
	    $udcn = $GLOBALS['MACW']['site']['udcn'];
        $content = "";
        switch ($object->Event)
        {
            case "subscribe":

         if($gzd<>''&& strstr($gzd, "导航")){
			 $gzd = str_replace("导航", "", $gzd);
			 $gzd = str_replace("+", "", $gzd);
         $content = array();
         $content[0] = array("Title"=>$gzd."\n已开通的指令如下：", "Description"=>"", "PicUrl"=>$gzi, "Url" =>$gzl);
         if($gjcan<>'') $content[$gjcan] = array("Title"=>$gjcac."指令,输入:".$gjcac, "Description"=>"", "PicUrl"=>"", "Url" =>"");
         if($gjcbn<>'') $content[$gjcbn] = array("Title"=>$gjcbc."指令,输入:".$gjcbc, "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($gjccn<>'') $content[$gjccn] = array("Title"=>$gjccc."指令,输入:".$gjccc, "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($gjcdn<>'') $content[$gjcdn] = array("Title"=>$gjcdc."指令,输入:".$gjcdc, "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($dyn<>'')  $content[$dyn] = array("Title"=>$dyc."指令,输入:".$dyc."+关键词", "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($xsn<>'')  $content[$xsn] = array("Title"=>$xsc."指令,输入:".$xsc."+关键词", "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 if($udn<>'' && $udc!==$xsc && $udc!==$dyc&& $udc!==$gjcan&& $udc!==$gjcbn&& $udc!==$gjccn&& $udc!==$gjcdn) $content[$udn] = array("Title"=>$udc."指令,输入:".$udc."+关键词", "Description"=>"", "PicUrl"=>"", "Url" =>"");
		 }elseif($gzd<>''){
         $content = array();
         $content[0] = array("Title"=>$gzd, "Description"=>"", "PicUrl"=>$gzi, "Url" =>$gzl);
		 }else{
            echo '';		 
		 }

                break;
            case "unsubscribe":
                $content = "拜拜了您内~";
                break;
            case "CLICK":
                switch ($object->EventKey)
                {
                    default:
                        $content = "你点击了: ".$object->EventKey;
                        break;
                }
                break;
            default:
                $content = "receive a new event: ".$object->Event;
                break;
        }
if(!$content){
      $content = array();
      $content[] = array("Title"=>"输入指令错误或未找到本资源", "Description"=>"", "PicUrl"=>"", "Url" =>"");
      $content[] = array("Title"=>"更多好玩的东西", "Description"=>"", "PicUrl"=>"", "Url" =>"http://www.avziliao.com/ad.php");
			}

if(is_array($content)){
             if (isset($content[0])){
             $result = $this->transmitNews($object, $content, $funcFlag);  }
             else{
			 $result = $this->transmitText($object, $content, $funcFlag);}
						      }
        return $result;
    }


    private function transmitText($object, $content, $flag = 0)
    {
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $resultStr;
    }


    private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return;
        }
        $itemTpl =
        "<item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
        </item>";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl =
        "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <ArticleCount>%s</ArticleCount>
        <Articles>%s</Articles>
        </xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray),$item_str);
        return $result;
    }

    private function transmitImage($object, $mediaId)
    {
        $imageTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[image]]></MsgType>
            <Image>
            <MediaId><![CDATA[%s]]></MediaId>
            </Image>
            </xml>";

        $resultStr = sprintf($imageTpl, $object->FromUserName, $object->ToUserName, time(), $mediaId);
        return $resultStr;
    }

}
?>
