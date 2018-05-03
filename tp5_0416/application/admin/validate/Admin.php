<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate{
	protected $rule = [
		'username' => 'require|max:30|unique:admin',
		'password' => 'require|min:1',
	];

	protected $message = [
		'username.unique' => '管理员名称不能重复',
		'username.max' => '管理员名词不能大于5个字符',
		'username.require' => '管理员名词必须填写',
		'password.require' => '密码必须填写',
		'password.min' => '密码不能少于1位',
	];
}