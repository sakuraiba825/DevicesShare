<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class FileshowController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码
            $model = D('file');
            intval($_GET['limit']) ? $limit = $_GET['limit'] : $limit = 10;
            $list = $model->limit($limit)->select();

            $this->ajaxReturn($list);
            break;
        case 'put': // put请求处理代码id
            break;
        case 'post': // post请求处理代码

    }

}
}
