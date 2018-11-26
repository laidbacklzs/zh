<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 17:02
 */

namespace app\common\validate;

use think\Validate;
class User extends Validate
{
    protected $rule = [
        'name|姓名'=>'require|length:3,20|chsAlphaNum',
        'email|邮箱'=>'require|email|unique:zh_user',
        'mobile|手机号码'=>'require|mobile|unique:zh_user',
        'password|密码'=>'require|length:6,20|alphaNum|confirm',
    ];
}