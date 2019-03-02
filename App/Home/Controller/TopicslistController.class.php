<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class TopicslistController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码

            $model = D('topic');
            intval($_GET['limit']) ? $limit = $_GET['limit'] : $limit = 5;
            $list = $model->field('id,img1,title,reply_count')->order('addtime desc')->limit($limit)->select();

            $this->ajaxReturn($list);
            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码


        }
    }


}
