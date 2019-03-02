<?php
namespace Home\Controller;
use Think\Controller;
use WechatSdk\wechat;
Class MenusetController extends Controller {
Public function index() {
    $options = array(
        'token' => 'SlJOepU62dlgzXQUOngE2P61HrEWBc5X', //填写你设定的key
        'encodingaeskey' => 'Vl7OemQxTbx02QDm7QC3y178vdkuSa53ZgxKKH9gxp3', //填写加密用的EncodingAESKey
        'appid' => 'wx76ba28fa1ddda905', //填写高级调用功能的app id, 请在微信开发模式后台查询
        'appsecret' => 'cbe43442bce712a2ffead81e279db7ca' //填写高级调用功能的密钥
    );
    $weObj = new Wechat($options);
    $data=array (
      	    'button' => array (
      	      0 => array (
             'name' => '论坛',
     	        'sub_button' => array (
      	            0 => array (
      	              'type' => 'view',
      	              'name' => '互动平台',
                        'url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx76ba28fa1ddda905&redirect_uri=http://arashi.natapp1.cc/OAuth2&response_type=code&scope=snsapi_userinfo&state=ncepu#wechat_redirect',
     	            ),
                    1 => array (
                        'type' => 'view',
                        'name' => '后台管理',
                        'url' => 'http://arashi.natapp1.cc/log',
      	            ),

      	        ),
     	      ),
),
);

    $a=$weObj->createMenu($data);
    $this->ajaxReturn($a);
}
}
