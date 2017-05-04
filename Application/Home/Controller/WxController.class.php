<?php
namespace Home\Controller;
use Think\Controller;

class WxController extends Controller {
    
    
    /**
     * 主页
     */
    public function index()
    {
       
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echo = $_GET["echostr"];
    
        $token = "small";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        M('wx')->add(array(
            'signature'=>$signature,
            'timestamp'=>$timestamp,
            'nonce'=>$nonce,
            'str'=>$echo
            
        ));
        if(!strcmp($tmpStr,$signature) ){
            M('wx')->add(array(
            'signature'=>$signature,
            'timestamp'=>$timestamp,
            'nonce'=>$nonce,
            'str'=>1
            
            ));
            echo $echo;
        }else{
            return false;
            
        }
    }
    

}