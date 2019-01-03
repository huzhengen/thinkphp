<?php
namespace app\admin\validate;
use think\Validate;

class Order extends Validate{
	protected $rule = [
		'name' => 'require|max:30',
		'qudao' => 'require|max:30',
	];

	protected $message = [
		'name.require' => '姓名不能为空',
		'qudao.require' => '请选择渠道',
	];
}