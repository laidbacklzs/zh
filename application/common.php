<?php

// 应用公共文件
use think\Db;
//获取用户名
if (!function_exists('getUserName')){
    function getUserName($data=[])
    {
     return Db::table('zh_user')->where('id',$data)->value('name');
    }
}
//截取内容
if (!function_exists('getArtContent')){
    function getArtContent($data=[],$start=0,$length=100)
    {

        return mb_substr(strip_tags($data),$start,$length);
    }
}
if (!function_exists('getCateName')){
    function getCateName($data=[])
    {
        return Db::table('zh_article_category')->where('id',$data)->value('name');
    }
}
