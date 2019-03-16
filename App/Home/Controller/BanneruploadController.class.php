<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class BanneruploadController extends RestController
{
    Public function index()
    {


        switch ($this->_method) {
            case 'get': // get请求处理代码
                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码
                $type=explode(".",$_FILES['file']['name']);

                $stored_path = 'Uploads/banner/'.time().'.'.$type[1];
                $num=cookie('num');
                $key='path'.$num;
                cookie($key,$stored_path);
                $a=move_uploaded_file($_FILES['file']['tmp_name'],$stored_path);
                if($a=='true')
                {
                    $value=$num+1;
                    cookie('num',$value);
                }
                $list['url']=$stored_path;
                D('banner')->add($list);
                echo $stored_path;
                    }





        }



}
