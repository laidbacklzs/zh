<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 17:26
 */

namespace app\index\controller;


use app\common\controller\Base;
use think\facade\Request;
use app\common\model\User as UserModel;
use think\facade\Session;

class User extends Base
{
    public function register()
    {
        $this->assign('title','用户注册');
        return $this->fetch('register');
    }
    public function insert()
    {
        if (Request::isAjax()){
            $data=Request::post();
            $rule='app\common\validate\User';
            $info=$this->validate($data,$rule);
            if ($info===true){
                if ($res=UserModel::create($data)){
                    $result=UserModel::get($res->id);
                    Session::set('user_id',$result->id);
                    Session::set('user_name',$result->name);
                    return['status'=>1,'message'=>'恭喜注册成功！'];
                }else{
                    return['message'=>'注册失败'];
                }
            }else{
                return['message'=>$info];
            }
        }else{
            return['message'=>'请求类型错误'];
        }

    }
    public function login()
    {
        $this->hasLogin();
        $this->assign('title','用户登录');
        return $this->fetch('login');
    }
    public function loginCheck()
    {
        if (Request::isAjax()){
            $data=Request::post();
            $rule=['email|邮箱'=>'require|email','password|密码'=>'require|alphaNum'];
            $info=$this->validate($data,$rule);
            if ($info===true){
                $res=UserModel::get(function ($query)use($data){
                   $query->where('email',$data['email'])
                       ->where('status',1)
                       ->where('password',sha1($data['password']));
                });
                if ($res){
                    Session::set('user_id',$res->id);
                    Session::set('user_name',$res->name);
                    Session::set('user_level',$res->is_admin);
                    return['status'=>1,'message'=>'登录成功！'];
                }else{
                    return ['message'=>'登录失败，邮箱或密码不正确'];
                }
            }else{
                return['message'=>$info];
            }
        }else{
            return['message'=>'请求类型错误'];
        }
    }
    public function logout()
    {
        Session::clear();
        $this->success('退出登录成功','/');
    }

}