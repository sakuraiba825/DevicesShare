<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class TextbackController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码

            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码

            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);

            $list['title']=$data['title'];
            $list['content']=$data['content'];
            $num=cookie('num');
            for($i=1;$i<$num;$i++)
            {
                $key1='img'.$i;
                $key2='path'.$i;
                $list[$key1]=cookie($key2);
            }
            $list['addtime']=date('Y-m-d H:i:s');

            $text=D('text');
            $text->add($list);
            for($i=1;$i<$num;$i++)
            {
                $key2='path'.$i;
                cookie($key2,null);
            }
            cookie('num',null);
            $this->ajaxReturn($list);
            }


        }






}
