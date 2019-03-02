<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class MygoodsController extends RestController
{
    public function index()
    {

        switch ($this->_method) {
            case 'get': // get请求处理代码

                $openid =cookie('openid');
                $a['mid']=$openid;
                $goodmodel=D('good');

                $good =  $goodmodel->where($a)->field('name,detail,img1,state')->select();

                $this->ajaxReturn($good);
                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码



        }

    }
}

