<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class FileuploadController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码

            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码

                $BootName1 = "./Uploads/file/";
                $BootName2="Uploads/file/";

                //把文件名和后缀名分开
                $arr = explode(".", $_FILES['file']['name']);
                //从原来的临时文件移动到指定路径
                $url = $BootName1.time().'.'.$arr[1];
                $bool = move_uploaded_file($_FILES['file']['tmp_name'], $url);
                if ($bool) {
                    $list['extension']=$arr[1];
                    $list['address']=$BootName2.time().'.'.$arr[1];
                    $list['name']=$arr[0];
                    D('file')->add($list);
                   $this->ajaxReturn($list);

                }else{
                    $this->ajaxReturn(0);

                }
            }

    }

}

