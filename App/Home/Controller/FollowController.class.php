<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class FollowController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码
            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码

            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);
            //添加联系人
        $contact=D('contact');
            if($data['state']==1)
            {
                $a['linkman']=$data['openid'];
                $a['me']=cookie('openid');
                $contact->add($a);
            }else if($data['state']==0)
            { $a['linkman']=$data['openid'];
                $a['me']=cookie('openid');
                $contact->where($a)->delete();
            }
    }

}
}
