<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/31
 * Time: 16:33
 */

namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule=[
        'title|标题'=>'require|length:3,60',
        'content|内容'=>'require',
//        'title_img|图片'=>'require',
        'user_id|作者'=>'require',
        'cate_id|栏目名称'=>'require',
    ];

}