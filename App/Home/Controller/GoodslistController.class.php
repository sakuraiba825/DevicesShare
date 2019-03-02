<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class GoodslistController extends RestController {
//    public function _initialize(){
//        if(cookie('pass')==null){
//            $this->redirect("/login");
//        }
//    }
    Public function index() {
    switch ($this->_method) {
        case 'get': // get请求处理代码

            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码
            $goods = D('good');

            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);
            $size=$data['size'];
            $page=$data['page'];
            $list = $goods->field('id,img1,name,detail')->order('addtime desc')->limit($size)->page($page)->select();

            $this->ajaxReturn($list);

    }
}

}
