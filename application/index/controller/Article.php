<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/31
 * Time: 15:37
 */

namespace app\index\controller;

use app\common\controller\Base;
use think\Db;
use think\facade\Request;
use app\common\model\Article as ArtModel;
class Article  extends Base
{
    public function index()
    {
        $this->isLogin();//检查是否未登录
        $this->assign('title','发布新闻');
        return $this->fetch('index');
    }
    //添加文章
    public function insert()
    {
        if (Request::isPost()){
            $data=Request::post();

            $rule='app\common\validate\Article';
            $res=$this->validate($data,$rule);
            if (true!==$res){
                return $this->error($res);
            }else{
                //获取上传的文件信息
                if (!Request::file()){
                    $this->error('请上传标题图片');
                }
                $file=Request::file('title_img');
                $info=$file->validate([
                    'size'=>10485760,
                    'ext'=>'jpeg,jpg,png,gif',
                ])->move('uploads');
                if ($info){
                    $data['title_img'] = $info->getSaveName();

                }else{
                     $this->error($file->getError());
                }

                if (ArtModel::create($data)){
                    $this->success('发布成功','/index.php');
                }else{
                    $this->error('发布失败');
                }
            }

        }else{
             $this->error('请求类型错误');
        }
    }
    //显示文章详细信息
    public function detail()
    {
        $data=Request::param('id');
        $artList= ArtModel::get(function ($query)use($data){
            $query->where('status','1')->where('id',$data)->setInc('pv');
        }) ;
        $this->assign('artList',$artList);
        $this->assign('title',$artList['title']);
        return $this->fetch('detail');
    }

}