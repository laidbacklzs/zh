<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 14:42
 */

namespace app\common\model;

use think\Model;
class User extends Model
{
    protected $pk='id';//主键
    protected $table='zh_user';//数据表
    //密码采用sha1加密
    protected function setPasswordAttr($value=[])
    {
        return sha1($value);
    }
    protected function getStatusAttr($value=[])
    {
        $status=['1'=>'启用','0'=>'停用'];
        return$status[$value];
    }

}