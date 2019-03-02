<?php
namespace Home\Controller;
use Think\Controller\RestController;
class SearchtopicsController extends RestController
{
    public function index()
    {
        switch ($this->_method) {
            case 'get': // get请求处理代码

                    $keyword = I('search');
                    $topic=M('topic');

                    $map['title|content']=array("like","%".$keyword."%");
                    // 把查询条件传入查询方法
                $topics=$topic->where($map)->field('title,content,img1,nickname')->order('searchtime desc')->select();
                $num=$topic->where($map)->field('name')->count('id');

                    if(is_null($topics[0]))
                    {
                        $this->redirect('/search');

                    }else{
                        for($i=0;$i<$num;$i++)
                        {
                            $a['id']=$topics[$i]['id'];
                            $t=$topic->where($a)->find();
                            $data['searchtime']=$t['searchtime']+1;
                            $topic->where($a)->save($data);
                        }
                        $this->ajaxReturn($topics);
                    }

                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码


        }

    }
}