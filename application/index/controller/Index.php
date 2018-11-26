<?php
namespace app\index\controller;

use app\common\controller\Base;

use app\common\model\Article;
use think\Db;
use think\facade\Request;

class Index extends Base
{
    protected $map=[];//全局条件
    public function index()
    {
        $this->map[]=['status','=',1];
        $this->search();
        $this->showArt();
        return $this->fetch();
    }
    //搜索
    public function search()
    {
        $keywords=Request::param('keywords');
        if (!empty($keywords)){
            $this->map[]=['title','like','%'.$keywords.'%'];
        }

    }
    //文章显示
    public function showArt()
    {
        $cateId=Request::param('cate');
        if (isset($cateId)){
            $this->map[]=['cate_id','=',$cateId];
        }
        $artList = Db::table('zh_article')->where( $this->map)->order('update_time','desc')->paginate(5);
        $this->assign('artList',$artList);
    }
}
