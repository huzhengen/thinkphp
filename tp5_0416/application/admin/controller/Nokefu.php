<?php
namespace app\admin\controller;
use think\Controller;

class Nokefu extends Controller{
	//定义控制器初始化方法_initialize，在该控制器的方法调用之前首先执行
	public function _initialize()
	{
		if(session('type') != 1){
			return $this->error('对不起，没有权限', url('admin/admin'));
		}
	}
}