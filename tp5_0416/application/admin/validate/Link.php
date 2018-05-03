<?php 
namespace app\admin\validate;
use think\Validate;

class Link extends Validate{
	//验证规则
    protected $rule = [
        'title' => 'require|max:50|unique:link',
        'url' => 'require|url',
    ];
    //验证提示
    protected $message = [
        'title.unique' => '链接名称不能重复',
        'title.max' => '链接名称不能大于50个字符',
        'title.require' => '链接名称必须填写',
        'url.require' => '链接地址必须填写',
        'url.url' => '无效的url地址',
    ];
}