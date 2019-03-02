<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class MessageController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码

            $openid=cookie('openid');
            $fan=D('fan');
            $a['openid']=$openid;


            if(isset($_GET['relname']))
            {
                $list['relname']=$_GET['relname'];

                $fan->where($a)->save($list);
                $this->ajaxReturn(1);
            }
            else if(isset($_GET['class']))
            {
                $list['class']=$_GET['class'];
                $fan->where($a)->save($list);
                $this->ajaxReturn(1);
            }
            else if(isset($_GET['stuid']))
            {
                $list['stuid']=$_GET['stuid'];
                $fan->where($a)->save($list);
                $this->ajaxReturn(1);
            }
            else  if(isset($_GET['mobile']))
            {
                $list['mobile']=$_GET['mobile'];
                $fan->where($a)->save($list);
                $this->ajaxReturn(1);
            }
            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码

    }

}
}
