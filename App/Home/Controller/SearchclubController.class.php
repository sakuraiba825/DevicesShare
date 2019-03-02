<?php
namespace Home\Controller;
use Think\Controller\RestController;
class SearchclubController extends RestController
{
    public function index()
    {
        switch ($this->_method) {
            case 'get': // get请求处理代码

                    $keyword = I('search');
                    $club=M('club');

                    $map['name']=array("like","%".$keyword."%");
                    // 把查询条件传入查询方法
                $clubs=$club->where($map)->field('name')->order('searchtime desc')->select();
                $num=$club->where($map)->field('name')->count('id');

                    if(is_null($clubs[0]))
                    {
                        $this->redirect('/search');

                    }else{
                        for($i=0;$i<$num;$i++)
                        {
                            $a['id']=$clubs[$i]['id'];
                            $t=$club->where($a)->find();
                            $data['searchtime']=$t['searchtime']+1;
                            $club->where($a)->save($data);
                        }
                        $this->ajaxReturn($clubs);
                    }

                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码


        }

    }
}