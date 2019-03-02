<?php
namespace Home\Controller;
use Think\Controller;
Class LoginController extends Controller
{
    Public function index()
    {
                $admin = M("Admin");
                $name = I('user');
               $pass = I('pass');

               $a['name']=$name;
        $userinfo = $admin->where($a)->find();
        if(!$userinfo){
            $this->error('用户名错误','',2);
        }
        else{
        if($userinfo['pass']!==$pass){
            $this->error('密码错误','',2);
        }
        else {
        cookie('name', $name,3600);
        cookie('pass',$pass,3600);
        cookie('num',1,7200);
        $this->redirect('/Backstage');
        }



        }

}
}
