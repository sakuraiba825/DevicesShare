<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class GoodbadController extends RestController
{
    public function index()
    {

        switch ($this->_method) {
            case 'get': // get请求处理代码

                $id = I('id');
                $gb=I('gb');
                $reply=D('reply');
                $judge=D('judge');

                $data = $reply->where("id=$id")->find();

                $openid = cookie('openid');

                $a['openid'] = $openid;
                $a['rid'] = $id;
                $a['state']=0;
                $good = $judge->where($a)->count('id');

                $z['openid'] = $openid;
                $z['rid'] = $id;
                $z['state']=1;
                $bad = $judge->where($z)->count('id');
                if ($gb == "g" and $good==0) {
                    $b['good'] = $data['good'] + 1;
                 $reply->where("id=$id")->save($b);

                    $c['rid'] = $id;
                    $c['openid'] = $openid;
                    $c['goodtime'] = date('Y-m-d H:i:s');
                    $c['state']=0;
                    $judge->add($c);
                    $this->ajaxReturn("g1");

                } else if ($gb == "g" and $good!=0){
                    $this->ajaxReturn("g0");
                }

                if ($gb == "b" and $bad==0) {
                    $b['bad'] = $data['bad'] + 1;
                    $reply->where("id=$id")->save($b);

                    $c['rid'] = $id;
                    $c['openid'] = $openid;
                    $c['badtime'] = date('Y-m-d H:i:s');
                    $c['state']=1;
                    $judge->add($c);
                    $this->ajaxReturn("b1");

                } else if ($gb == "b" and $bad!=0){
                    $this->ajaxReturn("b0");
                }
                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码


        }

    }
}

