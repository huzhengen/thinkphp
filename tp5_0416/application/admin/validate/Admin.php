<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate{
	protected $rule = [
		'username' => 'require|max:30|unique:admin',
		'password' => 'require|min:1',
	];

	protected $message = [
		'username.unique' => '用户名不能重复',
		'username.require' => '用户名必须填写',
		'password.require' => '密码必须填写',
		'password.min' => '密码不能少于1位',
	];
}