<?php
namespace app\admin\validate;
use think\Validate;

class Order extends Validate{
	protected $rule = [
		'name' => 'require|max:30',
	];

	protected $message = [
		'name.max' => '姓名',
	];
}