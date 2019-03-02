<?php
namespace Home\Controller;
use Think\Controller;
use WechatSdk\wechat;
Class PasswordController extends Controller
{
    Public function index()
    {

                $request_body = file_get_contents('php://input');
                $data = json_decode($request_body, true);
                $a['id'] = $data['id'];

                $goodmodel=D('good');

                $password['account']=$data['number'];
                $password['password']=$data['passwd'];
                $good=$goodmodel->where($a)->find();
        $goodmodel->where($a)->save($password);

                $options = array(
                    'token' => 'SlJOepU62dlgzXQUOngE2P61HrEWBc5X', //填写你设定的key
                    'encodingaeskey' => 'Vl7OemQxTbx02QDm7QC3y178vdkuSa53ZgxKKH9gxp3', //填写加密用的EncodingAESKey
                    'appid' => 'wx76ba28fa1ddda905', //填写高级调用功能的app id, 请在微信开发模式后台查询
                    'appsecret' => 'cbe43442bce712a2ffead81e279db7ca' //填写高级调用功能的密钥
                );
                $weObj = new Wechat($options);

                $good = $goodmodel->where($a)->find();
                $b['openid'] = $good['uid'];

                $fanmodel=D('fan');
                $c = $fanmodel->where($b)->find();

                $list['touser'] = $good['uid'];
                $list['template_id'] = "5sYX2CpGSnu2DC3VgAA4AHJmYo6BkyGElui0LpKO6k4";
                $list['url'] = "http://arashi.natapp1.cc";
                $list['topcolor'] = "#FF0000";

                $list['data']['keyword1']['value'] = '您已成功预约设备' . $good['name'];
                $list['data']['keyword1']['color'] ="#173177";

                $list['data']['keyword2'] ['value']= date('Y-m-d H:i:s');
                $list['data']['keyword2']['color'] ="#173177";

                $list['data']['keyword3']['value'] = $c['relname'];
                $list['data']['keyword3']['color'] ="#173177";

                $list['data']['keyword4']['value'] = $good['phone'];
                $list['data']['keyword4']['color'] ="#173177";

                $list['data']['keyword5']['value'] = $good['address'];
                $list['data']['keyword5']['color'] ="#173177";
                $remark = '远程账号为' . $data['number'] . '远程密码为' . $data['passwd'];
                $list['data']['remark']['value'] = $remark;
                $list['data']['remark']['color'] ="#173177";


                $d=$weObj->sendTemplateMessage($list);
                if($d['errcode']==0)
                {$this->ajaxReturn($d);}else{$this->ajaxReturn($d);}
    }

}






