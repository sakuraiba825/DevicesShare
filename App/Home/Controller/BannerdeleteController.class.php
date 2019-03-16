<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class BannerdeleteController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码

            break;
        case 'put': // put请求处理代码id
            break;
        case 'post': // post请求处理代码
            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);
            $id=$data['uid'];

            $search['uid']=$id;
            $bannermodel=D('banner');
            $bannermodel->where($search)->delete();
    }

}
}
