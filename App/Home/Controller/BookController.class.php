<?php
namespace Home\Controller;
use Think\Controller\RestController;
use WechatSdk\wechat;

/*预约设备控制器*/
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

                //获取前端传来的数据
                $request_body = file_get_contents('php://input');
                $data = json_decode($request_body, true);

                $GoodId = $data['id'];
                $State = $data['state'];
                $Openid = cookie('openid');
                
                //实例化对象
                $Queuemodel=D('queue');
                $Goodmodel=D('good');
                $Fanmodel=D('fan');


                //创建wechat 类的实例对象
                $options = array(
                    'token'=>'SlJOepU62dlgzXQUOngE2P61HrEWBc5X', //填写你设定的key
                    'encodingaeskey'=>'Vl7OemQxTbx02QDm7QC3y178vdkuSa53ZgxKKH9gxp3', //填写加密用的EncodingAESKey
                    'appid'=>'wx76ba28fa1ddda905', //填写高级调用功能的app id, 请在微信开发模式后台查询
                    'appsecret'=>'cbe43442bce712a2ffead81e279db7ca' //填写高级调用功能的密钥
                );
                $weObj = new Wechat($options);

                $SizeOfQueue=$Queuemodel->where("gid=$GoodId")->count('id');
                $Good=$Goodmodel->where("id=$GoodId")->find();

                //预约队列中是否有这个数据，避免数据重复插入
                $Search['openid']=$Openid;
                $Search['gid']=$GoodId;
                $Existence=$Queuemodel->where($Search)->count('id');


                $Search2['openid'] = $Good['masteropenid'];
                $MasterOfGood = $Fanmodel->where($Search2)->find();

                $OpenidOfUser=$Good['UserOpenid'];
                
                //统计排队人数
                if(isset($GoodId)and !isset($State) ){
                   
                    $Return1=array();
                    
                    //队列中有人
                    if($SizeOfQueue>0and !empty($OpenidOfUser)){
                        //正在排队的用户加上正在使用的用户
                        $QueueNumber=$SizeOfQueue+1;
                        $Return1['num']=$QueueNumber;
                        $this->ajaxReturn($Return1);}
                        else if($SizeOfQueue==0and!empty($OpenidOfUser)) {
                        //没有用户在排队，只有一个正在使用的用户
                            $Return1['num']=1;
                            $this->ajaxReturn($Return1);}
                     else if($SizeOfQueue==0 and empty($OpenidOfUser)) {
                        //没有用户在排队，也没有用户在使用这个设备
                        $Return1['num']=0;
                           $this->ajaxReturn($Return1);}
                }
                
                //借用设备或者进入队列
                
                    else if (isset($GoodId)and isset($State) and $Existence==0) {
                   
                    //直接借用
                   if ($State == 0) {

                       $GoodUpdate1['useropenid'] = $Openid;
                        $GoodUpdate1['state'] = 1;//修改设备状态为借用
                        $Goodmodel->where("id=$GoodId")->save($GoodUpdate1);

                        //计算账号密码最新的更新时间
                       $timediff=time()-$Good['updatetime'];

                        $days = $timediff/86400;

                        $returntest['time']=$Good['updatetimeime'];
                        $returntest['days']=$days;


                        //最近12小时更新过，直接给设备使用者返回账号密码。
                        if ($days <0.5) {

                            $list['touser'] = $Openid;
                            $list['template_id'] = "5sYX2CpGSnu2DC3VgAA4AHJmYo6BkyGElui0LpKO6k4";
                            $list['url'] = "http://arashi.natapp1.cc";
                            $list['topcolor'] = "#FF0000";

                            $list['data']['keyword1']['value'] = '您已成功预约设备' . $Good['name'];
                            $list['data']['keyword1']['color'] = "#173177";

                            $list['data']['keyword2'] ['value'] = date('Y-m-d H:i:s');
                            $list['data']['keyword2']['color'] = "#173177";

                            $list['data']['keyword3']['value'] = $MasterOfGood['relname'];
                            $list['data']['keyword3']['color'] = "#173177";

                            $list['data']['keyword4']['value'] = $Good['phone'];
                            $list['data']['keyword4']['color'] = "#173177";

                            $list['data']['keyword5']['value'] = $Good['address'];
                            $list['data']['keyword5']['color'] = "#173177";
                            $remark = 'ID:' . $Good['account'] . '密码:' . $Good['password'];
                            $list['data']['remark']['value'] = $remark;
                            $list['data']['remark']['color'] = "#173177";
                            $ReturnCode = $weObj->sendTemplateMessage($list);
                            //通过返回的代码判断发送信息是否成功
                            if ($ReturnCode['errcode'] == 0) {
                               // $this->ajaxReturn($returntest);
                               $this->ajaxReturn(1);
                            } else {
                                $this->ajaxReturn(0);
                            }
                        } else {

                            //最近12小时没有更新过，给设备主人发送填写账号和密码 的信息
                            $date1 = date('Y-m-d H:i:s');
                            $date2 = date('Y-m-d H:i:s', strtotime("$date1 +1 hour"));

                            $list['touser'] = $Good['masteropenid'];
                            $list['template_id'] = "WnE7p_bcWnnCZ1hojmD6tbAifR0G0pgE6lI3y_b-I68";
                            $list['url'] = "http://arashi.natapp1.cc/Backstage#/";
                            $list['topcolor'] = "#FF0000";

                            $list['data']['first']['value'] = '您好，有用户借用您的设备 ' . $Good['name'] . ' 请您点击此处填入最新的远程账号和远程密码';
                            $list['data']['first']['color'] = "#173177";

                            $list['data']['keyword1'] ['value'] = $MasterOfGood['nickname'];
                            $list['data']['keyword1']['color'] = "#173177";

                            $list['data']['keyword2']['value'] = $date2;
                            $list['data']['keyword2']['color'] = "#173177";


                            $list['data']['remark']['value'] = '谢谢您的支持';
                            $list['data']['remark']['color'] = "#173177";

                            $ReturnCode = $weObj->sendTemplateMessage($list);
                            if ($ReturnCode['errcode'] == 0) {
                             //   $this->ajaxReturn($list);
                                $this->ajaxReturn(1);
                            } else {
                                $this->ajaxReturn(0);
                            }
                        }
                      }
                    //进入排队
                    else if ($State == 1)
                    {

                            $InQueue['gid'] = $GoodId;
                            $InQueue['my'] = $Openid;
                            $Queuemodel->add($InQueue);

                        $this->ajaxReturn("预约成功");
                        }


                    }
                }
              }
    }






