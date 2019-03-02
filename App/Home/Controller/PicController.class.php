<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class PicController extends RestController
{
    Public function index()
    {
        //把图片存入服务器
        switch ($this->_method){
            case 'get': // get请求处理代码
                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码
                $type=explode(".",$_FILES['file']['name']);

                $stored_path = 'Uploads/text/'.time().'.'.$type[1];
                $num=cookie('num');
                $key='path'.$num;
                cookie($key,$stored_path);
                $a=move_uploaded_file($_FILES['file']['tmp_name'],$stored_path);
                if($a=='true')
                {
                    $value=$num+1;
                    cookie('num',$value);
                }
                echo $stored_path;
        }

    }
}
