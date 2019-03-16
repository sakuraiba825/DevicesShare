<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class FiledownloadController extends RestController {
Public function index() {
    switch ($this->_method){
        case 'get': // get请求处理代码

            break;
        case 'put': // put请求处理代码
            break;
        case 'post': // post请求处理代码


            $filename = $_GET['filename'];

// 修改这一行设置你的文件下载目录
            $download_path = "./Uploads/file/";

// 不能下载上一层目录的文件
            if(eregi("\.\.", $filename)) die("抱歉，你不能下载该文件！");
            $file = str_replace("..", "", $filename);

// 包含 .ht 的文件不能下载
            if(eregi("\.ht.+", $filename)) die("抱歉，你不能下载该文件！");

// 创建文件下载路径
            $file = "$download_path$file";

// 判断文件是否存在
            if(!file_exists($file)) die("抱歉，文件不存在！");

//  文件类型，作为头部发送给浏览器
            $type = filetype($file);

// 获取时间和日期
            $today = date("F j, Y, g:i a");
            $time = time();

// 发送文件头部
            header("Content-type: $type");
            header("Content-Disposition: attachment;filename=$filename");
            header("Content-Transfer-Encoding: binary");
            header('Pragma: no-cache');
            header('Expires: 0');
// 发送文件内容
            set_time_limit(0);
            readfile($file);
    }

}
}
