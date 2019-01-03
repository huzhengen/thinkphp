<?php
namespace app\admin\validate;
use think\Validate;

class Baoming extends Validate{
	protected $rule = [
		'name' => 'require',
		'tel' => 'require',
	];

	protected $message = [
		'name.require' => '姓名还没填写',
		'tel.require' => '电话还没填写',
	];
}