<?php 
namespace app\admin\validate;
use think\Validate;

class Article extends Validate{
	protected $rule = [
		'title' => 'require|max:50|unique:article'
	];

	protected $message = [
		'title.unique' => '文章名称不能重复',
		'title.max' => '文章名称不能大于50个字符',
		'title.require' => '文章名称必须填写'
	];
}