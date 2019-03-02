<?php
namespace Home\Controller;
use Think\Controller\RestController;
class HotsearchController extends RestController
{
    public function index()
    {
        switch ($this->_method) {
            case 'get': // get请求处理代码
                $type=I('type');
                if($type=='goods')
                {
                    $data=D('good')->field('name,img1,searchtime')->order('searchtime desc')->select();
                    $this->ajaxReturn($data);
                }elseif ($type=='topics')
                { $data=D('topic')->field('title,img1,searchtime')->order('searchtime desc')->select();
                    $this->ajaxReturn($data);}
                    elseif($type=='clubs')
                    { $data=D('club')->field('name,searchtime')->order('searchtime desc')->select();
                        $this->ajaxReturn($data);}

                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码


        }

    }
}