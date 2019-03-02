<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class ReturnController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码

            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码

            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);

            $queue=D('queue');
            $good=D('good');
            $id = $data['id'];

            //判断设备队列人数
            $gid=$queue->where("gid=$id")->count('id');
            $u=$good->where("id=$id")->find();

                if($gid>0){
                    //队列有人，选id最小的最早进入队列的人出队列借用设备
                    $a=$queue->where("gid=$id")->min('id');
                    $uid=$a['my'];

                    $b['uid']=$uid;
                    $good->where("id=$id")->save($b);



                    $c['my']=$uid;
                    $c['gid']=$id;
                    $queue->where($c)->delete();
                    $this->ajaxReturn(1);
            }
            else
                {
                    //队列无人，把设备状态从借用改为空闲
                    $a['uid']='';
                    $a['state']=0;
                    $good->where("id=$id")->save($a);
                    $this->ajaxReturn(1);
                }
    }
    }

}
