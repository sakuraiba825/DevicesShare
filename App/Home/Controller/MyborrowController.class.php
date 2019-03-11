<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class MyborrowController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码

                $openid=cookie('openid');
                $goodmodel=D('good');

                $a['useropenid'] = $openid;
                $gid = $goodmodel->where($a)->field('id')->order('id desc')->select();
                $num = sizeof($gid);
                $arr = array();
                for ($i = 0; $i < $num; $i++) {
                    $id = $gid[$i]['id'];
                    $good = $goodmodel->where("id=$id")->field('id,name,detail,img1,state,phone,address')->find();
                    $arr[$i] = $good;
                }
                $this->ajaxReturn($arr);

            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码

    }

}
}
