<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class GoodsaddController extends RestController
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

                $fan=D('fan');

                $s['openid']=$openid;
                $master=$fan->where($s)->find();
                $relname=$master['relname'];

                $list['name'] = $data['title'];
                $list['addtime'] = date('Y-m-d H:i:s');
                $list['detail'] = $data['content'];
                $list['model'] = $data['num'];
                $list['classid']=$data['selectvalue']['value']+1;
                $list['masteropenid']=$openid;
                $list['masterrealName']=$relname;
                $list['phone']=$master['mobile'];
              //  $list['address']=$data['address'];
                //$list['account']=$data['account'];
               //$list['password']=$data['password'];


                $i=0;
                while(isset($data['files'][$i]['url'])&&$i<5) {
                    $base64_image_content = $data['files'][$i]['url'];
                    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
                        $type = $result[2];
                        $new_file = "Uploads/goods/";
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


                $goods = D('good');

                $goods->add($list);
            $this->ajaxReturn(1);


            }




        }



}
