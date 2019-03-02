<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class ReplyaddController extends RestController
{
    Public function index()
    {

        switch ($this->_method) {
            case 'get': // get请求处理代码

                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码
                $request_body = file_get_contents('php://input');
                $data = json_decode($request_body, true);
                $id=$data['id'];
                $openid=cookie('openid');
                $fanmodel=D('fan');
                $a['openid']=$openid;
                $person=$fanmodel->where($a)->find();


                $list['topics_id']=$data['id'];
                $list['addtime'] = time();
                $list['content'] = $data['content'];
                $list['openid']=$openid;
                $list['nickname']=$person['nickname'];
                $list['headimgurl']=$person['headimgurl'];
                $list['good']=0;
                $list['bad']=0;
                $reply=D('reply');
                $reply->add($list);

                $topics = D('topics');

                $topic=$topics->where("id=$id")->find();
                $data['reply_count']=$topic['reply_count']+1;
                $topics->where("id=$id")->save($data);

                $this->ajaxReturn("success");


        }

    }

}