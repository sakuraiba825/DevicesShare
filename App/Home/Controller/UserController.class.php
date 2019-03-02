<?php
/**
 * Created by PhpStorm.
 * User: xieyu
 * Date: 2018/8/22
 * Time: 22:00
 */
namespace Home\Controller;
use Think\Controller\RestController;
class UserController extends RestController
{
    Public function index()
    {
        switch ($this->_method) {
            case 'get': // get请求处理代码
                $openid=cookie('openid');
                $fan=D('fan');

                $a['openid'] = $openid;
                $data = $fan->where($a)->field('headimgurl,relname,class,stuid')->find();
                $b=$fan->where($a)->find();
                $c=$b['sex'];
                if($c==1)
                {$data['sex']='男';}
                else
                    {$data['sex']='女';}
                $this->ajaxReturn($data);
                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码

        }
    }
}