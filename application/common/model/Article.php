<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 17:05
 */

namespace app\common\model;

use think\Model;
class Article extends Model
{
    protected $pk='id';
    protected $table='zh_article';
    protected $autoWriteTimestamp=true;//开启自动时间戳
    protected $createTime='create_time';//创建时间字段
    protected $updateTime='update_time';//更新时间字段

}