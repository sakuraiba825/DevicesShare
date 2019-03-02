<?php
namespace Home\Controller;
use Think\Controller\RestController;
Class DetailController extends RestController
{
    public function index()
    {

        switch ($this->_method) {
            case 'get': // get请求处理代码

                $topics_id=I('id');
                $a['topics_id']=$topics_id;

                $replymodel=D('reply');
                $topicmodel=D('topic');

                $reply = $replymodel->where($a)->field('id,nickname,content,headimgurl,good,bad')->select();
                $data['reply']=$reply;
                $t = $replymodel->where("topics_id=$topics_id")->select();
                $num=$replymodel->where("topics_id=$topics_id")->count();
                for($i=0;$i<$num;$i++)
                {
                    $time=$t[$i]['addtime'];

                    $rtime = date("m-d H:i",$time);
                    $htime = date("H:i",$time);

                    $time = time() - $time;

                    if ($time < 60) {
                        $str = '刚刚';
                    }
                    elseif ($time < 60 * 60) {
                        $min = floor($time/60);
                        $str = $min.'分钟前';
                    }
                    elseif ($time < 60 * 60 * 24) {
                        $h = floor($time/(60*60));
                        $str = $h.'小时前 '.$htime;
                    }
                    elseif ($time < 60 * 60 * 24 * 3) {
                        $d = floor($time/(60*60*24));
                        if($d==1)
                            $str = '昨天 '.$rtime;
                        else
                            $str = '前天 '.$rtime;
                    }
                    else {
                        $str = $rtime;
                    }

                    $data['reply'][$i]['time']=$str;
                }

                $t=$topicmodel->where("id=$topics_id")->find();
                $data2=$topicmodel->where("id=$topics_id")->field('title,nickname,content,addtime')->find();

                $data['topic_title']=$data2['title'];
                $data['topic_nickname']=$data2['nickname'];
                $data['topic_content']=$data2['content'];
                $data['topic_addtime']=$data2['addtime'];
                $imgs=array();
                for($i=1;$i<6;$i++)
                {
                    $img='img'.$i;
                    if($t[$img]=="")
                    {break;}
                    else{
                        $a=$t[$img];
                        $imgs[]=$a;
                    }
                }

                $data['imgs']=$imgs;

                $this->ajaxReturn($data);

                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码

        }

    }

}

