<?php
namespace Home\Controller;
use Think\Controller\RestController;
use WechatSdk\wechat;
class BookController extends RestController
{
    public function index()
    {
        switch ($this->_method) {
            case 'get': // get请求处理代码

                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码


                $request_body = file_get_contents('php://input');
                $data = json_decode($request_body, true);
                $queuemodel=D('queue');
                $goodmodel=D('good');
                $fanmodel=D('fan');

                $id = $data['id'];
                $state = $data['state'];
                $openid = cookie('openid');

                $gid=$queuemodel->where("gid=$id")->count('id');
                $u=$goodmodel->where("id=$id")->find();
                $t['openid']=$openid;
                $t['gid']=$id;
                $g=$queuemodel->where($t)->count('id'); //避免数据重复插入

                $options = array(
                    'token'=>'SlJOepU62dlgzXQUOngE2P61HrEWBc5X', //填写你设定的key
                    'encodingaeskey'=>'Vl7OemQxTbx02QDm7QC3y178vdkuSa53ZgxKKH9gxp3', //填写加密用的EncodingAESKey
                    'appid'=>'wx76ba28fa1ddda905', //填写高级调用功能的app id, 请在微信开发模式后台查询
                    'appsecret'=>'cbe43442bce712a2ffead81e279db7ca' //填写高级调用功能的密钥
                );
                $weObj = new Wechat($options); //创建实例对象


                $uid=$u['uid'];
                //排队人数
                if(isset($id)and !isset($state) ){
                    $a=array();
                    if($gid>0and !empty($uid)){
                        $n=$gid+1;
                        $a['num']=$n;
                        $this->ajaxReturn($a);}
                        else if($gid==0and!empty($uid))
                        {$a['num']=1;
                            $this->ajaxReturn($a);}
                     else if($gid==0 and empty($uid))
                       {$a['num']=0;
                           $this->ajaxReturn($a);}
                }
                    else if (isset($id)and isset($state) and $g==0) {
                    //直接借用
                    if ($state == 0) {
                        $a['uid'] = $openid;
                        $a['state']=1;
                        $goodmodel->where("id=$id")->save($a);


                        $c['openid']= $u['mid'];
                        $master=$fanmodel->where($c)->find();
                        $mastername=$master['nickname'];

                        $date1=date('Y-m-d H:i:s');
                        $date2=date('Y-m-d H:i:s',strtotime("$date1 +1 day"));

                        $list['touser'] = $u['mid'];
                        $list['template_id'] = "WnE7p_bcWnnCZ1hojmD6tbAifR0G0pgE6lI3y_b-I68";
                        $list['url'] = "http://arashi.natapp1.cc/Backstage#/";
                        $list['topcolor'] = "#FF0000";

                        $list['data']['first']['value'] = '您好，有用户借用您的设备 '.$u['name'].' 请您点击此处填入最新的远程账号和远程密码';
                        $list['data']['first']['color'] ="#173177";

                        $list['data']['keyword1'] ['value']= $mastername;
                        $list['data']['keyword1']['color'] ="#173177";

                        $list['data']['keyword2']['value'] = $date2;
                        $list['data']['keyword2']['color'] ="#173177";


                        $list['data']['remark']['value'] = '谢谢您的支持';
                        $list['data']['remark']['color'] ="#173177";

                        $d=$weObj->sendTemplateMessage($list);
                if($d['errcode']==0)
                {$this->ajaxReturn(1);}else{$this->ajaxReturn(0);}
                    }
                    //进入排队
                    else if ($state == 1)
                    {

                            $c['gid'] = $id;
                            $c['my'] = $openid;
                            $queuemodel->add($c);

                        $this->ajaxReturn("预约成功");
                        }

                    }
                }
                }
    }






