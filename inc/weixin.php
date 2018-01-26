<?php
require("conn.php");
require(MAC_ROOT.'/inc/common/360_safe3.php');
define('TOKEN', $GLOBALS['MAC']['weixin']['token']);

$wechatObj = new wechatCallbackapi();
if (isset($_GET['echostr'])) {
	$wechatObj->valid();
}
else {
	$wechatObj->responseMsg();
}
    
class wechatCallbackapi {
	
	public function valid() {
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
    
	public function responseMsg() {
		$postStr = $GLOBALS['HTTP_RAW_POST_DATA'];
		if (!empty($postStr)) {
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$postType = trim($postObj->MsgType);
			switch ($postType) {
                    case 'text':
                        $res = $this->receiveText($postObj);
                    break;
                    case 'image':
                        $res = $this->receiveImage($postObj);
                    break;
                    case 'location':
                        $res = $this->receiveLocation($postObj);
                    break;
                    case 'voice':
                        $res = $this->receiveVoice($postObj);
                    break;
                    case 'video':
                        $res = $this->receiveVideo($postObj);
                    break;
                    case 'link':
                        $res = $this->receiveLink($postObj);
                    break;
                    case 'event':
                        $res = $this->receiveEvent($postObj);
                    break;
                    default:
                        $res = 'unknow msg type: '.$postType;
                    break;
			}
			echo $res;
		}
		else{
			echo '';
			exit;
		}
	}
	private function receiveLink($object) {
		$msg = '你发送的是链接已收到，请等待处理';
		$res = $this->transmitText($object, $msg);
		return $res;
	}
	private function receiveText($object) {
		$content = trim($object->Content);
        
		if ($GLOBALS['MAC']['weixin']['gjc1'] <> '' && strstr($content, $GLOBALS['MAC']['weixin']['gjc1'])) {
			$res = array();
			$res[] = array('Title'=>$GLOBALS['MAC']['weixin']['gjcm1'], 'Description'=>'', 'PicUrl'=>$GLOBALS['MAC']['weixin']['gjci1'], 'Url'=>$GLOBALS['MAC']['weixin']['gjcl1']);
		}
		elseif ($GLOBALS['MAC']['weixin']['gjc2'] <> '' && strstr($content, $GLOBALS['MAC']['weixin']['gjc2'])) {
			$res = array();
			$res[] = array('Title'=>$GLOBALS['MAC']['weixin']['gjcm2'], 'Description'=>'', 'PicUrl'=>$GLOBALS['MAC']['weixin']['gjci2'], 'Url'=>$GLOBALS['MAC']['weixin']['gjcl2']);
		}
		elseif ($GLOBALS['MAC']['weixin']['gjc3'] <> '' && strstr($content, $GLOBALS['MAC']['weixin']['gjc3'])) {
			$res = array();
			$res[] = array('Title'=>$GLOBALS['MAC']['weixin']['gjcm3'], 'Description'=>'', 'PicUrl'=>$GLOBALS['MAC']['weixin']['gjci3'], 'Url'=>$GLOBALS['MAC']['weixin']['gjcl3']);
		}
		elseif ($GLOBALS['MAC']['weixin']['gjc4'] <> '' && strstr($content, $GLOBALS['MAC']['weixin']['gjc4'])) {
			$res = array();
		$res[] = array('Title'=>$GLOBALS['MAC']['weixin']['gjcm4'], 'Description'=>'', 'PicUrl'=>$GLOBALS['MAC']['weixin']['gjci4'], 'Url'=>$GLOBALS['MAC']['weixin']['gjcl4']);
		}
		else {
			$res = array();
			$num = 0;
                
			$db = new AppDb($GLOBALS['MAC']['db']['server'],$GLOBALS['MAC']['db']['user'],$GLOBALS['MAC']['db']['pass'],$GLOBALS['MAC']['db']['name']);
                
			$sql="SELECT d_id,d_name,d_pic,d_starring,d_directed,d_area,d_year,d_lang,d_content from {pre}vod WHERE d_name like '%".$content."%' or d_enname like '%".($content)."%' ";
			//echo $sql;die;
			$rs = $db->queryArray($sql,false);
			if(!$rs){
				$res = array();
				$res[] = array('Title'=>$GLOBALS['MAC']['weixin']['wuziyuan'], 'Description'=>'', 'PicUrl'=>'', 'Url'=>$GLOBALS['MAC']['weixin']['wuziyuanlink']);
				//$res[] = array('Title'=>'更多好玩的东西', 'Description'=>'', 'PicUrl'=>'', 'Url'=> $GLOBALS['MAC']['weixin']['sousuo'].'/ad.html');
			}
			else{
				foreach($rs as $k=>$v){
					
					$url = "http://". $GLOBALS['MAC']['weixin']['sousuo'] ."/index.php?m=vod-detail-id-".$v['d_id'].".html";
					if ($GLOBALS['MAC']['weixin']['bofang']>0) {
						$url = "http://". $GLOBALS['MAC']['weixin']['sousuo'] ."/index.php?m=vod-play-id-".$v['d_id']."-src-1-num-1.html";
					}
					//$picUrl1 ="http://i1.piimg.com/1949/4258f172e127c807.gif";
					$picUrl = "http://". $GLOBALS['MAC']['weixin']['sousuo'] ."/".$v['d_pic'];
					if(substr($v['d_pic'],0,4)== 'http'){
						$picUrl = $v['d_pic'];
					}
					$res[$num] = array('Title'=>$v['d_name'], 'Description'=>getTextt(20, strip_tags($v["d_content"])), 'PicUrl'=>$picUrl, 'Url'=>$url);
					$num = $num+1;
					if ($num == 7) break;
				}
			} 
		}
		if (is_array($res)){
			if (isset($res[0])){
				$r = $this->transmitNews($object, $res);
			}
			else{
				$r = $this->transmitText($object, $res);
			}
		}
	    return $r;
	}
	
    private function receiveEvent($object) {
        $guanzhu = $GLOBALS['MAC']['weixin']['guanzhu'];
        $msg = '';
        switch ($object->Event) {
            case 'subscribe':
                $msg = $guanzhu;
            break;
            case 'unsubscribe':
                $msg = '拜拜了您内~';
            break;
            case 'CLICK':
                switch ($object->EventKey) {
                    default:
                        $res = '你点击了: '.$object->EventKey;
                    break;
                }
            break;
            default:
                $msg = 'receive a new event: '.$object->Event;
            break;
        }
        $res = $this->transmitText($object, $msg);
        return $res;
    }
    private function transmitText($object, $content) {
        $xmlTpl = '<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>';
        $res = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $res;
    }
    private function transmitNews($object, $newsArray) {
        if (!is_array($newsArray)) {
            return;
        }
        $itemTpl = '<item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
        </item>';
        $item_str = '';
        foreach($newsArray as $item) {
            $item_str.= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = '<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <ArticleCount>%s</ArticleCount>
        <Articles>%s</Articles>
        </xml>';
        $res = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray),$item_str);
        return $res;
    }
    
    private function transmitImage($object, $imageArray) {
        $xmlTpl = '<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[image]]></MsgType>
            <Image>
            <MediaId><![CDATA[%s]]></MediaId>
            </Image>
            </xml>';
		
        $res = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $imageArray['MediaId']);
        return $res;
    }
}
?>