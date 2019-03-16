<?php
namespace Home\Controller;
use Think\Controller\RestController;
class FilesearchController extends RestController
{
    public function index()
    {
        switch ($this->_method) {
            case 'get': // get请求处理代码

                    $keyword = I('search');
                    $model=D('file');

                    $map['name']=array("like","%".$keyword."%");
                    // 把查询条件传入查询方法
                    $result=$model->where($map)->select();

                    $this->ajaxReturn($result);



                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码


        }

    }
}