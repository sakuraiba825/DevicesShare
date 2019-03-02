<?php
namespace Home\Controller;
use Think\Controller\RestController;

class MybookController extends RestController
{
    public function index()
    {
        switch ($this->_method) {
            case 'get': // get请求处理代码

                $openid=cookie('openid');

                $queue=D('queue');
                $goodmodel=D('good');

                $a['my']=$openid;
                $gid=$queue->where($a)->field('gid')->order('id desc')->select();
                $num=sizeof($gid);
                $arr=array();
                for($i=0;$i<$num;$i++) {
                    $id=$gid[$i]['gid'];
                    $good = $goodmodel->where("id=$id")->field('name,detail,img1,state,phone,address')->find();
                    $n=$queue->where("gid=$id")->count('id');
                    $good['num']=$n;
                    $arr[$i]=$good;
                }
                $this->ajaxReturn($arr);
                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码


        }
    }
}





