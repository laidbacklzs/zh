<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 14:45
 */

namespace app\common\controller;
use app\common\model\Article;
use think\Controller;
use app\common\model\ArtCate;
use think\facade\Session;

class Base extends Controller
{
    protected function initialize()
    {
        $this->showCate();
        $this->showHot();

    }

    //显示导航分类
    protected function showCate()
    {
        $cateList=ArtCate::all()->where('status','1')->order('sort','asc');
        $this->assign('cateList',$cateList);
    }
    //显示热门排行
    protected function showHot()
    {
        $artHot = Article::where('status', '1')->limit(10)->order('pv', 'desc')->select();

        $this->assign('artHot', $artHot);
    }
    //检查是否已登录
    protected function hasLogin()
    {
        if (Session::has('user_id')){
            $this->error('您已登录过了');
        }
    }
    //检查是否未登录
    protected function isLogin()
    {
        if (!Session::has('user_id')){
            $this->error('请您先登录','user/login');
        }
    }

}