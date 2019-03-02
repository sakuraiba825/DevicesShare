<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class TopicsaddController extends RestController
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


                $openid=cookie('openid');
                $nickname=cookie('nickname');
                $list=array();
                $list['title'] = $data['title'];
                $list['addtime'] = date('Y-m-d H:i:s');
                $list['content'] = $data['content'];
                $list['openid']=$openid;
                $list['nickname']=$nickname;

                //上传图片
                $i=0;
                while(isset($data['files'][$i]['url'])and $i<9) {
                    $base64_image_content = $data['files'][$i]['url'];
                    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
                        $type = $result[2];
                        $new_file = "Uploads/topics/";
                        if (!file_exists($new_file)) {
                            //检查是否有该文件夹，如果没有就创建，并给予最高权限
                            mkdir($new_file, 0700);
                        }
                        $new_file = $new_file . time() .$i. ".{$type}";

                        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {

                            $i++;
                            $a='img'.$i;
                            $list[$a]=$new_file;

                            //return '/' . $new_file;
                        }
                    }
                }
                $topic= M('topic');
                $topic->add($list);
                $this->ajaxReturn($list);


                //   $this->ajaxReturn("success");


        }

    }

}