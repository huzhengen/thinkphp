<?php 
namespace app\admin\validate;
use think\Validate;

class Cate extends Validate{
	protected $rule = [
		'catename' => 'require|max:25|unique:cate',
		'keyword' => 'require'
	];

	protected $message = [
		'catename.unique' => '栏目不能重复',
		'catename.max' => '栏目名称不能大于25个字符',
		'catename.require' => '必须填写栏目名称',
		'keyword.require' => '栏目关键词必须填写'
	];

	protected $scene = [
		'edit' => ['catename']
	];
}