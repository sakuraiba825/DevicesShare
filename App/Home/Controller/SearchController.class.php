<?php
namespace Home\Controller;
use Think\Controller\RestController;
class SearchController extends RestController
{
    public function index()
    {
        switch ($this->_method) {
            case 'get': // get请求处理代码

                    $keyword = I('search');
                    $good=M('good');

                    $map['name|model']  = array("like","%".$keyword."%");
                    // 把查询条件传入查询方法
                $goods=$good->where($map)->field('id,name,detail,model,img1,state,phone,address,mname')->order('searchtime desc')->select();

                $num=$good->where($map)->field('name')->count('id');

                if(is_null($goods[0]))
                {
                    $this->redirect('/search');

                }else{
                    for($i=0;$i<$num;$i++)
                    {
                        $a['id']=$goods[$i]['id'];
                        $t=$good->where($a)->find();
                        $data['searchtime']=$t['searchtime']+1;
                        $good->where($a)->save($data);
                    }
                    $this->ajaxReturn($goods);
                }

                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码


        }

    }
}