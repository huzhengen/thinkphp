<?php
namespace app\admin\validate;
use think\Validate;

class Ketang extends Validate{
	protected $rule = [
		'title' => 'require',
		'ketangtime' => 'require',
	];

	protected $message = [
		'title.require' => '标题还没填写',
		'ketangtime.require' => '时间还没填写',
	];
}