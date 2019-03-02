<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class TextfrontController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码
            $model = D('text');
            intval($_GET['limit']) ? $limit = $_GET['limit'] : $limit = 5;
            $list = $model->field('id,title,content,addtime')->order('addtime desc')->limit($limit)->select();

            $this->ajaxReturn($list);
            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码



    }

}
}
