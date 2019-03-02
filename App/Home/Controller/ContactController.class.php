<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class ContactController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码
            // $openid=cookie('openid');
            $openid="oKLlQ1AoMNtnyiPYUa7pWRohW5iI";

            $contactmodel=D('contact');
            $fanmodel=D('fan');
            $goodmodel=D('good');
            //常用联系人
            $a['me']=$openid;
            $linkmanid = $contactmodel->where($a)->field('linkman')->select();
            $num=$contactmodel->where($a)->field('linkman')->count('id');
            for($i=0;$i<$num;$i++)
            {
                $b['openid']=$linkmanid[$i]['linkman'];

                $master=$fanmodel->where($b)->find();
                $data['contact'][$i]['openid']=$master['openid'];
                $data['contact'][$i]['headimgurl']=$master['headimgurl'];
                $data['contact'][$i]['relname']=$master['relname'];
                $data['contact'][$i]['mobile']=$master['mobile'];
                $data['contact'][$i]['state']=1;

            }
            //排队预约设备的联系人
            $a['my']=$openid;
            $bookid = D('queue')->where($a)->field('gid')->select();
            $num=D('queue')->where($a)->field('gid')->count('id');
            for($i=0;$i<$num;$i++)
            {
                $goods_id=$bookid[$i]['gid'];
                $good=$goodmodel->where("id=$goods_id")->find();

                $b['openid']=$good['mid'];

                $master=$fanmodel->where($b)->find();
                $data['book'][$i]['openid']=$master['openid'];
                $data['book'][$i]['headimgurl']=$master['headimgurl'];
                $data['book'][$i]['relname']=$master['relname'];
                $data['book'][$i]['mobile']=$master['mobile'];
                $data['book'][$i]['goodsname']=$good['name'];
                $data['book'][$i]['state']=0;

            }
            //正在借用设备的联系人
            $a['uid']=$openid;
            $borrowid = $goodmodel->where($a)->field('id')->select();

            $num=$goodmodel->where($a)->field('id')->count('id');

            for($i=0;$i<$num;$i++)
            {
                $goods_id=$borrowid[$i]['id'];
                $good=$goodmodel->where("id=$goods_id")->find();

                $b['openid']=$good['mid'];

                $master=$fanmodel->where($b)->find();
                $data['borrow'][$i]['openid']=$master['openid'];
                $data['borrow'][$i]['headimgurl']=$master['headimgurl'];
                $data['borrow'][$i]['relname']=$master['relname'];
                $data['borrow'][$i]['mobile']=$master['mobile'];
                $data['borrow'][$i]['goodsname']=$good['name'];
                $data['borrow'][$i]['state']=0;

            }
            $this->ajaxReturn($data);
            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码



    }

}
}
