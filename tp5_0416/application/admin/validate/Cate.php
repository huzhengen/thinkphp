<?php 
namespace app\admin\validate;
use think\Validate;

class Cate extends Validate{
	protected $rule = [
		'catename' => 'require|max:25|unique:cate',
	];

	protected $message = [
		'catename.unique' => '栏目不能重复',
		'catename.require' => '必须填写栏目名称'
	];
}