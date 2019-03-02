<?php
namespace Home\Controller;
use Think\Controller;
use WechatSdk\wechat;

class OAuth2Controller extends Controller {
    public function index()
    {
        $options = array(
            'token'=>'SlJOepU62dlgzXQUOngE2P61HrEWBc5X', //填写你设定的key
            'encodingaeskey'=>'Vl7OemQxTbx02QDm7QC3y178vdkuSa53ZgxKKH9gxp3', //填写加密用的EncodingAESKey
            'appid'=>'wx76ba28fa1ddda905', //填写高级调用功能的app id, 请在微信开发模式后台查询
            'appsecret'=>'cbe43442bce712a2ffead81e279db7ca' //填写高级调用功能的密钥
        );
        $weObj = new Wechat($options); //创建实例对象

        $callback="http://arashi.natapp1.cc/OAuth2";
        $state="ncepu";
        $scope='snsapi_userinfo';
        $o=$weObj->getOauthRedirect($callback,$state,$scope); //获取网页授权oAuth跳转地址

        $a=$weObj->getOauthAccessToken();//通过回调的code获取网页授权access_token

        $refresh_token=$a['refresh_token'];
       $b= $weObj->getOauthRefreshToken($refresh_token); //通过refresh_token对access_token续期

        $access_token=$b['access_token'];
        $openid=$b['openid'];



     $c =$weObj->getOauthUserinfo($access_token,$openid); //通过网页授权的access_token获取用户资料
        $nickname=$c['nickname'];
        $sex=$c['sex'];
        $language=$c['language'];
        $city=$c['city'];
        $province=$c['province'];
        $country=$c['country'];
        $headimgurl=$c['headimgurl'];

        cookie('openid',$openid);
        cookie('nickname',$nickname);
        cookie('headimgurl',$headimgurl);
        cookie('access_token',$access_token);

        $search['openid']=$openid;
        $fan=D('fan');
        $num=$fan->where($search)->count('id');
         $data=array();
         if($num==0) {
             $data['openid'] = $openid;
             $data['nickname'] = $nickname;
             $data['sex'] = $sex;
             $data['language'] = $language;
             $data['city'] = $city;
             $data['province'] = $province;
             $data['country'] = $country;
             $data['headimgurl'] = $headimgurl;
             $fan->add($data);
         }



       $d=$weObj->getOauthAuth($access_token,$openid); //检验授权凭证access_token是否有效

        $this->redirect('/index');


    }




}
