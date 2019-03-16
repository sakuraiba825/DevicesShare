<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class BannershowController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码
            $model = D('banner');
            intval($_GET['limit']) ? $limit = $_GET['limit'] : $limit = 5;
            $list = $model->field('uid,url')->limit($limit)->select();

            $this->ajaxReturn($list);
            break;
        case 'put': // put请求处理代码id
            break;
        case 'post': // post请求处理代码

    }

}
}
