<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/31
 * Time: 11:57
 */

namespace app\common\model;

use think\Model;
class ArtCate extends Model
{
    protected $pk='id';//主键
    protected $table='zh_article_category';//数据表
    protected $autoWriteTimestamp=true;//开启自动时间戳
    protected $createTime='create_time';//创建时间字段
    protected $updateTime='update_time';//更新时间字段

}